<?php
namespace app\index\controller;
use think\Controller;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Goodscategory extends Controller
{  
   /**
   *商品分类页面
   */
   public function categoryAdd()
   {
   	if ($_POST) {
   		$data=input("post.");
      $data['cat_name']=htmlspecialchars(input('post.cat_name'));
      $data['sort']=htmlspecialchars(input('post.sort'));
      $data['cat_keywords']=htmlspecialchars(input('post.cat_keywords'));
      $data['cat_desc']=htmlspecialchars(input('post.cat_desc'));
         $data['filter_attr']=implode(',',$data['filter_attr']);
   		//var_dump($data);die;
   		 $file = request()->file('cat_logo');
   		 $info = $file->move('../../uploads');
   		   if($info){
   		   	$data['cat_logo']=$info->getSaveName();
   		   }
   		$res=Db::table('pp_goods_category')->insert($data);
   		if($res){
   			$this->redirect('categoryShow');
   		}
   	}
   	$data=model('GoodsCategory')->selectOne();
   	//var_dump($data);die;
   	$datas=model('GoodsCategory')->cateSelect($data);
   	$goods_type=model('GoodsCategory')->selectType();
   	 // echo "<pre>";
   	 // print_r($datas);die;
    return $this->fetch('categoryAdd',['datas'=>$datas,'goods_type'=>$goods_type]);
   }
   /**
   *查询 属性
   */
   public function attrSelect(){
      $cateid=input('post.type_id');
      //var_dump($cateid);
      $attr = Db::table("pp_attribute")-> where("type_id=".$cateid)->field('attr_id,attr_name')->select();
      echo json_encode($attr);
   }
   /**
   *查询展示 分类
   */
   public function categoryShow()
   {  
       $page=1;
      $size=6; //每页条数
      $limit=($page-1)*$size;
      $count=Db::table('pp_goods_category')->count(); //总条数
      $total=ceil($count/$size); //总页数
   	$data=Db::table('pp_goods_category')->limit($limit,6)->select();
   	 return $this->fetch('categoryShow',['data'=>$data,'total'=>$total]);
   }
    /*
   *分类删除
   */
   public function cateDel()
   {
       $cat_id=input('post.cat_id');
      $page=input('post.page',1);
      $size=6; //每页条数
      $limit=($page-1)*$size; //偏移量
      //var_dump($title_id);
      $res=model('GoodsCategory')->delOne($cat_id);
      if ($res) {
     $data=Db::table('pp_goods_category')->limit($limit,$size)->select();
      }
      return $data; 
   }
    /*
   *分类 搜索、分页
   */
   public function catPage()
   {
      $pagenow=input('post.pagenow',1);//当前页
      $search=input('post.keyword'); //搜索的关键字
       $size=6; //每页条数
       $limit=($pagenow-1)*$size; //偏移量
     
       if (!isset($search)) {
          $data =Db::table('pp_goods_category')->limit($limit,$size)->select();
       }else{
         $count=Db::table('pp_goods_category')->where('cat_keywords','like',"%$search%")->count(); //总条数
         $total=ceil($count/$size); //总页数
         $data=Db::table('pp_goods_category')->limit($limit,$size)->where('cat_keywords','like',"%$search%")->select(); //搜索查询的数组 
       }
    $arr['data']=$data;
    $arr['total']=$total;
    return $arr;
   }
   /**
   *修改是否显示的状态
   */
    public function changeIsshow(){
      $is_show=input('post.is_show'); //是否显示的状态
      $cat_id=input('post.cat_id');   //当前状态的cat_id
      if ($is_show==0) {
       $is_show=1;
      }else{
      $is_show=0;
      }
      $ret=Db::table('pp_goods_category')->update(['cat_id'=>$cat_id,'is_show'=>$is_show]);
      if ($ret) {
       return 1; //修改状态成功
      }else{
      return 2; //修改状态失败
      }
      }
       /**
   *修改是否显示在导航栏的状态
   */
    public function changeNav(){
      $is_nav=input('post.is_nav'); //是否显示的状态
      $cat_id=input('post.cat_id');   //当前状态的cat_id
      if ($is_nav==0) {
       $is_nav=1;
      }else{
      $is_nav=0;
      }
      $ret=Db::table('pp_goods_category')->update(['cat_id'=>$cat_id,'is_nav'=>$is_nav]);
      if ($ret) {
       return 1; //修改状态成功
      }else{
      return 2; //修改状态失败
      }
      }
      /**
      *全选删除
      */
   public function delAll(){
      $cat_id=input('post.cat_id');
      $page=input('post.page',1);
      $size=6; //每页条数
      $limit=($page-1)*$size; //偏移量
      $keyword=input('post.keyword');
      $ret=Db::table('pp_goods_category')->where('cat_id','in',$cat_id)->delete($cat_id);
      if ($ret) {
       if ($keyword=="") {
      $count=Db::table('pp_goods_category')->count();
      $total=ceil($count/$size);
        $data=Db::table('pp_goods_category')->limit($limit,$size)->select();
      }else{
       $count=Db::table('pp_goods_category')->where('cat_keywords','like',"%$keyword%")->count();
      $total=ceil($count/$size);
      $data=Db::table('pp_goods_category')->limit($limit,$size)->where('cat_keywords','like',"%$keyword%")->select();
      } 
      }
      $arr['data']=$data;
      $arr['total']=$total;
      echo json_encode($arr);
      }
}	
