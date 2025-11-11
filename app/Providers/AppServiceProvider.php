<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        Gate::define('manage-post', function (User $user, Post $post){
            return $user->id === $post->user_id;
        });
    }
}
