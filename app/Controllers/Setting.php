<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Data_Model;
use App\Models\Contact_Model;
use App\Models\Department_Model;
use App\Models\Skill_Model;
use App\Models\Achievement_Model;

class Setting extends BaseController
{
  protected $userModel;
  protected $dataModel;
  protected $contactModel;
  protected $deptModel;
  protected $skillModel;
  protected $achievementModel;
  protected $session;

  public function __construct()
  {
    $this->userModel = new User_Model();
    $this->dataModel = new Data_Model();
    $this->contactModel = new Contact_Model();
    $this->deptModel = new Department_Model();
    $this->skillModel = new Skill_Model();
    $this->achievementModel = new Achievement_Model();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Setting | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->first(),

      'validation' => \Config\Services::validation()
    ];

    return view('/setting/index', $data);
  }

  public function editGeneral()
  {
    $session_id = $this->session->get('id');
    $user = $this->dataModel->where('id', $session_id)->first();

    

    if (!$this->validate([
      'name' => [
        'rules' => 'required|min_length[3]',
        'errors' => [
          'required' => 'Name is required',
          'min_length' => 'Minimal 3 characters.'
        ]
      ],
      'nim' => [
        'rules' => 'required|regex_match[/[a-kA-K]+[0-9]{8,20}/]',
        'errors' => [
          'required' => 'NIM is required',
          'regex_match' => 'Not a valid IPB NIM'
        ]
      ],
      'cv' => [
        'rules' => 'max_size[cv,4096]|mime_in[cv,application/pdf]',
        'errors' => [
          'max_size' => 'File size too large (max: 4MB)',
          'mime_in' => 'Only .pdf format!'
        ]
      ]
    ])) {
      return redirect()->to('/setting/index')->withInput();
    }

    //get nim and find dept
    $nim = strtoupper($this->request->getVar('nim'));
    $dept = $this->deptModel->where('dept_id', substr($nim, 0, 2))->first();

    //if dept not found
    if ($dept) {
      $fac = $dept['faculty'];
      $dept = $dept['department'];
    } else {
      $dept = '';
      $fac = '';
    }

    //cv
    $cv = $this->request->getFile('cv');
    if ($cv->getError() == 4) {
      $cvName = $this->request->getVar('hiddenCV');
    } else {

      $oldCV = $this->request->getVar('hiddenCV');
      if ($oldCV != '') {
        unlink('docs/cv/' . $oldCV);
      }

      //generate nama sampul random
      $cvName = $user['name'] . " (" . $user['username'] . ").pdf";
      //pindahkan file ke folder img
      $cv->move('docs/cv', $cvName);
      //remove old pic

    }
    

    //update data
    $this->dataModel->where('id', $session_id)->set([
      'name' => ucwords(strtolower($this->request->getVar('name'))),
      'nim' => $nim,
      'batch' => $this->request->getVar('batch'),
      'department' => $dept,
      'faculty' => $fac,
      'cv' => $cvName,
      'availability' => $this->request->getVar('availability'),
      'about_me' => $this->request->getVar('about_me'),
    ])->update();

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Your changes are successfully made :)
      </div>'
    );

    return redirect()->to('/setting/index');
  }

  public function deleteCV()
  {
    $session_id = $this->session->get('id');

    $cv = $this->dataModel->where('id', $session_id)->first()['cv'];

    if ($cv != '') {
      unlink('docs/cv/' . $cv);

      $this->dataModel->where('id', $session_id)->set([
        'cv' => ''
      ])->update();
    }
    return redirect()->to("/setting/index")->withInput();
  }

  public function contact()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Setting | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->first(),

      'contact' => $this->contactModel->where('id', $session_id)->first(),

      'validation' => \Config\Services::validation()
    ];

    return view('/setting/contact', $data);
  }

  public function editContact()
  {
    $session_id = $this->session->get('id');



    $this->contactModel->where('id', $session_id)->set([
      'website' => $this->request->getVar('website'),
      'phone' => $this->request->getVar('phone'),
      'mail' => $this->request->getVar('mail'),
      'whatsapp' => $this->request->getVar('whatsapp'),
      'twitter' => $this->request->getVar('twitter'),
      'instagram' => $this->request->getVar('instagram'),
      'facebook' => $this->request->getVar('facebook'),
      'linkedin' => $this->request->getVar('linkedin'),
      'reddit' => $this->request->getVar('reddit'),
      'github' => $this->request->getVar('github'),
    ])->update();


    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Your changes are successfully made :)
      </div>'
    );

    return redirect()->to('/setting/contact');
  }

  public function appearance()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Setting | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->select('avatar, header, name, username, cv')->first(),

      'validation' => \Config\Services::validation()
    ];

    return view('/setting/appearance', $data);
  }

  public function editAppearance()
  {
    $session_id = $this->session->get('id');

    if (!$this->validate([
      'avatar' => [
        'rules' => 'max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'File size too large (max: 1MB)',
          'is_image' => 'Only .jpg, .jpeg, .png format!',
          'mime_in' => 'Only .jpg, .jpeg, .png format!'
        ]
      ],
      'header' => [
        'rules' => 'max_size[header,4096]|is_image[header]|mime_in[header,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'File size too large (max: 4MB)',
          'is_image' => 'Only .jpg, .jpeg, .png format!',
          'mime_in' => 'Only .jpg, .jpeg, .png format!'
        ]
      ],
    ])) {
      return redirect()->to("/setting/appearance")->withInput();
    }

    $avatar = $this->request->getFile('avatar');
    $header = $this->request->getFile('header');

    //profile pic
    if ($avatar->getError() == 4) {
      $avatarName = $this->request->getVar('hiddenAvatar');
    } else {
      //generate nama sampul random
      $avatarName = $avatar->getRandomName();
      //pindahkan file ke folder img
      $avatar->move('img/avatar/', $avatarName);
      //remove old pic
      $oldAvatar = $this->request->getVar('hiddenAvatar');
      if ($oldAvatar != 'default.jpg')
        unlink('img/avatar/' . $oldAvatar);
    }

    //header
    if ($header->getError() == 4) {
      $headerName = $this->request->getVar('hiddenHeader');
    } else {
      //generate nama sampul random
      $headerName = $header->getRandomName();
      //pindahkan file ke folder img
      $header->move('img/header/', $headerName);
      //remove old pic
      $oldHeader = $this->request->getVar('hiddenHeader');
      if ($oldHeader != 'default.jpg')
        unlink('img/header/' . $oldHeader);
    }

    $this->dataModel->where('id', $session_id)->set([
      'avatar' => $avatarName,
      'header' => $headerName
    ])->update();

    $this->session->set('avatar' ,$avatarName);

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Your changes are successfully made :)
      </div>'
    );

    return redirect()->to('/setting/appearance');
  }

  public function skill()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Setting | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->first(),
      'skill' => $this->skillModel->where('user_id', $session_id)->orderBy('created_at DESC')->findAll(),

      'validation' => \Config\Services::validation()
    ];

    return view('/setting/skill', $data);
  }

  public function addSkill()
  {
    $session_id = $this->session->get('id');

    $name = $this->request->getVar('nameSkill');
    $level = $this->request->getVar('levelSkill');

    $this->skillModel->set([
      'user_id' => $session_id,
      'name' => $name,
      'level' => $level,
      'created_at' => time()
    ])->insert();

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Skill successfully added :)
      </div>'
    );

    return redirect()->to('/setting/skill');
  }

  public function editSkill($id)
  {
    $session_id = $this->session->get('id');

    $this->skillModel->where([
      'user_id' => $session_id,
      'id' =>  $id
    ])->set([
      'name' => $this->request->getVar('nameSkillEdit'),
      'level' => $this->request->getVar('levelSkillEdit')
    ])->update();

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Skill successfully edited :)
      </div>'
    );

    return redirect()->to('/setting/skill');
  }

  public function deleteSkill($id)
  {
    $session_id = $this->session->get('id');

    $this->skillModel->where([
      'user_id' => $session_id,
      'id' =>  $id
    ])->delete();

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Skill successfully deleted :)
      </div>'
    );

    return redirect()->to('/setting/skill');
  }

  public function achievement()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Setting | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->first(),
      'achieve' => $this->achievementModel->where('user_id', $session_id)->orderBy('created_at DESC')->findAll(),

      'validation' => \Config\Services::validation()
    ];

    return view('/setting/achievement', $data);
  }

  public function addAchievement()
  {
    $session_id = $this->session->get('id');

    $this->achievementModel->set([
      'user_id' => $session_id,
      'name' => $this->request->getVar('nameAchieve'),
      'field' => $this->request->getVar('fieldAchieve'),
      'rank' => ($this->request->getVar('rankAchieve') == null) ? 'Other' : $this->request->getVar('rankAchieve'),
      'organiser' => $this->request->getVar('organiserAchieve'),
      'description' => $this->request->getVar('descriptionAchieve'),
      'created_at' => time()
    ])->insert();

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Achievement successfully added :)
      </div>'
    );

    return redirect()->to('/setting/achievement');
  }

  public function editAchievement($id)
  {
    $session_id = $this->session->get('id');

    $this->achievementModel->where([
      'user_id' => $session_id,
      'id' => $id
    ])->set([
      'user_id' => $session_id,
      'name' => $this->request->getVar('nameAchieveEdit'),
      'field' => $this->request->getVar('fieldAchieveEdit'),
      'rank' => $this->request->getVar('rankAchieveEdit'),
      'organiser' => $this->request->getVar('organiserAchieveEdit'),
      'description' => $this->request->getVar('descriptionAchieveEdit'),
    ])->update();

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Achievement successfully editted :)
      </div>'
    );

    return redirect()->to('/setting/achievement');
  }

  public function deleteAchievement($id)
  {
    $session_id = $this->session->get('id');

    //delete selected achevement by id
    $this->achievementModel->where([
      'user_id' => $session_id,
      'id' =>  $id
    ])->delete();

    session()->setFlashdata(
      'setting_message',
      '<div class="alert alert-success" role="alert">
        Achievement successfully deleted :)
      </div>'
    );

    return redirect()->to('/setting/achievement');
  }

  public function account()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Setting | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->first(),

      'validation' => \Config\Services::validation()
    ];

    return view('/setting/account', $data);
  }

  public function editPassword()
  {
    $session_id = $this->session->get('id');

    if (!$this->validate([
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Old password is required',
        ]
      ],
      'passnew' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'New password is required',
        ]
      ],
      'passconf' => [
        'rules' => 'required|matches[passnew]',
        'errors' => [
          'required' => 'Confirm your password!',
          'matches' => "Your password doesn't match"
        ]
      ],
    ])) {
      return redirect()->to('/setting/account')->withInput();
    }

    //get current password
    $password = $this->userModel->where('id', $session_id)->first()['password'];

    //get input
    $passold = $this->request->getVar('password');
    $passnew = $this->request->getVar('passnew');

    //check if old password is the same as current
    if (password_verify($passold, $password)) { //success
      $hash = password_hash($passnew, PASSWORD_DEFAULT);
      $this->userModel->where('id', $session_id)->set([
        'password' => $hash,
      ])->update();

      session()->setFlashdata(
        'setting_message',
        '<div class="alert alert-success" role="alert">
          Password successfully changed :)
        </div>'
      );
    } else { //fail, worng old password
      session()->setFlashdata(
        'setting_message',
        '<div class="alert alert-danger" role="alert">
          Password failed to change. Wrong old password :(
        </div>'
      );
    };

    return redirect()->to('/setting/account');
  }

  public function deleteAccount()
  {
    $session_id = $this->session->get('id');

    if (!$this->validate([
      'passdel' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Password is required',
        ]
      ],
    ])) {
      return redirect()->to('/setting/account')->withInput();
    }

    //get current password
    $password = $this->userModel->where('id', $session_id)->first()['password'];

    //get input
    $passdel = $this->request->getVar('passdel');

    //check if old password is the same as current
    if (password_verify($passdel, $password)) { //success

      dd('delete account');

      return redirect()->to('/auth/logout');
    } else { //fail, worng password
      session()->setFlashdata(
        'delete_message',
        '<div class="alert alert-danger" role="alert">
          Delete account failed. Wrong password :(
        </div>'
      );
    };

    return redirect()->to('/setting/account');
  }
}
