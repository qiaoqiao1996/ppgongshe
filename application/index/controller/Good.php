<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
/**
	* 用户登录接口
	* 请求方式：post
	* 接受参数：
	* @param $access_token 验证规则     $access_token=urlencode($name.$pwd.$token)
	* return json
	* {"resultcode":int,"reason":string}
	* 注意事项：
	*
*/
class Good extends Controller 
{
    public function goods()
    {
    	$code="1511phpG";
    	$access_token_server=md5($code);
    	$request = Request::instance();
    	// var_dump($request->post());die;
    	$access_token=$request->get('access_token');
    	$goods_id=$request->get('goods_id');
    	

    	//判断是否是get请求
        if ($request->isGet()) 
        {
        	

			//判断token是否传入
			if (!isset($access_token)) 
			{
					$res=array(
        			"resultcode"=>203,
					"reason"=>"token is nothing!",
					"error_code"=>10003
        		);
        		return json($res);
			}

			//判断goods_id是否传入
			if (!isset($goods_id)) 
			{
					$res=array(
        			"resultcode"=>205,
					"reason"=>"goods_id is nothing!",
					"error_code"=>10002
        		);
        		return json($res);
			}

			//判断token是否正确
			if ($access_token_server!=$access_token) 
			{
					$res=array(
        			"resultcode"=>204,
					"reason"=>"access_token is error!",
					"error_code"=>10004
        		);
        		return json($res);
			}
			
			

			$goods=Db::table('pp_goods')->field('goods_name,shop_price')->where("goods_id='$goods_id'")->find();
			
			if ($goods) 
			{
				$goods_img=Db::query("select img_path from pp_goods_img where goods_id='$goods_id'");
				if($goods_img){
					$goods_attr=Db::query("select goods_attr_id,goods_id,pp_goods_attr.attr_id,attr_value,attr_name from pp_goods_attr INNER JOIN pp_attribute on pp_goods_attr.attr_id=pp_attribute.attr_id where pp_attribute.attr_type=2 AND pp_goods_attr.goods_id='$goods_id'");
					$goods['goods_img']=$goods_img;
					$goods['goods_attr']=$goods_attr;
					
					if($goods_attr){
						$res=array(
	        			"resultcode"=>200,
						"result"=>$goods,
						"reason"=>"success!",
						"error_code"=>0
		        		);	
		         		return json($res);
					}else{
						$res=array(
	        			"resultcode"=>208,
						"reason"=>"data is nothing",
						"error_code"=>10008
		        		);	
		         		return json($res);
					}
				}else{
					$res=array(
        			"resultcode"=>208,
					"reason"=>"data is nothing",
					"error_code"=>10008
	        		);	
	         		return json($res);
				}
			}else{
				$res=array(
        			"resultcode"=>208,
					"reason"=>"data is nothing",
					"error_code"=>10008
        		);	
         		return json($res);
			}
				
         }
         else
         {
         	//不是get 返回错误信息
        	$res=array(
        			"resultcode"=>201,
					"reason"=>"method is error you should use post",
					"error_code"=>10001
        		);
        	return json($res);
         }  
    }
    /**
     * 注册接口
     * @return json字符串
     * 
     */


    public function aa()
    {
    	$arr=[1,2,3];
    	foreach ($arr as &$value) {
    		# code...
    	}
    	foreach ($arr as $value) {
    		# code...
    	}
    	echo "<pre>";
    	var_dump($arr);

    }
}
