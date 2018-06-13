<?php
namespace app\index\controller;
use think\Controller;
use think\Model;
use think\request;
use think\Db;
use think\Cookie;
use think\cache\driver\Redis;
class Showtitle extends Controller
{
   /*
   *商品标题添加
   */
   public function titleAdd()
   {
   	if ($_POST) {
   		$data=input('post.');
      $data['title_name']=htmlspecialchars(input('post.title_name'));
   		$res=model('ShowTitle')->addOne($data);
   		if($res){
   			$this->redirect('titleShow');
   		}
   	}
    return $this->fetch('titleAdd');
   }
   /*
   *商品标题展示
   */
   public function titleShow()
   {
      $page=1;
      $size=6; //每页条数
      $limit=($page-1)*$size;
      $count=Db::table('pp_show_title')->count(); //总条数
      $total=ceil($count/$size); //总页数
      $data =Db::table('pp_show_title')->limit($limit,6)->select();
   	 return $this->fetch('titleShow',['data'=>$data,'total'=>$total]);
   }
   /*
   *商品标题删除
   */
   public function titleDel()
   {
       $title_id=input('post.title_id');
      $page=input('post.page',1);
      $size=6; //每页条数
      $limit=($page-1)*$size; //偏移量
      //var_dump($title_id);
      $res=model('ShowTitle')->delOne($title_id);
      if ($res) {
     $data=Db::table('pp_show_title')->limit($limit,$size)->select();
      }
      return $data;
     
   }
   /*
   *商品标题分页 、搜索
   */
  public function titlePage()
   {   
        $pagenow=input('post.pagenow',1);//当前页
        $search=input('post.keyword'); //搜索的关键字
       $size=6; //每页条数
       $limit=($pagenow-1)*$size; //偏移量
     
       if (!isset($search)) {
          $data =Db::table('pp_show_title')->limit($limit,$size)->select();
       }else{
         $count=Db::table('pp_show_title')->where('title_name','like',"%$search%")->count(); //总条数
         $total=ceil($count/$size); //总页数
         $data=Db::table('pp_show_title')->limit($limit,$size)->where('title_name','like',"%$search%")->select(); //搜索查询的数组 
       }
    $arr['data']=$data;
    $arr['total']=$total;
    return $arr;
   }
   /**
   *修改商品标题
   */
    public function changeTitle(){
      $new_title=input('post.new_title');  //修改成$new_title
      $title_id=input('post.title_id');  //标题ID
      $arr=array(
        "title_id"=>$title_id,
        "title_name"=>$new_title
      );
      $ret=Db::table('pp_show_title')->where('title_id='.$title_id)->update($arr);
      if ($ret) {
        return 1;  //修改成功
      }else{
         return 2; //修改失败
      }
    }
}	
