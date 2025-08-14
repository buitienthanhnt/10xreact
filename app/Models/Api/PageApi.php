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

	function register($data = [])
	{
		/**
		 * format data for model factory by : FILLED_FILEDS và $data input.
		 */
		$modelData = array_intersect_key( // so sánh 2 mảng và trả về mảng có khóa chung
			$data,
			array_flip($this->page::FILLED_FILEDS) // đảo ngược khóa và gía trị. trong mảng 1 chiều nó sẽ nhận giá trị là index số : 0,1,2,3
		);
		return $this->page->factory()->create($modelData)->save();
	}
}
