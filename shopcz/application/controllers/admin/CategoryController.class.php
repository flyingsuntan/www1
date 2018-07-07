<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/26
 * Time: 17:43
 */
//商品类控制器
class CategoryController extends BaseController {
    //加载商品分类页面
    public function indexAction(){
        //获取所有的分类信息
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();//结果是个二维数组
        //载入表单
        include CUR_VIEW_PATH . "cat_list.html";
    }
    //载入商品分类增加页面
    public function addAction(){
        //获取所有的分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();//结果是个二维数组
        include CUR_VIEW_PATH . "cat_add.html";
    }
    //新增商品分类
    public function insertAction(){
        //1.收集表单数据,以关联数组的形式
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['parent_id'] = $_POST['parent_id'];
        $data['sort_order'] = $_POST['sort_order'];
        $data['unit'] = $_POST['unit'];
        $data['cat_desc'] = ($_POST['cat_desc']);
        $data['is_show'] = $_POST['is_show'];
        $this->heloer('input');
        $data = deepspecialchars($data);

        //2.做相应的验证和处理
        if($data['cat_name'] == ''){
            $this->jump('index.php?p=admin&c=category&a=add','分类名名称不能为空',3);
        }

        //3.调用模型完成入库并给出提示
        $categoryModel = new CategoryModel('category');
        if($categoryModel->insert($data)){
            $this->jump('index.php?p=admin&c=category&a=index','添加分类成功',0);
        }else{
            $this->jump('index.php?p=admin&c=category&a=add','添加分类失败',3);
        }
    }
    //载入商品分类修改页面
    public function editAction(){
        //获取cat_id
        $cat_id = $_GET['cat_id'] + 0; //?
        //获取当前这条记录
        $categoryModel = new CategoryModel('category');
        $cat = $categoryModel->selectByPk($cat_id);
        //获取所有的分类信息
        $cats = $categoryModel->getCats();
        include CUR_VIEW_PATH . "cat_edit.html";
    }
    //商品分类修改
    public function updateAction(){
        //1.收集表单数据
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['parent_id'] = $_POST['parent_id'];
        $data['sort_order'] = $_POST['sort_order'];
        $data['unit'] = $_POST['unit'];
        $data['cat_desc'] = ($_POST['cat_desc']);
        $data['is_show'] = $_POST['is_show'];
        $data['cat_id'] = $_POST['cat_id'];
        $cat_id = $_POST['cat_id'];
        $this->heloer('input');
        $data = deepspecialchars($data);


        //2.验证及处理
        if($data['cat_name'] == ''){
            $this->jump('index.php?p=admin&c=category&a=add','分类名名称不能为空',3);
        }
        //不能将当前分类的后代或自己作为期上级分类
        $categoryModel = new CategoryModel('category');
        $ids = $categoryModel->getSubIds($data['cat_id']);
        if(in_array($data['parent_id'],$ids)){
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}", '不能将当前分类的后代或自己作为其上级分类', 3);
        }
        //3.调用模型完成更新并给出提示
        if ($categoryModel->update($data)) {
            $this->jump('index.php?p=admin&c=category&a=index', '修改分类成功', 2);
        } else {
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}", '修改分类失败', 3);
        }

    }
    //商品分类删除
    public function deleteAction(){
        //1.获取cat_id
        $cat_id = $_GET['cat_id']+0; //?
        //2.判断
        $categoryModel = new CategoryModel('category');
        $ids = $categoryModel->getSubIds($cat_id);
        if(count($ids)>1){
            $this->jump('index.php?p=admin&c=category&a=index', '当前分类有后代分类，请先删除后代分类', 3);
        }
        //3.调用模型完成删除并给出提示

        if($categoryModel->delete($cat_id)){
            $this->jump('index.php?p=admin&c=category&a=index', '删除分类成功', 2);
        } else {
            $this->jump('index.php?p=admin&c=category&a=index', '删除分类失败', 3);
        }
    }
}
