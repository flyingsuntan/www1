<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/28
 * Time: 16:54
 */
//后台商品类型模型
class TypeModel extends Model{
    public function getTypes(){
        $sql = "select * from {$this->table}";
        return $types = $this->db->getAll($sql);
    }

    //分页获取商品类型
    public function getPageTypes($offset,$pagesize){
        $sql = "select a.*,count(attr_name) as num from {$this->table} as a 
				left join cz_attribute as b
				on a.type_id = b.type_id
				group by a.type_id
				ORDER BY a.type_id DESC
		        LIMIT $offset,$pagesize";

        return $this->db->getAll($sql);
    }

}