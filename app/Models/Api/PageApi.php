<?php

namespace App\Models\Api;

use App\Models\Page;

class PageApi
{
	protected $page;

	function __construct(
		Page $page
	) {
		$this->page = $page;
	}

	/**
	 * get all items of paper
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function listPage()
	{
		return $this->page->all();
	}

	/**
	 * @var int $limit
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 */
	function pagePaginate($limit = 12)
	{
		return $this->page->paginate($limit);
	}
}
