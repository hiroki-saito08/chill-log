<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class NgWordFilter
{
    public static function containsNgWord(string $text): bool
    {
        $norm = self::normalize($text);
        $terms = Cache::remember('ng_words:v1', 600, function () {
            $path = storage_path('ng_words.txt');
            if (!file_exists($path)) return [];
            $lines = array_filter(array_map('trim', file($path)));
            // 正規化して重複排除
            $lines = array_unique(array_map([self::class, 'normalize'], $lines));
            return array_values(array_filter($lines));
        });

        if (empty($terms) || $norm === '') return false;

        // シンプル版（まずはこれでOK / 後でAho–Corasickに差し替え可）
        foreach ($terms as $w) {
            if ($w !== '' && Str::contains($norm, $w)) {
                return true;
            }
        }
        return false;
    }

    private static function normalize(string $s): string
    {
        // ざっくり正規化：小文字化、全半角統一、空白畳み込み、記号除去
        $s = mb_strtolower($s);
        // 全角→半角（英数・カナ）
        if (class_exists(\Normalizer::class)) {
            // 可能ならUnicode正規化
            $s = \Normalizer::normalize($s, \Normalizer::FORM_KC);
        }
        $s = self::kanaToHiragana($s);
        // 空白・記号の簡易除去
        $s = preg_replace('/\s+/u', '', $s);
        $s = preg_replace('/[^\p{L}\p{N}]+/u', '', $s);
        return $s ?? '';
    }

    private static function kanaToHiragana(string $s): string
    {
        // カタカナ→ひらがな
        return mb_convert_kana($s, 'c', 'UTF-8'); // 'c' = カタカナ→ひらがな
    }
}
