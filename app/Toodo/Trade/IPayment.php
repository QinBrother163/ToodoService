<?php

namespace App\Toodo\Trade;

interface IPayment
{
    public function signCode($inputBody);
    /**
     * @param OrderIn $inputBody
     * @return mixed
     */
    public function createOrder($inputBody);

    public function payOnline($bizOrder);

    public function onConfirm($inputBody);

    public function onCallback($inputBody);

    public function onNotice($inputBody);
    /**
     * @param string $url
     * @param array $data
     */
    public function submit($url, $data);

    public function auth($inputBody);
}