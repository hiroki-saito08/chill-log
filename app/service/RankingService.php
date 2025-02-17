<?php

namespace App\Services;

use App\Models\Ranking;

class RankingService
{
  public function getRanking($type)
  {
    return Ranking::where('rank_type', $type)
      ->orderBy('position', 'asc')
      ->with('post')
      ->get();
  }
}
