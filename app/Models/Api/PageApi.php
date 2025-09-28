<?php

namespace App\Models\Api;

use App\Models\Category;
use App\Models\Page;
use App\Models\PageContent;
use App\Models\Types\CategoryInterface;
use App\Models\Types\PageContentInterface;
use App\Models\Types\PageInterface;
use App\Models\Types\TagInterface;
use App\Models\Types\WriterInterface;
use App\Models\Writer;
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
		$this->category = $category;
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
	 * default paginate.
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

	/**
	 * get list page item and filter action.
	 * @param int $limit 
	 */
	public function pageFilterPaginate(int $limit = 12)
	{
		$requestParam = $this->request->all();
		/**
		 * define for values.
		 */
		$allPages = collect();
		$hasFilter = false;
		$cache_key = "page-list.$limit." . $this->request->get('page', 1) . "." . $this->request->get('order', 'id') . "." . $this->request->get('sort', 'asc');

		/**
		 * filter pages by categories.
		 */
		if (isset($requestParam[CategoryInterface::CATEGORY_FILTER_KEY]) && $cateId = $requestParam[CategoryInterface::CATEGORY_FILTER_KEY]) {
			$pageByCategory = $this->pageByCategoryId($cateId)->get();
			$allPages = $allPages->merge($pageByCategory->pluck(PageInterface::ID));
			$hasFilter = true;
			$cache_key .= '.' . $cateId;
		}

		/**
		 * filter by writer
		 */
		if ($writerFilter = $this->request->get(WriterInterface::WRITER_FILTER_KEY)) {
			$pageByWriters = Page::where(PageInterface::WRITER, '=', $writerFilter)->get()->pluck(PageInterface::ID);
			$allPages = $allPages->count() ? $allPages->intersect($pageByWriters) : $allPages->merge($pageByWriters);
			$hasFilter = true;
			$cache_key .= '.' . $writerFilter;
		}

		/**
		 * filter by content type.
		 */
		if ($typeFilter = $this->request->get(PageContentInterface::TYPE_FILTER_KEY)) {
			$pageByFilters = $this->pageByType(PageContentInterface::TYPE_FILTER_KEY, $typeFilter)->get()->pluck(PageInterface::ID);
			$allPages = $allPages->count() ? $allPages->intersect($pageByFilters) : $allPages->merge($pageByFilters);
			$hasFilter = true;
			$cache_key .= '.' . $typeFilter;
		}

		if ($hasFilter) {
			/**
			 * get paginate pages by filter values.
			 * cache_key
			 * cache_time: second(đơn vị tính bằng giây)
			 * cache_callback
			 */
			return Cache::remember($cache_key, 1 * 60 * 60, function () use ($allPages, $limit) {
				return Page::whereIn(PageInterface::ID, $allPages->toArray())->paginate($limit);
			});
		}
		return $this->pagePaginate($limit);
	}

	/**
	 * @param int $categoryId
	 * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function pageByCategoryId(int $categoryId)
	{
		$category = $this->category->find($categoryId);
		return $category ? $category->pages() : null;
	}

	/**
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	public function pageByType(string $type, $value)
	{
		$pageIds = PageContent::where($type, $value)
			->get(PageContentInterface::PAGE_ID)
			->unique(PageContentInterface::PAGE_ID)
			->pluck(PageContentInterface::PAGE_ID)
			->toArray();
		return Page::whereIn(PageInterface::ID, $pageIds);
	}

	/**
	 * filter page by writer
	 * @param int $writerId
	 * @return Illuminate\Database\Eloquent\Builder
	 */
	public function pageByWriter(int $writerId)
	{
		// call ->get() to return collection.
		return Page::where(PageInterface::WRITER, $writerId);
	}

	/**
	 * @return \Illuminate\Support\Collection<TKey, TMapValue>|static<TKey, TMapValue>
	 */
	public function pageFilters()
	{
		$pageFilters = [];
		$pageFilters[] = $this->pageFilterType();
		$pageFilters[] = $this->pageFilterCategories();
		$pageFilters[] = $this->pageFilterWriters();
		$pageFilters[] = $this->pageSortFilter();
		$pageFilters[] = $this->pageOrderFilter();
		return $pageFilters;
	}

	/**
	 * list of sort filter value
	 * @return array
	 */
	protected function pageSortFilter(): array
	{
		return [
			'label' => 'sort',
			'type' => 'sort',
			'data' => [
				['value' => 'asc', 'label' => 'asc', 'selected' => strtolower($this->request->get('sort')) === 'asc'],
				['value' => 'desc', 'label' => 'desc', 'selected' => strtolower($this->request->get('sort')) === 'desc'],
			],
		];
	}

	/**
	 * list of sort filter attribute value
	 * @return array
	 */
	protected function pageOrderFilter(): array
	{
		return [
			'label' => 'order by',
			'type' => 'order',
			'data' => [
				['value' => 'id', 'label' => 'id', 'selected' => strtolower($this->request->get('order')) === 'id'],
				['value' => 'title', 'label' => 'title', 'selected' => strtolower($this->request->get('order')) === 'title'],
				['value' => 'created_at', 'label' => 'created_at', 'selected' => strtolower($this->request->get('order')) === 'created_at'],
			],
		];
	}

	/**
	 * get page filter of page content type.
	 */
	protected function pageFilterType()
	{
		$filters = $this->request->all();
		$types = PageContent::all([PageContentInterface::TYPE])->unique(PageContentInterface::TYPE)->map(function ($item) use ($filters) {
			return [
				'value' => $item->{PageContentInterface::TYPE},
				'label' => __("attr.type.$item->type"),
				'selected' => in_array(PageContentInterface::TYPE, array_keys($filters)) && ($item->{PageContentInterface::TYPE} == $filters[PageContentInterface::TYPE])
			];
		})->values();

		return [
			'label' => 'type',
			'type' => PageContentInterface::TYPE_FILTER_KEY,
			'data' => $types,
		];
	}

	/**
	 * get page filter of categories.
	 * @return array
	 */
	protected function pageFilterCategories()
	{
		return [
			'label' => 'categories',
			'type' => CategoryInterface::CATEGORY_FILTER_KEY,
			'data' => array_map(function ($category) {
				return [
					...$category,
					'selected' => $category['value'] == $this->request->get(CategoryInterface::CATEGORY_FILTER_KEY),
				];
			}, Category::getCategoryTree(prefix: ''))
		];
	}

	/**
	 * @return array
	 */
	protected function pageFilterWriters()
	{
		$filters = $this->request->all();
		/**
		 * @var array $realWriters
		 */
		$realWriters = Page::all(PageInterface::WRITER)->unique(PageInterface::WRITER)->pluck(PageInterface::WRITER)->toArray();
		$types = Writer::whereIn(WriterInterface::ID, $realWriters)->get()->map(function ($item) use ($filters) {
			return [
				'value' => $item->{PageContentInterface::ID},
				'label' => $item->{WriterInterface::NAME},
				'selected' => isset($filters[WriterInterface::WRITER_FILTER_KEY]) ? $item->{WriterInterface::ID} == $filters[WriterInterface::WRITER_FILTER_KEY] : false,
			];
		})->values();

		return [
			'label' => 'writers',
			'type' => 'writer',
			'data' => $types,
		];
	}

	/**
	 * action for register new page
	 * @param array $data
	 * @return bool
	 */
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
	 * @param string|bool|mixed $value
	 * @return \App\Models\Page|null
	 */
	public function detailByAttr(string $key, $value)
	{
		return $this->cacheHelper->saveAndReturn('p_' . $key . "=" . $value, 60 * 60, function () use ($key, $value) {
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

	/**
	 * return custom support fields for page content.
	 */
	public function customFields(): array
	{
		return [
			[
				'label' => 'tác giả',
				'type' => 'select',
				'path' => WriterInterface::WRITER_FILTER_KEY,
				'options' => Writer::writerOptions()->toArray(),
			],
			[
				'label' => 'danh muc',
				'type' => 'timeline',
				'path' => CategoryInterface::CATEGORY_FILTER_KEY,
				'options' => Category::getCategoryTree(prefix: ''),
			]
		];
	}
}
