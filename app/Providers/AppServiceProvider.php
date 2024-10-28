<?php

namespace App\Providers;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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
        view()->composer('*', function ($view) {
            $today = Visitor::whereDate('created_at', Carbon::today())->count();
            $thisWeek = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $thisMonth = Visitor::whereMonth('created_at', Carbon::now()->month)->count();
            $totalVisits = Visitor::count(); // Count all visits

            $view->with('visitorCounts', [
                'today' => $today,
                'thisWeek' => $thisWeek,
                'thisMonth' => $thisMonth,
                'totalVisits' => $totalVisits, // Share total number of visits
            ]);
        });
    }
}
