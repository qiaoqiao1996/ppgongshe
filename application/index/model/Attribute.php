<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Attribute extends Model
{
       /*
       *@类型单条查询
       *return 查询出的数据array()
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
           return Db::table("pp_attribute")->where($data)->field($field)->find();
       }

       /*
       *@类型数据条件查询并分页（不限制条数）
       *return array();
       */
       public function getPages($where="")
       {    
            if ($where) {
                 return Db::table("pp_attribute")->where($where)->field(["type_id","type_name","enabled","type_content"])->select(); 
            }else{
                  return Db::table("pp_attribute")->field(["type_id","type_name","enabled","type_content"])->select();
            }
            
       }




       public function getPage($start,$where="")
       {    
            if ($where=="") {
                 return Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id LIMIT $start 10");
                 
            }else{
                 return Db::query("SELECT attr_id,attr_name,attr_input_type,attr_values,type_name FROM pp_attribute AS a LEFT JOIN pp_goods_type AS g ON g.type_id=a.type_id WHERE a.type_id=$type_id LIMIT $start 10");  
            }
            
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
       *@类型数据查询
       *return array();
       */
       public function getSelect($data)
       {
       	return Db::table("pp_attribute")->where($data)->select();
       }
      

        /*
       *@属性单条删除
       *return array();
       */
       public function getDele($id)
       {
                return attribute::destroy($id,false);
       }

}