<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    function home()
    {
        return Inertia::render('Home');
    }

    function detail(Request $request)
    {
        // if (!$request->hasValidSignature()) {
        //     abort('403');
        // };
        //  $link = \Linkeys\UrlSigner\Facade\UrlSigner::generate(action([HomeController::class, 'list']), ['id' => 1], '+1 hours', 1);
        // echo $link->getFullUrl();
        return Inertia::render('Detail', [
            "value" => 123,
            "once_link" =>  '/' // $link->getFullUrl()
        ]);
    }

    function list(Request $request)
    {
        return Inertia::render('List', [
            "currentPage" => (int) $request->get('page') ?: 1,
            "pageSize" => 14
        ]);
    }

    function about()
    {
        return Inertia::render('About', [
            "value" => 123
        ]);
    }

    function category()
    {
        return Inertia::render('Screen/Category', [
            "items" => []
        ]);
    }
}
