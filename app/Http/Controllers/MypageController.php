<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\MypageService;

class MypageController extends Controller
{
    protected $mypageService;

    public function __construct(MypageService $mypageService)
    {
        $this->mypageService = $mypageService;
    }

    /**
     * マイページデータを取得（自分の投稿 & お気に入り）
     */
    public function index()
    {
        return Inertia::render('ChillPages/Mypage', $this->mypageService->getMypageData());
    }
}
