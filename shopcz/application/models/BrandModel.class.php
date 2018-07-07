<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 11:16
 */
class BrandModel extends Model{
    public function getBrands(){
        $sql = "select * from {$this->table}";
        $brands = $this->db->getAll($sql);
        return $brands;
    }
    public function getPageBrands($offset,$pagesize){
        $sql = "select * from {$this->table} limit $offset,$pagesize";
        $brands = $this->db->getAll($sql);
        return $brands;
    }
}