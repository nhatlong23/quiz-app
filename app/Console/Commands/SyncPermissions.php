<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize permissions with routes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->loadAdminRoutes();

        $routes = Route::getRoutes();
        $permissions = [];

        $parentPermissions = [
            'roles' => 'Quản lý vai trò',
            'users' => 'Quản lý người dùng',
        ];

        // Insert or update parent permissions and get their IDs
        foreach ($parentPermissions as $key => $name) {
            $inserted = DB::table('permissions')->updateOrInsert(
                ['name' => $name],
                ['description' => $name, 'parent_id' => 0, 'created_at' => now(), 'updated_at' => now()]
            );
        
            if ($inserted) {
                $parentPermissionIds[$key] = DB::table('permissions')->where('name', $name)->value('id');
            }
        }
        
        $permissions = [];

        // Process routes and generate permissions
        foreach ($routes as $route) {
            $routeName = $route->getName();
            if ($routeName && strpos($routeName, 'admin.') === 0) {
                $parts = explode('.', $routeName);
                $parentKey = "{$parts[1]}";

                $permissions[] = [
                    'name' => $this->generatePermissionName($routeName),
                    'description' => $this->generatePermissionDescription($routeName),
                    'parent_id' => $parentPermissionIds[$parentKey],
                    'key_code' => $routeName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert or update child permissions
        DB::table('permissions')->upsert($permissions, ['key_code'], ['name', 'description', 'parent_id', 'updated_at']);

        $this->info('Permissions synchronized successfully.');

        return 0;
    }

    /**
     * Load the admin routes.
     */
    protected function loadAdminRoutes()
    {
        require base_path('routes/admin.php');
    }

    /**
     * Generate a permission name from the route name.
     *
     * @param string $routeName
     * @return string
     */
    private function generatePermissionName(string $routeName): string
    {
        // Convert route name to a more readable format
        return ucwords(str_replace('.', ' ', $routeName));
    }

    /**
     * Generate a permission description from the route name.
     *
     * @param string $routeName
     * @return string
     */
    private function generatePermissionDescription(string $routeName): string
    {
        return ucwords(str_replace('.', ' ', $routeName));
    }
}
