<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $rank_type = $request->query('type', 'weekly'); // デフォルトは weekly
        $rankings = Ranking::where('rank_type', $rank_type)
            ->orderBy('position', 'asc')
            ->with('post')
            ->get();

        return response()->json($rankings);
    }
}
