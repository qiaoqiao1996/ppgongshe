<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Attr extends Controller
{

	/**
	属性添加
	*/
	public function attrAdd()
	{
		if(Request::instance()->isGet()){
			$type_id=input('get.id');
			$goods_id=input('get.goods_id');
			//如果该商品没有类型，查询所有类型
			$data=Db::table('pp_goods_type')->select();
			$this->assign("data",$data);
			$this->assign('goods_id',$goods_id);
			return view('attr_add');

			
		}else{
			
			
			$data=input('post.');

			// print_r($data['attr_type']);die;
			if(in_array(1,$data['attr_type'])){
				// print_r($data);die;
				
			   
				if(in_array(2,$data['attr_type'])){
					$goods_id=$data['goods_id'];
					// print_r($goods_id);die;
					// print_r($data);die;
					$files = request()->file('attr_img');

			
				 	foreach($files as $file){
				        // 移动到框架应用根目录/public/uploads/ 目录下
				        $info = $file->move('../../uploads');
				        if($info){
				            // 成功上传后 获取上传信息
				            
				            array_push($data["attr_img"], $info->getSaveName());
				            
				            
				        }else{
				            // 上传失败获取错误信息
				            echo $file->getError();
				        }    
				    }
					$array=[];
					foreach ($data["attr_value"] as $key => $value) {
						    $array[$key]["attr_value"]=$value;
						    $array[$key]["attr_price"]=$data["attr_price"][$key];
						    $array[$key]["attr_id"]=$data["attr_id"][$key];
						    $array[$key]["attr_img"]=$data["attr_img"][$key];
						    // print_r($array[$key]["attr_value"]);die;
					 }
				
				   foreach ($array as $key => $v) 
				   {
				   		$array[$key]['goods_id']=$data['goods_id'];
				   		// $array[$key]['type_id']=$data['type_id'];
				   }	
				   // print_r($array);die;
				   
				   

				}else{
					$goods_id=$data['goods_id'];
					$array=[];
					foreach ($data["attr_value"] as $key => $value) {
						    $array[$key]["attr_value"]=$value;
						    $array[$key]["attr_price"]=$data["attr_price"][$key];
						    $array[$key]["attr_id"]=$data["attr_id"][$key];
						    $array[$key]["attr_img"]=$data["attr_img"][$key];
						    // print_r($array[$key]["attr_value"]);die;
					 }
				
					   foreach ($array as $key => $v) 
					   {
					   		$array[$key]['goods_id']=$data['goods_id'];
					   		// $array[$key]['type_id']=$data['type_id'];
					   }	
					   // print_r($array);die;
					   $attr_id=[];
				   foreach ($array as $key => $value) {
				   	  $attr_id[]=$value["attr_id"];
				   }
				   $attr_id=array_unique($attr_id);
				   // print_r($attr_id);die;
		           $new_arr=[];
				   foreach ($attr_id as $key => $value) {
				   	   $new_arr[]=Db::table('pp_goods_attr')->where("attr_id='$value'")->where("goods_id",$data['goods_id'])->field("attr_value")->select();
				   }
		           // print_r($new_arr);die;
		           if (!empty($new_arr)) {
		           	   $attr_value=[];
					   foreach ($new_arr as $key => $value) {
					   	      foreach ($value as $k => $v) {
					   	      	   $attr_value[]=$v["attr_value"];
					   	      }
					   }

					   $attr_value=array_unique($attr_value);
					   // print_r($array);
					   // print_r($attr_value);die;
			           foreach ($array as $key => $value) {
			           	
			           	// print_r($va);die;
			           	       if (in_array($value["attr_value"],$attr_value)) {
			           	       		// echo 11;die;
			           	       	$va=$value["attr_value"];
			           	       	   // Db::query('DELETE FROM pp_goods_attr WHERE goods_id="$goods_id" AND attr_value="$va"');
			           	       	
			           	       	   Db::table("pp_goods_attr")->where("goods_id",$goods_id)->where("attr_value",$va)->delete();
			           	       }
			           }
		           }
					   	$res=Db::table('pp_goods_attr')->insertAll($array);
		  	

					  	if($res){
					  		$res=Db::table('pp_goods')->where('goods_id',$data['goods_id'])->update(['type_id'=>$data['type_id']]);
					  		return $this->redirect("goods/goodsshow");
					  	}
				}
			}else{
				$goods_id=$data['goods_id'];
					// print_r($goods_id);die;
					// print_r($data);die;
					$files = request()->file('attr_img');

			
				 	foreach($files as $file){
				        // 移动到框架应用根目录/public/uploads/ 目录下
				        $info = $file->move('../../uploads');
				        if($info){
				            // 成功上传后 获取上传信息
				            
				            $data['attr_img'][]= $info->getSaveName();
				            
				            
				        }else{
				            // 上传失败获取错误信息
				            echo $file->getError();
				        }    
				    }
				    // print_r($data);die;
					$array=[];
					foreach ($data["attr_value"] as $key => $value) {
						    $array[$key]["attr_value"]=$value;
						    $array[$key]["attr_price"]=$data["attr_price"][$key];
						    $array[$key]["attr_id"]=$data["attr_id"][$key];
						    $array[$key]["attr_img"]=$data["attr_img"][$key];
						    // print_r($array[$key]["attr_value"]);die;
					 }
				
				   foreach ($array as $key => $v) 
				   {
				   		$array[$key]['goods_id']=$data['goods_id'];
				   		// $array[$key]['type_id']=$data['type_id'];
				   }	
				   // print_r($array);die;
			}
			
			// print_r($type_id);die;
			// $data=Db::table('pp_goods_type')->select();
			


		   
		   
		  	$attr_id=[];
				   foreach ($array as $key => $value) {
				   	  $attr_id[]=$value["attr_id"];
				   }
				   $attr_id=array_unique($attr_id);
				   // print_r($attr_id);die;
		           $new_arr=[];
				   foreach ($attr_id as $key => $value) {
				   	   $new_arr[]=Db::table('pp_goods_attr')->where("attr_id='$value'")->where("goods_id",$data['goods_id'])->field("attr_value")->select();
				   }
		           // print_r($new_arr);die;
		           if (!empty($new_arr)) {
		           	   $attr_value=[];
					   foreach ($new_arr as $key => $value) {
					   	      foreach ($value as $k => $v) {
					   	      	   $attr_value[]=$v["attr_value"];
					   	      }
					   }

					   $attr_value=array_unique($attr_value);
					   // print_r($array);
					   // print_r($attr_value);die;
			           foreach ($array as $key => $value) {
			           	
			           	// print_r($va);die;
			           	       if (in_array($value["attr_value"],$attr_value)) {
			           	       		// echo 11;die;
			           	       	$va=$value["attr_value"];
			           	       	   // Db::query('DELETE FROM pp_goods_attr WHERE goods_id="$goods_id" AND attr_value="$va"');
			           	       	
			           	       	   Db::table("pp_goods_attr")->where("goods_id",$goods_id)->where("attr_value",$va)->delete();
			           	       }
			           }
		           }
		  		
		  		$res=Db::table('pp_goods_attr')->insertAll($array);
		  	

		  	if($res){
		  		$res=Db::table('pp_goods')->where('goods_id',$data['goods_id'])->update(['type_id'=>$data['type_id']]);
		  		return $this->redirect("products",['goods_id'=>$data['goods_id']]);
		  	}
		}
	}

	/*
	类型属性查询
	*/
	public function attrSele(){
		$type_id=input('post.type_id');
		$data=Db::table('pp_attribute')->where('type_id',$type_id)->select();
		return $data;
	}


	/**
	商品属性添加库存
	*/


	public function products()
	{
		$goods_id=input('param.goods_id');
		// print_r($goods_id);die;
		if(Request::instance()->isPost()){
            $post=input("post.");
            // $product_number=input('post.product_number');
            // print_r($post);die;
            $tmp = array();
            
            // echo $dat;die;
            // echo $product_sn;die;
            foreach ($post['attr_value'] as $key => $value) {
                foreach ($value as $k => $v) {
                    $tmp[$k][] = $v;	
                }
            }

            foreach ($tmp as $key => $value) {
                $tmp[$key] = implode(',', $value);
            }
           
            foreach ($tmp as $key => $value) {
            	$dat=date("YmdHis",strtotime("now"));

            	$product_sn="ATC".rand(100000,999999).$dat;
            	$product_number= $post['product_number'][$key];

                $data = array(
                    'goods_id'=>$goods_id,
                    'goods_attr'=>$value,
                    'product_sn'=>$product_sn,
                    'product_number'=>$product_number
                );

                 $product=Db::table('pp_products')->where('goods_id',$goods_id)->where('goods_attr',$value)->find();
                 if($product==''){
                 	$res= Db::table("pp_products")->insert($data);
                 }else{
                 	if(in_array($value,$product)){
            		
						$number=$product['product_number'];

						$newnum=$number+$product_number;
						// print_r($newnum);die;
						$res=Db::table('pp_products')->where('goods_id',$goods_id)->where('goods_attr',$value)->update(['product_number' =>$newnum]);
	            	}else{
	 					$res= Db::table("pp_products")->insert($data);
	            	}
                 }


            	
            		
            	

            }
            $dae=Db::table('pp_products')->where('goods_id',$goods_id)->field('product_number')->select();
            // print_r($dae);die;
            $var=array();
            foreach ($dae as $k=>$value) {
            	// print_r($value['product_number']);die;
            	$var[$k]=$value['product_number'];
            }
            $product_number=array_sum($var);

           // print_r($var);die;
            // echo $product_number-1;die;
            Db::table('pp_goods')->where('goods_id',$goods_id)->update(['goods_number'=>$product_number]);
         
          
            if($res){
               return $this->redirect("goods/goodsShow");
            }else{
                return $this->redirect("goodsShow");
            }
            	
        }else{
        	$data = Db::query("select g.goods_attr_id,g.goods_id,g.attr_id,g.attr_value,a.attr_name from pp_goods_attr g INNER JOIN pp_attribute a on g.attr_id = a.attr_id where a.attr_type = 2 AND g.goods_id = '$goods_id'");
        	// print_r($data);die;
        	
	        $new_arr=array();
	        foreach($data as $key=>$val){
	            $new_arr[$val['attr_id']]['attr_name'] = $val['attr_name'];
	            $new_arr[$val['attr_id']]['value'][$val['goods_attr_id']] = $val['attr_value'];
	        }
	        $this->assign('data',$new_arr);
	        $this->assign('goods_id',$goods_id);

	        return view("products_add");
	    }

        
	}
}