<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\Model;
use think\cache\driver\Redis;
class Rebate extends Controller
{   
	public function rebateAdd()
    {
        if ($_POST) {
            $res=input("post.");
            // print_r($res);die;
            if ($res["v"]==1) {
                $msg["rebate_id"]=1;
                $msg["one"]=$res["rebate"];
            }
            print_r($msg);
        }else{
            $data=Db::table("pp_rebate")->find();
            return $this->fetch("rebateAdd",["data"=>$data]);
        }
    }
}
