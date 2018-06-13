<?php 
namespace app\index\model;
use think\Model;
use think\Db;
class GoodsCategory extends Model{
	/**
	*无限极树状分类方法
	*$parent_id 父级ID
	*$level  等级
	*@return array
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
  *查询表中的数据
  *@return array
  */
  public function selectOne(){
  	return Db::table('pp_goods_category')->select();
  }
  /**
  *查询表中的数据
  *@return array
  */
  public function selectType(){
  	return Db::table('pp_goods_type')->select();
  }
  /**
  *删除表中的数据
  *@return array
  */
  public function delOne($id){
    return Db::table('pp_goods_category')->where('cat_id='.$id)->delete();
  }

}





 ?>