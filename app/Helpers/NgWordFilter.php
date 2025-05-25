<?php

namespace App\Helpers;

class NgWordFilter
{
  public static function containsNgWord(string $text): bool
  {
    $text = mb_strtolower($text);

    $ngWords = [
      // 英語
      'fuck',
      'shit',
      'bitch',
      'asshole',
      'pussy',
      'dick',
      'sex',
      'suck',
      // 日本語
      'くそ',
      'ちくしょう',
      'しね',
      'やりまん',
      'やりちん',
      'まんこ',
      'ちんこ',
      'うんこ',
      'きちがい'
    ];

    foreach ($ngWords as $word) {
      if (str_contains($text, $word)) {
        return true;
      }
    }

    return false;
  }
}
