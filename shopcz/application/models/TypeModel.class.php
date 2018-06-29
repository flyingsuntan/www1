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
        $sql = "select * from {$this->table} order by type_id limit $offset,$pagesize";

        return $this->db->getAll($sql);
    }

}