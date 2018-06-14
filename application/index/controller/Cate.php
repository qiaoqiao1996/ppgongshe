<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
// use 

class Cate extends Controller
{
	/*
	*	分类列表
	*/
	public function cateList()
	{
		$cate_data = Db::table('pp_goods_category')->select();

		$cate_data = $this->recursion($cate_data);
		// print_r($cate_data);die;
		//赋值商品分类下默认商品数量为0
		foreach($cate_data as $k=>$v)
		{		
			$cate_data[$k]['count'] = '';
		}

		// //取出商品表的分类路径
		$goods = Db::table('pp_goods')->field("cat_id")->select();
		// print_r($goods);die;
		$arr = array();
		foreach($goods as $k=>$v)
		{
			//将-替换为,
			// $str = str_replace("-", ",", $v['path']);
			// //截取两位之后的字符
			// $str = substr($str, 2);
			// //转化为数组
			// $arr = explode(",", $str);
			// print_r($arr);die;
			foreach($cate_data as $key=>$val)
			{
				// $cate_data[$key]['count'] = 0;
				//判断商品处理后的路径id在那个分类id下
				if($val['cat_id'] == $v['cat_id'])
				{
					$cate_data[$key]['count'] += 1;
					// $arr[$key]['count'] = $cate_data[$key]['count'];
				}
			}
			// echo "$str";die;
		}
		// print_r($cate_data);die;
		// print_r($arr);die;
		// foreach($cate_data as $k=>$v)
		// {
		// 	// if($v['parent_id']!=0 && $v['count']!=0)
		// 	foreach($cate_data as $key=>$val)
		// 	{
		// 		if($v['cat_id'] != $val['cat_id'])
		// 		{
		// 			if($v['parent_id']==0)
		// 			{
		// 				// $cate_data[$k]['count'] = 
		// 			}
		// 		}
		// 	}
		// }
		// print_r($cate_data);die;
		
		$this->assign("cate_data",$cate_data);
		return view("cateList");
	}
	/*
	*	分类添加
	*/
	public function cateAdd()
	{
		if(Request::instance()->isPost())
		{
			// print_r(input("post."));die;
			$cate_data = input("post.");
			// $last = Db::query("select max(cat_id) from pp_goods_category");
			// $last_id = $last[0]['max(cat_id)']+1;
			// // print_r($last_id);die;
			// //判断是否是顶级分类  拼接fullpath（全路径）
			// if($cate_data['path'] == "0")
			// {	
			// 	// print_r(input("post."));die;
			// 	$cate_data['fullpath'] = '0-'.$last_id;
			// }else{
				
	  //           //拼接添加分类的path值
	  //           $cate_data['fullpath'] = $cate_data['path'].'-'.$last_id;
	  //           // $data['path']=$parentPath.'_'.$data['parent_id'];
			// }
			// print_r($cate_data);die;

			$file = request()->file('cat_logo');
			// if(!file_exists(ROOT_PATH.'public'.DS.'uploads'))
			// {
			// 	mkdir(ROOT_PATH.'public'.DS.'uploads',777);
			// }
			$info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move('../../uploads');

			if($info){

			  $info->getExtension();
			  // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg        
			  $info->getSaveName();
			  // 输出 42a79759f284b767dfcb2a0197904287.jpg
	          $info->getFilename(); 

	 		}else{
	 			echo $file->getError();
	 		}

	 		$cat_logo = $info->getSaveName();

			$cate_data['cat_logo'] = $cat_logo;
			$cate_data['filter_attr'] = "167,181";
			$res = Db::table('pp_goods_category')->insert($cate_data);
			if($res){
				$this->redirect("cate/cateList");
			}else{

			}
		}else{

			$cate_data = Db::table('pp_goods_category')->select();

			$cate_data = $this->recursion($cate_data);
			// print_r($cate_data);die;
			$this->assign("cate_data",$cate_data);
			return view("cateAdd");
		}
		
	}


