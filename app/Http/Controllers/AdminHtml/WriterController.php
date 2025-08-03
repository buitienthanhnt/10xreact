<?php

namespace App\Http\Controllers\AdminHtml;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWriterRequest;
use App\Http\Requests\UpdateWriterRequest;
use App\Models\Types\WriterInterface;
use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{

    protected $request;

    function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * danh sach thuoc tinh hien thi.
         */
        $attributes = [
            WriterInterface::ID,
            WriterInterface::NAME,
            WriterInterface::ACTIVE,
            WriterInterface::ALIAS,
        ];

        /**
         * danh sach tinh nang ap dung cho cac chi muc
         * duoc ap dung cho toan bo cac thanh phan.
         */
        $actionItems = [
            [
                'type' => 'view',
                'url' => 'adminhtml/writer/detail/',
                'label' => '',
                'icon' => 'preview',
            ],
            [
                'type' => 'edit',
                'url' => 'adminhtml/writer/edit/',
                'label' => '',
                'icon' => 'edit',
            ],
            [
                'type' => 'delete',
                'url' => 'adminhtml/writer/delete/',
                'label' => '',
                'icon' => 'delete',
            ],
        ];

        /**
         * ap dung phan trang 
         * @var Illuminate\Pagination\LengthAwarePaginator $writerPagiante
         */
        $writerPagiante = Writer::paginate(8);

        /**
         * params about:
         * 1. attributes: danh sach thuoc tinh can hien thi
         * 2. pages: danh sach phan tu hien thi(co the dung truc tiep dang phan trang)
         * 3. actions: danh sach cac nut ho tro tinh nang: them sua xoa.
         */
        return view('adminhtml.pages.writerView.list', [
            'attributes' => $attributes,
            'pages' => $writerPagiante,
            'actions' => $actionItems
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminhtml.pages.writerView.create', [
            'listAttributes' => WriterInterface::FROM_FIELDS
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWriterRequest $request)
    {
        /**
         * @input data of writer create form submit.
         */
        $writerInput = [
            WriterInterface::NAME => $request->get(WriterInterface::NAME),
            WriterInterface::EMAIL => $request->get(WriterInterface::EMAIL),
            WriterInterface::ACTIVE => $request->get(WriterInterface::ACTIVE),
            WriterInterface::ALIAS => $request->get(WriterInterface::ALIAS),
            WriterInterface::PHONE => $request->get(WriterInterface::PHONE),
            WriterInterface::ADDRESS => $request->get(WriterInterface::ADDRESS),
            WriterInterface::DESCRIPTION => $request->get(WriterInterface::DESCRIPTION),
            WriterInterface::DATE_OF_BIRTH => $request->get(WriterInterface::DATE_OF_BIRTH),
        ];

        Writer::factory()->create($writerInput)->save();

        return redirect('adminhtml/writer')->with('message', 'add new writer success!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Writer $writer)
    {
        $writer = $writer->find($id);
        return view('adminhtml.pages.writerView.detail', [
            'writer' => $writer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Writer $writer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWriterRequest $request, Writer $writer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, Writer $writer)
    {
        /**
         * @var Writer $writer
         */
        $writer = $writer->find($id);
        $writer->delete();
        return redirect()->back()->with('message', 'delete success!');
    }
}
