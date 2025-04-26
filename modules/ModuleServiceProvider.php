<?php

namespace Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Modules\User\src\Http\Middlewares\DemoMiddleware;

class ModuleServiceProvider extends ServiceProvider
{



    public function boot()
    {
        $directories = array_map('basename', File::directories(__DIR__));

        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $this->registerModule($directory);
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
        if (File::exists($modulePath . '/languages')) {
            $this->loadTranslationsFrom($modulePath . '/languages', $module);
            $this->loadJsonTranslationsFrom($modulePath . '/languages');
        }

        //Khai bao view
        if (File::exists($modulePath . '/resources/views')) {
            $this->loadViewsFrom($modulePath . '/resources/views', $module);
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
        $directories = array_map('basename', File::directories(__DIR__));

        foreach ($directories as $directory) {
            $modulePath = __DIR__ . '/' . $directory;

            // 1. Đăng ký Config
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

        // Middleware
        $middlewares = [
            'demo' => DemoMiddleware::class,
        ];
       

        if (!empty($middlewares)) {
            foreach ($middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
                
            }
        }
    }
}
