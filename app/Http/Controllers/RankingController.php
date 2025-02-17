<?php

namespace App\Http\Controllers;

use App\Services\RankingService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRankingRequest;

class RankingController extends Controller
{
    protected $rankingService;

    public function __construct(RankingService $rankingService)
    {
        $this->rankingService = $rankingService;
    }

    public function index(Request $request)
    {
        return response()->json($this->rankingService->getRanking($request->query('type', 'weekly')));
    }

    public function store(StoreRankingRequest $request)
    {
        return response()->json($this->rankingService->storeRanking($request->validated()));
    }
}
