<?php
namespace app\index\model;

use think\Model;
use think\Db;

class SetMealDetails extends Model
{
//	查询套餐
	public function getMeal($where,$field)
	{
		$res = self::where($where)->field($field)->select();
		if($res){
			$data = [];
			foreach($res as $k => $v){
				$data[] = $v->data;
			}
			return $data;
		}
		return $res;
	}
}


