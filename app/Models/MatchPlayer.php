<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchPlayer extends Model
{
  use HasFactory;

  protected $fillable = [
    'football_match_id',
    'player_id',
  ];

  public function footballMatch()
  {
    return $this->belongsTo(FootballMatch::class, 'football_match_id', 'id');
  }

  public function player()
  {
    return $this->belongsTo(Player::class);
  }
}
