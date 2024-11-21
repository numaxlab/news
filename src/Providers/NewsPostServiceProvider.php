<?php


namespace NumaxLab\NewsPost\Providers;

use Illuminate\Support\ServiceProvider;
use NumaxLab\NewsPost\Commands\Install;

class NewsPostServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('news-post.php'),
            __DIR__ . '/../../lang' => $this->app->langPath('vendor/news-post'),


        ]);
        $this->loadRoutesFrom(__DIR__ . '/../../routes/news-post.php');

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'news-post');

        $this->publishesMigrations([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'news-post'
        );
    }
}
