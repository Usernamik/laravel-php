<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Observers\BlogPostObserver;
use App\Observers\BlogCategoryObserver;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        BlogPost::class => BlogPostObserver::class,
        BlogCategory::class => BlogCategoryObserver::class,
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
