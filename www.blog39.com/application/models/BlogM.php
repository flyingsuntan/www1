<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 14:48
 */
class BlogM extends CI_Model{
    public function add(){
        //构造数据
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content',TRUE),//true:过滤xss
            'is_show' => $this->input->post('is_show'),
            'addtime' => date('Y-m-d H:i:s'),
        );
        //插入数据库
        $this->db->insert('b39_blog',$data);
    }
}