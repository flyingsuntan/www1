<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 15:52
 */
//后台商品品牌控制器
class BrandController extends BaseController {
    public function indexAction(){
        //获取所有商品品牌
        $brandModel = new BrandModel('brand');
        //获取当前页
        $current = isset($_GET['page']) ? $_GET['page'] : 1;//默认第一页

        //设置煤业显示的记录数
        $pagesize = 2;
        //$types = $typeModel->getTypes();//结果是个二维数组
        $offset = ($current - 1) * $pagesize;
        $brands = $brandModel->getPageBrands($offset,$pagesize);
        //载入分页工具类
        $this->libaray('Page');
        //获取总的记录数
        $total = $brandModel->total($where);
        $page = new Page($total,$pagesize,$current,'index.php',array('p'=>'admin','c'=>'brand','a'=>'index'));
        $pageinfo = $page->showPage();

        include CUR_VIEW_PATH . "brand_list.html";
    }
    //显示添加表单页面
    public function addAction(){

        include CUR_VIEW_PATH . "brand_add.html";
    }
    public function insertAction(){
        //收集所有表单信息
        $data['brand_name'] = $_POST['brand_name'];
        $data['url'] = $_POST['url'];
        $data['brand_desc'] = $_POST['brand_desc'];
        $data['sort_order'] = $_POST['sort_order'];
        $data['is_show'] = $_POST['is_show'];

        //验证和处理
        if($data['brand_name'] == '') {
            $this->jump('index.php?p=admin&c=brand&a=add', '品牌名称不能为空', 3);
        }
        $this->heloer('input');
        $data = deepspecialchars($data);
        $data = deepaddslashes($data);

        //调用模型完成入库并给出提示
        $brandModel = new brandModel('brand');
        if( $brandModel->insert($data)){
            $this->jump("index.php?p=admin&c=brand&a=index",'添加品牌成功',2);
        }else{
            $this->jump('index.php?p=admin&c=brand&a=add','添加品牌失败',3);
        }
    }
    public function editAction(){
        //获取品牌id
        $brand_id = $_GET['brand_id'] + 0;
        //获取指定品牌的信息
        $brandModel = new BrandModel('brand');
        $brand = $brandModel->selectByPk($brand_id);

        include CUR_VIEW_PATH ."brand_edit.html";
    }
    public function updateAction(){
        //获取更新后的数据
        $data['brand_name'] = $_POST['brand_name'];
        $data['url'] = $_POST['url'];
        $data['brand_desc'] = $_POST['brand_desc'];
        $data['sort_order'] = $_POST['sort_order'];
        $data['is_show'] = $_POST['is_show'];
        $data['brand_id']=$_POST['brand_id'];
        //验证和处理
        if($data['brand_name'] == '') {
            $this->jump('index.php?p=admin&c=brand&a=update', '品牌名称不能为空', 3);
        }
        $this->heloer('input');
        $data = deepspecialchars($data);
        $data = deepaddslashes($data);

        //调用模型完成入库并给出提示
        $brandModel = new brandModel('brand');
        if( $brandModel->update($data)){
            $this->jump("index.php?p=admin&c=brand&a=index",'添加品牌成功',2);
        }else{
            $this->jump("index.php?p=admin&c=brand&a=update&brand_id={$data['brand_id']}",'添加品牌失败',3);
        }
    }
    public function deleteAction(){
        //1.获取brand_id
        $brand_id = $_GET['brand_id']+0; //?

        //3.调用模型完成删除并给出提示
        $brandModel = new BrandModel('brand');

        if($brandModel->delete($brand_id)){
            $this->jump('index.php?p=admin&c=brand&a=index', '删除分类成功', 2);
        } else {
            $this->jump('index.php?p=admin&c=brand&a=index', '删除分类失败', 3);
        }
    }
}