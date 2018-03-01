<?php

namespace App\Toodo\Serve;

use App\Toodo\Fast;
use App\Toodo\Market\TdoGoodsInfo;
use App\User;
use Illuminate\Database\Eloquent\Model;

class TdoServiceData extends Model
{
    protected $fillable = [
        'serialNo',
        'userId',
        'retailId',
        'productId',
        'goodsName',
        'beginTime',
        'endTime',
        'tradeNo',
        'own',
        'ownTime',
    ];

    protected $primaryKey = 'serialNo';
    public $incrementing = false;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param $user User
     * @param $product TdoGoodsInfo
     * @param $mth
     */
    public function book($user, $product, $mth)
    {
        if (empty($this->serialNo)) {
            $beginTime = date('Y-m-d H:i:s');
            $endTime = date('Y-m-d H:i:s', strtotime("$beginTime +$mth month"));
            $this->fill([
                'serialNo' => Fast::serialNo(),
                'userId' => $user->id,
                'retailId' => $user->retailId,
                'productId' => $product->productId,
                'goodsName' => $product->goodsName,
                'beginTime' => $beginTime,
                'endTime' => $endTime,
            ]);
        } else {
            $beginTime = $this->endTime;
            $endTime = date('Y-m-d H:i:s', strtotime("$beginTime +$mth month"));
            $this->endTime = $endTime;
        }
        $this->save();
    }

    public function isOwn($now = null)
    {
        $sv = $this;
        if ($sv->own) return true;

        if (empty($now)) $now = date('Y-m-d H:i:s');
        if (!empty($sv->ownTime) && $sv->ownTime > $now) return true;

        return $sv->beginTime < $now && $now < $sv->endTime;
    }
}
