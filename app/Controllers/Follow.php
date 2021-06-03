<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Data_Model;
use App\Models\Follow_Model;
use App\Models\Department_Model;

class Follow extends BaseController
{
  protected $userModel;
  protected $dataModel;
  protected $deptModel;
  protected $skillModel;
  protected $session;

  public function __construct()
  {
    $this->userModel = new User_Model();
    $this->dataModel = new Data_Model();
    $this->deptModel = new Department_Model();
    $this->followModel = new Follow_Model();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
		$session_id = $this->session->get('id');
		$follower_id_find = $this->followModel->where('following_id', $session_id)->select('follower_id')->findAll();
		foreach($follower_id_find as $f){
			$follower_id[] = $f['follower_id'];
		}

		$follower = $this->dataModel->whereIn('id', $follower_id)->findAll();

    $data = [
      'title' => "Follow | Agrifind",
			'follower' => $follower
    ];

    return view('/follow/index', $data);
  }

  public function following()
  {
		$session_id = $this->session->get('id');
		$following_id_find = $this->followModel->where('follower_id', $session_id)->select('following_id')->findAll();
		foreach($following_id_find as $f){
			$following_id[] = $f['following_id'];
		}

		$following = $this->dataModel->whereIn('id', $following_id)->findAll();

    $data = [
      'title' => "Follow | Agrifind",
			'following' => $following
    ];

    return view('/follow/following', $data);
  }


}
