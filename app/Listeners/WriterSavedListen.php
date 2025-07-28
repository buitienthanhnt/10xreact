<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class WriterSavedListen
{
    protected $request;

    /**
     * Create the event listener.
     */
    public function __construct(
        Request $request
    )
    {
        
        $this->request = $request;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        dd($event->writer);
        /**
         * 1. save image into storage
         * 2. get image path of file saved
         * 3. update for the writer saved in the event. 
         */
    }
}
