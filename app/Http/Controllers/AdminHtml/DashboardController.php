<?php

namespace App\Http\Controllers\Adminhtml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DashboardController extends Controller
{
    const ADMIN_USER = 'adminUser';

    /**
     *
     */
    function home() : \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory {
        return view('adminhtml.home');
    }

    /**
     *
     */
    function login() : \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory {
        return view('adminhtml.pages.sign-in');
    }

    function logout() : \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse {
        Session::remove(self::ADMIN_USER);
        Session::save();
        return redirect()->to('/adminhtml/login');
    }

    function loginPost(Request $request) : \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse {
        Session::push(self::ADMIN_USER, [
            'name' => 'tha nan',
            "email" => $request->get('email')
        ]);
        Session::save();
        return redirect()->route('dashboard');
    }

}
