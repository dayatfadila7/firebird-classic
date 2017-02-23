<?php
namespace FireBirdClassic;

use Illuminate\Support\ServiceProvider;
use FireBirdClassic\Query\IbaseQuery;

class FirebirdClassicServiceProvider extends ServiceProvider
{

    /**
     * Register.
     *
     * @return
     */
    public function register()
    {

    }

    /**
     * Boot.
     *
     * @return void
     */
    public function boot()
    {

        return new IbaseQuery();

    }
   
}
