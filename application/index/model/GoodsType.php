<?php
namespace app\index\model;
use think\Model;
use think\Db;

class GoodsType extends Model
{
       /*
       *@类型单条查询
       *return 查询出的数据object
       */
       public function getFind($data)
       {
       	   return $this->where($data)->find();
       }


       /*
       *@类型单条查询字段值
       *return 查询出的数据array()
       */
       public function getfinds($data,$field='*')
       {    
           return Db::table("pp_goods_type")->where($data)->field($field)->find();
       }


       /*
       *@类型单条添加
       *return 添加后的id
       */
       public function insertOne($data)
       {
       	    return $this->insert($data); 
       }
        

        /*
       *@类型数据查询1（总体）
       *return array();s
       */
       public function getSelects($where="1=1",$fid=[])
       {
            return Db::table("pp_goods_type")->where($where)->field($fid)->select();
       }

        /*
       *@类型数据查询（总体）
       *return array();
       */
       public function getSelect($where="1=1",$fid=[])
       {
       	return Db::table("pp_goods_type")->where($where)->limit(0,10)->field($fid)->select();
       }
       

       /*
       *@类型数据字段查询
       *return array();
       */
       public function getField($data=[])
       {
            return Db::table("pp_goods_type")->field($data)->select();
       }

        /*
       *@类型数据单条删除
       *return array();
       */
       public function getDele($id)
       {
       	    return GoodsType::destroy($id,false);
       }

       /*
       *@类型数据条件查询并分页（限制条数）
       *return array();
       */
       public function getPage($start,$where="")
       {    
            if ($where=="") {
                 return Db::table("pp_goods_type")->field(["type_id","type_name","enabled","type_content"])->limit($start,10)->select(); 
            }else{
                 return Db::table("pp_goods_type")->where($where)->field(["type_id","type_name","enabled","type_content"])->limit($start,10)->select();   
            }
            
       }


       /*
       *@类型数据条件查询并分页（不限制条数）
       *return array();
       */
       public function getPages($where="")
       {    
            if ($where) {
                 return Db::table("pp_goods_type")->where($where)->field(["type_id","type_name","enabled","type_content"])->select(); 
            }else{
                  return Db::table("pp_goods_type")->field(["type_id","type_name","enabled","type_content"])->select();
            }
            
       }


       /*
       *@类型数据修改
       *return array();
       */
       public function getUpdate($data)
       {
            return Db::table('pp_goods_type')->update($data);
       }

}