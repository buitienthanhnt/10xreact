<?php

namespace App\Http\Controllers;

use App\Models\Api\PageApi;
use App\Models\Api\WriterApi;
use App\Models\Page;
use App\Models\Types\PageInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    protected $request;

    protected $pageApi;
    protected $writerApi;

    public function __construct(
        Request $request,
        PageApi $pageApi,
        WriterApi $writerApi,
    ) {
        $this->request = $request;
        $this->pageApi = $pageApi;
        $this->writerApi = $writerApi;
    }

    public function home()
    {
        return Inertia::render('Home');
    }

    /**
     * detail of paper
     */
    public function detail(string $alias, Request $request)
    {
        /**
         * get page by alias(first of paper by alias)
         * done!
         */
        $page = Page::where(PageInterface::ALIAS, '=', $alias)->get()->first();
        return Inertia::render('Screen/Detail', [
            'page' => $page
        ]);

        // if (!$request->hasValidSignature()) {
        //     abort('403');
        // };
        //  $link = \Linkeys\UrlSigner\Facade\UrlSigner::generate(action([HomeController::class, 'list']), ['id' => 1], '+1 hours', 1);
        // echo $link->getFullUrl();
        // return Inertia::render('Detail', [
        //     "value" => 123,
        //     "once_link" =>  '/' // $link->getFullUrl()
        // ]);
    }

    /**
     * list of all paper.
     */
    public function list(Request $request)
    {
        $page = $this->pageApi->pagePaginate(6);
        return Inertia::render('List', $page);
    }

    /**
     * list render of writer.
     */
    public function account() {
        $writers = $this->writerApi->writerPagination(6);
        return Inertia::render('Screen/Writers', $writers);
    }

    public function writerDetail(int $id) {
        $writer = $this->writerApi->getById($id);
        return Inertia::render('Screen/Writer/WriterDetail', [
            'writer' => $writer,
            'pages' => $writer->pages
        ]);
    }

    public function about()
    {
        return Inertia::render('About', [
            "value" => 123
        ]);
    }

    public function category()
    {
        return Inertia::render('Screen/Category', [
            "items" => []
        ]);
    }
}
