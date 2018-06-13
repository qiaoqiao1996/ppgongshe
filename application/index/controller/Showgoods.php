<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\Model;
use think\Url;
use think\cache\driver\Redis;
use app\index\model\Orderinfo;
use app\index\model\Ordergoods;
use app\index\model\Userinfo;
class Showgoods extends Controller
{   
	/*
    *商品及商品分类接口对接
    *
    */ 
    public function goodsTitle()
    {   

        $code="1511phpG";
        $server_access_token=md5($code);
        $access_token=input("get.access_token");
        //判断access_token是否为空
        if ($access_token=="") {
            $res=[
                    "resultcode"=>204,
                    "reason"=>"access_token is notting!",
                    "error_code"=>10003
                ];
                return json($res);
        }
        //判断传输过来的access_token是否一致
        if ($server_access_token!=$access_token) {
            $res=[
                    "resultcode"=>204,
                    "reason"=>"access_token is error!",
                    "error_code"=>10004
                ];
                return json($res);
        }
        //查询标题以及对应的商品数据
        $data=Db::query("SELECT pp_goods.title_id,title_name,goods_id,type_id,goods_sn,goods_name,brand_id,market_price,shop_price,keywords,goods_desc FROM pp_goods LEFT JOIN pp_show_title ON pp_goods.title_id=pp_show_title.title_id");
        //将传输过来的数据格式化
        if ($data) {
            $res=[
                  "resultcode"=>200,
                  "reason"=>$data,
                  "error"=>0
            ];
            return json($res);
        }else{
            $res=[
                  "resultcode"=>208,
                  "reason"=>"data is notting",
                  "error"=>10045
            ];
            return json($res);
        }

    }

