<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{
  public function createReview($userId, $postId, array $data)
  {
    return Review::create(array_merge($data, [
      'user_id' => $userId,
      'post_id' => $postId
    ]));
  }

  public function updateReview(Review $review, array $data)
  {
    // レビュー投稿者のみ更新できるようにする
    if ($review->user_id !== auth()->id()) {
      abort(403, 'You are not authorized to update this review.');
    }

    $review->update($data);
    return $review->refresh();
  }

  public function deleteReview(Review $review)
  {
    // レビュー投稿者のみ削除できるようにする
    if ($review->user_id !== auth()->id()) {
      abort(403, 'You are not authorized to delete this review.');
    }

    $review->delete();
  }
}
