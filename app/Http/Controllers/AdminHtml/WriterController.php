<?php

namespace App\Http\Controllers\AdminHtml;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWriterRequest;
use App\Http\Requests\UpdateWriterRequest;
use App\Models\Types\FormInterface;
use App\Models\Types\WriterInterface;
use App\Models\Writer;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adminhtml.pages.writerView.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminhtml.pages.writerView.create', [
            'listAttributes' => [
                ['key' => WriterInterface::NAME, 'type' => FormInterface::TYPE_TEXT, 'label' => 'tên tác giả'],
                ['key' => WriterInterface::EMAIL, 'type' => FormInterface::TYPE_EMAIL],
                ['key' => WriterInterface::ACTIVE, 'type' => FormInterface::TYPE_CHECKBOX],
                ['key' => WriterInterface::ALIAS, 'type' => FormInterface::TYPE_TEXT, 'label' => 'but danh'],
                ['key' => WriterInterface::PHONE, 'type' => FormInterface::TYPE_PHONE, 'label' => 'sdt'],
                ['key' => WriterInterface::ADDRESS, 'type' => FormInterface::TYPE_TEXT,],
                ['key' => WriterInterface::IMAGE_PATH, 'type' => FormInterface::TYPE_FILE],
                ['key' => WriterInterface::DESCRIPTION, 'type' => FormInterface::TYPE_TEXTAREA],
                ['key' => WriterInterface::DATE_OF_BIRTH, 'type' => FormInterface::TYPE_DATE, 'label' => 'ngay sinh']
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWriterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Writer $writer)
    {
        //
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
    public function destroy(Writer $writer)
    {
        //
    }
}
