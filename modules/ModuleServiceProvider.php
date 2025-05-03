<?php

namespace Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Modules\User\src\Http\Middlewares\DemoMiddleware;
use Modules\User\src\Commands\TestCommand;
use Modules\User\src\Repositories\UserRepository;

class ModuleServiceProvider extends ServiceProvider
{


    private $middlewares = [
        'demo' => DemoMiddleware::class,
    ];

    private $commands = [
        TestCommand::class
    ];


    public function boot()
    {
        $modules = $this->getModules();

        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerModule($module);
            }
        }
    }

    public function registerModule($module)
    {

        $modulePath = __DIR__ . "/{$module}";

        //Khai bao router
        // $tets=File::exists($modulePath . '/routes/routes.php');
        // dd($tets);
        if (File::exists($modulePath . '/routes/routes.php')) {

            $this->loadRoutesFrom($modulePath . '/routes/routes.php');
        }

        //Khai bao migration
        if (File::exists($modulePath . '/migrations')) {
            $this->loadMigrationsFrom($modulePath . '/migrations');
        }

        //Khai bao languages
        if (File::exists($modulePath . '/resources/lang')) {
            $this->loadTranslationsFrom($modulePath . '/resource/lang', strtolower($module));
            $this->loadJsonTranslationsFrom($modulePath . '/resource/lang');
        }

        //Khai bao view
        if (File::exists($modulePath . '/resources/views')) {
            $this->loadViewsFrom($modulePath . '/resources/views', strtolower($module));
        }

        if (File::exists($modulePath . '/helpers')) {
            $helperList = File::allFiles($modulePath . '/helpers');
            if (!empty($helperList)) {
                foreach ($helperList as $helper) {
                    $file = $helper->getPathname();
                    require $file;
                }
            }
        }

        
        


    }

    public function register()
    {
        // $directories = array_map('basename', File::directories(__DIR__));

        // foreach ($directories as $directory) {
        //     $modulePath = __DIR__ . '/' . $directory;

        //     // 1. Đăng ký Config

        // }

        $modules = $this->getModules();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerConfig($module);
            }
        }

        // Middleware
        // $middlewares = [
        //     'demo' => DemoMiddleware::class,
        // ];
        $this->registerMiddleware();

        // //Commands

        $this->commands($this->commands);

        $this->app->singleton(
            UserRepository::class
        );
    }


    private function getModules()
    {
        return array_map('basename', File::directories(__DIR__));
    }


    private function registerConfig($module)
    {
        $modulePath = __DIR__ . '/' . $module;
        $configPath = $modulePath . '/configs';

        if (File::exists($configPath)) {
            $configFiles = array_map('basename', File::allFiles($configPath));

            foreach ($configFiles as $config) {
                $alias = basename($config, '.php');

                $configFull = $configPath . '/' . $config;
                $this->mergeConfigFrom($configFull, $alias);
            }
        }
    }

    private function registerMiddleware()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }
}
