<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Data_Model;
use App\Models\Token_Model;
use App\Models\Contact_Model;
use App\Models\Department_Model;

class Auth extends BaseController
{
  protected $userModel;
  protected $dataModel;
  protected $tokenModel;
  protected $contactModel;
  protected $deptModel;
  protected $session;

  public function __construct()
  {
    $this->userModel = new User_Model();
    $this->dataModel = new Data_Model();
    $this->tokenModel = new Token_Model();
    $this->contactModel = new Contact_Model();
    $this->deptModel = new Department_Model();
    $this->session = \Config\Services::session();
  }

  public function login()
  {
    $session_id = $this->session->get('id');
    if ($session_id) return redirect()->to('/profile');

    $data = [
      'title' => 'Login | Agrifind',
      'validation' => \Config\Services::validation()
    ];

    return view('/auth/login', $data);
  }

  public function signup()
  {
    $session_id = $this->session->get('id');
    if ($session_id) return redirect()->to('/profile');

    $data = [
      'title' => 'Sign Up | Agrifind',
      'validation' => \Config\Services::validation()
    ];

    return view('auth/signup', $data);
  }

  public function logout()
  {
    $this->session->destroy();

    return redirect()->to('/auth/login');
  }

  public function registration()
  {
    if (!$this->validate([
      'name' => [
        'rules' => 'required|min_length[3]',
        'errors' => [
          'required' => 'Name is required',
          'min_length' => 'Minimal 3 characters.'
        ]
      ],
      'username' => [
        'rules' => 'required|is_unique[user.username]|regex_match[/^[a-zA-Z0-9_]{1,}$/]',
        'errors' => [
          'required' => 'Email is required',
          'is_unique' => 'Email is taken',
          'regex_match' => 'Only letter, number and _'
        ]
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Password is required',
        ]
      ],
      'passconf' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'Confirm your password!',
          'matches' => "Your password doesn't match"
        ]
      ],
      'termcond' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'You need to agree to term and condition!'
        ]
      ]

    ])) {
      return redirect()->to('/auth/signup')->withInput();
    }

    $email = $this->request->getVar('username') . "@apps.ipb.ac.id";

    //hash password
    $password = $this->request->getVar('password');
    $hash = password_hash($password, PASSWORD_DEFAULT);

    //first letter name capital turn capital
    $name = strtolower($this->request->getVar('name'));
    $name = ucwords($name);

    // save data at user table
    $this->userModel->save([
      'name' => $name,
      'email' => $email,
      'username' => $this->request->getVar('username'),
      'password' => $hash,
      'is_active' => 0,
      'is_setup' => 0,
    ]);

    //create token for activation
    $token = base64_encode(random_bytes(32));
    $user_token = [
      'email' => $email,
      'token' => $token,
      'date_created' => time()
    ];

    //save new activation token
    $this->tokenModel->save($user_token);

    //send email to verify
    $this->_sendEmail($token, 'verify');

    //alert for succcessful account creation
    session()->setFlashdata(
      'success_account',
      '<div class="alert alert-success" role="alert">
        Your account has been successfully signed up! Please activate your account. Activation link expires in 24 hours.
      </div>'
    );

    return redirect()->to('/auth/login');
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol' => 'smtp',
      'SMTPHost' => 'smtp.gmail.com',
      'SMTPUser' => 'agrifind.ipb@gmail.com',
      'SMTPPass' => 'rahmangofud123',
      'SMTPPort' => 465,
      'SMTPCrypto' => 'ssl',
      'mailType' => 'html',
      'charset' =>  'utf-8',
      'newline' =>  "\r\n"
    ];

    $user_email = $this->request->getVar('username') . "@apps.ipb.ac.id";
    $user_name = $this->request->getVar('username');

    $email = \Config\Services::email();

    $email->initialize($config);
    $email->setFrom('agrifind.ipb@gmail.com', 'Agrifind Admin');
    $email->setTo('agrifind.ipb@gmail.com');

    if ($type == 'verify') {
      $email->setSubject('Agrifind Account Activation');
      $email->setMessage(
        
        '<div style="background:#16694A;border:1px solid #ccc;padding:5px 10px;"><span style="color:#FFFFFF;"><strong><span style="font-family:arial,helvetica,sans-serif;">Agrifind</span></strong></span></div>

        <h2><span style="font-family:arial,helvetica,sans-serif;">Account Activation ['.$user_name.']</span></h2>
        
        <p><span style="font-family:arial,helvetica,sans-serif;">Hello '.$user_name.',</span></p>
        
        <p><span style="font-family:arial,helvetica,sans-serif;">Please click the button below to <strong>activate your account</strong>.</span></p>
        
        <p><span style="font-family:arial,helvetica,sans-serif;"><a href="' . base_url() . '/auth/verify?email=' . $user_email . '&token=' . urlencode($token) . '"><button>Activate</button><a></span></p>
        <p>&nbsp;</p>
        <p><span style="font-family:arial,helvetica,sans-serif;">If you did not create an account, no further action required</span></p>
        <p><span style="font-family:arial,helvetica,sans-serif;">Link expires in 24 hours</span></p>
        
        <p><span style="font-family:arial,helvetica,sans-serif;">Best Regard,<br />
        Agrifind Team.</span></p>
        
        <hr />
        <p><span style="font-family:arial,helvetica,sans-serif;">If you are having trouble clicking the button above, open the URL below<br />
        ' . base_url() . '/auth/verify?email=' . $user_email . '&token=' . urlencode($token) . '</span></p>

        Activate your account: <br><a href="' . base_url() . '/auth/verify?email=' . $user_email . '&token=' . urlencode($token) . '">Activate<a>'
      );

      $email->send();
    } else if ($type == 'forgot') {
      $email->setSubject('Agrifind Change Password');
      $email->setMessage(
        '<div style="background:#16694A;border:1px solid #ccc;padding:5px 10px;"><span style="color:#FFFFFF;"><strong><span style="font-family:arial,helvetica,sans-serif;">Agrifind</span></strong></span></div>

        <h2><span style="font-family:arial,helvetica,sans-serif;">Forgot Password ['.$user_name.']</span></h2>
        
        <p><span style="font-family:arial,helvetica,sans-serif;">Hello '.$user_name.',</span></p>
        
        <p><span style="font-family:arial,helvetica,sans-serif;">Please click the button below to <strong>change your password</strong>.</span></p>
        
        <p><span style="font-family:arial,helvetica,sans-serif;"><a href="' . base_url() . '/auth/changePassword?email=' . $user_email . '&token=' . urlencode($token) . '"><button>Change</button><a></span></p>
        <p>&nbsp;</p>
        <p><span style="font-family:arial,helvetica,sans-serif;">If you do not want to change your password, no further action required</span></p>
        <p><span style="font-family:arial,helvetica,sans-serif;">Link expires in 24 hours</span></p>
        
        <p><span style="font-family:arial,helvetica,sans-serif;">Best Regard,<br />
        Agrifind Team.</span></p>
        
        <hr />
        <p><span style="font-family:arial,helvetica,sans-serif;">If you are having trouble clicking the button above, open the URL below<br />
        ' . base_url() . '/auth/changePassword?email=' . $user_email . '&token=' . urlencode($token) . '</span></p>

        Change your password: 
        <br><a href="' . base_url() . '/auth/changePassword?email=' . $user_email . '&token=' . urlencode($token) . '">Change<a>'
      );

      $email->send();
    }
  }

  public function verify()
  {
    $email = $this->request->getGet('email');
    $token = $this->request->getGet('token');

    $user = $this->userModel->where('email', $email)->first();
    $user_id = $user['id'];

    if ($user) {

      $user_token = $this->tokenModel->where('token', $token)->first();

      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) { //token successful, not expired
          $this->userModel->where('email', $email)->set(['is_active' => 1])->update(); //update active status

          $this->tokenModel->where('token', $token)->delete(); //delete token

          session()->setFlashdata(
            'success_account',
            '<div class="alert alert-success" role="alert">
                Account activation successful! Please login :)
            </div>'
          );

          $this->dataModel->insert([
            'id' => $user_id,
            'name' => $user['name'],
            'username' => $user['username'],
            ''
          ]);

          $this->contactModel->insert([
            'id' => $user_id,
          ]);


          return redirect()->to('/auth/login');
        } else { //token expired
          $this->userModel->where('email', $email)->delete();
          $this->tokenModel->where('token', $token)->delete();

          session()->setFlashdata(
            'success_account',
            '<div class="alert alert-danger" role="alert">
                Account activation failed! Token expired :(
            </div>'
          );
          return redirect()->to('/auth/login');
        }
      } else { //token invalid
        session()->setFlashdata(
          'success_account',
          '<div class="alert alert-danger" role="alert">
              Account activation failed! Token invalid :(
          </div>'
        );

        return redirect()->to('/auth/login');
      }
    } else { //wrong email for activaiton
      session()->setFlashdata(
        'success_account',
        '<div class="alert alert-danger" role="alert">
            Account activation failed! Wrong email :(
        </div>'
      );

      return redirect()->to('/auth/login');
    }
  }

  public function forgot()
  {
    $data = [
      'title' => 'Forgot Password',
      'validation' => \Config\Services::validation()
    ];

    return view('/auth/forgot', $data);
  }

  public function forgotPassword()
  {
    if (!$this->validate([
      'username' => [
        'rules' => 'required|regex_match[/^[a-zA-Z0-9_]{1,}$/]',
        'errors' => [
          'required' => 'Email is required',
          'regex_match' => 'Invalid email'
        ]
      ],

    ])) {
      return redirect()->to('/auth/forgot')->withInput();
    }

    $username = $this->request->getVar('username');
    $email = $this->request->getVar('username') . "@apps.ipb.ac.id";

    $user = $this->userModel->where('username', $username)->first();

    // dd($username, $email, $user);

    if ($user) { //user is available
      if($user['is_active'] == 0){
        session()->setFlashdata(
          'forgot_message',
          '<div class="alert alert-warning" role="alert">
          Activate your account.
          </div>'
        );
  
        return redirect()->to('/auth/forgot');
      }

      //create token for activation
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      //save new activation token
      $this->tokenModel->save($user_token);

      //send email to verify
      $this->_sendEmail($token, 'forgot');

      //alert for succcessful account creation
      session()->setFlashdata(
        'forgot_message',
        '<div class="alert alert-success" role="alert">
        Email successfully sent! Check your email to change your password. Link expires in 24 hours.
        </div>'
      );

      return redirect()->to('/auth/forgot');
    } else { // user is unregistered
      //alert for succcessful account creation
      session()->setFlashdata(
        'forgot_message',
        '<div class="alert alert-danger" role="alert">
        Email is not registered! <a href="/auth/signup">Sign up</a> now!
        </div>'
      );

      return redirect()->to('/auth/forgot');
    }
  }

  public function changePassword()
  {
    $email = $this->request->getGet('email');
    $token = $this->request->getGet('token');

    
    $user = $this->userModel->where('email', $email)->first();
    // dd($email, $token, $user);

    if ($user) {

      $user_token = $this->tokenModel->where('token', $token)->first();

      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) { //token successful, not expired
          // $this->tokenModel->where('token', $token)->delete(); //delete token

          $data = [
            'title' => 'Change Password',
            'user' => $user,
            'email' => $email,
            'token' => $token,

            'validation' => \Config\Services::validation()
          ];

          return view('/auth/changePassword', $data);

        } else { //token expired
          $this->tokenModel->where('token', $token)->delete();

          session()->setFlashdata(
            'success_account',
            '<div class="alert alert-danger" role="alert">
                Change password failed! Token expired :(
            </div>'
          );
          return redirect()->to('/auth/login');
        }
      } else { //token invalid
        session()->setFlashdata(
          'success_account',
          '<div class="alert alert-danger" role="alert">
            Change password failed! Token invalid :(
          </div>'
        );

        return redirect()->to('/auth/login');
      }
    } 
    else { //wrong email for activaiton
      session()->setFlashdata(
        'success_account',
        '<div class="alert alert-danger" role="alert">
          Change password failed! Wrong email :(
        </div>'
      );

      return redirect()->to('/auth/login');
    }
  }

  public function confirmPassword()
  {  
    $user_email = $this->request->getVar('email');
    $token = $this->request->getVar('token');

    if (!$this->validate([
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Password is required',
        ]
      ],
      'passconf' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'Confirm your password!',
          'matches' => "Your password doesn't match"
        ]
      ],
    ])) {
      return redirect()->to('/auth/changePassword?email='.$user_email.'&token='.urlencode($token))->withInput();
    }

    //erase token for password
    $this->tokenModel->where('token', $token)->delete();
    
    //new password hash
    $password = $this->request->getVar('password');
    $hash = password_hash($password, PASSWORD_DEFAULT);

    //update password
    $this->userModel->where('email', $user_email)->set([
      'password' => $hash
    ])->update();

    session()->setFlashdata(
      'success_account',
      '<div class="alert alert-success" role="alert">
      Password successfully changed.
      </div>'
    );

    return redirect()->to('/auth/login');

  }

  public function loginAccount()
  {
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    $user = $this->userModel->where('username', $username)->first();

    if (!$user) {
      session()->setFlashdata( //email unavailable
        'success_account',
        '<div class="alert alert-danger" role="alert">
          Your email is not registered!
        </div>'
      );
      return redirect()->to('/auth/login');
    } else if ($user['is_active'] == 0) { //account in not activated
      session()->setFlashdata(
        'success_account',
        '<div class="alert alert-warning" role="alert">
          Activate your account!
        </div>'
      );
      return redirect()->to('/auth/login');
    } else if (!password_verify($password, $user['password'])) { //wrong password
      session()->setFlashdata(
        'success_account',
        '<div class="alert alert-danger" role="alert">
          Wrong password!
        </div>'
      );
      return redirect()->to('/auth/login');
    }

    $user_data = $this->dataModel->where('username', $username)->first();

    $this->session->set('id', $user_data['id']);
    $this->session->set('username', $user_data['username']);
    $this->session->set('avatar', $user_data['avatar']);

    if ($user['is_setup'] == 0) {
      return redirect()->to('/profile/setup');
    }

    return redirect()->to('/profile');
  }
}
