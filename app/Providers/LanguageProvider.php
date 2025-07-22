<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class LanguageProvider extends ServiceProvider
{
    const LANGUAGE_SESSION = 'LANGUAGE_SESSION';

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * use after session function start.
     * return current locale after set language.
     * @param string $locale
     * @return string
     */
    public static function applyLanguage(string $locale): string
    {
        Session::put(self::LANGUAGE_SESSION, $locale);
        Session::save();
        App::setLocale($locale);
        return App::currentLocale();
    }

    public static function resetLanguage() {
        Session::forget(self::LANGUAGE_SESSION);
        Session::save();
    }
}
