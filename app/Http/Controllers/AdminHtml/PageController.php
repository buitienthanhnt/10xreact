<?php

namespace App\Http\Controllers\AdminHtml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $request;

    function __construct(
        Request $request
    )
    {
        $this->request = $request;
    }

    public function list() : \Illuminate\Contracts\View\View {
        // dd($this->request->all());
        return view('adminhtml.pages.pageView.list');
    }

    function create() : \Illuminate\Contracts\View\View {
        return view('adminhtml.pages.pageView.create');
    }
}
