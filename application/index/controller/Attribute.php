<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\Model;
use think\Url;
use think\cache\driver\Redis;
class Attribute extends Controller
{   
	/**
	*@模型属性列表
	*/
    public function attrList()
     {  
        //接收数据
        $type_id=input("get.type_id");
        if (isset($type_id)) {
            $where="type_id=$type_id";
            //根据条件进行数据查询
            $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id");
            //总条数
            $sum=count($data1);
            //总页数
            $pagesum=ceil($sum/10);

            $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id LIMIT 10");
            //查询模型名称
            $field=["type_id","type_name"];
            $type=model("GoodsType")->getField($field);
            //页面渲染       
            return $this->fetch("attrList",["data"=>$data,"type"=>$type,"type_id"=>$type_id,"sum"=>$sum,"pagesum"=>$pagesum]);

        }else{
            //数据查询
            $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id");

            //总条数
            $sum=count($data1);
            //总页数
            $pagesum=ceil($sum/10);
            //查询模型名称
            $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id LIMIT 10");


            $field=["type_id","type_name"];
            $type=model("GoodsType")->getField($field);
            //页面渲染
            return $this->fetch("attrList",["data"=>$data,"type"=>$type,"type_id"=>0,"sum"=>$sum,"pagesum"=>$pagesum]);

        }
     	
     }





     /**
	*@商品模型属性添加
	*/
	public function attrAdd()
	{   
		// $request = Request::instance();
		if ($_POST) {
            //接收前台表单数据
			$data=input("post.");


            // print_r($data);die;
			// Array ( [attr_name] => 颜色 [type_id] => 16 [attr_type] => 1 )
            //防止用户xss攻击并组合添加数据
			$attr_name=$da['attr_name']=htmlspecialchars($data['attr_name']);
			$type_id=$data['type_id'];
            if ($type_id==0) {
                echo "<script>alert('请选择模型');location.href='attrAdd'</script>";
                die;
            }
            $da['type_id']=$type_id;
            $da['attr_type']=$data['attr_type'];
			//调用model判断唯一性
            $where="attr_name='$attr_name' AND type_id=$type_id";
			$msg=model("Attribute")->getfind($where);
         
            if($msg){
            	 echo "<script>alert('请勿重复添加');location.href='attrAdd'</script>";
            	die;  
            }else{
            	//调用model执行添加操作
            	$add=model("Attribute")->insertOne($da);
            	if($add){
				    return $this->redirect('attrRedirect',array("attr_name"=>$attr_name,"type_id"=>$type_id)); 
				}else{
					echo "<script>alert('添加失败');location.href='attrAdd'</script>";
				}
            }
            
		}else{

            //接收前台传输过来的数据type_id值
            $type_id=input("get.type_id");

            if (isset($type_id)) {
                $where="type_id=$type_id";
            }else{
                $where="1=1";
            }
            $field=["type_id","type_name"];
            $type=model("GoodsType")->getField($field);
            
            return $this->fetch("attrAdd",["type"=>$type,"type_id"=>$type_id]); 
		}
	}

       /**
       *@添加完之后的选择跳转
       */
        public function attrRedirect()
        {
            $data=input("param.");
            return $this->fetch("attrRedirect",["data"=>$data]); 
        }

    /**
    *@属性分页
    *return json数据
    */
    public function page()
    {
        $p=input("get.p");
        $type_id=input("get.type_id");
        $start=($p-1)*10;
        if ($type_id==0) {
            $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id");

            $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id LIMIT $start,10");
            $sum=count($data);
            $num=ceil($sum/10);

        }else{
            
            $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id");


            $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id LIMIT $start,10");
            $sum=count($data);
            $num=ceil($sum/10);
        }
        
        if ($data1) {
            $msg["status"]=1;
            $msg["sum"]=$sum;
            $msg["pagesum"]=$num;
            $msg['contents']=$data1;
        }else{
            $msg["status"]=0;
        }
        echo json_encode($msg);
    }

    public function attrDele()
    {
        $attr_id=input("post.attr_id");

        $pagenow=input("post.pagenow");
        $type_id=input("post.type_id");
        if ($attr_id) {
           $attr=explode(",", $attr_id); 
        }else{
           echo "<script>alert('请选择要删除的属性');location.href='attrList'</script>";
           die;
        }
        //执行删除
        $res=model("Attribute")->getDele($attr);

        if ($res) {

        $start=($pagenow-1)*10;
        //判断删除条件
        if ($type_id==0) {
            $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id"); 
            $sum=count($data1);
            $pagesum=ceil($sum/10);
            
           $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id  LIMIT $start,10"); 
        }else{

            $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id"); 
            $sum=count($data1);
            $pagesum=ceil($sum/10);


            $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id LIMIT $start,10");
        }
        //组合返回数据
            $msg["contents"]=$data;
            $msg["status"]=1;
            $msg["pagesum"]=$pagesum;
            $msg["sum"]=$sum;
        }else{
            $msg["status"]=0;
        }
       echo json_encode($msg);
    }


    /**
    *@属性查询
    *return json数据
    */
    public function search()
    {    
        //接收数据
        $type_id=input("post.type_id");
        
        if (isset($type_id)) {

            if ($type_id==0) {
                //根据条件进行数据查询
                $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id");
                //总条数
                $sum=count($data1);
                //总页数
                $pagesum=ceil($sum/10);

                $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id  LIMIT 10");
            }else{
                //根据条件进行数据查询
                $data1=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id");
                //总条数
                $sum=count($data1);
                //总页数
                $pagesum=ceil($sum/10);

                $data=Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id LIMIT 10");
            }
            //页面渲染 
            $msg["status"]=1;
            $msg["contents"]=$data;
            $msg["sum"]=$sum;
            $msg["pagesum"]=$pagesum;

    }else{
        
          $msg["status"]=0;
    }

    echo json_encode($msg);

   }

   /**
    *@属性修改
    *return json数据
    */
   public function attrUpdate()
   {
       if ($_POST) {
           $data=input("post.");
           $type_id=$data["type_id"];
           $attr_name=$data["attr_name"];
           $attr_id=Db::query("SELECT attr_id FROM pp_attribute WHERE type_id=$type_id AND attr_name='$attr_name'");
           
           if ($attr_id) {
               if ($attr_id[0]["attr_id"]!=$data["attr_id"]) {
                  echo "<script>alert('该模型下已经有该属性');location.href='attrList'</script>";   
            }else{
               if(Db::table('pp_attribute')->update($data)){
                    echo "<script>alert('修改成功');location.href='attrList'</script>";
                  
               } 
            }
           }else{
             if(Db::table('pp_attribute')->update($data)){
                    echo "<script>alert('修改成功');location.href='attrList'</script>";
                  
               }
           }
           
           
           
       }else{
          $attr_id=input("get.attr_id");
          if ($attr_id) {
              $where="attr_id=$attr_id";
              $attr=model("Attribute")->getfinds($where);


              $field=["type_id","type_name"];
              $type=model("GoodsType")->getField($field);
              // print_r($type);die;
              return $this->fetch("attrUpdate",["attr"=>$attr,"type"=>$type]);
              // print_r($attr); 
          }else{
            echo "<script>alert('请选择要修改的属性');location.href='attrList'</script>";
          }
          
       }
   }
}