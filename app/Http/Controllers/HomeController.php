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
         * inject with writer model, page content, tags data, category value in list value
         * done!
         * @var Page $page
         */
        $page = Page::where(PageInterface::ALIAS, '=', $alias)->with('pageContents')->with('tags')->with('categories')->with('writer')->get()->first();
        return Inertia::render('Screen/PageScreen/Detail', [
            'page' => $page
        ]);
    }

    /**
     * list of all paper.
     */
    public function list(Request $request)
    {
        $page = $this->pageApi->pagePaginate(6);
        $pageFilterType = [
            'label' => 'type list',
            'type' => 'type',
            'data' => $this->pageApi->pageFilters(),
        ];

        $catPage = [
            'label' => 'categories',
            'type' => 'cat',
            'data' => [
                ['value' => '1', 'label' => 'trong nước',],
                ['value' => '2', 'label' => 'truyện tranh', 'selected' => true],
                ['value' => '3', 'label' => 'truyện ngắn'],
                ['value' => '4', 'label' => 'tiểu thuyết'],
            ],
        ];
        return Inertia::render('Screen/PageScreen/List', [
            ...$page->toArray(),
            'filters' =>[
                $pageFilterType, $catPage
            ],
        ]);
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

    /**
     * list of categories
     */
    public function docs(): Response
    {
        $allCategory = Category::all();
        return Inertia::render('Screen/CategoryScreen/Docs', [
            'categories' => $allCategory
        ]);
    }

    /**
     * detail for category and list page of category
     */
    public function category(string $category = '')
    {
        $categoryByAlias = Category::where(CategoryInterface::ALIAS, $category)->first();

        return Inertia::render('Screen/PageScreen/PagesByCategory', [
            "category" => $categoryByAlias,
            'pages' => $categoryByAlias->pages()->paginate(6)
        ]);
    }

    /**
     * demo for video player.
     */
    public function about()
    {
        return Inertia::render('Detail');
    }

    function Signature(Request $request): void
    {
        /**
         * check authenticate for request.
         */
        if (!$request->hasValidSignature()) {
            abort('403');
        };

        /**
         * create link with authenticate and live time.
         */
        $link = \Linkeys\UrlSigner\Facade\UrlSigner::generate(action([HomeController::class, 'list']), ['id' => 1], '+1 hours', 1);
        echo $link->getFullUrl();
        // return Inertia::render('Detail', [
        //     "value" => 123,
        //     "once_link" =>  '/' // $link->getFullUrl()
        // ]);
    }

    public function tag($value, Request $request)
    {
        return Inertia::render('Screen/PageScreen/PageByTag', [
            'tag' => $value,
            'pages' => $this->pageApi->pageByTag($value)
        ]);
    }
}
