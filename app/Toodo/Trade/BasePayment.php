<?php


namespace App\Toodo\Trade;


abstract class BasePayment implements IPayment
{
    /**
     * @var Trader
    */
    protected $trader;

    public function __construct()
    {
        $this->trader = app(Trader::class);
    }

    public function submit($url, $data)
    {
        return view('toodo.submit', [
            'url' => $url,
            'data' => $data,
        ]);
    }

    public function auth($inputBody)
    {
        // TODO: Implement auth() method.
    }
}