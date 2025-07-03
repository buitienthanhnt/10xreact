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
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	function listPage()
	{
		return $this->page->all();
	}
}
