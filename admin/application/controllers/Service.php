<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('service_model');
    }
    public function index(){
        $this->load->view("service_mgr.php");
    }
    public function add_service(){
        admin_log('添加维修记录');
        $plot_name=$this->input->post("plot_name");
        $house_name=$this->input->post("house_name");
        $facility_name=$this->input->post("facility_name");
        $question_dec = htmlspecialchars($this->input->post('editorValue'));
        $service_time=$this->input->post("service_time");
        $this->load->model('Service_model');
        $query=$this->Service_model->add($plot_name,$house_name,$facility_name,$question_dec,$service_time);
        if($query){
            redirect('service');
        }
    }

    public function service_mgr(){
        //header("Access-Control-Allow-Origin:*");
        admin_log('设备管理列表查询');
        $draw = $this->input->get('draw');
        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = htmlspecialchars($this->input->get('search[value]'));//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)
        $order_col = array('1'=>'service_id','2' => 'plot_name', '3' => 'house_name','4' => 'facility_name','5' => 'question_dec');
        //$order_col=array('0'=>'name');
        $recordsTotal = $this->service_model->get_total_count();
        $recordsFiltered = $this->service_model->get_filterd_count($search);


        $datas = $this->service_model->get_paginated_facility($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->service_id);
        }
        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function get_facility(){
        $datas = $this->service_model->get_facility();
        echo json_encode(array(
            "datas" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function del_all(){
        $namearr=$this->input->post('name');
        admin_log('管理员删除设备');
        //var_dump($namearr);
        $result=$this->service_model->del_all_name($namearr);
        if($result){
            echo "success";
        }else{
            echo "error";
        }
    }

    public function facility_del(){
        $facility_id = $this->input->get('facilityId');
        admin_log('设备管理删除设备编号'.$facility_id);
        //echo $facility_id;
        $row =$this->service_model->delete_facility($facility_id);
        if($row > 0){
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    public function order_search_plot()
    {
        $street = $this->input->get("street");
        $result = $this->service_model->order_search_plot($street);
        echo json_encode($result);
    }
    public function order_search_house()
    {
        $street = $this->input->get("street");
        $plot_id=$this->input->get("plot_id");
        $result = $this->service_model->order_search_house($street,$plot_id);
        echo json_encode($result);
    }

    public function order_search_facility(){
        $street = $this->input->get("street");
        $house_id=$this->input->get("house_id");
        $result = $this->service_model->order_search_facility($street,$house_id);
        echo json_encode($result);
    }
}
?>