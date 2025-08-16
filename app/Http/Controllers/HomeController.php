<?php

namespace App\Http\Controllers;

use App\Models\Api\PageApi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    protected $request;
    protected $pageApi;

    public function __construct(
        Request $request,
        PageApi $pageApi,
    )
    {
        $this->request = $request;
        $this->pageApi = $pageApi;
    }

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
        $page = $this->pageApi->pagePaginate(4);
        return Inertia::render('List', $page);
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
