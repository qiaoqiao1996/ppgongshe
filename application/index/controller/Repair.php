<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
//use think\Request;
//use think\Loader;
class Repair extends Controller
{
	/*
	*报修展示
	*/
    public function show()
     {
     	//$request = Request::instance();
          $data = db("repair_list")->alias("l")->join("repair_type t",'l.t_id = t.t_id')->order('l_id desc')->field("l_id,l_numbers,l_time,t_name,l_status,l_name")->limit(6)->select();
          
          // echo $request->root(). '/' . $request->module() . '/' . Loader::parseName($request->controller());
          $res=db("repair_list")->select();
          $count=count($res);
          $total=ceil($count/6);
          $type = db("repair_type")->select();

          
     	return $this->fetch("show",['data'=>$data,'total'=>$total,"count"=>$count,'type'=>$type]);
     }  
    
    /*
    *详细信息
    */
     public function xqlist()
     {
           $id = input("get.id");
           
           $data = Db::query("select * from pp_repair_list as l INNER JOIN pp_repair_type as t on l.t_id = t.t_id LEFT JOIN pp_repair_img as i ON l.l_id = i.l_id where l.l_id = ".$id);
       
        $new_data = array();
        foreach ($data as $k => $v) {
             $new_data['l_numbers']=$v['l_numbers'];
             $new_data['l_tel']=$v['l_tel'];
             $new_data['l_name']=$v['l_name'];
             $new_data['l_address']=$v['l_address'];
             $new_data['l_content']=$v['l_content'];
             $new_data['l_status']=$v['l_status'];
             $new_data['l_time']=$v['l_time'];
             $new_data['t_name']=$v['t_name'];
             $new_data['l_img'][$v['i_id']]=$v['i_img'];
         }
         // print_r($new_data);die;
         // if(empty($new_data['l_img'])){
         //    echo "是";
         // }else{
         //    echo "不";
         // }
         
        return view("xqlist",['data'=>$new_data]);
            
     }
    
    /*
    *分页
    */
    public function page(){
          $p=input("post.p");
          $statu=input("post.statu");
          $t_id=input("post.t_id");
          $where=array();
          if(!empty($t_id)){
            $where['pp_repair_list.t_id']=$t_id;
          }
           if(!empty($statu)){
                if($statu==1){
                     $where['l_status']="2";
                }else if($statu==2){
                     $where['l_status']=['lt',"2"];
                }
          }
           $limit = ($p-1)*6;

           $data=db("repair_list")->alias("l")->join("repair_type t",'l.t_id = t.t_id')->order('l_id desc')->field("l_id,l_numbers,l_time,t_name,l_status,l_name")->where($where)->limit($limit,6)->select();
          
              
         echo json_encode($data);
    }

     /*
     搜索
    */
    public function sea(){
          $statu=input("post.statu");
          $t_id = input("post.t_id");
          
          $where=array();
          if(!empty($t_id)){
            $where['pp_repair_list.t_id']=$t_id;
          }
           if(!empty($statu)){
                if($statu==1){
                     $where['l_status']="2";
                }else if($statu==2){
                     $where['l_status']=['lt',"2"];
                }
          }
              $data=db("repair_list")->alias("l")->join("repair_type t",'l.t_id = t.t_id')->order('l_id desc')->field("l_id,l_numbers,l_time,t_name,l_status,l_name")->where($where)->limit(0,6)->select();
              $count = count(db("repair_list")->where($where)->select());
              $total=ceil($count/6);          
          
          
        
          $arr['data']=$data;
          $arr['total']=$total;
          $arr['count']=$count;
          // // print_r($arr);
          return $arr;        
                 
     }

}
