<?php

namespace App\Models;

use CodeIgniter\Model;

class Data_Model extends Model
{
  protected $table      = 'user_data';
  protected $allowedFields = [
    'id',
    'name',
    'username',
    'nim',
    'department',
    'faculty',
    'batch',
    'about_me',
    'avatar',
    'header',
    'cv',
    'availability',
    'updated_at'
  ];

  public function search($keyword)
  {
    return $this->table('user_data')
      ->like('name', $keyword)
      ->orLike('username', $keyword)
      ->orLike('nim', $keyword)
      ->orLike('department', $keyword)
      ->orLike('faculty', $keyword)
      // ->orLike('availability', $keyword)
      ->orLike('batch', $keyword);
  }
}
