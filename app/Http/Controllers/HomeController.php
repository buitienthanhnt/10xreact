<?php

namespace App\Http\Controllers;

use App\Models\Api\PageApi;
use App\Models\Api\WriterApi;
use App\Models\Category;
use App\Models\Page;
use App\Models\Types\CategoryInterface;
use App\Models\Types\PageInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

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
        return Inertia::render('Screen/PageScreen/Detail', [
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
        return Inertia::render('Screen/PageScreen/List', $page);
    }

    /**
     * list render of writer.
     */
    public function account()
    {
        /**
         * list of writer pagination
         * @var \Illuminate\Pagination\LengthAwarePaginator $writers
         */
        $writers = $this->writerApi->writerPagination(6);
        return Inertia::render('Screen/Writer/WriterList', $writers);
    }

    /**
     * controller for detail of writer and list page of writer.
     */
    public function writerDetail(int $id)
    {
        $writer = $this->writerApi->getById($id);
        $pages = $writer->pages()->paginate(6);
        return Inertia::render('Screen/Writer/WriterDetail', [
            'writer' => $writer,
            'pages' => $pages
        ]);
    }

    public function docs(): Response
    {
        $allCategory = Category::all();
        return Inertia::render('Screen/CategoryScreen/Docs', [
            'categories' => $allCategory
        ]);
    }

    public function about()
    {
        return Inertia::render('Screen/Category', [
            "items" => []
        ]);
        return Inertia::render('About', [
            "value" => 123
        ]);
    }

    public function category(string $category = '')
    {
        $categoryByAlias = Category::where(CategoryInterface::ALIAS, $category)->first();

        return Inertia::render('Screen/PageScreen/PagesByCategory', [
            "category" => $categoryByAlias,
            'pages' => $categoryByAlias->pages()->paginate(6)
        ]);
    }
}
