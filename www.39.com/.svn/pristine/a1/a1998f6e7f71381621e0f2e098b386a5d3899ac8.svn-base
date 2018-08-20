<?php
namespace Admin\Model;
use Think\Model;
class OrderModel extends Model
{
    //下单时允许接收的字段
	protected $insertFields = array('shr_name','shr_tel','shr_province','shr_city','shr_area','shr_address');
	//下单时的表单验证规则
	protected $_validate = array(
		array('shr_name', 'require', '收货人姓名不能为空！', 1, 'regex', 3),
		array('shr_tel', 'require', '收货人电话不能为空！', 1, 'regex', 3),
		array('shr_province', 'require', '所在省份不能为空！', 1, 'regex', 3),
		array('shr_city', 'require', '所在城市不能为空！', 1, 'regex', 3),
		array('shr_area', 'require', '所在区地区不能为空！', 1, 'regex', 3),
		array('shr_address', 'require', '详细地址不能为空！', 1, 'regex', 3),
	);
    public function search($pageSize = 5)
    {
        $memberId = session('m_id');
        /**************************************** 搜索 ****************************************/
        $where['member_id'] = array('eq',$memberId);
        $noPayCount = $this->where(array(
            'member_id' => array('eq',$memberId),
            'pay_status' => array('eq','no')
        ))->count();
        /************************************* 翻页 ****************************************/
        $count = $this->alias('a')->where($where)->count();
        $page = new \Think\Page($count, $pageSize);
        // 配置翻页的样式
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $data['page'] = $page->show();
        /************************************** 取数据 ******************************************/
        $data['data'] = $this->alias('a')
        ->field('a.id,a.shr_name,a.total_price,a.addtime,a.pay_status,GROUP_CONCAT(c.sm_logo) logo')
        ->join('LEFT JOIN __ORDER_GOODS__ b ON a.id=b.order_id
                LEFT JOIN __GOODS__ c ON c.id=b.goods_id')
        ->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
        $data['noPayCount'] = $noPayCount;
        return $data;
    }
	// 添加前
	protected function _before_insert(&$data, &$option)
	{
        $memberId = session('m_id');
	/****************************下单前的检查*********************/
	    //是否登录
        if(!$memberId){
            $this->error = '请先登录！';
            return false;
        }
        //购物车中是否有商品
        $cartModel = D('cart');
        $option['goods'] = $goods = $cartModel->cartList();

        if(!$goods){
            $this->error = '购物车中没有商品，请先选择商品！';
            return false;
        }
        //读库存之前加锁
        $this->fp = fopen('./order.lock');
        flock($this->fp,LOCK_EX);
        $gnModel = D('goods_number');
        //循环购物车中的商品检查库存量并且计算总价
        $total_price = 0;
        foreach ($goods as $k => $v){
            $gnNumber = $gnModel->field('goods_number')->where(array(
                'goods_id' => array('eq',$v['goods_id']),
                'attr_list' => array('eq',$v['goods_attr_id'])
            ))->find();
            if($gnNumber['goods_number'] < $v['goods_number']){
                $this->error = '<strong>'.$v['goods_name'].' </strong>库存不足！';
                return false;
            }
            //统计总价
            $total_price += $v['price']*$v['goods_number'];
        }
        //把其他信息补充到订单表中
        $data['total_price'] = $total_price;
	    $data['member_id'] = $memberId;
	    $data['addtime'] = time();
        //为了确保三张表的操作都能成功：订单基本信息表，订单商品表，库存量表
        $this->startTrans();
	}
	//定单基本信息生成之后
	public function _after_insert($data,$option){
        //把购物车中的商品插入到订单商品表中并且减少库存
        $goods = $option['goods'];

        $ogModel = D('order_goods');
        $gnModel = D('goods_number');
        foreach ($goods as $k => $v){
            $ret = $ogModel->add(array(
                'order_id' => $data['id'],
                'goods_id' => $v['goods_id'],
                'goods_attr_id' => $v['goods_attr_id'],
                'goods_number' => $v['goods_number'],
                'price' => $v['price'],
            ));
            if(!$ret){
                $this->rollback();
                return false;
            }
            //减库存
            $ret = $gnModel->where(array(
                'goods_id' => $v['goods_id'],
                'attr_list' => $v['goods_attr_id'],
            ))->setDec('goods_number',$v['goods_number']);
        }
        if(FALSE === $ret){
            $this->rollback();
            return false;
        }
        //所有操作都成功提交事务
        $this->commit();
        //释放锁
        flock($this->fp,LOCK_UN);
        fclose($this->fp);
        //清空购物车;
        $cartModel = D('cart');
        $cartModel->clear();
    }
	// 修改前
	protected function _before_update(&$data, $option)
	{
	}
	// 删除前
	protected function _before_delete($option)
	{
	}
	/************************************ 其他方法 ********************************************/
    //设置为已支付的状态
    public function setPaid($orderId){
        /***********更新定单状态********************/
        $this->where(array(
            'id' => array('eq',$orderId),
        ))->save(array(
            'pay_status' => 'yes',
            'pay_time' => time(),
        ));
        /*****************更新会员积分*******************/
        $tp = $this->field('total_price,member_id')->find($orderId);
        $memberModel = D('member');
        $memberModel->where(array(
            'id' => array('eq',$tp['member_id']),
        ))->setInc('jifen',$tp['total_price']);
    }
}