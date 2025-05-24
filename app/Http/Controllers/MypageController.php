<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\MypageService;
use App\Http\Requests\UpdateProfileRequest;
use App\Helpers\NgWordFilter;
use App\Models\User;

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
        return Inertia::render('ChillPages/Mypage', [
            ...$this->mypageService->getMypageData(),
            'categories' => config('categories')
        ]);
    }

    // 各ユーザーの詳細画面
    public function show($id)
    {
        $user = User::with('posts.images')->findOrFail($id);

        return Inertia::render('ChillPages/UserProfile', [
            'user' => $user,
            'posts' => $user->posts()->with('images', 'reviews')->latest()->paginate(6),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        // NGワードチェック
        $checkFields = ['name', 'bio'];
        foreach ($checkFields as $field) {
            $value = $request->input($field);

            if (filled($value) && NgWordFilter::containsNgWord($value)) {
                return back()->withErrors([$field => 'Contains inappropriate language.']);
            }
        }

        $user = auth()->user();

        $this->mypageService->updateProfile($user, $request->validated());

        return back()->with('message', 'Profile updated successfully.');
    }
}
