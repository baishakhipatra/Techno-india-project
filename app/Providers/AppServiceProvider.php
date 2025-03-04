<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();

        // view::composer('*', function($view) {
        //     $ip = $_SERVER['REMOTE_ADDR'];
        // $permissionsTableExists = Schema::hasTable('permissions');
        // if ($permissionsTableExists) {
        //    $admin_id = Auth::check() ? Auth::user()->id : "";
        //     $RolePass = Permission::where('admin_id', $admin_id)->get()->pluck('value')->toArray();
        // }
        // view()->share('RolePass', $RolePass);
        // });
    }
}
