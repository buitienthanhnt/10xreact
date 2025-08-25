<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        /**
         * define for list element of top menu
         */
        $topMenu = [
            ['name' => 'page', 'icon' => '', 'url' => '/list'],
            ['name' => 'account', 'icon' => '', 'url' => '/account'],
            ['name' => 'Docs', 'icon' => '', 'url' => '/docs'],
            ['name' => 'About Us', 'icon' => '', 'url' => '/about'],
        ];

        /**
         * return value for share parameter all view with InertiaRequests.
         */
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'topMenu' => $topMenu
        ];
    }
}
