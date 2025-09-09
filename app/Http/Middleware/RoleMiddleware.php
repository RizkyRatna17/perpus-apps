<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    //... adalah variadic parameter bisa memanggil beberapa parameter
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        // jika yang akses bukan user dan
        if (!$request->user() || $request->user()->hasAnyRole($role)) {
            Alert::error('Upss', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->to('dashboard');

        }
        return $next($request);
    }
}
