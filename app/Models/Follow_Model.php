<?php

namespace App\Models;

use CodeIgniter\Model;

class Follow_Model extends Model
{
  protected $table      = 'user_follow';
  protected $allowedFields = [
    'follower_id',
    'following_id',
  ];
}
