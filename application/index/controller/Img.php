<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Img extends Controller
{

	/**
	图片添加页面
	添加图片
	*/
	public function imgAdd()
	{
		if(Request::instance()->isPost()){
			$data=Request::instance()->Post();
			// print_r($data);die;
			$goods_id=$data['goods_id'];
			$files = request()->file('img_path');

	
		 	foreach($files as $file){
		        // 移动到框架应用根目录/public/uploads/ 目录下
		        $info = $file->move('../../uploads');
		        if($info){
		            // 成功上传后 获取上传信息
		            $arr[]['img_path']=$info->getSaveName();
		        }else{
		            // 上传失败获取错误信息
		            echo $file->getError();
		        }    
		    }
		    // print_r($arr);die;	
		    foreach ($arr as $key => $val) {
	    		$arr[$key]["img_path"]=$val["img_path"];
	    		$arr[$key]["goods_id"]=$goods_id;

	    		
		    }

		   foreach ($arr as $key => $value) {
		   	

		   	$res=Db::table('pp_goods_img')->insert($value);
		   }
		    

			if ($res) {
				return $this->redirect("imgShow");
			}else{
				return $this->redirect("imgAdd");
			}
		}else{
			$data=Db::table('pp_goods')->field('goods_id,goods_name')->select();
			$this->assign('data',$data);
			return view('img_add');
		}
	}


	public function imgShow()
	{
		$data=Db::table('pp_goods_img')->join('pp_goods','pp_goods_img.goods_id=pp_goods.goods_id')->field('img_id,img_path,goods_name')->limit(6)->select();
		$count=Db::query("select count(*) from pp_goods_img");
		

		$date=Db::table('pp_goods')->field('goods_id,goods_name')->select();
		
			
		$total=ceil($count[0]["count(*)"]/6);
        $this->assign("total",$total);
        $this->assign('date',$date);
		$this->assign('data',$data);
		return view('img_show');
	}

	/**
	分页
	*/

	public function page(){
        	$p=input("post.p");
        	$goods_id=input("post.goods_id");
        	// echo $goods_name;
        	// print_r($goods_name);
       		if($goods_id==''){
				$limit=($p-1)*6;

	            $data=Db::table('pp_goods_img')->join('pp_goods','pp_goods_img.goods_id=pp_goods.goods_id')->field('img_id,img_path,goods_name')->limit($limit,6)->select();
       		}else{
       			$limit=($p-1)*6;
       			$goods_name=input("post.goods_name");
	            $data=Db::table('pp_goods_img')->join('pp_goods','pp_goods_img.goods_id=pp_goods.goods_id')->field('img_id,img_path,goods_name')->where('pp_goods_img.goods_id',$goods_id)->limit($limit,6)->select();
	           
       		}
       		echo json_encode($data);
    }


    /*
	搜索
    */
    public function sea(){
		$goods_id=input("post.goods_id");
        
      	if($goods_id==''){
      		$data=Db::table('pp_goods_img')->join('pp_goods','pp_goods_img.goods_id=pp_goods.goods_id')->field('img_id,img_path,goods_name')->limit(6)->select();
      		$count=Db::query("select count(*) from pp_goods_img");
			$total=ceil($count[0]["count(*)"]/6);
      	}else{
      		$data=Db::table('pp_goods_img')->join('pp_goods','pp_goods_img.goods_id=pp_goods.goods_id')->field('img_id,img_path,goods_name')->where('pp_goods_img.goods_id',$goods_id)->limit(0,6)->select();

      		$count=Db::query("select count(*) from pp_goods_img where  goods_id='$goods_id'");
		$total=ceil($count[0]["count(*)"]/6);
      	}
		
		
		
        
		$arr['data']=$data;
		$arr['total']=$total;
		// print_r($arr);
		return $arr;        
		       
	}

	public function imgDel(){
		$img_id=input("get.id");
		$data=Db::table('pp_goods_img')->where("img_id='$img_id'")->delete();
		if($data){
			return $this->redirect("imgShow");
		}
	}


	public function imgs(){
		$data=Db::table('pp_goods_img')->join('pp_goods','pp_goods_img.goods_id=pp_goods.goods_id')->field('img_id,img_path,goods_name')->select();
		return json($data);
	}
}