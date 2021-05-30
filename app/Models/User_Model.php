<?php

namespace App\Models;

use CodeIgniter\Model;

class User_Model extends Model
{
  protected $table      = 'user';
  protected $allowedFields = [
    'name',
    'email',
    'username',
    'password',
    'is_active',
    'is_setup'
  ];
}
