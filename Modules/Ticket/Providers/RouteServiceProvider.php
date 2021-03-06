<?php

namespace Modules\Ticket\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Modules\Ticket\Repositories\TicketRepository;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Ticket\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('ticket', function ($ticket) {
            /** @var TicketRepository $repository */
            $repository = $this->app->make(TicketRepository::class);
            return $repository->findOrFail($ticket);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix(api_version() . '/{locale}/api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Ticket', '/Routes/api.php'));
    }
}
