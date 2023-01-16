<?php

namespace NotifyLog\Laravel;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use NotifyLog\Laravel\Configuration;

class NotifyLogServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * The latest version of the client library.
     *
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * The platform of the client library.
     *
     * @var string
     */
    const PLATFORM  = 'PHP-Laravel';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Default package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/notifylog.php', 'notifylog');

        $this->registerSingleton();
        $this->registerContainer();
    }

    /**
     * Booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfigFile();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [NotifyLog::class];
    }

    /**
     * Setup configuration file.
     */
    protected function setupConfigFile()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/notifylog.php' => config_path('notifylog.php')]);
        }
    }

    /**
     * Register singleton.
     *
     * @return void
     */
    protected function registerSingleton()
    {
        // Bind NotifyLog for Helper Function
        $this->app->singleton('notifylog', function () {
            $configuration = (new Configuration(config('notifylog.token')))
                ->setUrl(config('notifylog.url', 'https://app.notifylog.com/api/v1/event'))
                ->setVersion(self::VERSION)
                ->setPlatform(self::PLATFORM);

            return new NotifyLog($configuration);
        });
    }

    /**
     * Register singleton.
     *
     * @return void
     */
    protected function registerContainer()
    {
        // Bind NotifyLog for Service Container
        $this->app->bind(NotifyLog::class, function () {
            $configuration = (new Configuration(config('notifylog.token')))
                ->setUrl(config('notifylog.url', 'https://app.notifylog.com/api/v1/event'))
                ->setVersion(self::VERSION)
                ->setPlatform(self::PLATFORM);
            return new NotifyLog($configuration);
        });
    }
}
