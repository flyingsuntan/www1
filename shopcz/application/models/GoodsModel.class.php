<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/1
 * Time: 11:42
 */
//商品模型
class GoodsModel extends Model{
    //获取推荐商品
    public function getBestGoods(){
        $sql = "select goods_id,goods_name,shop_price,goods_img from {$this->table} where is_best = 1 and is_onsale = 1 order by goods_id desc limit 4";
        return $this->db->getAll($sql);
    }
}