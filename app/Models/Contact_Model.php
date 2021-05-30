<?php

namespace App\Models;

use CodeIgniter\Model;

class Contact_Model extends Model
{
  protected $table      = 'user_contact';
  protected $allowedFields = [
    'id',
    'website',
    'phone',
    'mail',
    'whatsapp',
    'twitter',
    'instagram',
    'facebook',
    'linkedin',
    'reddit',
    'github'
  ];
}
