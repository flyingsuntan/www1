<?php

/**
 * 商品表goods的操作模型
 */
class GoodsModel extends BaseModel {

    /**
     * 插入商品
     */
    public function insertGoods($data) {

        $sql = "INSERT INTO `goods` VALUES (null, '{$data['goods_name']}', '{$data['shop_price']}', '{$data['goods_desc']}', '{$data['goods_number']}', '{$data['is_best']}', '{$data['is_new']}', '{$data['is_hot']}', '{$data['is_on_sale']}', '{$data['admin_id']}', '{$data['create_time']}','{$data['image_ori']}')";
        return $this->_dao->exec($sql);
    }

}