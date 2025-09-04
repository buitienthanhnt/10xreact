<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

/**
 * doc for laravel livewire:
 * https://livewire.laravel.com/docs/quickstart
 */
class Counter extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render(Page $page)
    {
        return view('livewire.counter', [
            'listAttributes' => $page->formField()
        ]);
    }
}
