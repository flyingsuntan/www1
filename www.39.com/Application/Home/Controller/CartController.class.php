<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller {
    public function add()
    {
        if(IS_POST)
        {
            $cartModel = D('Cart');
            if($cartModel->create(I('post.'), 1))
            {
                if($cartModel->add())
                {

                    $this->success('添加成功!', U('lst'));
                    exit;
                }
            }
            $this->error('添加失败，原因：'.$cartModel->getError());
        }
    }
    public function lst(){
        $cModel =D('cart');
        $data = $cModel->cartList();
        $this->assign(array(
            'data' => $data
        ));
//var_dump($data);
        //设置页面信息
        $this->assign(array(
           '_show_nav' => 1,
           '_page_title' => '购物车',
           '_page_keywords' => '购物车',
           '_page_description' => '购物车',
        ));


        $this->display();

    }
    public function ajaxCartList(){
        $cartModel = D('cart');
        $data = $cartModel->cartlist();
        echo json_encode($data);
    }
}