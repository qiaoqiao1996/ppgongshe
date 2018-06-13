<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Adver extends Controller
{
	/*
	*广告展示
	*/
    public function show()
     {
     	//查询数据
     	$data = Db('advertising')->select();
     	return $this->fetch("show",['data'=>$data]);
     } 
     /*
     *添加广告
     */
     public function advertising()
     {
     	
     	return $this->fetch("advertising");	
     }

     /*
     *添加页面
     */
     public function upload()
     {
     	
     	//接值
     	 $post = request()->post();
     	 $a_img = request()->file('a_img');
     	 //图片存储位置
     	 $info = $a_img->move(ROOT_PATH . '../' . DS . 'uploads');
     	 if($info)
     	 {
     	 	$img =  $info->getSaveName();
     	 }else{
     	 	echo $file->getError();
     	 }
     	 $post['a_img'] = $img;
     	 /*
     	 *添加入库
     	 */
     	 $data = Db('advertising')->insert($post);
          
     	 if ($data) 
     	 {
     	 	$this->redirect('show');
     	 }else{
     	 	$this->redirect('advertising');
     	 }

     }


     /**
     *首页轮播图接口
     * return json
     * {"resultcode":int,"reason":string}
     */
     public function SowingMapInterface()
     {
          $code="1511phpG";
          $access_token_server=md5($code);
          $request = Request::instance();
          //传过来的token
          $access_token=$request->post('access_token');
          //判断token是否传入
          if (!isset($access_token)) 
          {
               $res=array(
                    "resultcode"=>203,
                    "reason"=>"token is nothing!",
                    "error_code"=>10027
               ); 
               return json($res);
          }

          //判断token是否正确
          if ($access_token_server!=$access_token) 
          {
               $res=array(
                    "resultcode"=>204,
                    "reason"=>"access_token is error!",
                    "error_code"=>10028
               );
               return json($res);
          }
          //查询数据
          $data = Db('goods_advertising')->select();
          if ($data) 
          {
               //返回成功信息
               $res=array(
                    "resultcode"=>200,
                    'result'=>$data,
                    "reason"=>"success!",
                    "error_code"=>0
                    );
               return json($res);
          }
          else
          {
               $res=array(
               "resultcode"=>208,
               "reason"=>"",
               "error_code"=>10029
               );
               return json($res);
          }
     }


}
