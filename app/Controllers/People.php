<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Data_Model;
use App\Models\Contact_Model;
use App\Models\Skill_Model;
use App\Models\Achievement_Model;
use App\Models\Department_Model;

class People extends BaseController
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

    $currentPage = $this->request->getVar('page_user_data') ? $this->request->getVar('page_user_data') : 1;

    $keyword = $this->request->getVar('keyword');

    if ($keyword || $keyword != null) {
      $people = $this->dataModel->orderBy('availability ASC, name ASC')->search($keyword);
    } else {
      $people = $this->dataModel->orderBy('availability ASC, name ASC');
    }

    $data = [
      'title' => "People | Agrifind",
      'user' => $people->paginate(2, 'user_data'),
      'pager' => $this->dataModel->pager,
      'currentPage' => $currentPage,
      'keyword' => $keyword
    ];

    $session_id = $this->session->get('id');

    return view('/people/index', $data);
  }
}
