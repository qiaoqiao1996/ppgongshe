<?php
namespace app\index\model;

use think\Model;
use think\Db;
class NumberCard extends Model
{
	//查看手机号
	public function showCard($where='')
	{
		$res = self::alias('c')->join('phone_type t','c.type_id = t.type_id')->join('set_meal_details m','c.details_id = m.details_id')->where($where)->field('c.card_number,c.card_id,m.d_name,c.card_status,t.type_name')->select();
		if($res){
			$data = [];
			foreach($res as $k => $v){
				$data[] = $v->data;
			}
			return $data;
		}
		return $res;
	}
	
	public function findOne($where)
	{
		return self::where($where)->find();
	}
	
//	批量添加手机号
	public function cardAddAll($data)
	{
		return self::saveAll($data);
	}
//	删除
	public function del($where)
	{
		return self::destroy($where);
	}
}
