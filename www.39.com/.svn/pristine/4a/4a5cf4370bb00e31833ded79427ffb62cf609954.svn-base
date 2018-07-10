<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model
{
    protected $insertFields = array('cat_name', 'parent_id');
    protected $updateFields = array('id','cat_name', 'parent_id');
    protected $_validate = array(
        array('cat_name', 'require', '分类名称不能为空！', 1, 'regex', 3),
    );
    //找一个分类所有子分类的ID
    public function getChildren($cat_id){
        //取出所有的分类
        $data = $this->select();
        //递归从所有的分类中跳出分类的ID
        return $this->_getChildren($data,$cat_id,true);
    }
    //递归从数据中找子分类
    private function _getChildren($data,$cat_id,$isClear = false){
        static $res = array();
        if($isClear){
            $res = array();
        }
        //循环所有的分类找子分类
        foreach ($data as $k => $v){
            if($v['parent_id'] == $cat_id){
                $res[] = $v['id'];
                //在找这个$v的子分类
                $this->_getChildren($data,$v['id']);
            }
        }
        return $res;
    }
    public function getTree(){
        //取出所有的分类
        $data = $this->select();
        return $this-> _getTree($data);

    }
    public function _getTree($data,$parent_id=0,$level=0){
        static $res = array();
        foreach ($data as $k => $v){
            if($v['parent_id'] == $parent_id){
                $v['level'] = $level;
                $res[] = $v;
                $this->_getTree($data,$v['id'],$level+1);
            }
        }
        return $res;
    }
    public function _before_insert()
    {
         $cats = $this->getTree();

    }
    public function _before_delete(&$option){
        $children = $this->getChildren($option['where']['id']);
        $children[] = $option['where']['id'];
        $option['where']['id'] = array(
            0 => 'IN',
            1 => implode(',',$children),
        );





        /*
        //删除这些子分类
        if($ids) {
            $children = implode(',',$ids);
            //删除这些子分类
            //说明这里必须生成父类模型然后调用delete函数。因为如果使用$this
            //调用delete那么在delete之前优惠调用$this->_before_delete这样就死循环了
            //。用了父类的delete就会在delete之前调用父类的_before_delete和这个_before_delete没关系。就不会死循环了！！！！！
            $model = \Think\Model();
            $model->table('__CATEGORY__')->delete($children);

        }
        */
    }
}
