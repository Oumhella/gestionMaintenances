<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateMvc extends Command
{
    protected $signature = 'make:mvc {name}';
    protected $description = 'Create controller, view, and route for the given name';

    public function handle()
    {
        $name = $this->argument('name');

        // 1. Create Controller
        $controllerTemplate = "<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class {$name}Controller extends Controller
{
    public function index()
    {
        return view('{$name}.index');
    }
}";

        File::put(app_path("Http/Controllers/{$name}Controller.php"), $controllerTemplate);

        // 2. Create View
        File::makeDirectory(resource_path("views/{$name}"), 0777, true, true);
        File::put(resource_path("views/{$name}/index.blade.php"), "<h1>{$name} View</h1>");

        // 3. Create Route
        File::append(base_path('routes/web.php'), "\nRoute::get('/{$name}', [App\Http\Controllers\\{$name}Controller::class, 'index']);");

        $this->info('Controller, View, and Route created successfully.');
    }
}
