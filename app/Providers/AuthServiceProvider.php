<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\Discussion;
use App\Policies\PostPolicy;
use App\Policies\DiscussionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Discussion::class => DiscussionPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
