<?php

namespace App\Providers;

use App\Models\Document;
use App\Models\Film;
use App\Models\Gallery;
use App\Models\Lecture;
use App\Models\Sermon;
use App\Models\SermonPlaylist;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\User;
use App\Observers\ModelAuditObserver;
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
        Document::observe(ModelAuditObserver::class);
        Film::observe(ModelAuditObserver::class);
        Gallery::observe(ModelAuditObserver::class);
        Lecture::observe(ModelAuditObserver::class);
        Sermon::observe(ModelAuditObserver::class);
        SermonPlaylist::observe(ModelAuditObserver::class);
        Setting::observe(ModelAuditObserver::class);
        Subject::observe(ModelAuditObserver::class);
        User::observe(ModelAuditObserver::class);
    }
}
