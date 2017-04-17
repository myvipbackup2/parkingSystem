<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Plot extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('plot_model');

    }

    public function plot_del(){
        $plot_id = $this->input->get('plotId');

//        admin_log('小区管理删除小区编号'.$plot_id);
//        echo $plot_id;die;
        $row =$this->plot_model->delete_plot($plot_id);
        if($row > 0){
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    public function plot_mgr(){
//        admin_log('小区管理列表查询');
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = htmlspecialchars($this->input->get('search[value]'));//搜索内容
//        echo '111';
//        $order_col_no = $this->input->get('order[0][column]');//排序的列
//        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

//        $order_col = array('1'=>'plot_id');
        //$order_col=array('0'=>'name');
        $recordsTotal = $this->plot_model->get_total_count();
        $recordsFiltered = $this->plot_model->get_filterd_count($search);


        $datas = $this->plot_model->get_paginated_plot($length, $start, $search);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->plot_id);
        }
        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function get_plot(){
        $datas = $this->plot_model->get_plot();
        echo json_encode(array(
            "datas" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function add_plot(){
//        admin_log('小区管理添加小区');
        $plot_name=htmlspecialchars($this->input->post('add_plot_name'));
        $deve=htmlspecialchars($this->input->post('deve'));
        $plot_description = $this->input->post('plotDescription');
        $plot_video = htmlspecialchars($this->input->post('video'));
        $plot_pos = $this->input->post('pos');
        $this->load->model('plot_model');
        $query=$this->plot_model->insert_plot_name($plot_name,$deve,$plot_description,$plot_video,$plot_pos);
        if($query){
            redirect('plot');
        }

    }

    public function index(){
        $this->load->view('plot_mgr');
//

    }

    public function del_all(){
        $namearr=$this->input->post('name');
//        admin_log('管理员删除小区');
        $this->load->model('plot_model');
        $result=$this->plot_model->del_all_name($namearr);
        if($result){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function get_plot_by_id()
    {
        $plot_id=$this->input->get('plotId');
        $data = $this->plot_model->get_plot_by_id($plot_id);
        $deve=$this->plot_model->get_developer();
        if ($data) {
            echo json_encode(array('data'=>$data,'deve'=>$deve));
        } else {
            echo json_encode(array('err' => '未找到指定小区信息!'));
        }
    }
    public function plot_detail()
    {
        $plot_id = htmlspecialchars($this->input->post('plot_id'));
        $plot_name=htmlspecialchars($this->input->post('edit_plot_name'));
        $deve=htmlspecialchars($this->input->post('deve'));
//        echo $plot_id;die();
        $this->load->model('plot_model');
        $query=$this->plot_model->update_plot_name($plot_id,$plot_name,$deve);
        if($query){
            redirect('plot');
        }
    }

    public function get_del_plot()
    {
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');
        $search = htmlspecialchars($this->input->get('search[value]'));//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)
        $order_col = array('1' => 'plot_id', '2' => 'plot_name');

//        $datas=$this->plot_model->get_del_plot();
        $recordsTotal = $this->plot_model->get_total_del_count();
        $recordsFiltered = $this->plot_model->get_filterd_del_count($search);
        $datas = $this->plot_model->get_del_plot($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->plot_id);
        }
        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function plot_recover()
    {
        $plot_id= $this->input->get('plot_id');
        $row=$this->plot_model->plot_recover($plot_id);
        echo $row;
    }

    public function get_developer()
    {
        $data=$this->plot_model->get_developer();
        echo json_encode(array('data'=>$data));
    }
}

?>