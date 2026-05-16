<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

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
       if (!User::where('email', 'admin@example.com')->exists()) {

            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]);
        }

        if (!User::where('email', 'operator@example.com')->exists()) {

            User::create([
                'name' => 'Operator',
                'email' => 'operator@example.com',
                'password' => Hash::make('password123'),
                'role' => 'operator',
            ]);
        }
    }
}
