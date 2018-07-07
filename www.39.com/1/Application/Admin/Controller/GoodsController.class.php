<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller
{
    //显示和处理表单
    public function add()
    {
        //判断用户是否提交了表单
        if (IS_POST) {
            $model = D('goods');
            //接收数据并保存到模型中
            /*
             * 第一个参数：要接收的数据默认是$_POST
             * 第二个参数：表单的类型。当前是添加还是修改表单,1:添加 2：修改
             */
            if ($model->create(I('post.'), 1)) {
                if ($model->add()) {
                    //显示成功信息并等待1秒之后跳转
                    $this->success('操作成功！', U('lst'));
                    exit;
                }
            }
            //如果走到 这里 说明上面失败了在这里处理失败的请求
            $error = $model->getError();
            //由控制器显示错误信息，并在3秒跳回上一页面
            $this->error($error);

        }
        //显示表单
        $this->display();
    }

    public function lst()
    {
        //生成商品模型
        $model = D('Goods');
        //返回数据和翻页
        $data = $model->search();
        //var_dump($data);
        //die;
        $this->assign($data);

        $this->display();
    }

    public function edit()
    {
        $id = $_GET['id'];
        $model = D('goods');
        if (IS_POST) {

            if ($model->create(I('post.'), 2)) {
                if (FALSE !== $model->save()) {
                    //显示成功信息并等待1秒之后跳转
                    $this->success('操作成功！', U('lst'));
                    exit;
                }
            }

            $error = $model->getError();
            $this->error($error);

        }
        //根据ID取出要修改的商品的原信息
        $data = $model->find($id);
        $this->assign('$data',$data);
        var_dump($data);
        echo $data['logo'];
        //die;
        //显示表单
        $this->display();
    }
}