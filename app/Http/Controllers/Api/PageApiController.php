<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\PageApi;
use Illuminate\Http\Request;

final class PageApiController extends Controller
{
	protected $pageApi;

	public function __construct(
		PageApi $pageApi,
	) {
		$this->pageApi = $pageApi;
	}

	public function related() {}

	/**
	 * 
	 */
	public function pageByIds(Request $request) {
		$pageIds = $request->get('ids');
		return $this->pageApi->pageByIds(explode(',', $pageIds));
	}

	/**
	 * get random pages.
	 */
	function pageRandom() {
		// sleep(3);
		return $this->pageApi->getRandom();
	}
}
