<?php

namespace App\Http\Controllers\AdminHtml;

use App\Http\Controllers\Controller;
use App\Models\Api\PageApi;
use App\Models\Page;
use App\Models\Types\FormInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $request;

    protected $pageApi;

    function __construct(
        Request $request,
        PageApi  $pageApi
    )
    {
        $this->request = $request;
        $this->pageApi = $pageApi;
    }

    public function list() : \Illuminate\Contracts\View\View {
        // dd($this->request->all());
        // dd($this->pageApi->listPage());

        /**
         * nguyên tắc là truyền 2 giá trị gồm:
         * 1. danh sách khóa hiển thị;
         * 2. danh sách dữ liệu hiển thị theo khóa trên.
         * các tiêu đề đã được chuyển ngữ theo file ngôn ngữ: attr.php
         */
        return view('adminhtml.pages.pageView.list', [
            'attributes' => [
                Page::ID,
                Page::TITLE, 
                // Page::DESCRIPTION, 
                Page::IMAGE_PATH, 
                Page::ALIAS, 
                Page::ACTIVE,
            ],
            'pages' => $this->pageApi->listPage()
        ]);
    }

    function create() : \Illuminate\Contracts\View\View {
        /**
         * create new page row in database by factory.
         */
        // Page::factory()->create();
        $listAttributes = [
            ['key' => Page::TITLE, 'type' =>  FormInterface::TYPE_TEXT, 'value' => null],
            ['key' => Page::DESCRIPTION, 'type' =>  FormInterface::TYPE_TEXTAREA],
            ['key' => Page::IMAGE_PATH, 'type' =>  FormInterface::TYPE_TEXT],
            ['key' => Page::ALIAS, 'type' =>  FormInterface::TYPE_TEXT],
            ['key' => Page::ACTIVE, 'type' =>  FormInterface::TYPE_CHECKBOX],
        ];

        return view('adminhtml.pages.pageView.create', [
            'listAttributes' => $listAttributes
        ]);
    }
}
