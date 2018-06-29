<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/28
 * Time: 16:43
 */
//后台商品类型控制器
class TypeController extends BaseController {
    //显示商品类型
    public function indexAction(){
        //使用模型获取所有商品类型
        $typeModel = new TypeModel('goods_type');
        //获取当前页
        $current = isset($_GET['page']) ? $_GET['page'] : 1;//默认第一页

        //设置煤业显示的记录数
        $pagesize = 3;
        //$types = $typeModel->getTypes();//结果是个二维数组
        $offset = ($current - 1) * $pagesize;
        $types = $typeModel->getPageTypes($offset,$pagesize);
        //载入分页工具类
        $this->libaray('Page');
        //获取总的记录数
        $total = $typeModel->total($where);
        $page = new Page($total,$pagesize,$current,'index.php',array('p'=>'admin','c'=>'type','a'=>'index'));
        $pageinfo = $page->showPage();

        include CUR_VIEW_PATH . "goods_type_list.html";
    }

    //载入新增商品类型页面
    public function addAction(){
        include CUR_VIEW_PATH . "goods_type_add.html";
    }
    //新增商品分类
    public function insertAction(){
        //1.收集表单数据,以关联数组的形式
        $data['type_name'] = trim($_POST['type_name']);
        $this->heloer('input');
        $data = deepspecialchars($data);
        $data = deepaddslashes($data);
        //2.做相应的验证和处理
        if($data['type_name'] == ''){
            $this->jump('index.php?p=admin&c=type&a=add','类型名名称不能为空',3);
        }
        //3.调用模型完成入库并给出提示
        $typeModel = new TypeModel('goods_type');
        if($typeModel->insert($data)){
            $this->jump('index.php?p=admin&c=type&a=index','添加类型成功',2);
        }else{
            $this->jump('index.php?p=admin&c=type&a=add','添加类型失败',3);
        }
    }
    //加载修改商品类型页面
    public function editAction(){
        //获取商品id
        $type_id = $_GET['type_id'] + 0;
        $typeModel = new TypeModel('goods_type');
        $type = $typeModel->selectByPk($type_id);

        include CUR_VIEW_PATH . "goods_type_edit.html";

    }

    //商品类型修改
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

    //删除商品类型
    public function deleteAction(){
        //1.获取type_id
        $type_id = $_GET['type_id']+0; //?
        //2.调用模型完成删除并给出提示
        $typeModel = new TypeModel('goods_type');
        if($typeModel->delete($type_id)){
            $this->jump('index.php?p=admin&c=type&a=index', '删除商品类型成功', 2);
        } else {
            $this->jump('index.php?p=admin&c=type&a=index', '删除商品类型失败', 3);
        }
    }
}