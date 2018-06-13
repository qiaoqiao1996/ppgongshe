<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
/**
	* 社区广告轮播展示
	* 请求方式 GET
	* 接受参数：
	* @param $access_token 验证规则     $access_token=md5($token)
	* return json
	* {"resultcode":int,"reason":string}
	* 注意事项：
	*
*/
class Carousel extends Controller 
{
	/*
		*社区轮播图展示页面
	*/
	public function advertising()
	{
		$code = "1511phpG";
		$access_token_server = md5($code);
		
		//请求
		$request = Request::instance();
		$access_token = $request->get('access_token');
		$com_id = $request->get('com_id');
		//判断token是否导入
		if(!isset($access_token))
		{
			$res=array(
    			"resultcode"=>203,
				"reason"=>"token is nothing!",
				"error_code"=>10003
        	);
        	return json($res);
		}
		//判断token是否正确
		if($access_token_server!=$access_token)
		{
			$res=array(
    			"resultcode"=>204,
				"reason"=>"access_token is error!",
				"error_code"=>10004
        	);
        	return json($res);
		}
		//判断社区id是否存在
		if(!isset($com_id))
		{
			$res=array(
    			"resultcode"=>205,
				"reason"=>"com_id doesn't exist!",
				"error_code"=>10005
        	);
        	return json($res);
		}
		//查询轮播图数据
		$user = Db('advertisin')->where('com_id='.$com_id)->order('adv_id desc')->limit(5)->select();
		if ($user) 
		{
			//返回成功信息
			$res=array(
    			"resultcode"=>200,
    			'result'=>$user,
				"reason"=>"success!",
				"error_code"=>0
    		);
     		return json($res);
		}
		else
		{
			//数据错误
			$res=array(
    			"resultcode"=>208,
				"reason"=>"Data doesn't exist!",
				"error_code"=>10008
    		);
     		return json($res);
		}
	}
}