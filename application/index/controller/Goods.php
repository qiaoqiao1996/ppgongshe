<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Goods extends Controller
{
	/**
	新商品添加
	*/
	public function goodsAdd()
	{
		if(Request::instance()->isPost()){
			$data=request()->post();
			// print_r($data);die;
			$data["goods_region"]=$data["location_p"]."-".$data["location_c"]."-".$data["location_a"];
			unset($data["file"]);
			unset($data["location_p"]);
			unset($data["location_c"]);
			unset($data["location_a"]);
			
			
			$res=Db::table('pp_goods')->insert($data);
			if($res){
				return $this->redirect("goodsShow");
				
			}else{
				return $this->redirect("goodsAdd");
			}

		}else{
			$data=Db::table('pp_brand')->field('brand_id,brand_name')->select();
			$date=Db::table('pp_goods_type')->field('type_id,type_name')->select();
			$det=Db::table('pp_show_title')->field('title_id,title_name')->select();
			$dat=Db::table('pp_goods_category')->select();
			$list=$this->cateSelect($dat);
			$this->assign('data',$data);
			$this->assign('date',$date);
			$this->assign('det',$det);
			$this->assign('list',$list);
			return view('goods_add');
		}
	}
	/**
	商品列表
	*/
	public function goodsShow(){

		
		$data=Db::table('pp_goods')->field('goods_id,goods_name,goods_sn,goods_number,shop_price,type_id')->limit(6)->select();
		$count=Db::query("select count(*) from pp_goods");
		
		$total=ceil($count[0]["count(*)"]/6);
        $this->assign("total",$total);
		$this->assign("data",$data);
		
		return view('goods_show');
	}


/*
	*	递归
	*/
	 public function cateSelect($data,$parent_id=0,$level=1)
  {
   static $new_arr=array();
   foreach ($data as $key => $val) {
   if ($val['parent_id']==$parent_id) {
   $val['level']=$level;
   $new_arr[]=$val;
   $this->cateSelect($data,$val['cat_id'],$level+1);
   }
   }
   return $new_arr;
  }


	/**
	商品删除
	*/

	public function goodsDel()
	{
		$id=input('get.id');
		$res=Db::table('pp_goods')->where('goods_id',$id)->delete();
		if($res){
			$this->redirect('goods/goodsShow');
		
		}
	}
	/**
	搜索
	*/
	public function sea(){
		$goods_name=input("post.goods_name");
        
      
		$data=Db::query("select goods_id,goods_name,goods_sn,goods_number,shop_price from pp_goods where  goods_name like '%$goods_name%' LIMIT 0,6");
		$count=Db::query("select count(goods_id) as num from pp_goods where  goods_name like '%$goods_name%'");
		$total=ceil($count[0]['num']/6);
		// echo $total;
        $this->assign("total",$total);
		$arr['data']=$data;
		$arr['total']=$total;
		return $arr;         
	}



	/**
	分页
	*/
	public function page(){
        	$p=input("post.p");
        	$goods_name=input("post.goods_name");
        	// echo $goods_name;
        	// print_r($goods_name);
       		if($goods_name==''){
				$limit=($p-1)*6;

	            $data=Db::query("select goods_id,goods_name,goods_sn,goods_number,shop_price from pp_goods LIMIT $limit,6");
       		}else{
       			$limit=($p-1)*6;
       			$goods_name=input("post.goods_name");
	            $data=Db::query("select goods_id,goods_name,goods_sn,goods_number,shop_price from pp_goods where goods_name like '%$goods_name%' LIMIT $limit,6");
	           
       		}
       		echo json_encode($data);
    }


}