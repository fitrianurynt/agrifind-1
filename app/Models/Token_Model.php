<?php

namespace App\Models;

use CodeIgniter\Model;

class Token_Model extends Model
{
  protected $table      = 'user_token';
  protected $allowedFields = [
    'email', 
    'token', 
    'date_created', 
  ];
}
