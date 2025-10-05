<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\PageApi;
use App\Models\PageCategory;
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
		// sleep(4);
		return $this->pageApi->getRandom();
	}

	/**
	 * get sugget page by id
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function pageSugget(int $id) {
		/**
		 * @var \App\Models\Page $page
		 */
		$page = $this->pageApi->pageByIds([$id])->first();
		$categories = $page->categories->pluck('id')->toArray();
		$pageIds = PageCategory::whereIn('category_id', $categories)->whereNotIn('page_id', [$id])->latest('page_id')->limit(6)->get('page_id')->toArray();
		return $this->pageApi->pageByIds($pageIds);
	}
}
