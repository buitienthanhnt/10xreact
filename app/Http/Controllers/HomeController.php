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

    function detail()
    {
        return Inertia::render('Detail', [
            "value" => 123
        ]);
    }

    function list()
    {
        return Inertia::render('List', [
            "value" => 123
        ]);
    }
}
