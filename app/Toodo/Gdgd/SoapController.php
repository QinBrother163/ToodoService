<?php

namespace App\Toodo\Gdgd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SoapController extends Controller
{
    protected $fsdp;

    public function __construct(FsdpClient $fsdp)
    {
        $this->fsdp = $fsdp;
    }

    public function orderRelation(Request $request)
    {
        return $this->fsdp->orderRelation($request->all());
    }

    public function orderRelationAffirm(Request $request)
    {
        return $this->fsdp->orderRelationAffirm($request->all());
    }

    public function orderRelationLv2(Request $request)
    {
        return $this->fsdp->orderRelationLv2($request->all());
    }

    public function payAuth(Request $request)
    {
        return $this->fsdp->payAuth($request->all());
    }

    public function queryServInfo(Request $request)
    {
        return $this->fsdp->queryServInfo($request->all());
    }

    public function queryUserInfo(Request $request)
    {
        return $this->fsdp->queryUserInfo($request->all());
    }

    public function fsdp(Request $request)
    {
       return $this->fsdp->fsdp($request);
    }
}
