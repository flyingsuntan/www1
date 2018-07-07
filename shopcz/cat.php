<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/1
 * Time: 14:46
 */
$cat = array(
    array('cat_id'=>1,'cat_name'=>'男女服装','parent_id'=>0),
    array('cat_id'=>2,'cat_name'=>'家用电器','parent_id'=>0),
    array('cat_id'=>3,'cat_name'=>'男装','parent_id'=>1),
    array('cat_id'=>4,'cat_name'=>'女装','parent_id'=>1),
    array('cat_id'=>5,'cat_name'=>'衬衣','parent_id'=>3),
    array('cat_id'=>6,'cat_name'=>'牛仔裤','parent_id'=>3),
    array('cat_id'=>7,'cat_name'=>'连衣裙','parent_id'=>4),
);

$res = array(
    array(
        'cat_id'=>1,'
        cat_name'=>'男女服装','
        parent_id'=>0,
        'child'=>array(
            array(
                'cat_id'=>3,
                'cat_name'=>'男装','
                parent_id'=>1,
                'child'=>array(
                    array('cat_id'=>5,'cat_name'=>'衬衣','parent_id'=>3),
                    array('cat_id'=>6,'cat_name'=>'牛仔裤','parent_id'=>3),
                )
            ),
            array(
                'cat_id'=>4,
                'cat_name'=>'女装',
                'parent_id'=>1,
                'child'=>array(
                    array('cat_id'=>7,'cat_name'=>'连衣裙','parent_id'=>4),
                )
            ),
        ),
        array(
            'catt_id'=>2,
            'cat_name'=>'家用电器',
            'parent_id'=>0
        ),
    )
    );

//将平行的二维数组，转成包含关系的多维数组
class a
{
    function child($arr, $pid = 0)
    {
        $res = array();
        foreach ($arr as $v) {
            if ($v['parent_id'] == $pid) {
                //找到了，继续查找其后代节点
                //$temp = $this->child($arr,$v['cat_id']);
                //将找到的结果作为当前数组的一个元素来保存，其下标是child
                //$v['child'] = $temp;
                $v['child'] = $this->child($arr, $v['cat_id']);
                $res[] = $v;
            }
        }
        return $res;
    }
}
$cata = new a();
$cats = $cata->child($cat);
var_dump($cats);
var_dump($res);