<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Data_Model;
use App\Models\Contact_Model;
use App\Models\Skill_Model;
use App\Models\Achievement_Model;
use App\Models\Department_Model;

class Profile extends BaseController
{
  protected $userModel;
  protected $dataModel;
  protected $contactModel;
  protected $deptModel;
  protected $skillModel;
  protected $achieveModel;
  protected $session;

  public function __construct()
  {
    $this->userModel = new User_Model();
    $this->dataModel = new Data_Model();
    $this->contactModel = new Contact_Model();
    $this->deptModel = new Department_Model();
    $this->skillModel = new Skill_Model();
    $this->achieveModel = new Achievement_Model();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'My Profile | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->first(),
      'contact' => $this->contactModel->where('id', $session_id)->first(),
      'skill' => $this->skillModel->where('user_id', $session_id)->findAll(),
      'achieve' => $this->achieveModel->where('user_id', $session_id)->findAll(),
      'rank' => $this->achieveModel->rank($session_id)
    ];

    return view('/profile/index', $data);
  }

  public function setup()
  {
    $session_id = $this->session->get('id');
    $user_setup = $this->userModel->where('id', $session_id)->first()['is_setup'];

    //set up user cannot resetup
    if ($user_setup == 1) return redirect()->to('/profile');

    $data = [
      'title' => 'Setup | Agrifind',
      'user' => $this->dataModel->where('id', $session_id)->first(),

      'validation' => \Config\Services::validation(),
    ];

    return view('/profile/setup', $data);
  }

  public function setupAccount()
  {
    $session_id = $this->session->get('id');
    if (!$this->validate([
      'nim' => [
        'rules' => 'required|regex_match[/[a-kA-K]+[0-9]{8,20}/]',
        'errors' => [
          'required' => 'NIM is required',
          'regex_match' => 'Not a valid IPB NIM'
        ]
      ],
      'batch' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Batch is required',
        ]
      ]
    ])) {
      return redirect()->to('/profile/setup')->withInput();
    }

    //get nim and batch
    $nim = strtoupper($this->request->getVar('nim'));
    $batch = $this->request->getVar('batch');

    //get department and faculty from nim first 2 letter
    $dept = substr($nim, 0, 2);
    $dept = $this->deptModel->where('dept_id', $dept)->select('department, faculty')->first();

    //update data table
    $this->dataModel->where('id', $session_id)->set([
      'nim' => $nim,
      'batch' => $batch,
      'department' => $dept['department'],
      'faculty' => $dept['faculty']
    ])->update();

    //update so account is set up
    $this->userModel->where('id', $session_id)->set([
      'is_setup' => 1
    ])->update();

    //sent message to profile
    session()->setFlashdata(
      'profile_message',
      '<div class="alert alert-success" role="alert">
          Account successfully set up! Enjoy using Agrifind!
      </div>'
    );

    return redirect()->to('/profile');
  }

  public function view($username)
  {
    $session_id = $this->session->get('id');
    if($username == $this->dataModel->where('id', $session_id)->first()['username'])
      return redirect()->to('/profile');

    $user = $this->dataModel->where('username', $username)->first();
    $user_id = $user['id'];

    $data = [
      'title' => 'My Profile | Agrifind',
      'user' => $this->dataModel->where('id', $user_id)->first(),
      'contact' => $this->contactModel->where('id', $user_id)->first(),
      'skill' => $this->skillModel->where('user_id', $user_id)->findAll(),
      'achieve' => $this->achieveModel->where('user_id', $user_id)->findAll(),
      'rank' => $this->achieveModel->rank($user_id)
    ];

    return view('/profile/view', $data);
  }
}
