<?php

namespace App\Toodo\Tdc;

use App\Toodo\Edo\EdoGameInfo;
use App\Toodo\ToodoController;
use Illuminate\Http\Request;


class TdcController extends ToodoController
{
    protected function doMethod($request)
    {
        //$method = $request['method'];
        return [
            'code' => 10004,
            'msg' => '找不到指定method的方法',
        ];
    }

    public function item(Request $request)
    {
        $itemId = $request->input('item', 0);
        $item = TdcItemInfo::find($itemId);
        if (!$item) {
            return null;
        }

        $biz = null;
        switch ($item->type) {
            case 1:
                $biz = EdoGameInfo::where('gameId', '=', $item->typeId)->first();
                break;
            case 2:
                $biz = TdcShopInfo::find($item->typeId);
                break;
        }
        return [
            'itemId' => $item->id,
            'slotId' => $item->type,
            'biz' => json_encode($biz),
        ];
    }

    public function page(Request $request)
    {
        $area = $request->input('area', 1);
        $page = $request->input('page', 1);
        $size = $request->input('size', 5);

        $paginate = TdcPageInfo::whereArea($area)->paginate($size, ['*'], 'page', $page);

        $contains = $paginate->items();
        foreach ($contains as $contain) {
            $docker = TdcDockerInfo::find($contain->docker);
            if ($docker) {
                $iIds = explode(',', $docker->items);
                $beginId = intval($iIds[0]);
                $endId = intval($iIds[1]);

                $items = TdcItemInfo::whereBetween('id', [$beginId, $endId])->get();
                $itemCnt = count($items);
                $idx = 0;
                \Log::debug("-e TdcItemInfo $beginId $endId :"
                    . json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

                /** @var TdcRowInfo[] $rows */
                $rows = TdcRowInfo::whereDocker($docker->id)->get();
                foreach ($rows as $row) {
                    $holdItems = [];

                    $imgIds = empty($row->imgs) ? null : explode(',', $row->imgs);

                    for ($itnIdx = 0; $itnIdx < $row->count; ++$itnIdx) {
                        if ($idx >= $itemCnt) break;

                        $imgId = empty($imgIds) ? 0 : $imgIds[$itnIdx];

                        $item = $items[$idx];
                        $md5 = md5($item->updated_at);

                        $imgs = json_decode($item->imgs, true);
                        $img = array_get($imgs, "img$imgId", '');

                        $biz = null;
                        switch ($item->type) {
                            case 2:
                                $biz = TdcShopInfo::find($item->typeId);
                                break;
                        }

                        array_push($holdItems, [
                            'itemId' => $item->id,
                            'slotId' => $item->type,
                            'img' => $img,
                            'v' => substr($md5, 0, 4), //4位MD5版本号
                            'biz' => json_encode($biz),
                        ]);
                        $idx++;
                    }
                    $row->infos = $holdItems;
                }

                $docker->rows = $rows;
            }
            $contain->docker = $docker;
        }

        return [
            'total' => $paginate->total(),
            'per_page' => $paginate->perPage(),
            'current_page' => $paginate->currentPage(),
            'last_page' => $paginate->lastPage(),
            //'next_page_url' => $paginate->nextPageUrl(),
            //'prev_page_url' => $paginate->previousPageUrl(),
            'from' => $paginate->firstItem(),
            'to' => $paginate->lastItem(),
            'data' => $contains,
        ];
    }
}
