<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Schema::defaultStringLength(191);          // aman untuk MySQL/MariaDB lama di XAMPP
        Paginator::defaultView('vendor.pagination.stapov');
        Paginator::defaultSimpleView('vendor.pagination.stapov');
    }
}
