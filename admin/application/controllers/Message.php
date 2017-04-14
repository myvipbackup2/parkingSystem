<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');

    }
    public function index()
    {

            $this->load->view("message_mgr");

    }
    public function message_mgr()
    {
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

        $order_col = array('1' => 'message_id', '2' => 'username', '3' => 'content', '4' => 'add_time');

        $recordsTotal = $this->message_model->get_total_count();
        $recordsFiltered = $this->message_model->get_filterd_count($search);


        $datas = $this->message_model->get_paginated_message($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->message_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);

    }
    public function message_detail()
    {
        $message_id = $this->input->get('messageId');
        $message = $this->message_model->get_message_by_id($message_id, array('inc_orders'=>FALSE, 'inc_comments'=>FALSE));
        if ($message) {
            echo json_encode($message);

        } else {
            echo json_encode(array('err' => '未找到指定留言!'));
        }
    }
    public function message_del()
    {
        $message_id = $this->input->get('messageId');

        $row =  $this->message_model->delete_message($message_id);
        if($row > 0){
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    //查询该条留言详情
    public function get_message_detail()
    {
        $message_id = $this->input->get('messageId');
//        var_dump($message_id);
//        die();
        $message = $this->message_model->get_message_detail($message_id, array('inc_orders'=>FALSE, 'inc_comments'=>FALSE));

        if ($message) {
            echo json_encode($message);
            $adminId = -1;
            $read = $this->message_model->read_message($message_id);
            if($read){
                $row =  $this->Login_model->is_read($adminId);
                $this->session->set_userdata(array(
                    "unread" => $row
                ));
            }
        } else {
            echo json_encode(array('err' => '未找到指定留言信息!'));
        }
    }
    //管理员回复用户
    public function answer_message()
    {
        $id = $this->input->get("id");
        $receiver = $this->input->get("receiver");
        $content = $this->input->get("content");
        $reply_id = $this->input->get("reply_id");
        $row = $this->message_model->answer_message($id,$content,$receiver,$reply_id);
        if($row){
            echo "success";
        }else{
            echo "fail";
        }
    }


    public function message_add()
    {
        $receiver = $this -> input -> get('receiver_id');
        $content = $this -> input -> get('content');
        $row = $this -> message_model -> save_message("-1", $receiver, $content);
        if($row){
            echo "success";
        }else{
            echo "fail";
        }
    }

}
