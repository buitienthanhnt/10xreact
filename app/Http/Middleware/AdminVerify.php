<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Adminhtml\DashboardController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $adminUser = Session::get(DashboardController::ADMIN_USER);
        // dd($adminUser);
        if (!$request->session()->get(DashboardController::ADMIN_USER)) {
            // abort(404);
            return redirect('adminhtml/login')->with('message', 'please login before redirect dashboard!');
        }
        return $next($request);
    }
}
