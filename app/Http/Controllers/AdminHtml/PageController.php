<?php

namespace App\Http\Controllers\AdminHtml;

use App\Helper\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ShareAction\DeleteAction;
use App\Http\Controllers\ShareAction\UpdateAction;
use App\Models\Api\PageApi;
use App\Models\Page;
use App\Models\Types\FormInterface;
use App\Models\Types\PageContentInterface;
use App\Models\Types\PageInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * custom trait
     */
    use ImageHelper;
    use DeleteAction;
    use UpdateAction;

    protected $request;
    protected $pageApi;
    protected $defaultModel;

    function __construct(
        Request $request,
        PageApi  $pageApi,
        Page $page,
    ) {
        $this->request = $request;
        $this->pageApi = $pageApi;
        $this->defaultModel = $page;
    }

    public function list(): \Illuminate\Contracts\View\View
    {
        $actions = [
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
                Page::ACTIVE,
            ],
            'lists' => $this->pageApi->pagePaginate(),
            'actions' => $actions
        ]);
    }

    /**
     * @return Illuminate\Http\RedirectResponse | \Illuminate\Contracts\View\View
     */
    function create(Request $request)
    {
        /**
         * create new page row in database by factory.
         */
        return view('adminhtml.pages.pageView.create', [
            'listAttributes' => $this->defaultModel->formField(),
            'defaultSupportFields' => json_encode(PageContentInterface::DEFAULT_FIELD_TYPE),
            'contentFields' => json_encode([
                // ['key' => 'a', 'type' => 'text', 'value' => 'demo for textInput', 'label' => 'name', 'placeholder' => 'name for a'],
                // ['key' => 'b', 'type' => 'number', 'value' => null],
                // ['key' => 'c', 'type' => 'checkbox', 'value' => true, 'name' => 'c'],
                // ['key' => 'e', 'type' => 'textarea', 'value' => '123 demo hello'],
                // ['key' => 'g', 'type' => 'textEditor', 'value' => '<h3>123 demo hello</h3>'],
                // ['key' => 'f', 'type' => 'select', 'value' => '320000000', 'options' => \App\Models\Page::writerOptions()],
                // ['key' => 'd', 'type' => 'file', 'value' => 'http://adoc.dev/storage/files/uploads/261479696_1820281014826477_6400419339212881138_n_084353.jpg', 'label' => 'iamge file'],
            ])
        ]);
    }

    /**
     * register new page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $page = Page::factory()->create($this->defaultModel->fillData($request->toArray()));
        // $form = $this->pageContentValue($page->id);
        // dd($form);
        return redirect()->to(PageInterface::ROUTE_PREFIX)->with('message', "add success new page: ".$page->{PageInterface::TITLE});
    }

    protected function pageContentValue(int $page_id): array
    {
        $formValue = [];
        $listKey = explode('|', $this->request->get('key-sort'));
        foreach ($listKey as $key) {
            $type = explode('-', $key, 2)[0];
            $value = $this->request->get($key);
            switch ($type) {
                case FormInterface::TYPE_FILE:
                    if (!$imageUploaded = $this->uploadImage($this->request->file($key), PageContentInterface::SAVED_IMAGE_FOLDER .'/'. $page_id)) {
                        break;
                    }
                    $value = $imageUploaded['public_path'];
                    break;
                    case FormInterface::TYPE_IMAGE_CHOOSE:
                        $value = urlToStoragePath($value) ?: null;
                        break;
                default:
                    break;
            }
            $formValue[] = [
                PageContentInterface::KEY => $key,
                PageContentInterface::VALUE => $value,
                PageContentInterface::EXTEND_VALUE => null,
                PageContentInterface::TYPE => $type,
                PageContentInterface::PAGE_ID => $this->request->get('page_id') ?: $page_id,
            ];
        }
        return $formValue;
    }

    /**
     * @return Illuminate\Http\RedirectResponse | \Illuminate\Contracts\View\View
     */
    function detail($id, Request $request)
    {
        return view('adminhtml.pages.pageView.detail', []);
    }

    public function edit(int $id, Request $request)
    {
        $page = $this->defaultModel->find($id);
        return view('adminhtml.pages.pageView.edit', [
            'method' => 'POST',
            'action' => url("adminhtml/page/update/" . $page->{PageInterface::ID}),
            'listAttributes' => $page->formField(),
        ]);
    }
}
