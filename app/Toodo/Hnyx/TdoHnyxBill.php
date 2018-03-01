<?php

namespace App\Toodo\Hnyx;

use Illuminate\Database\Eloquent\Model;


class TdoHnyxBill extends Model
{
    protected $primaryKey = 'userId';

    public $incrementing = false;

    /**
     * @param $productId integer
     * @return OwnBill
     */
    public function find($productId)
    {
        $bills = collect(json_decode($this->ownBills));
        $bill = $bills->where('productId', '=', $productId)->first();
        return $bill;
    }

    public function add()
    {
    }

    public function remove()
    {
    }
}
