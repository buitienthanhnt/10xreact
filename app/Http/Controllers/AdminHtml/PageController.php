<?php

namespace App\Http\Controllers\AdminHtml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function __construct()
    {

    }

    public function list() : \Illuminate\Contracts\View\View {
        return view('adminhtml.pages.pageView.list');
    }
}
