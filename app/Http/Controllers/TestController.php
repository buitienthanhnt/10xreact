<?php

namespace App\Http\Controllers;

use App\Enums\ViewSourceEnum;
use App\Models\Page;
use App\Models\Types\PageInterface;
use App\Models\Types\ViewSourceInterface;
use App\Models\ViewSource;
use Exception;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $viewSourceApi;

    public function __construct(
        \App\Models\Api\ViewSourceApi $viewSourceApi,
    )
    {
        $this->viewSourceApi = $viewSourceApi;
    }

    public function addViewSource(Request $request) {
        if (!$target_id = $request->get(ViewSourceInterface::TARGET_ID)) {
            throw new Exception("Error Processing Request target_id is requuired!", 1);
            
        }
        return $this->viewSourceApi->addSource(
            target_id: $target_id, 
            action_type: $request->get(ViewSourceEnum::ACTION_TYPE->value, ViewSourceInterface::TYPE_LIKE),
            action: $request->get(ViewSourceEnum::ACTION->value, ViewSourceInterface::ACTION_ADD),
            type: $request->get(ViewSourceInterface::TYPE, PageInterface::MODEL_TYPE),
        );

        // $response = ViewSource::create($request->all());
        // dd($response->{ViewSourceInterface::VALUE});
        // return $response;
    }

    public function getViewSource($page_id) {
        $page = Page::with('source')->find($page_id);
        return $page;
    }
}
