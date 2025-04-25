<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\MypageService;
use App\Http\Requests\UpdateProfileRequest;

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
        $user->bio = $request->input('bio');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
