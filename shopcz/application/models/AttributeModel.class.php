<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 17:04
 */
//后台商品属性模型
class AttributeModel extends Model {
    //获取指定类型下的属性
    /*
    public function getAttrs($type_id){
        $sql = "select * from {$this->table} where type_id = '$type_id'";
        return $this->db->getAll($sql);
    }
    */
    //第二版，获取指定类型下的属性，需要联表获取类型名称
    public function getAttrs($type_id,$offset,$pagesize){
        $type_table = $GLOBALS['config']['prefix'] . "goods_type";
        $sql = "select *from {$this->table} as a inner join $type_table as b on a.type_id = b.type_id where a.type_id = $type_id limit $offset,$pagesize";
        return $this->db->getAll($sql);
    }
    public function getTypes(){
        $sql = "select * from {$this->table}";
        return $types = $this->db->getAll($sql);
    }
    //分页获取商品类型
    public function getPageTypes($offset,$pagesize,$type_id)
    {
        $sql = "select * from {$this->table} where type_id ='$type_id'  order by attr_id  limit $offset,$pagesize";

        return $this->db->getAll($sql);
    }
}