	/*
	*	向下查子分类的递归
	*/
	public function recursion($data, $parent_id="0", $f=1)
	{
		static $result=array();
		foreach ( $data as $key => $val ) {		
	        if ( $parent_id == $val['parent_id'] ) {
	      //   	$arr[$k]=$v;
    			// $arr[$k]['child']=$this->digui($data,$v['type_id']);
    			$val["f"] = $f;
	            $result[] = $val;
	            // $result[$key]['child'] = $this->recursion( $data, $val['fullpath']);
	            $this->recursion( $data, $val['cat_id'], $f+1);
	        }
	    }

    	return $result;
	}


	/*
	*	向上查父分类并赋值商品数量
	*/
	// public function parents($data, $fullpath)
	// {
	// 	foreach($data as $key=>$val)
	// 	{
	// 		if($fullpath == $val['fullpath'])
	// 		{

	// 		}
	// 	}
	// }

	/*
	*	分类删除
	*/
	public function cateDel()
	{
		$cate_id = input("post.cate_id");
		$cate =  Db::table('pp_goods_category')->where("cat_id",$cate_id)->find();
		$cate_datas = Db::table('pp_goods_category')->select();
		$cate_data = $this->getCartid($cate_datas,$cate_id);
		$cate_data[] = $cate_id;
		// print_r($cate_data);die;
		$goods = Db::table('pp_goods')->field("cat_id")->select();
		foreach($goods as $k=>$v)
		{
			if(in_array($v['cat_id'], $cate_data))
			{
				echo json_encode(array("status"=>1,"is_del"=>0,"msg"=>$cate['cat_name']."或子分类下还存在商品，请先处理商品"));die;
			}
		}
		// $goods = Db::table('pp_goods')->field("path")->select();
		// print_r($goods);die;
		// foreach($goods as $k=>$v)
		// {
		// 	//将-替换为,
		// 	$str = str_replace("-", ",", $v['path']);
		// 	//截取两位之后的字符
		// 	$str = substr($str, 2);
		// 	//转化为数组
		// 	$arr = explode(",", $str);
		// 	// print_r($arr);die;
			
		// 	//判断该分类下是否有商品
		// 	if(in_array($cate_data['cate_id'] , $arr))
		// 	{
		// 		echo json_encode(array("status"=>1,"is_del"=>0,"msg"=>$cate_data['cate_name']."下还存在商品，请先处理商品"));die;
		// 	}
		// 	// echo "$str";die;
		// }

		//删除分类
		//判断该分类下是否有子分类
		$ret = Db::table('pp_goods_category')->where("parent_id",$cate_id)->find();
		if($ret)
		{
			echo json_encode(array("status"=>1,"is_del"=>2,"msg"=>$cate['cat_name']."下还存在子分类，请先删除子分类"));die;
		}else{
			$res = Db::table('pp_goods_category')->where('cat_id',$cate_id)->delete();
			if($res)
			{
				echo json_encode(array("status"=>1,"is_del"=>1));die;
			}else{
				echo json_encode(array("status"=>1,"is_del"=>3,"msg"=>$cate['cate_name']."删除失败"));die;
			}
		}
	}

	public function getCartid($cate_datas,$cat_id)
	{
		static $result=array();
		foreach ( $cate_datas as $key => $val ) {		
	        if ( $cat_id == $val['parent_id'] ) {
	            $result[] = $val['cat_id'];
	            // $result[$key]['child'] = $this->recursion( $data, $val['fullpath']);
	            $this->getCartid( $cate_datas, $val['cat_id']);
	        }
	    }

    	return $result;
	}

	/*
	*	分类修改
	*/
	public function cateUp()
	{
		// if(Request::instance()->isPost())
		// {
		// 	$cate = input("post.");
		// 	print_r($cate);die;
		// 	$cate_id = base64_decode(input("post.id"));
		// 	$cate_data = Db::table('pp_goods_category')->where("cat_id",$cate_id)->find();
		// 	if($cate['path'] == $cate_data['path'])
		// 	{
		// 		$this->redirect("cate/cateList");
		// 	}
		// 	$fullpath = $cate['path']."-".$cate_data['cate_id'];

		// 	print_r($fullpath);die;
		// }else{
			$cate_data = Db::table('pp_goods_category')->select();

			$cate_data = $this->recursion($cate_data);
			// print_r($cate_data);die;
			$cate_id = base64_decode(input("get.id"));
			$cate =  Db::table('pp_goods_category')->where("cat_id",$cate_id)->find();

			foreach($cate_data as $k=>$v)
			{
				if($v['cat_id'] == $cate_id)
				{
					foreach($cate_data as $key=>$val)
					{
						if($val['cat_id'] == $cate['parent_id'])
						{
							$cate_data[$key]['select'] = "selected";
						}
					}
				}
			}
			// print_r($cate_data);die;
			$this->assign("cate",$cate);
			$this->assign("cate_data",$cate_data);
			$this->assign("cate_id",base64_encode($cate_id));
			return view("cateUp");
		// }
		
	}

