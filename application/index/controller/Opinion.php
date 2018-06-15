<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Opinion extends Controller
{
	/*
	*意见展示
	*/
     public function show()
     {
     	//$request = Request::instance();
          $data = db("opinion")->alias("o")->join("user u",'o.u_id = u.user_id')->order('o_id desc')->field("o_id,o_title,o_content,user_name")->limit(6)->select();
          // echo $request->root(). '/' . $request->module() . '/' . Loader::parseName($request->controller());
          $res = db("opinion")->select();
          $count = count($res);
          $total = ceil($count/6);
          
     	return $this->fetch("",['data'=>$data,'total'=>$total,"count"=>$count]);
     }

     /*
     *意见详情
     */
     public function details()
     {
          $id = input("get.id");
          $data = db("opinion")->alias("o")->join("opinion_img i",'o.o_id = i.o_id')->field("img")->where('o.o_id',$id)->select();
          return $this->fetch("",['data'=>$data]);
     
     }

     /*
    *分页
    */
    public function page(){
          $p = input("post.p");
          $limit = ($p-1)*6;

          $data = db("opinion")->alias("o")->join("user u",'o.u_id = u.user_id')->order('o_id desc')->field("o_id,o_title,o_content,user_name")->limit($limit,6)->select();
              
          echo json_encode($data);
    }

}