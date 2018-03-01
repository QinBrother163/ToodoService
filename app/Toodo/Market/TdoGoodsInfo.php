<?php

namespace App\Toodo\Market;

use Illuminate\Database\Eloquent\Model;


class TdoGoodsInfo extends Model
{
    protected $fillable = [
        'goodsId',
        'goodsName',
        'goodsDesc',
        'complex',
        'comment',
        'category',
        'price',
        'storeId',
        'storeName',
        'verify',
        'note',
    ];
    public $timestamps = false;
    protected $primaryKey = 'productId';
    protected $hidden = [
        'storeId',
        'storeName',
        'verify',
        'note',
    ];

    public function canOrder()
    {
        return $this->complex == 0 && $this->category == 0;
    }
}
