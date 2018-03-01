<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Toodo\Biz{
/**
 * App\Toodo\Biz\TdoUserAddress
 *
 * @property int $id
 * @property int $userId
 * @property int $retailId
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property bool $workday
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoUserAddress whereWorkday($value)
 */
	class TdoUserAddress extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoAreaInfo
 *
 * @property int $area
 * @property string $name
 * @property bool $trial
 * @property string $freeBegin
 * @property string $freeEnd
 * @property int $cntId
 * @property int $ownId
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoAreaInfo whereArea($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoAreaInfo whereCntId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoAreaInfo whereFreeBegin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoAreaInfo whereFreeEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoAreaInfo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoAreaInfo whereOwnId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoAreaInfo whereTrial($value)
 */
	class EdoAreaInfo extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoBlacklist
 *
 * @property int $id
 * @property string $retailId
 * @property bool $black
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoBlacklist whereBlack($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoBlacklist whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoBlacklist whereRetailId($value)
 */
	class EdoBlacklist extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoCallGameLog
 *
 * @property int $id
 * @property int $userId 用户编号
 * @property int $gameId 游戏编号
 * @property int $versionCode 游戏版本序号
 * @property string $time 操作时间
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoCallGameLog whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoCallGameLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoCallGameLog whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoCallGameLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoCallGameLog whereVersionCode($value)
 */
	class EdoCallGameLog extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoDownGameLog
 *
 * @property int $id
 * @property int $userId 用户编号
 * @property int $gameId 游戏编号
 * @property int $versionCode 游戏版本序号
 * @property string $fileInfos 下载明细
 * @property int $flag 安装标志
 * @property string $time 操作时间
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoDownGameLog whereFileInfos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoDownGameLog whereFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoDownGameLog whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoDownGameLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoDownGameLog whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoDownGameLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoDownGameLog whereVersionCode($value)
 */
	class EdoDownGameLog extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoGameExt
 *
 * @property int $gameId
 * @property string $gameName
 * @property string $gameNameCn
 * @property int $gameType
 * @property string $packageName
 * @property string $startActivityName
 * @property string $takeHandType
 * @property int $freePlayTime
 * @property int $playCount
 * @property int $gameHint
 * @property string $infraredPicture
 * @property string $handPicture
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereFreePlayTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereGameHint($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereGameName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereGameNameCn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereGameType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereHandPicture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereInfraredPicture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt wherePackageName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt wherePlayCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereStartActivityName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameExt whereTakeHandType($value)
 */
	class EdoGameExt extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoGameInfo
 *
 * @property int $id
 * @property int $gameId 游戏编号
 * @property string $gameName 游戏名称
 * @property string $gameNameCn 中文名
 * @property string $gameDescription 游戏简介
 * @property int $gameType "游戏类型
 * @property string $packageName java包名
 * @property int $versionCode 版本号
 * @property string $gameUrl 主程序文件
 * @property string $gameVersion bin版本
 * @property int $gameSize bin大小/kb
 * @property string $resUrl 资源地址
 * @property string $resVersion res版本
 * @property int $resSize res大小/kb
 * @property string $updateTime 更新时间
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameNameCn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereGameVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo wherePackageName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereResSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereResUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereResVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereUpdateTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoGameInfo whereVersionCode($value)
 */
	class EdoGameInfo extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoItemInfo
 *
 * @property int $id
 * @property int $page 分页编号
 * @property string $itemName 信息标题
 * @property int $itemId 关联项目编号
 * @property int $itemType 项目类型
 * @property string $itemPicture 项目图片
 * @property int $pictureType 图片类型
 * @property string $itemDescription 项目描述
 * @property int $operateType 游戏操作模式
 * @property int $propId 单次进入游戏的费用
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo whereItemDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo whereItemName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo whereItemPicture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo whereItemType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo whereOperateType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo wherePage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo wherePictureType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoItemInfo wherePropId($value)
 */
	class EdoItemInfo extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoShopInfo
 *
 * @property int $id
 * @property int $page
 * @property string $title
 * @property string $desc
 * @property string $img
 * @property int $imgType
 * @property int $operateType
 * @property int $trial
 * @property int $itemId
 * @property int $itemType
 * @property int $productId
 * @property int $prodId
 * @property string $biz
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereBiz($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereImg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereImgType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereItemType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereOperateType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo wherePage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereProdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoShopInfo whereTrial($value)
 */
	class EdoShopInfo extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoStbConfig
 *
 * @property int $id
 * @property string $model
 * @property int $gameType
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbConfig whereGameType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbConfig whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbConfig whereModel($value)
 */
	class EdoStbConfig extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoStbLog
 *
 * @property int $id
 * @property int $userId
 * @property string $loginTime
 * @property string $uid
 * @property string $model
 * @property string $type
 * @property int $ram
 * @property string $os
 * @property string $gName
 * @property string $gVendor
 * @property string $gVersion
 * @property int $gRam
 * @property bool $gMt
 * @property string $gRt
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereGMt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereGName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereGRam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereGRt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereGVendor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereGVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereLoginTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereModel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereOs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereRam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereUid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoStbLog whereUserId($value)
 */
	class EdoStbLog extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoUser
 *
 * @property int $userId 用户编号
 * @property string $nickName 昵称
 * @property string $passportId 账号
 * @property string $retailId 渠道编号
 * @property string $items 业务数据
 * @property string $bizContent 业务数据
 * @property string $ownProps 拥有物品的到期时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereBizContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereItems($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereNickName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereOwnProps($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser wherePassportId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUser whereUserId($value)
 */
	class EdoUser extends \Eloquent {}
}

namespace App\Toodo\Edo{
/**
 * App\Toodo\Edo\EdoUserActionLog
 *
 * @property int $id
 * @property int $userId
 * @property int $page
 * @property int $action
 * @property int $flag
 * @property int $biz
 * @property string $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUserActionLog whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUserActionLog whereBiz($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUserActionLog whereFlag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUserActionLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUserActionLog wherePage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUserActionLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Edo\EdoUserActionLog whereUserId($value)
 */
	class EdoUserActionLog extends \Eloquent {}
}

namespace App\Toodo\Gxgd{
/**
 * App\Toodo\Gxgd\TdoGxgdAsset
 *
 * @property int $songId
 * @property string $assetId
 * @property string $otherSongs
 * @property int $online
 * @property int $verify
 * @property string $videoId
 * @property string $indexId
 * @property string $mediaId
 * @property string $originalId
 * @property string $url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereAssetId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereIndexId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereMediaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereOnline($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereOriginalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereOtherSongs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereSongId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereVerify($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAsset whereVideoId($value)
 */
	class TdoGxgdAsset extends \Eloquent {}
}

namespace App\Toodo\Gxgd{
/**
 * App\Toodo\Gxgd\TdoGxgdAssetOp
 *
 * @property int $opId
 * @property string $id 媒资注入ID
 * @property string $msg_id 消息id
 * @property string $type
 * @property string $opt_type
 * @property string $cp_id
 * @property string $status
 * @property string $create_time
 * @property string $summary
 * @property string $nns_id
 * @property string $is_sync
 * @property string $original_id
 * @property string $sync_time
 * @property string $code
 * @property string $msg
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereCpId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereCreateTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereIsSync($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereMsg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereMsgId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereNnsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereOpId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereOptType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereOriginalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereSummary($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereSyncTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdAssetOp whereType($value)
 */
	class TdoGxgdAssetOp extends \Eloquent {}
}

namespace App\Toodo\Gxgd{
/**
 * App\Toodo\Gxgd\TdoGxgdProd
 *
 * @property int $id
 * @property int $productId 产品编码
 * @property string $goodsName 产品包名称
 * @property int $feeType 计费周期
 * @property int $price 计费价格
 * @property string $idcId IDC产品ID
 * @property string $bossId BOSS产品ID
 * @property string $tariffId BOSS产品资费ID
 * @property bool $env 测试环境
 * @property bool $verify 已审核
 * @property string $pId 促销ID
 * @property string $pName 促销名称
 * @property string $pDesc 促销描述
 * @property int $pType
 * @property string $pUnit
 * @property string $pValue
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereBossId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereEnv($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereFeeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereGoodsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereIdcId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd wherePDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd wherePId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd wherePName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd wherePType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd wherePUnit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd wherePValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereTariffId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Gxgd\TdoGxgdProd whereVerify($value)
 */
	class TdoGxgdProd extends \Eloquent {}
}

namespace App\Toodo\Hnyx{
/**
 * App\Toodo\Hnyx\TdoHnyxAsset
 *
 * @property int $songId
 * @property string $assetId
 * @property string $otherSongs
 * @property int $online
 * @property int $verify
 * @property string $videoId
 * @property string $url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereAssetId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereOnline($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereOtherSongs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereSongId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereVerify($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAsset whereVideoId($value)
 */
	class TdoHnyxAsset extends \Eloquent {}
}

namespace App\Toodo\Hnyx{
/**
 * App\Toodo\Hnyx\TdoHnyxAssetOp
 *
 * @property int $id
 * @property int $op
 * @property int $songId
 * @property string $assetId
 * @property string $code
 * @property string $msg
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereAssetId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereMsg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereOp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereSongId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxAssetOp whereUpdatedAt($value)
 */
	class TdoHnyxAssetOp extends \Eloquent {}
}

namespace App\Toodo\Hnyx{
/**
 * App\Toodo\Hnyx\TdoHnyxBill
 *
 * @property int $userId
 * @property string $ownBills
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxBill whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxBill whereOwnBills($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxBill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Hnyx\TdoHnyxBill whereUserId($value)
 */
	class TdoHnyxBill extends \Eloquent {}
}

namespace App\Toodo\Market{
/**
 * App\Toodo\Market\TdoGoodsInfo
 *
 * @property int $productId 统一商品编号
 * @property string $goodsId 商家自编号
 * @property string $goodsName 商品名称
 * @property string $goodsDesc 商品描述
 * @property bool $complex 是复合产品
 * @property string $comment 复合内容
 * @property bool $category 产品类型
 * @property int $price 定价/分
 * @property int $storeId 商家编号
 * @property string $storeName 商家名称
 * @property bool $verify 已审核
 * @property string $note 备注
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereComplex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereGoodsDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereGoodsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereGoodsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereStoreName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Market\TdoGoodsInfo whereVerify($value)
 */
	class TdoGoodsInfo extends \Eloquent {}
}

namespace App\Toodo\Serve{
/**
 * App\Toodo\Serve\TdoServiceData
 *
 * @property string $serialNo 开通服务序列号
 * @property int $userId 用户编号
 * @property string $retailId 渠道编号
 * @property int $productId 商品统一编号
 * @property string $goodsName 服务名称
 * @property string $beginTime 起始时间
 * @property string $endTime 到期时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $tradeNo
 * @property bool $own
 * @property string $ownTime
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereBeginTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereGoodsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereOwn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereOwnTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereSerialNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Serve\TdoServiceData whereUserId($value)
 */
	class TdoServiceData extends \Eloquent {}
}

namespace App\Toodo\Tda{
/**
 * App\Toodo\Tda\TdaMatch
 *
 * @property int $id
 * @property int $songId
 * @property string $records
 * @property string $beginTime
 * @property string $endTime
 * @property int $last
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaMatch whereBeginTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaMatch whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaMatch whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaMatch whereLast($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaMatch whereRecords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaMatch whereSongId($value)
 */
	class TdaMatch extends \Eloquent {}
}

namespace App\Toodo\Tda{
/**
 * App\Toodo\Tda\TdaRecord
 *
 * @property int $id
 * @property int $songId
 * @property int $userId
 * @property int $score
 * @property int $combo
 * @property float $perfect
 * @property int $eval
 * @property float $calorie
 * @property string $time
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereCalorie($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereCombo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereEval($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord wherePerfect($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereScore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereSongId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaRecord whereUserId($value)
 */
	class TdaRecord extends \Eloquent {}
}

namespace App\Toodo\Tda{
/**
 * App\Toodo\Tda\TdaSong
 *
 * @property int $songId
 * @property int $category
 * @property string $title
 * @property string $singer
 * @property int $long
 * @property bool $hot
 * @property bool $fresh
 * @property bool $suggest
 * @property string $rhythm
 * @property int $grade
 * @property int $state
 * @property bool $verify
 * @property int $user
 * @property int $score
 * @property string $mvUrl
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereFresh($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereGrade($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereHot($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereLong($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereMvUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereRhythm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereScore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereSinger($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereSongId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereSuggest($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereUser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaSong whereVerify($value)
 */
	class TdaSong extends \Eloquent {}
}

namespace App\Toodo\Tda{
/**
 * App\Toodo\Tda\TdaUser
 *
 * @property int $userId
 * @property string $records
 * @property float $calorie
 * @property float $lastCalorie
 * @property float $hisCalorie
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $matchs 最近比赛得分
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereCalorie($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereHisCalorie($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereLastCalorie($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereMatchs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereRecords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tda\TdaUser whereUserId($value)
 */
	class TdaUser extends \Eloquent {}
}

namespace App\Toodo\Tdc{
/**
 * App\Toodo\Tdc\TdcDockerInfo
 *
 * @property int $id
 * @property string $subject
 * @property string $body
 * @property int $count
 * @property string $items
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcDockerInfo whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcDockerInfo whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcDockerInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcDockerInfo whereItems($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcDockerInfo whereSubject($value)
 */
	class TdcDockerInfo extends \Eloquent {}
}

namespace App\Toodo\Tdc{
/**
 * App\Toodo\Tdc\TdcItemInfo
 *
 * @property int $id
 * @property int $type
 * @property int $typeId
 * @property string $imgs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcItemInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcItemInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcItemInfo whereImgs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcItemInfo whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcItemInfo whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcItemInfo whereUpdatedAt($value)
 */
	class TdcItemInfo extends \Eloquent {}
}

namespace App\Toodo\Tdc{
/**
 * App\Toodo\Tdc\TdcPageInfo
 *
 * @property int $id
 * @property int $area
 * @property int $page
 * @property int $docker
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcPageInfo whereArea($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcPageInfo whereDocker($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcPageInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcPageInfo wherePage($value)
 */
	class TdcPageInfo extends \Eloquent {}
}

namespace App\Toodo\Tdc{
/**
 * App\Toodo\Tdc\TdcRowInfo
 *
 * @property int $id
 * @property int $docker
 * @property bool $subject
 * @property bool $body
 * @property int $width
 * @property int $height
 * @property int $padding
 * @property int $spacing
 * @property int $count
 * @property string $span
 * @property string $slots
 * @property string $imgs
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereDocker($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereImgs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo wherePadding($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereSpacing($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereSpan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcRowInfo whereWidth($value)
 */
	class TdcRowInfo extends \Eloquent {}
}

namespace App\Toodo\Tdc{
/**
 * App\Toodo\Tdc\TdcShopInfo
 *
 * @property int $id
 * @property string $subject
 * @property string $body
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcShopInfo whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcShopInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tdc\TdcShopInfo whereSubject($value)
 */
	class TdcShopInfo extends \Eloquent {}
}

namespace App\Toodo\Tde{
/**
 * App\Toodo\Tde\TdeCoinsLog
 *
 * @property int $id
 * @property int $userId
 * @property int $coins
 * @property int $add
 * @property string $time
 * @property int $gameId
 * @property string $goodsId
 * @property string $goodsName
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereAdd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereCoins($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereGoodsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereGoodsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeCoinsLog whereUserId($value)
 */
	class TdeCoinsLog extends \Eloquent {}
}

namespace App\Toodo\Tde{
/**
 * App\Toodo\Tde\TdePageInfo
 *
 * @property int $id
 * @property int $page 页面编号
 * @property int $itemId 显示项编号
 * @property string $title 显示标题
 * @property int $gameId 游戏编号
 * @property int $productId 商品统一编号.查询服务
 * @property int $prodId 商品统一编号.查询商店
 * @property string $url 项目调用地址
 * @property string $img 显示图片
 * @property bool $trial 状态标识
 * @property string $biz 备注
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereBiz($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereImg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo wherePage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereProdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereTrial($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdePageInfo whereUrl($value)
 */
	class TdePageInfo extends \Eloquent {}
}

namespace App\Toodo\Tde{
/**
 * App\Toodo\Tde\TdeUser
 *
 * @property int $userId 用户编号
 * @property string $nick 昵称
 * @property int $coins 金币余额
 * @property int $hisCoins 历史总额
 * @property string $biz 业务信息
 * @property string $ownTD003 跳舞包月到期时间
 * @property string $ownTD011 半年送毯到期时间
 * @property string $ownTD005 上次跳舞毯购买时间
 * @property string $ownTD017 季度送毯到期时间
 * @property string $childLock 童锁
 * @property int $danceMat 历史购买跳舞毯次数
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereBiz($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereChildLock($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereCoins($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereDanceMat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereHisCoins($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereNick($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereOwnTD003($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereOwnTD005($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereOwnTD011($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereOwnTD017($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Tde\TdeUser whereUserId($value)
 */
	class TdeUser extends \Eloquent {}
}

namespace App\Toodo{
/**
 * App\Toodo\TdoNotifyLog
 *
 * @property int $id
 * @property string $retailId
 * @property string $method
 * @property string $bizIn
 * @property string $bizOut
 * @property string $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoNotifyLog whereBizIn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoNotifyLog whereBizOut($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoNotifyLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoNotifyLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoNotifyLog whereMethod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoNotifyLog whereRetailId($value)
 */
	class TdoNotifyLog extends \Eloquent {}
}

namespace App\Toodo{
/**
 * App\Toodo\TdoPayLog
 *
 * @property string $tradeNo
 * @property int $userId
 * @property string $retailId
 * @property string $biz
 * @property string $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoPayLog whereBiz($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoPayLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoPayLog whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoPayLog whereTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\TdoPayLog whereUserId($value)
 */
	class TdoPayLog extends \Eloquent {}
}

namespace App\Toodo\Trade{
/**
 * App\Toodo\Trade\TdoBillLog
 *
 * @property int $id
 * @property int $userId
 * @property string $retailId
 * @property string $tradeNo
 * @property int $productId
 * @property string $subject
 * @property int $logType
 * @property int $amount
 * @property string $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereLogType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoBillLog whereUserId($value)
 */
	class TdoBillLog extends \Eloquent {}
}

namespace App\Toodo\Trade{
/**
 * App\Toodo\Trade\TdoOrderData
 *
 * @property string $tradeNo 交易号
 * @property string $retailId 渠道编号
 * @property string $orderNo 输入订单号
 * @property int $userId 买家的用户编号
 * @property int $storeId 门店编号
 * @property string $storeName 门店名称
 * @property int $totalAmount 订单金额/分
 * @property string $subject 订单标题
 * @property string $body 订单描述
 * @property string $goodsDetail 订单包含的商品列表信息
 * @property string $extendParams 业务扩展参数
 * @property string $extUserInfo 买家额外信息
 * @property string $payTimeout 最晚付款时间
 * @property int $payAmount 买家实付金额/分
 * @property int $receiptAmount 实收金额/分
 * @property string $serialNo 支付流水号
 * @property int $tradeStatus 交易状态
 * @property string $payTime 交易支付时间
 * @property string $sendPayTime 打款给卖家的时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereExtUserInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereExtendParams($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereGoodsDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereOrderNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData wherePayAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData wherePayTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData wherePayTimeout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereReceiptAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereSendPayTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereSerialNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereStoreName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereTotalAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereTradeStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereUserId($value)
 */
	class TdoOrderData extends \Eloquent {}
}

namespace App\Toodo\Trade{
/**
 * App\Toodo\Trade\TdoOrderStatusLog
 *
 * @property int $id
 * @property int $userId
 * @property string $tradeNo
 * @property int $tradeStatus
 * @property string $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderStatusLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderStatusLog whereTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderStatusLog whereTradeStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderStatusLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderStatusLog whereUserId($value)
 */
	class TdoOrderStatusLog extends \Eloquent {}
}

namespace App\Toodo\Unicom{
/**
 * App\Toodo\Unicom\TdoUnicomProd
 *
 * @property int $id
 * @property int $productId
 * @property string $goodsName
 * @property int $feeType
 * @property int $price
 * @property string $idcId
 * @property bool $env 测试环境
 * @property bool $verify 已审核
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd whereEnv($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd whereFeeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd whereGoodsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd whereIdcId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Unicom\TdoUnicomProd whereVerify($value)
 */
	class TdoUnicomProd extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $personId 用户编号
 * @property int $stboxId 用户机顶盒编号
 * @property string $retailId 平台渠道编号
 * @property string $regionCode 区域编号
 * @property string $cardTV 机顶盒卡号
 * @property string $bizUser 业务用户信息
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBizUser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCardTV($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePersonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRegionCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStboxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

