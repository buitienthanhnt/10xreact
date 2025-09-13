<?php

namespace App\Models\Api;

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

	/**
	 * \Illuminate\Http\Request $request
	 */
	protected $request;

	function __construct(
		\App\Models\Page $page,
		\App\Models\Tag $tag,
		\Illuminate\Http\Request $request,
	) {
		$this->page = $page;
		$this->tag = $tag;
		$this->request = $request;
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
		$cache_key = "page-list.$limit.".$this->request->get('page', 1);
		if (Cache::has($cache_key)) {
			return Cache::get($cache_key);
		}
		return Cache::remember($cache_key, 1000, function () use($limit) {
			return $this->page->paginate($limit);
		});
	}

	/**
	 * @return \Illuminate\Support\Collection<TKey, TMapValue>|static<TKey, TMapValue>
	 */
	public function pageFilters() {
		$filters = $this->request->all();
		$types = PageContent::all([PageContentInterface::TYPE])->unique(PageContentInterface::TYPE)->map(function($item)use($filters){
			return [
				'value' => $item->{PageContentInterface::TYPE},
				'label' => __("attr.type.$item->type"),
				'selected' => in_array(PageContentInterface::TYPE, array_keys($filters)) && ($item->{PageContentInterface::TYPE} == $filters[PageContentInterface::TYPE])
			];
		});
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
	public function pageByIds(array $ids) {
		/**
		 * sau khi goi: where() -> $queryBuilder -> get() -> $collection
		 */
		return $this->page->whereIn(PageInterface::ID, $ids)->get();
	}

	/**
	 * @param string $tag
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 */
	public function pageByTag(string $tag) {
		$cache_key = "tag.$tag.".$this->request->get('page', 1);
		if (Cache::has($cache_key)) {
			return Cache::get($cache_key);
		}
		return Cache::remember($cache_key, 1000, function () use($tag) {
			$listTags = $this->tag->where(TagInterface::KEY, '=', $tag)->get(TagInterface::TARGET_ID);
			return $this->page->whereIn(PageInterface::ID, $listTags)->paginate(12);
		});
	}

	public function getRandom(array $excludes = []) {
		return $this->page->all()->random(5);
	}
}
