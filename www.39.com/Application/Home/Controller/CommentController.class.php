<?php
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller{
    //发表评论
    public function add(){
        if(IS_POST){
            $model = D('Admin/comment');
            if($model->create(I('post.'),1)){
                if($id = $model->add()){
                    $this->success(array(
                        'id' => $id,
                        'face' => session('m_face'),
                        'username' => session('m_username'),
                        'addtime' => date('Y-m-d H:i:s'),
                        'content' => I('post.content'),
                        'star' => I('post.star'),
                    ),'',TRUE);
                }
            }
            $this->error($model->getError(),'',TRUE);
        }

    }
    public function ajaxGetPl(){
        $goodsId = I('get.goods_id');
        $model = D('Admin/Comment');
        $data = $model->search($goodsId,5);

        echo json_encode($data);
    }
    public function reply(){
        if(IS_POST){
            $model = D('Admin/commentReply');
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->success(array(

                        'face' => session('m_face'),
                        'username' => session('m_username'),
                        'addtime' => date('Y-m-d H:i:s'),
                        'content' => I('post.content'),
                    ));
                }
            }
            $this->error($model->getError());
        }

    }
}