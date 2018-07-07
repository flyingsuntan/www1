<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
    //添加时调用create方法允许接受的字段
    protected $insertFields = 'goods_name,market_price,shop_price,is_on_sale,goods_desc';
    protected $updateFields = 'id,goods_name,market_price,shop_price,is_on_sale,goods_desc';

    //定义验证规则
    protected $_validate = array(
        array('goods_name','require','商品名称不能为空！',1),
        array('market_price','currency','市场价格必须是货币类型！',1),
        array('shop_price','currency','本店价格必须是货币类型！',1),
    );
    //这个方法在添加之前会被自动调用
    //第一个参数：表单中即将要插入到数据库的数据->数组
    protected function _before_insert(&$data,$option){
        /*****************处理LOGO***********************/
        //判断有没有选择图片
        if($_FILES['logo']['error'] == 0){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     1024*1024 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     'Goods/'; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error = $upload->getError();
                return FALSE;
            }else{// 上传成功
                /*******************生成缩略图*********************/
                //先拼出原图的路径
                $logo = $info['logo']['savepath'] . $info['logo']['savename'];
                //拼出缩略图的路径和名称
                $mbiglogo = $info['logo']['savepath'] . 'mbig_' . $info['logo']['savename'];
                $biglogo = $info['logo']['savepath'] . 'big_' . $info['logo']['savename'];
                $midlogo = $info['logo']['savepath'] . 'mid_' . $info['logo']['savename'];
                $smlogo = $info['logo']['savepath'] . 'sm_' . $info['logo']['savename'];
                $image = new \Think\Image();
                //打开要生成缩略图的图片
                $image ->open('./Public/Uploads/' . $logo);
                //生成缩略图
                $image->thumb(700, 700)->save('./Public/Uploads/' .$mbiglogo);
                $image->thumb(350, 350)->save('./Public/Uploads/' .$biglogo);
                $image->thumb(130, 130)->save('./Public/Uploads/' .$midlogo);
                $image->thumb(50, 50)->save('./Public/Uploads/' .$smlogo);
                /***********************把路径放到表单中***********************/
                $data['logo'] = $logo;
                $data['mbig_logo'] = $mbiglogo;
                $data['big_logo'] = $biglogo;
                $data['mid_logo'] = $midlogo;
                $data['sm_logo'] = $smlogo;


                // var_dump($info);die;
                //$this->success('上传成功！');
                //return true;
            }
        }
        //获取当前时间
        $data['addtime']=date('Y/m/d H:i:s',time());
        //我们自己来过滤这个字段
        //echo $data['goods_desc'] = removeXSS($_POST['goods_desc']);
       // die;


    }
    /*
     * 实现翻页、搜索、排序
     */
    public function search($perpage = 5){
        /**********************搜索********************/
        $where = array();//空的where条件
        //商品名称
        $gn = I('get.gn');
        if($gn){
            $where['goods_name'] = array('like',"%$gn%");
        }
        //价格
        $fp = I('get.fp');
        $tp = I('get.tp');
        if($fp && $tp)
        {
            $where['shop_price'] = array('between',array($fp,$tp));
        }else if($fp){
            $where['shop_price'] = array('egt',$fp);
        }else if($tp){
            $where['shop_price'] = array('elt',$tp);
        }
        //是否上架
        $ios = I('get.ios');
        if($ios){
            $where['is_on_sale'] = array('eq',$ios);
        }
        //添加时间
        $fa = I('get.fa');
        $ta = I('get.ta');
        if($fa && $ta)
        {
            $where['addtime'] = array('between',array($fa,$ta));
        }else if($fp){
            $where['addtime'] = array('egt',$fa);
        }else if($tp){
            $where['addtime'] = array('elt',$ta);
        }
        /****************翻页********************/
        $count      = $this->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$perpage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        //生成页面下面显示上一页、下一页的字符串
        //设置样式
        $Page->setConfig('next','下一页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('first','首页');
        $Page->setConfig('end','尾页');
        $show       = $Page->show();// 分页显示输出
        //排序
        $orderby = 'id';   //默认的排序字段
        $orderway = 'desc';  //默认的排序方式
        $odby = I('get.odby');
        if($odby){
            if($odby == "id_asc") {
                $orderway = 'asc';
            }else if ($odby == "price_desc"){
                $orderby = 'shop_price';
            }else if ($odby == "price_asc"){
                $orderby = 'shop_price';
                $orderway = 'asc';
            }
        }
        /*********************取某一页的数据********************/
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $this->order($orderby,$orderway)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        /***********************返回数据****************************/
       // var_dump($list);
       // die;
        return array(
            'data' => $list, //数据
            'page' => $show,  //翻页字符串
        );

    }
}