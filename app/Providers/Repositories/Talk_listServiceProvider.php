<?php

namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;

class Talk_listServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        app()->bind(
            \App\Repositories\Talk_list\Interfaces\TalkListDataAccessRepositoryInterface::class,
            \App\Repositories\Talk_list\Repositories\TalkListDataAccessRepository::class
        );
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
