<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\Model;
use think\cache\driver\Redis;
class Type extends Controller
{   
	/**
	*@商品模型列表
	*/
    public function typeList()
     {   

        //查询数据
        $where="1=1";
        $fid=["type_id","type_name","enabled","type_content"];

        //查询所有数据

        $data1=model("GoodsType")->getSelects($where,$fid);
     	//限制条数查询
        $data=model("GoodsType")->getSelect($where,$fid);
        //总条数
        $sum=count($data1);
        //每页条数
        $num=10;
        //总页数
        $pagesum=ceil($sum/$num);
        // echo $pagesum;
     	return $this->fetch("typeList",["data"=>$data,"pagesum"=>$pagesum,"sum"=>$sum]);
     }





     /**
	*@商品模型添加
	*/
	public function typeAdd()
	{   
		// $request = Request::instance();
		if ($_POST) {
            //接收前台表单数据
			$data=input("post.");
			unset($data['file']);
            //防止用户xss攻击并组合添加数组
			$type_name=$da['type_name']=htmlspecialchars($data['type_name']);
			$da['type_content']=htmlspecialchars($data['type_content']);
			$da['enabled']=1;
			//调用model判断唯一性
            $where="type_name='$type_name'";
			$msg=model("GoodsType")->getfind($where);

            if($msg){
            	 echo "<script>alert('请勿重复添加');location.href='typeAdd'</script>";
            	die;  
            }else{
            	//调用model执行添加操作
            	$add=model("GoodsType")->insertOne($da);
            	if($add){
				    echo "<script>alert('添加成功');location.href='typeList'</script>";
				}else{
					echo "<script>alert('添加失败');location.href='typeAdd'</script>";
				}
            }
            
			
		}else{
           return $this->fetch("typeAdd"); 
		}
	}



	/**
	*@商品模型删除
	*/
    public function typeDele()
     {  
     	//接收数据（类型id）
     	$type_id=input("post.type_id");
        // echo $type_id;die;
        //查询出模型下面相对应的属性
        $attr_id=Db::query("SELECT attr_id FROM pp_attribute WHERE type_id IN($type_id)");
        if ($attr_id) {
            $arr=[];
            foreach ($attr_id as $key => $value) {
                array_push($arr, $value["attr_id"]);
            }
            $arr=implode(",", $arr);
            // print_r($arr);die;
            //删除模型下面相对应的属性
            Db::query("DELETE FROM pp_attribute WHERE attr_id IN($arr)");
        }
        
        // print_r($type_ids);die;
        $type_id=explode(",", $type_id);
        // $type_ids=[];
        // array_push($type_ids, $type_id);
        // print_r($type_id);die;
        $pagenow=input("post.pagenow");
        $search_input=input("post.search_input");
        // 执行删除
        $res=model("GoodsType")->getDele($type_id);



        // print_r($res);die;
     	if ($res) {

            $start=($pagenow-1)*10;
            //判断删除条件
            if ($search_input=="") {
               $data=model("goods_type")->getPage($start); 
            }else{
                $where="type_name like '%$search_input%'";
                $data=model("goods_type")->getPage($start,$where);
            }
            //组合返回数据
            $msg["contents"]=$data;
     		$msg["status"]=1;
     	}else{
            $msg["status"]=0;
     	}
        //返回json数据
        echo json_encode($msg);
     }


    /**
    *@商品模型搜索
    *return json数据
    */
    public function search()
     {  
        //接收数据（类型id）
        $search_input=input("get.search_input");
        $where="type_name like '%$search_input%'";
        $fid=["type_id","type_name","enabled","type_content"];

        $data1=model("GoodsType")->getSelects($where,$fid);


        $data=model("GoodsType")->getSelect($where,$fid);
        //总条数
        $sum=count($data1);
        //每页条数
        $num=10;
        //总页数
        $pagesum=ceil($sum/$num);

        if ($data) {
            $msg["status"]=1;
            $msg['contents']=$data;
            $msg["sum"]=$sum;
            $msg['pagesum']=$pagesum;
        }else{
            $msg["status"]=0;
            $msg["sum"]=$sum;
            $msg['pagesum']=$pagesum;
        }

        echo json_encode($msg);
     }


    /**
    *@商品分页
    *return json数据
    */
    public function page()
    {
        $p=input("get.p");
        $search_input=input("get.search_input");
        $start=($p-1)*10;
        if ($search_input=="") {
            $where="";
        }else{
            $where="type_name like '%$search_input%'";
        }
        //不限制条数
            $data1=model("GoodsType")->getPages($where);
            //符合条件的总条数
            $sum=count($data1);
            //总页数
            $num=ceil($sum/10);
            //限制条数查询出的数据
            $data=model("GoodsType")->getPage($start,$where);
        
        if ($data) {
            $msg["status"]=1;
            $msg["sum"]=$sum;
            $msg["pagesum"]=$num;
            $msg['contents']=$data;
        }else{
            $msg["status"]=0;
        }
        echo json_encode($msg);
    }
    


    /**
    *类型数据修改
    */
    public function typeUpdate()
    {   
        if ($_POST) {
            $feg=input("post.");
            unset($feg["file"]);
            
            if(model("GoodsType")->getUpdate($feg)){
                echo "<script>alert('修改成功');location.href='typeList'</script>";
            }else{
                echo "<script>alert('没有修改数据');location.href='typeList'</script>";
            }
            // print_r($feg);
        }else{
            $type_id=input("get.type_id");
            $data="type_id=$type_id";
            $feild=["type_id","type_name","enabled","type_content"];
            $msg=model("GoodsType")->getfinds($data,$feild);
            // print_r($msg);
            return $this->fetch("typeUpdate",["msg"=>$msg]); 
        }
        
    }


}
