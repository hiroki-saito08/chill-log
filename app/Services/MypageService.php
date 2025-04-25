<?php

namespace App\Services;

use App\Repositories\MypageRepository;
use Illuminate\Support\Facades\Auth;

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
}
