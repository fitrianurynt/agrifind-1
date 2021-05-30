<?php

namespace App\Models;

use CodeIgniter\Model;

class Achievement_Model extends Model
{
  protected $table      = 'user_achievement';
  protected $allowedFields = [
    'user_id',
    'name',
    'field',
    'rank',
    'organiser',
    'description',
    'created_at'
  ];

  public function rank($id)
  {
    $competition_rank = ["First", "Second", "Third", "Favorite", "Honorable Mention", "Participate", "Other"];
    foreach ($competition_rank as $c){
      $query = $this->table('user_achievement')->where('user_id', $id)->where('rank', $c)->findAll();
      $rank[] = sizeof($query);
    }

    return $rank;
  }
}
