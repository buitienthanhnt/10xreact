<?php

namespace App\Models\Api;

use App\Models\Page;
use App\Models\PageContent;
use App\Models\Types\PageContentInterface;
use App\Models\Types\PageInterface;
use App\Models\Types\TagInterface;
use Illuminate\Support\Facades\Cache;

class PageApi
{
	/**
	 * @var \App\Models\Page $page
	 */
	protected $page;

	/**
	 * @var \App\Models\Tag $tag
	 */
	protected $tag;

	protected $category;

	/**
	 * \Illuminate\Http\Request $request
	 */
	protected $request;

	protected $cacheHelper;

	function __construct(
		\Illuminate\Http\Request $request,
		\App\Helper\CacheHelper $cacheHelper,
		\App\Models\Page $page,
		\App\Models\Tag $tag,
		\App\Models\Category $category,
	) {
		$this->request = $request;
		$this->cacheHelper = $cacheHelper;
		$this->page = $page;
		$this->tag = $tag;
		$this->category =$category;
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
		/**
		 * "page-list.{limit}.{page}.{order}.{sort}"
		 * "page-list.12.1.id.asc"
		 */
		$cache_key = "page-list.$limit." . $this->request->get('page', 1) . "." . $this->request->get('order', 'id') . "." . $this->request->get('sort', 'asc');

		/**
		 * cache_key
		 * cache_time: second(đơn vị tính bằng giây)
		 * cache_callback
		 */
		return Cache::remember($cache_key, 1 * 60 * 60, function () use ($limit) {
			return $this->page->paginate($limit);
		});
	}

	public function pageFilterPaginate(int $limit = 12) {
		$requestParam = $this->request->all();
		if (isset($requestParam['cat']) && $cateId = $requestParam['cat']) {
			$pageByCategory = $this->pageByCategoryId($cateId);
			return ($pageByCategory ? $pageByCategory->paginate($limit) : []);
		}
		return $this->pagePaginate($limit);
	}

	function pageByCategoryId(int $categoryId) {
		$category = $this->category->find($categoryId);
		return $category ? $category->pages() : null;
	}

	/**
	 * @return \Illuminate\Support\Collection<TKey, TMapValue>|static<TKey, TMapValue>
	 */
	public function pageFilters()
	{
		$filters = $this->request->all();
		$types = PageContent::all([PageContentInterface::TYPE])->unique(PageContentInterface::TYPE)->map(function ($item) use ($filters) {
			return [
				'value' => $item->{PageContentInterface::TYPE},
				'label' => __("attr.type.$item->type"),
				'selected' => in_array(PageContentInterface::TYPE, array_keys($filters)) && ($item->{PageContentInterface::TYPE} == $filters[PageContentInterface::TYPE])
			];
		})->values();
		return $types;
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

	/**
	 * @param array $ids
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function pageByIds(array $ids)
	{
		/**
		 * sau khi goi: where() -> $queryBuilder -> get() -> $collection
		 */
		return $this->page->whereIn(PageInterface::ID, $ids)->get();
	}

	/**
	 * @param int|Page $param
	 * @return \App\Models\Page
	 */
	public function detailById(int $param)
	{
		if ($param instanceof \App\Models\Page) {
			$param = $param->{PageInterface::ID};
		}
		/**
		 * get page by alias(first of paper by alias)
		 * inject with writer model, page content, tags data, category value in list value
		 * done!
		 */
		return $this->cacheHelper->saveAndReturn('page_detail_' . $param, 60 * 60, function () use ($param) {
			return $this->page->where(PageInterface::ID, '=', $param)
				->with('pageContents')
				->with('tags')
				->with('categories')
				->with('writer')
				->get()
				->first();
		});
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @return \App\Models\Page|null
	 */
	public function detailByAttr(string $key, $value) {
		return $this->cacheHelper->saveAndReturn('p_' . $key."=".$value, 60 * 60, function () use ($key, $value) {
			return $this->page->where($key, '=', $value)
				->with('pageContents')
				->with('tags')
				->with('categories')
				->with('writer')
				->get()
				->first();
		});
	}

	/**
	 * @param string $tag
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 */
	public function pageByTag(string $tag)
	{
		$cache_key = "tag.$tag." . $this->request->get('page', 1);
		return Cache::remember($cache_key, 1 * 60 * 60, function () use ($tag) {
			$listTags = $this->tag->where(TagInterface::KEY, '=', $tag)->get(TagInterface::TARGET_ID);
			return $this->page->whereIn(PageInterface::ID, $listTags)->paginate(12);
		});
	}

	public function getRandom(array $excludes = [])
	{
		return $this->page->all()->random(5);
	}
}
