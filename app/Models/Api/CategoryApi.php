<?php

namespace App\Models\Api;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

final class CategoryApi
{

	protected $category;

	public function __construct(
		Category $category
	) {
		$this->category = $category;
	}

	/**
	 * @param int $limit
	 * @return LengthAwarePaginator
	 */
	function paginate(int $limit = 12)
	{
		return $this->category->paginate($limit);
	}
}
