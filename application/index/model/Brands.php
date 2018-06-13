<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Brands extends Model{

	protected $table = 'pp_brand';

	/** 添加 */
	public function insertData($data)
	{

		return Db::table($this->table)->insertGetId($data);

	}

	/** 展示 */
	public function show()
	{

		return Db::table($this->table)->select();

	}

	/** 删除 */
	public function deleteData($brand_id)
	{

		return Db::table($this->table)->where('brand_id','=',$brand_id)->delete();

	}

	/** 查询单挑数据 */
	public function findData($brand_id)
	{

		return Db::table($this->table)->where('brand_id','=',$brand_id)->find();

	}

	/** 修改 */
	public function updateData($data,$brand_id)
	{

		return Db::table($this->table)->where('brand_id','=',$brand_id)->update($data);

	}
}