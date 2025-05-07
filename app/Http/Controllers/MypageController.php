<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\MypageService;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;

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

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $this->mypageService->updateProfile($user, $request->validated());

        return back()->with('message', 'Profile updated successfully.');
    }
}
