<?php

namespace App\Http\Controllers\AdminHtml;

use App\Helper\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Api\PageApi;
use App\Models\Page;
use App\Models\Types\PageInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use ImageHelper;

    protected $request;
    protected $pageApi;

    function __construct(
        Request $request,
        PageApi  $pageApi
    ) {
        $this->request = $request;
        $this->pageApi = $pageApi;
    }

    public function list(): \Illuminate\Contracts\View\View
    {
        $actions = [
            [
                'type' => 'view',
                'url' => PageInterface::ROUTE_PREFIX . '/detail/',
                'label' => '',
                'icon' => 'preview',
            ],
            [
                'type' => 'edit',
                'url' => PageInterface::ROUTE_PREFIX . '/edit/',
                'label' => '',
                'icon' => 'edit',
            ],
            [
                'type' => 'delete',
                'url' => PageInterface::ROUTE_PREFIX . '/delete/',
                'label' => '',
                'icon' => 'delete',
            ],
        ];

        /**
         * nguyên tắc là truyền 2 giá trị gồm:
         * 1. danh sách khóa hiển thị;
         * 2. danh sách dữ liệu hiển thị theo khóa trên.
         * các tiêu đề đã được chuyển ngữ theo file ngôn ngữ: attr.php
         */
        return view('adminhtml.pages.pageView.list', [
            'attributes' => [
                Page::ID,
                Page::IMAGE_PATH,
                Page::TITLE,
                Page::ALIAS,
                Page::ACTIVE,
            ],
            'pages' => $this->pageApi->pagePaginate(),
            'actions' => $actions
        ]);
    }

    /**
     * @return Illuminate\Http\RedirectResponse | \Illuminate\Contracts\View\View
     */
    function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $dataUploaded = $this->uploadImage($request->file(PageInterface::IMAGE_PATH), dirPath: 'pages');
            dd($dataUploaded);
            return redirect()->back()->with('message', "add success new page: ")->withInput();
        }

        /**
         * create new page row in database by factory.
         */
        // Page::factory()->create();

        return view('adminhtml.pages.pageView.create', [
            'listAttributes' => array_values(PageInterface::FORM_FIELDS)
        ]);
    }

    /**
     * @return Illuminate\Http\RedirectResponse | \Illuminate\Contracts\View\View
     */
    function detail($id, Request $request)
    {
        return view('adminhtml.pages.pageView.detail', []);
    }
}
