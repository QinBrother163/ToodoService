<?php

namespace App\Toodo;

use App\Toodo\Gdgd\GdgdPayment;
use App\Toodo\Gxgd\GxgdPayment;
use App\Toodo\Hnyx\HnyxPayment;
use App\Toodo\Trade\IPayment;
use Illuminate\Support\ServiceProvider;

class ToodoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->toodo();
        $this->gxgd();
        $this->gdgd();
        $this->hnyx();
    }

    protected function toodo()
    {

    }

    protected function gxgd()
    {
        $this->app
            ->when('\App\Toodo\Gxgd\GxgdController')//自定义命名空间路由要绝对路径
            ->needs(IPayment::class)
            ->give(GxgdPayment::class);
    }

    protected function gdgd()
    {
        $this->app
            ->when('\App\Toodo\Gdgd\GdgdController')//自定义命名空间路由要绝对路径
            ->needs(IPayment::class)
            ->give(GdgdPayment::class);
    }

    protected function hnyx(){
        $this->app
            ->when('\App\Toodo\Hnyx\HnyxController')//自定义命名空间路由要绝对路径
            ->needs(IPayment::class)
            ->give(HnyxPayment::class);
    }
}
