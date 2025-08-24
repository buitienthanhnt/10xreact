<?php

namespace App\Listeners;

use App\Models\Types\PageInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class PageSavedListen
{
    protected $request;

    /**
     * Create the event listener.
     */
    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        /**
         * define in event class define.
         */
        $page = $event->page;
        /**
         * dung sync se dam bao xay dung ban ghi 1-1 khong bi trung lap trong bang trung gian
         * https://laravel.com/docs/12.x/eloquent-relationships#updating-many-to-many-relationships
         * Syncing Associations
         */
        $page->categories()->sync($this->request->get(PageInterface::CATEGORY));
    }
}
