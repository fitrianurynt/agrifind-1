<?php

namespace App\Models;

use CodeIgniter\Model;

class Message_Model extends Model
{
  protected $table      = 'user_message';
  protected $allowedFields = [
    'sender_id',
    'receiver_id',
    'sender_name',
    'receiver_name',
    'subject',
    'message',
    'delete_sender',
    'delete_receiver',
    'created_at'
  ];
}
