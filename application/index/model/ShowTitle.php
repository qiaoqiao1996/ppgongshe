<?php 
namespace app\index\model;
use think\Model;
class ShowTitle extends Model
{
	/**
	*向表中添加数据
	*@return blooer
	*/
	public function addOne($data){
    return $this->insert($data);
	}
	/**
	*查询表中数据
	*@return array
	*/
	public function selectOne(){
		return  $this->select();
	}
  	/**
	*删除表中数据
	*@return array
	*/
	public function delOne($id){
		return  $this->where('title_id='.$id)->delete();
	}

}
 ?>