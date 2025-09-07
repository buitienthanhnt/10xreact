<?php

namespace App\Providers;

use App\Events\CategorySaved;
use App\Events\PageSaved;
use App\Events\WriterSaved;
use App\Listeners\CategorySavedListen;
use App\Listeners\PageContentListen;
use App\Listeners\PageSavedListen;
use App\Listeners\WriterSavedListen;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        WriterSaved::class => [ // register for listener writer event after saved
            WriterSavedListen::class,
        ],
        CategorySaved::class => [
            CategorySavedListen::class, // define for listener category after saved.
        ],
        PageSaved::class => [
            PageSavedListen::class, // define for listener page after saved.
            PageContentListen::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
