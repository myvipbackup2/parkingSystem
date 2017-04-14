<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_model');
    }

    public function index()
    {
        $this->load->view('invoice_mgr');
    }

    public function invoice_mgr()
    {
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)


        $order_col = array('0' => 'order_id', '1' => 'invoice_no', '2' => 'invoice_title', '3' => 'invoice_time', '4' => 'price', '5' => 'username');
        $recordsTotal = $this->invoice_model->get_total_count();
        $recordsFiltered = $this->invoice_model->get_filterd_count($search);


        $datas = $this->invoice_model->get_paginated_invoice($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->order_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);

    }

    public function update_post_state(){
        $id = $this -> input -> get('orderId');
        $row = $this -> invoice_model ->update_post_by_id($id);
        if($row>0){
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function update_voiced_state(){
        $id = $this -> input -> get('orderId');
        $row = $this -> invoice_model ->update_voiced_by_id($id);
        if($row>0){
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function invoice_get(){
        $this->load->view('invoice_create');
    }

    public function invoice_create(){
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)


        $order_col = array('0' => 'order_id', '1' => 'add_time', '2' => 'invoice_title', '3' => 'price', '4' => 'username');
        $recordsTotal = $this->invoice_model->get_order_total_count();
        $recordsFiltered = $this->invoice_model->get_order_filterd_count($search);


        $datas = $this->invoice_model->get_paginated_order($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->order_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);

    }

}
