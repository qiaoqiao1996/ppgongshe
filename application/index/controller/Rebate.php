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
    /*
    * 返利比例添加
    *
    */
	public function rebateAdd()
    {
        if ($_POST) {
            $res=input("post.");
            $ss=Db::table("pp_rebate")->where("rebate_id",1)->find();
                unset($ss["rebate_id"]);
            if ($res["v"]==1) { 
                $um=$ss['one'];
                $ss["one"]=$res["rebate"];
                $num=array_sum($ss);
                if ($num>100) {
                    $turn["status"]=0;
                    $turn["um"]=$um;
                    $turn["num"]="提交比例不正确";
                    echo json_encode($turn);
                    die;
                }else{
                   $msg["rebate_id"]=1;
                   $msg["one"]=$res["rebate"]; 
                }
                
            }else if($res["v"]==2) {
                $um=$ss['two'];
                $ss["two"]=$res["rebate"];
                $num=array_sum($ss);
                if ($num>100) {
                    $turn["status"]=0;
                    $turn["um"]=$um;
                    $turn["num"]="提交比例不正确";
                    echo json_encode($turn);
                    die;
                }else{
                   $msg["rebate_id"]=1;
                   $msg["two"]=$res["rebate"];
                }

                
            }else if($res["v"]==3){
                $um=$ss['three'];
                $ss["three"]=$res["rebate"];
                $num=array_sum($ss);
                if ($num>100) {
                    $turn["status"]=0;
                    $turn["um"]=$um;
                    $turn["num"]="提交比例不正确";
                    echo json_encode($turn);
                    die;
                }else{
                   $msg["rebate_id"]=1;
                   $msg["three"]=$res["rebate"];
                }
                
            }else if($res["v"]==4){
                $um=$ss['four'];
                $ss["four"]=$res["rebate"];
                $num=array_sum($ss);
                if ($num>100) {
                    $turn["status"]=0;
                    $turn["um"]=$um;
                    $turn["num"]="提交比例不正确";
                    echo json_encode($turn);
                    die;
                }else{
                   $msg["rebate_id"]=1;
                   $msg["four"]=$res["rebate"];
                }
                
            }else if($res["v"]==5){
                $um=$ss['five'];
                $ss["five"]=$res["rebate"];
                $num=array_sum($ss);
                if ($num>100) {
                    $turn["status"]=0;
                    $turn["um"]=$um;
                    $turn["num"]="提交比例不正确";
                    echo json_encode($turn);
                    die;
                }else{
                   $msg["rebate_id"]=1;
                   $msg["five"]=$res["rebate"];
                }
                
            }
            if(Db::table("pp_rebate")->update($msg)){
                 $turn["status"]=1;
                 $turn["num"]="修改成功";
                 echo json_encode($turn);
            }else{
                 $turn["status"]=2;
                 $turn["um"]=$res["rebate"];
                 $turn["num"]="修改失败";
                 echo json_encode($turn);
            }
            
        }else{
            $data=Db::table("pp_rebate")->find();
            return $this->fetch("rebateAdd",["data"=>$data]);
        }
    }
    
    /*
    * 个人返利详情
    *
    */

    public function rebateShow()
    {
        $user_id=input("get.user_id");
        if ($user_id) {
            $data=Db::query("SELECT rebate_type,rebate_user,rebate_money,rebate_level,rebate_pro,rebate_time FROM pp_rebateinfo WHERE user_id=$user_id");
            foreach ($data as $key => $value) {
                 $data[$key]["rebate_time"]=date("Y-m-d H:i:s",$value['rebate_time']);
                 $user=Db::table("pp_user")->field("user_name")->where("user_id",$value["rebate_user"])->find();
                 $data[$key]["rebate_user"]=$user["user_name"];
            }
            // print_r($data);die;
            return $this->fetch("rebateShow",["data"=>$data]);
        }else{
            echo "<script>alert('参数错误');location.href='rebate_list'</script>";
        }
        
    }


    /*
    * 返利列表
    *
    */

    public function rebateList()
    {   
        $data=Db::query("SELECT pp_user.user_id,regirect_time,rebate_money,user_name FROM pp_user LEFT JOIN pp_user_info ON pp_user.user_id=pp_user_info.user_id");
        foreach ($data as $key => $value) {
                $data[$key]["regirect_time"]=date('Y-m-d H:i:s',$value["regirect_time"]);
        }
        // print_r($data);die;
        return $this->fetch("rebateList",["data"=>$data]);
    }


}
