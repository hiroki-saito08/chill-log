<?php

namespace App\Services;

use App\Repositories\MypageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MypageService
{
  protected $mypageRepository;

  public function __construct(MypageRepository $mypageRepository)
  {
    $this->mypageRepository = $mypageRepository;
  }

  public function getMypageData()
  {
    return [
      'user' => Auth::user(),
      'posts' => $this->mypageRepository->getUserPosts(Auth::id()),
      'favorites' => $this->mypageRepository->getUserFavorites(Auth::id())
    ];
  }

  public function updateProfile($user, $data)
  {
    if (!empty($data['name'])) {
      $user->name = $data['name'];
    }

    if (!empty($data['clear_bio'])) {
      $user->bio = '';
    } elseif (!empty($data['bio'])) {
      $user->bio = $data['bio'];
    }

    if (!empty($data['new_password'])) {
      $user->password = Hash::make($data['new_password']);
    }

    if (!empty($data['profile_image'])) {
      // すでに登録されている画像があれば削除
      if ($user->profile_image) {
        Storage::disk('public')->delete($user->profile_image);
      }

      $path = $data['profile_image']->store('profile_images', 'public');
      $user->profile_image = $path;
    }

    $user->save();
  }
}
