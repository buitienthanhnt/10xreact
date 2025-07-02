<?php

namespace App\Http\Controllers\AdminHtml;

use App\Http\Controllers\Controller;
use App\Models\Page;
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
        /**
         * create new page row in database by factory.
         */
        Page::factory()->create();

        return view('adminhtml.pages.pageView.create');
    }
}
