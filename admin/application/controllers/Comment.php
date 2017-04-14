<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Comment extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('comment_model');

        }

        public function index()
        {
            $this->load->view('comment_mgr.php');
        }

        public function comment_mgr(){
            admin_log("查询评论列表");
            $draw = $this->input->get('draw');

            //分页
            $start = $this->input->get('start');//从多少开始
            $length = $this->input->get('length');//数据长度
            $search = $this->input->get('search[value]');//搜索内容
            $order_col_no = $this->input->get('order[0][column]');//排序的列
            $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

            $order_col = array('0' => 'comm_id', '1' => 'comm_time', '2' => 'content','3'=>'username','4'=>'title');
            $recordsTotal = $this->comment_model->get_total_count();
            $recordsFiltered = $this->comment_model->get_filterd_count($search);

            $datas = $this->comment_model->get_paginated_comment($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

            foreach ($datas as $data) {
                $data->DT_RowData = array('id' => $data->comm_id);
            }

            echo json_encode(array(
                "draw" => intval($draw),
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $datas
            ), JSON_UNESCAPED_UNICODE);

        }


        public function comment_detail(){
            $comm_id = $this->input->get('commId');
            $row = $this->comment_model->get_comment_detail($comm_id);
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(array('err' => '未找到指定评论信息!'));
            }
        }
    }


?>