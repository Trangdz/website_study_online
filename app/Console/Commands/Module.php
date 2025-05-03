<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class Module extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create module CLI';

    public function handle()
    {
        $name = $this->argument('name');
        $modulePath = base_path('modules/' . $name);

        if (File::exists($modulePath)) {
            $this->error('Module already exists!');
            return;
        }

        File::makeDirectory($modulePath, 0755, true, true);

        // configs
        $configFolder = base_path('modules/' . $name . '/configs');
        if (!File::exists($configFolder)) {
            File::makeDirectory($configFolder, 0755, true, true);
        }

        // helpers
        $helperFolder = base_path('modules/' . $name . '/helpers');
        if (!File::exists($helperFolder)) {
            File::makeDirectory($helperFolder, 0755, true, true);
        }

        // migrations
        $migrationFolder = base_path('modules/' . $name . '/migrations');
        if (!File::exists($migrationFolder)) {
            File::makeDirectory($migrationFolder, 0755, true, true);
        }

        // resources
        $resourcesFolder = base_path('modules/' . $name . '/resources');
        if (!File::exists($resourcesFolder)) {
            File::makeDirectory($resourcesFolder, 0755, true, true);

            $languageFolder = base_path('modules/' . $name . '/resources/lang');
            if (!File::exists($languageFolder)) {
                File::makeDirectory($languageFolder, 0755, true, true);
            }

            $viewFolder = base_path('modules/' . $name . '/resources/views');
            if (!File::exists($viewFolder)) {
                File::makeDirectory($viewFolder, 0755, true, true);
            }
        }

        // routes
        $routesFolder = base_path('modules/' . $name . '/routes');
        if (!File::exists($routesFolder)) {
            File::makeDirectory($routesFolder, 0755, true, true);

            // create file routes.php
            $routesFile = base_path('modules/' . $name . '/routes/routes.php');
            if (!File::exists($routesFile)) {
                File::put($routesFile, "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\n// Module Routes Here");
            }
        }

        // src
        $srcFolder = base_path('modules/' . $name . '/src');
        if (!File::exists($srcFolder)) {
            File::makeDirectory($srcFolder, 0755, true, true);

            $commandsFolder = base_path('modules/' . $name . '/src/Commands');
            if (!File::exists($commandsFolder)) {
                File::makeDirectory($commandsFolder, 0755, true, true);
            }

            $httpFolder = base_path('modules/' . $name . '/src/Http');
            if (!File::exists($httpFolder)) {
                File::makeDirectory($httpFolder, 0755, true, true);

                $controllerFolder = base_path('modules/' . $name . '/src/Http/Controllers');
                if (!File::exists($controllerFolder)) {
                    File::makeDirectory($controllerFolder, 0755, true, true);
                }

                $middlewaresFolder = base_path('modules/' . $name . '/src/Http/Middlewares');
                if (!File::exists($middlewaresFolder)) {
                    File::makeDirectory($middlewaresFolder, 0755, true, true);
                }
            }

            $modelsFolder = base_path('modules/' . $name . '/src/Models');
            if (!File::exists($modelsFolder)) {
                File::makeDirectory($modelsFolder, 0755, true, true);
            }

            //Repositories
            $repositoriesFolder = base_path('modules/' . $name . '/src/Repositories');
            if (!File::exists($repositoriesFolder)) {
                File::makeDirectory($repositoriesFolder, 0755, true, true);

                $moduleRepository = base_path('modules/' . $name . '/src/Repositories/' . $name . 'Repository.php');
                if (!File::exists($moduleRepository)) {
                    $moduleRepositoryContent = file_get_contents(app_path('Console/Commands/Template/ModuleRepository.txt'));
                    $moduleRepositoryContent=str_replace('{module}',$name,$moduleRepositoryContent);
                    File::put($moduleRepository, $moduleRepositoryContent);
                }
            }
        }
        // Đường dẫn đến file Repository của module



        $this->info('Module created successfully.');
    }
}