	//执行修改
	public function cateUpdo()
	{
		$post_data = input("post.");
		$cat_id = base64_decode($post_data['id']);
		$cate =  Db::table('pp_goods_category')->where("cat_id",$cat_id)->find();
		unset($post_data['id']);
		// print_r($cate);die;
		$file = request()->file('cat_logo');  
         // var_dump($file);die;
        // $info = $file->move(ROOT_PATH . 'public/uploads');  
       	// var_dump($info) ;die;  
  
        $info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move('../../uploads');

		if($info){

		  $info->getExtension();
		  // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg        
		  $info->getSaveName();
		  // 输出 42a79759f284b767dfcb2a0197904287.jpg
          $info->getFilename(); 

 		}else{
 			echo $file->getError();
 		}
 		// unlink(ROOT_PATH . 'public\\uploads\\'.$cate['cat_logo']);
 		$post_data['cat_logo'] = $info->getSaveName();

		$res = Db::table('pp_goods_category')->where('cat_id', $cat_id)->update($post_data);
		// print_r($post_data);die;
		//查询分类下的所有子分类
		// print_r($res);
		if($res)
		{
			// $cate_datas = Db::table('pp_goods_category')->select();
			// $cate_data = $this->getCartid($cate_datas,$cat_id);
			// // $cate_data[] = $cat_id;
			// // print_r($cate_data);
			// foreach($cate_data as $k=>$v)
			// {
			// 	Db::table('pp_goods_category')->where('cat_id', $v)->update(['parent_id'=>]);
			// }
			$this->redirect("cate/cateList");
		}else{

		}
		
	}
	//检验要修改的分类下有无商品
	public function checkUp()
	{
		// echo "1";
		$cate_id = input("post.cate_id");
		$cate =  Db::table('pp_goods_category')->where("cat_id",$cate_id)->find();
		$cate_datas = Db::table('pp_goods_category')->select();
		$cate_data = $this->getCartid($cate_datas,$cate_id);
		$cate_data[] = $cate_id;
		// print_r($cate_data);die;
		$goods = Db::table('pp_goods')->field("cat_id")->select();
		foreach($goods as $k=>$v)
		{
			if(in_array($v['cat_id'], $cate_data))
			{
				echo json_encode(array("status"=>1,"is_del"=>0,"msg"=>$cate['cat_name']."或子分类下还存在商品，请先处理商品"));die;
			}
		}
		echo json_encode(array("status"=>1,"is_del"=>1,"msg"=>"cateUp","cate_id"=>base64_encode($cate_id)));die;
	}

	//检验所选父级分类下是否有商品
	// public function checkCat()
	// {
	// 	$cate_id = input("post.cate_id");
	// 	$cate =  Db::table('pp_goods_category')->where("cat_id",$cate_id)->find();
	// 	$cate_datas = Db::table('pp_goods_category')->select();
	// 	$cate_data = $this->getCartid($cate_datas,$cate_id);
	// 	$cate_data[] = $cate_id;
	// 	// print_r($cate_data);die;
	// 	$goods = Db::table('pp_goods')->field("cat_id")->select();
	// 	foreach($goods as $k=>$v)
	// 	{
	// 		if(in_array($v['cat_id'], $cate_data))
	// 		{
	// 			echo json_encode(array("status"=>1,"is_del"=>0,"msg"=>"所选父级分类下存在商品，不可修改到此父级下"));die;
	// 		}
	// 	}

	// 	echo json_encode(array("status"=>1,"is_del"=>1,"msg"=>"cateUpdo","cate_id"=>base64_encode($cate_id)));die;
	// }
}