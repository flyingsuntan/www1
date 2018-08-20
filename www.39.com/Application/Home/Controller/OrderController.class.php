<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {

    // 接收支付宝发来的支付成功的消息
    public function receive(){
        require ('./alipay/notify_url.php');
    }
    //下单
    public function add()
    {
        //如果会员没有登录就跳到登录页面，登录成功之后再跳回这个页面
        $memberId = session('m_id');
        if(!$memberId){
            //先把登录成功之后要跳回的地址存到session中
            session('returnUrl',U('Order/add'));
            redirect(U('Login/login'));
        }
        if(IS_POST)
        {
            $orderModel = D('Admin/Order');

            if($orderModel->create(I('post.'), 1))
            {
                if($orderId = $orderModel->add())
                {

                    $this->success('添加成功!', U('order_success?order_id='.$orderId));
                    exit;
                }
            }
            $this->error('下单失败，原因：'.$orderModel->getError());
        }

        //先取出购物车中所有的商品
        $cartModel = D('cart');
        $data = $cartModel->cartList();
        //设置页面信息
        $this->assign(array(
            'data' => $data,
            '_page_title' => '定单确认页',
            '_page_keywords' => '定单确认页',
            '_page_description' => '定单确认页',
        ));


        $this->display();
    }




    public function order_success(){
        $btn = makeAlipayBtn(I('get.order_id'));
        $this->assign(array(
            'btn' => $btn,
            '_page_title' => '下单成功',
            '_page_keywords' => '下单成功',
            '_page_description' => '下单成功',
        ));

        $this->display();
    }

}