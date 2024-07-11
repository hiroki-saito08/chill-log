<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaveLastVisitedUrl
{
    public function handle(Request $request, Closure $next)
    {
        // headerの中にある 「referer」 が前ページのURLを持っているため取得する
        $referer = $request->headers->get('referer');

        // 前のURLが存在し、同じホスト内のURLであることを確認してからセッションに保存
        if ($referer && parse_url($referer, PHP_URL_HOST) === $request->getHost()) {
            $request->session()->put('previous_url', $referer);
        }

        return $next($request);
    }
}
