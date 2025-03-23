<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd(auth()->user()); // ここでユーザー情報を確認
        // ログインしているユーザーが管理者か確認
        if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

        // 管理者以外はアクセスを許可しない
        return redirect()->route('items.index')->with('error', '管理者のみがアクセスできます。');
    }
}
