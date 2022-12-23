<?php

namespace App\Providers;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\BlockReptileHistoryRepositoryInterface;
use App\Repositories\EggRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\BlockReptileHistoryRepository;
use App\Repositories\Eloquent\EggRepository;
use App\Repositories\Eloquent\MatingRepository;
use App\Repositories\Eloquent\ReptileImageRepository;
use App\Repositories\Eloquent\ReptileRepository;
use App\Repositories\Eloquent\TypeRepository;
use App\Repositories\MatingRepositoryInterface;
use App\Repositories\ReptileImageRepositoryInterface;
use App\Repositories\ReptileRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerResponseBindings();
    }

    /**
     * Register the response bindings.
     *
     * @return void
     */
    protected function registerResponseBindings()
    {
        $this->app->singleton(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->singleton(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->singleton(ReptileRepositoryInterface::class, ReptileRepository::class);
        $this->app->singleton(EggRepositoryInterface::class, EggRepository::class);
        $this->app->singleton(MatingRepositoryInterface::class, MatingRepository::class);
        $this->app->singleton(BlockReptileHistoryRepositoryInterface::class, BlockReptileHistoryRepository::class);
        $this->app->singleton(ReptileImageRepositoryInterface::class, ReptileImageRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
