<?php

namespace App\Models;

use CodeIgniter\Model;

class Skill_Model extends Model
{
  protected $table      = 'user_skill';
  protected $allowedFields = [
    'user_id',
    'name',
    'level',
    'created_at'
  ];
}