    /**
     *首页轮播图接口
     * return json
     * {"resultcode":int,"reason":string}
     */
     public function Sowing()
     {
          $code="1511phpG";
          $access_token_server=md5($code);
          $request = Request::instance();
          //传过来的token
          $access_token=$request->get('access_token');
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
          $data = Db::table('pp_advertising')->select();
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
               "reason"=>"error",
               "error_code"=>10029
               );
               return json($res);
          }
     }




        /**
    *商品顶级分类查询接口
    */
    public function GoodsCateInterface()
    {
       $code="1511phpG";
       $access_token_server=md5($code);
       $request=Request::instance();
       //接收传过来的Token
       $access_token=$request->get('access_token');
       //判断Token值是否传入
       if (!isset($access_token)) {
        $res=array(
          "resultcode"=>203,
          "reason"=>"token id nothing",
          "error_code"=>10021
        );  
        return json($res);
       }
       //判断Token是否正确
       if ($access_token_server!=$access_token) {
        $res=array(
          "resultcode"=>204,
          "reason"=>"access_token is error",
          "error_code"=>10022
        );
        return json($res);
       }
       //查询数据
       $data=Db::query("select cat_id,cat_name,sort,cat_logo from pp_goods_category where parent_id=0");
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
               "reason"=>"error",
               "error_code"=>10023
               );
               return json($res);
          }
    }
    /**
    *展示顶级分类下的商品
    */
    public function CateshowInterface()
    {
       $code="1511phpG";
       $access_token_server=md5($code);
       $request=Request::instance();
       //接收传过来的Token
       $access_token=$request->get('access_token');
       //判断Token值是否传入
       if (!isset($access_token)) {
        $res=array(
          "resultcode"=>206,
          "reason"=>"token id nothing",
          "error_code"=>10024
        );
        return json($res);
       }
       //判断Token是否正确
       if ($access_token_server!=$access_token) {
        $res=array(
          "resultcode"=>207,
          "reason"=>"access_token is error",
          "error_code"=>10025
        );
        return json($res);
       }
       //接收分类ID
        $cat_id=$request->get('cat_id');
       //判断cat_id值是否传入
       if (!isset($cat_id)) {
        $res=array(
          "resultcode"=>205,
          "reason"=>"cat_id id nothing",
          "error_code"=>10026
        );
        return json($res);
       }
       //查询分类下的商品数据
      $data=Db::query("select cat_name,sort,cat_keywords,cat_logo,goods_name,goods_sn,brand_id,goods_number,goods_desc,market_price,shop_price,keywords from pp_goods_category as ca inner join pp_goods as go on ca.cat_id=go.cat_id where ca.cat_id=$cat_id");
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
               "reason"=>"error",
               "error_code"=>10027
               );
               return json($res);
          }
    }


    /**
    *添加订单
    */
    public function order_add()
    {
        $request = Request::instance();
        if ($request->isPost()) 
        {
            $access_token = isset($_POST['access_token'])?$_POST['access_token']:"";//授权的token
            $code = "1511phpG";
            $access_token_r = md5($code);
            if($access_token!=$access_token_r)
            {
                $res= array(
                    'active_time'=>0,
                    'message'=>'错误的access_token参数',
                    'status'=>320,
                    );
                return json($res);
            } 

            $data['user_id'] = $user_id = isset($_POST['user_id'])?$_POST['user_id']:"";// 用户ID
            $data['address'] = $address = isset($_POST['address'])?$_POST['address']:"";// 地址id
            $data1['goods_id'] = $goods_id = isset($_POST['goods_id'])?$_POST['goods_id']:"";// 商品ID
            $data1['goods_name'] = $goods_name = isset($_POST['goods_name'])?$_POST['goods_name']:"";// 商品名称
            $data1['goods_sn'] = $goods_sn = isset($_POST['goods_sn'])?$_POST['goods_sn']:"";// 商品货号
            $data1['goods_num'] = $goods_num = isset($_POST['goods_num'])?$_POST['goods_num']:"";// 商品的购买数量
            $data1['price'] = $price = isset($_POST['price'])?$_POST['price']:"";// 商品本店单价
            $data1['goods_attr'] = $goods_attr = isset($_POST['goods_attr'])?$_POST['goods_attr']:"";// 商品的属性
            $data1['goods_attr_id'] = $goods_attr_id = isset($_POST['goods_attr_id'])?$_POST['goods_attr_id']:"";// 商品属性id(多个属性id用'，'隔开)
            $data['pay_type'] = $pay_type = isset($_POST['pay_type'])?$_POST['pay_type']:"";// 支付方式  1支付宝  2微信支付方式 3货到付款
            $data['user_integral'] = $user_integral = isset($_POST['user_integral'])?$_POST['user_integral']:"";// 用户所拥有的积分
            $data['use_integral'] = $use_integral = isset($_POST['use_integral'])?$_POST['use_integral']:"";// 用户想使用多少公分
            $data['invoice'] = $invoice = isset($_POST['invoice'])?$_POST['invoice']:"";// 发票索要  0：不索要   1：索要
            $data['postscript'] = $postscript = isset($_POST['postscript'])?$_POST['postscript']:"";// 买家留言
            $data['payable_amount'] = $data1['prices'] = $payable_amount = $goods_num * $price;// 应付商品总金额（商品单价*商品数）
            $data['integral_money'] = $integral_money = isset($_POST['integral_money'])?$_POST['integral_money']:"";// 使用公分抵消的金额
            $data['shipping_fee'] = $shipping_fee = isset($_POST['shipping_fee'])?$_POST['shipping_fee']:"";//运费
            $data['real_amount'] = $real_amount = $payable_amount - $integral_money; // 实付（-会员折扣，-公分抵扣）
            $data['order_amount'] = $order_amount = $payable_amount - $integral_money + $shipping_fee; // 总计（-会员折扣，-公分抵扣,+运费）

            $Userinfo = new Userinfo();
            $res1 = $Userinfo -> where("user_id = '$user_id'")->find();
            $is_vip = $res1['is_vip'];
            $data['order_no'] = $order_no = rand(111111,999999).$user_id.$is_vip.$goods_id.$goods_num.$invoice.time();//订单号

            $data['create_time'] = date("Y-m-d H:i:s",time());


            if(empty($access_token))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少access_token参数',
                    'status'=>301,
                    );
                return json($res);
            }else
            if(empty($user_id))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少user_id参数',
                    'status'=>302,
                    );
                return json($res);
            }else
            if(empty($address))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少address参数',
                    'status'=>303,
                    );
                return json($res);
            }else
            if(empty($goods_id))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少goods_id参数',
                    'status'=>304,
                    );
                return json($res);
            }else
            if(empty($goods_name))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少goods_name参数',
                    'status'=>305,
                    );
                return json($res);
            }else
            if(empty($goods_sn))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少goods_sn参数',
                    'status'=>306,
                    );
                return json($res);
            }else
            if(empty($goods_num))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少goods_num参数',
                    'status'=>307,
                    );
                return json($res);
            }else
            if(empty($price))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少price参数',
                    'status'=>308,
                    );
                return json($res);
            }else
            if(empty($goods_attr))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少goods_attr参数',
                    'status'=>309,
                    );
                return json($res);
            }else
            if(empty($goods_attr_id))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少goods_attr_id参数',
                    'status'=>310,
                    );
                return json($res);
            }else
            if(empty($pay_type))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少pay_type参数',
                    'status'=>311,
                    );
                return json($res);
            }else
            if(empty($user_integral))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少user_integral参数',
                    'status'=>312,
                    );
                return json($res);
            }else
            if(empty($use_integral))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少use_integral参数',
                    'status'=>313,
                    );
                return json($res);
            }else
            if(empty($invoice))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少invoice参数',
                    'status'=>314,
                    );
                return json($res);
            }else
            if(empty($postscript))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少postscript参数',
                    'status'=>315,
                    );
                return json($res);
            }else
            // if(empty($payable_amount))
            // {
            //  $res=  array(
            //      'active_time'=>0,
            //      'message'=>'缺少payable_amount参数',
            //      'status'=>316,
            //      );
      //        return json($res);
            // }else
            if(empty($integral_money))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少integral_money参数',
                    'status'=>317,
                    );
                return json($res);
            }else
            if(empty($shipping_fee))
            {
                $res=  array(
                    'active_time'=>0,
                    'message'=>'缺少shipping_fee参数',
                    'status'=>318,
                    );
                return json($res);
            }else
            // if(empty($real_amount))
            // {
            //  $res=  array(
            //      'active_time'=>0,
            //      'message'=>'缺少real_amount参数',
            //      'status'=>319,
            //      );
      //        return json($res);
            // }else
            {
                $orderinfo = new Orderinfo();
                $res = $orderinfo -> insert($data);
                $res2 = $orderinfo->where("order_no = '$order_no'")->find();

                $data1['order_id'] = $res2['order_id'];
                $ordergoods = new Ordergoods();
                $res = $ordergoods -> insert($data1);
                if($res)
                {
                    $res=  array(
                        'active_time'=>0,
                        'message'=>'success',
                        'status'=>200,
                        );
                    return json($res);
                }
                
            }
        }else
        {
            $res=  array(
                'active_time'=>0,
                'message'=>'请用post传值',
                'status'=>1001,
                );
            return json($res);
        }
    
    }
    
    /**
    *商品详情接口
    */

    public function goods()
    {
        $code="1511phpG";
        $access_token_server=md5($code);
        $request = Request::instance();
        // var_dump($request->post());die;
        $access_token=$request->get('access_token');
        $goods_id=$request->get('goods_id');
        

        //判断是否是post请求
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
                        "reason"=>$goods,
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
        * 添加购物车接口
        * 请求方式：post
        * 接收参数：
        * @param $access_token 验证规则  $access_token = urlencode($user_id.$goods_id.$token)
        * @return json
        * {"return_code":600,"explain":"success","error_code":0}
    */
    public function cart()
    {
        $code          = "1511phpG";
        $access_token_server = md5(md5($code));
        $request       = Request::instance();
        //获取post，get，参数，表单上传的文件。
        
        //Request::instance()->post();

        //$request->method();//获取上传方式
        //$request->param();//获取所有参数 最全
        //$request->get();//获取get上传的内容
        //$request->post();//获取post上传的内容
        //$request->file("file");//获取文件

        //判断是否是get请求
        if($request->isGet())
        {
            $user_id       = Cookie::get("user_id");
            $access_token  = $request->get("access_token");
            $goods_id      = $request->get("goods_id");

            //判断请求当中是否带有token
            if(!isset($access_token))
            {
                $res = array(
                        "return_code" => 602, //返回码：602
                        "explain"     => "There is no token value in the request", //解释：请求当中没有token值
                        "error_code"  => 60002 //错误代码：60002
                    );
                return json($res);
            }

            //判断token值是否正确
            if($access_token != $access_token_server)
            {
                $res = array(
                        "return_code" => 603, //返回码：603
                        "explain"     => "token is error", //解释：token值错误
                        "error_code"  => 60003 //错误代码：60003
                    );
                return json($res);
            }

            //判断用户ID是否为空
            if(!isset($user_id))
            {
                $res = array(
                        "return_code" => 604, //返回码：604
                        "explain"     => "please log in", //解释：请登录
                        "error_code"  => 60004 //错误代码：60004
                    );
                return json($res);
            }

            //判断商品ID是否为空
            if(!isset($goods_id))
            {
                $res = array(
                        "return_code" => 605, //返回码：605
                        "explain"     => "goods_id is nothing", //解释：商品ID是什么
                        "error_code"  => 60005 //错误代码：60005
                    );
                return json($res);
            }

            //判断购物车是否有同一人添加同一种商品 是执行修改 否执行添加
            $cart_data = model("cart")->showOne(array("goods_id"=>$goods_id,"user_id"=>$user_id));
            
            if($cart_data)
            {
                $where= array(
                            "cart_id"=>$cart_data["cart_id"],
                        );
                $up   = array(
                            "goods_number"=>$cart_data["goods_number"]+1,
                        );
                $res = model("cart")->upOne($where,$up);
            }
            else
            {
                $goods_data = model("goods")->showOne(array("goods_id"=>$goods_id));

                $data = array(
                    "user_id"       => $user_id,
                    "goods_id"      => $goods_data["goods_id"],
                    "goods_name"    => $goods_data["goods_name"],
                    "goods_price"   => $goods_data["shop_price"],
                    "goods_number"  => 1,
                    "goods_type_id" => $goods_data["type_id"],
                    "goods_sn"      => $goods_data["goods_sn"],
                    "goods_attr_id" => 0,
                    "is_shipping"   => 1,
                );

                $res = model("cart")->insertOne($data);
            }

            if($res)
            {
                $res = array(
                        "return_code" => 600, //返回码：600
                        "explain"     => "success", //解释：加入购物车成功
                        "error_code"  => 0 //错误代码：60000
                    );
                return json($res);
            }
            else
            {
                $res = array(
                        "return_code" => 606, //返回码：606
                        "explain"     => "internal error", //解释：内部错误
                        "error_code"  => 60006 //错误代码：60006
                    );
                return json($res);
            }
        }
        else
        {
            //不是get请求返回的错误信息
            $res = array(
                    "return_code" => 601, //返回码：601
                    "explain"     => "The request is not a get request", //请求方式不是get请求
                    "error_code"  => 60001 //错误代码：60001
                );
            return json($res);
        }
    }



    /**
        * 展示购物车接口
        * 请求方式：get
        * 接收参数：
        * @param $access_token 验证规则  $access_token = urlencode($user_id.$goods_id.$token)
        * @return json
        * {"return_code":600,"explain":"success","error_code":0}
    */
    public function cartShow()
    {
        $code          = "1511phpG";
        $access_token_server = md5(md5($code));
        $request       = Request::instance();


        //判断是否是get请求
        if($request->isGet())
        {
            $user_id       = Cookie::get("user_id");
            $access_token  = $request->get("access_token");

            //判断请求当中是否带有token
            if(!isset($access_token))
            {
                $res = array(
                        "return_code" => 602, //返回码：602
                        "explain"     => "There is no token value in the request", //解释：请求当中没有token值
                        "error_code"  => 60002 //错误代码：60002
                    );
                return json($res);
            }

            //判断token值是否正确
            if($access_token != $access_token_server)
            {
                $res = array(
                        "return_code" => 603, //返回码：603
                        "explain"     => "token is error", //解释：token值错误
                        "error_code"  => 60003 //错误代码：60003
                    );
                return json($res);
            }

            //判断用户ID是否为空
            if(!isset($user_id))
            {
                $res = array(
                        "return_code" => 604, //返回码：604
                        "explain"     => "please log in", //解释：请登录
                        "error_code"  => 60004 //错误代码：60004
                    );
                return json($res);
            }

            //数据展示
            $data = model("cart")->showAll(array("user_id"=>$user_id));

            if($data)
            {
                $res = array(
                        "return_code" => 600, //返回码：600
                        "explain"     => $data, //解释：加入购物车成功
                        "error_code"  => 0 //错误代码：60000
                    );
                return json($res);
            }
            else
            {
                $res = array(
                        "return_code" => 605, //返回码：605
                        "explain"     => "internal error", //解释：内部错误
                        "error_code"  => 60005 //错误代码：60005
                    );
                return json($res);
            }
        }
        else
        {
            //不是get请求返回的错误信息
            $res = array(
                    "return_code" => 601, //返回码：601
                    "explain"     => "The request is not a get request", //请求方式不是get请求
                    "error_code"  => 60001 //错误代码：60001
                );
            return json($res);
        }
    }
 

    
   
}
