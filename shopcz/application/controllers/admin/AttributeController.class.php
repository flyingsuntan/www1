<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 15:52
 */
//后台商品属性控制器
class AttributeController extends BaseController {
    //显示商品属性
    public function indexAction(){
        //获取所有的商品类型
        $typeModel = new TypeModel('goods_type');
        $types = $typeModel->getTypes();
        //获取type_id
        $type_id = $_GET['type_id'];
        //获取当前页
        $current = isset($_GET['page']) ? $_GET['page'] : 1;//默认第一页
        //设置煤业显示的记录数
        $pagesize = 5;

        //$types = $typeModel->getTypes();//结果是个二维数组
        $offset = ($current - 1) * $pagesize;
        //获取当前指定类型下的所有属性
        $attributeModel = new AttributeModel('attribute');
        $attrs = $attributeModel->getAttrs($type_id,$offset,$pagesize);

        //载入分页工具类
        $this->libaray('Page');
        //获取总的记录数
        $where = "type_id = $type_id";
        $total = $attributeModel->total($where);
        $page = new Page($total,$pagesize,$current,'index.php',array('p'=>'admin','c'=>'attribute','a'=>'index','type_id'=>$type_id));
        $pageinfo = $page->showPage();
        include CUR_VIEW_PATH . "attribute_list.html";
    }
    //显示添加表单页面
    public function addAction(){
        //获取商品类型
        $typeModel = new TypeModel('goods_type');
        $types= $typeModel->getTypes();
        //载入模板
        include CUR_VIEW_PATH . "attribute_add.html";
    }
    public function insertAction(){
        //收集表单数据
        $data['attr_name'] = trim($_POST['attr_name']);
        $data['type_id'] = $_POST['type_id'];
        $data['attr_type'] = $_POST['attr_type'];
        $data['attr_input_type'] = $_POST['attr_input_type'];
        $data['attr_value'] = isset($_POST['attr_value']) ? $_POST['attr_value'] : '';
        $type_id = $data['type_id'];

        //验证和处理

        if($data['attr_name'] == '') {
            $this->jump('index.php?p=admin&c=attribute&a=add', '属性名称不能为空', 3);
        }

        $this->heloer('input');
        $data = deepspecialchars($data);
        $data = deepaddslashes($data);
        //调用模型完成入库并给出提示

        $attributeModel = new AttributeModel('attribute');
        if( $attributeModel->insert($data)){
            $this->jump("index.php?p=admin&c=attribute&a=index&type_id=$type_id",'添加属性成功',2);
        }else{
            $this->jump('index.php?p=admin&c=attribute&a=add','添加属性失败',3);
        }

    }
    public function editAction(){
        include CUR_VIEW_PATH ."attribute_edit.html";
    }
    public function updateAction(){}
    public function deleteAction(){}
    //动态获取指定类型下的所有属性
    public function getAttrsAction(){
        //获取type_id
        $type_id = $_GET['type_id'] + 0;

        //调用模型获取该类型下所有属性所构成的表单
        $attrModel = new AttributeModel('attribute');
        $attrs = $attrModel->getAttrsForm($type_id);
        echo <<<STR
        <script type="text/javascript">
        window.parent.document.getElementById("tbody-goodsAttr").innerHTML = "$attrs";
        </script>

STR;



    }
}