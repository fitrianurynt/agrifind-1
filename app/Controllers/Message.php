<?php

namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Data_Model;
use App\Models\Follow_Model;
use App\Models\Message_Model;

class Message extends BaseController
{
  protected $userModel;
  protected $dataModel;
  protected $followModel;
  protected $messageModel;
  protected $session;

  public function __construct()
  {
    $this->userModel = new User_Model();
    $this->dataModel = new Data_Model();
    $this->followModel = new Follow_Model();
    $this->messageModel = new Message_Model();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Message | Agrifind',
      'message' => $this->messageModel->where('receiver_id', $session_id)->where('delete_receiver', 0)->orderBy('created_at DESC')->paginate(25, 'user_message'),
      'pager' => $this->messageModel->pager
    ];

    return view('/message/index', $data);
  }

  public function send()
  {
    $session_id = $this->session->get('id');

    $data = [
      'title' => 'Message | Agrifind',
      'message' => $this->messageModel->where('sender_id', $session_id)->where('delete_sender', 0)->orderBy('created_at DESC')->paginate(25, 'user_message'),
      'pager' => $this->messageModel->pager
    ];

    return view('/message/send', $data);
  }

  public function deleteReceiver($id)
  {
    $message = $this->messageModel->where('id', $id)->first();

    if($message['delete_sender'] == 1) $this->messageModel->where('id', $id)->delete();
    else {
      $this->messageModel->where('id', $id)->set([
        'delete_receiver' => 1
      ])->update();
    }

    return redirect()->to('/message');
  }

  public function deleteSender($id)
  {
    $message = $this->messageModel->where('id', $id)->first();

    if($message['delete_receiver'] == 1) $this->messageModel->where('id', $id)->delete();
    else {
      $this->messageModel->where('id', $id)->set([
        'delete_sender' => 1
      ])->update();
    }

    return redirect()->to('/message/send');
  }


}
