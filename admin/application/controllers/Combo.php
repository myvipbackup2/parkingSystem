<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Combo extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('combo_model');

        }

        public function index()
        {
            $this->load->view('combo_mgr.php');
        }
        public function combo_type()
        {
            $this->load->view('combo_type_mgr.php');
        }

        public function combo_mgr(){
            admin_log("查询套餐列表");
            $draw = $this->input->get('draw');

            //分页
            $start = $this->input->get('start');//从多少开始
            $length = $this->input->get('length');//数据长度
            $search = $this->input->get('search[value]');//搜索内容
            $order_col_no = $this->input->get('order[0][column]');//排序的列
            $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

            $order_col = array('0' => 'combo_id', '1' => 'title', '2' => 'park_title','3'=>'price','4'=>'days','5'=>'type_name');
            $recordsTotal = $this->combo_model->get_total_count();
            $recordsFiltered = $this->combo_model->get_filterd_count($search);

            $datas = $this->combo_model->get_paginated_combo($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

            foreach ($datas as $data) {
                $data->DT_RowData = array('id' => $data->combo_id);
            }

            echo json_encode(array(
                "draw" => intval($draw),
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $datas
            ), JSON_UNESCAPED_UNICODE);

        }



        public function combo_type_mgr(){
            admin_log("查询套餐类型");
            $draw = $this->input->get('draw');

            //分页
            $start = $this->input->get('start');//从多少开始
            $length = $this->input->get('length');//数据长度
            $search = $this->input->get('search[value]');//搜索内容
            $order_col_no = $this->input->get('order[0][column]');//排序的列
            $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

            $order_col = array('0' => 'type_id', '1' => 'type_name', '2' => 'description');
            $recordsTotal = $this->combo_model->get_type_total_count();
            $recordsFiltered = $this->combo_model->get_type_filterd_count($search);

            $datas = $this->combo_model->get_paginated_combo_type($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

            foreach ($datas as $data) {
                $data->DT_RowData = array('id' => $data->type_id);
            }

            echo json_encode(array(
                "draw" => intval($draw),
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $datas
            ), JSON_UNESCAPED_UNICODE);

        }

        public function add_combo(){
            admin_log("添加套餐");
            $park_id = htmlspecialchars($this->input->post('park_id'));
            $title = htmlspecialchars($this->input->post('title'));
            $start_time = htmlspecialchars($this->input->post('start_time'));
            $end_time = htmlspecialchars($this->input->post('end_time'));
            $price = htmlspecialchars($this->input->post('price'));
            $days = htmlspecialchars($this->input->post('days'));
            $link = htmlspecialchars($this->input->post('link'));
            $combo_type_id = htmlspecialchars($this->input->post('combo_type_id'));
            $rows = $this->combo_model->add_combo(array(
                'park_id'=>$park_id,
                'title'=>$title,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
                'price'=>$price,
                'days'=>$days,
                'link'=>$link,
                'combo_type_id'=>$combo_type_id
            ));
            if($rows>0){
                redirect('park');
            }else{
                echo json_encode(array('err' => '添加套餐失败!'));
            }
        }

        public function add_combo_type(){
            admin_log("添加套餐类型");
            $typeName = htmlspecialchars($this->input->post('type_name'));
            $description = htmlspecialchars($this->input->post('description'));
            $rows = $this->combo_model->add_combo_type($typeName,$description);
            if($rows>0){
                redirect('combo/combo_type');
            }else{
                echo json_encode(array('err' => '添加套餐类型失败!'));
            }

        }
        public function combo_type_del(){
            admin_log("删除套餐类型");
            $type_id = $this->input->get('type_id');
            $row =  $this->combo_model->delete_combo_type($type_id);
            if($row > 0){
                echo 'success';
            }else{
                echo 'fail';
            }
        }
        public function combo_del(){
            admin_log("删除套餐");
            $combo_id = $this->input->get('combo_id');
            $row =  $this->combo_model->delete_combo($combo_id);
            if($row > 0){
                echo 'success';
            }else{
                echo 'fail';
            }
        }

        public function combo_type_detail(){
            $type_id = $this->input->get('typeId');
            $row = $this->combo_model->get_type_detail($type_id);
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(array('err' => '未找到指定套餐类型信息!'));
            }
        }

        public function get_combo_type(){
            $parkId = $this->input->get('parkId');
            $result = $this->combo_model->get_combo_type();
            echo json_encode(array(
                "park_id" => intval($parkId),
                "types" => $result
            ), JSON_UNESCAPED_UNICODE);
        }

        public function combo_detail(){
            $combo_id = $this->input->get('comboId');
            $row = $this->combo_model->get_detail($combo_id);
            foreach ($row->types as $type){
                if($type->type_id == $row->combo_type_id){
                    $type->selected = 'selected';
                }
            }
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(array('err' => '未找到指定套餐信息!'));
            }
        }
        public function edit_combo_type(){
            admin_log("修改套餐类型");
            $type_id = htmlspecialchars($this->input->post('type_id'));
            $type_name = htmlspecialchars($this->input->post('type_name'));
            $description = htmlspecialchars($this->input->post('description'));
            $row = $this->combo_model->edit_combo_type($type_id,array(
                'type_name'=>$type_name,
                'description'=>$description
            ));
            if ($row) {
                redirect('combo/combo_type');
            } else {
                echo "更新失败";
            }
        }

        public function edit_combo(){
            admin_log("修改套餐");
            $combo_id = htmlspecialchars($this->input->post('combo_id'));
            $title = htmlspecialchars($this->input->post('title'));
            $start_time = htmlspecialchars($this->input->post('start_time'));
            $end_time = htmlspecialchars($this->input->post('end_time'));
            $price = htmlspecialchars($this->input->post('price'));
            $days = htmlspecialchars($this->input->post('days'));
            $combo_type_id = htmlspecialchars($this->input->post('combo_type_id'));
            $row = $this->combo_model->edit_combo($combo_id,array(
                'title'=>$title,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
                'price'=>$price,
                'days'=>$days,
                'combo_type_id'=>$combo_type_id
            ));
            if ($row) {
                redirect('combo');
            } else {
                echo "更新失败";
            }

        }

        public function type_del_all(){

            admin_log("删除套餐类型");
            $ids = $this -> input -> get("ids");
            $rows = $this -> combo_model -> del_type_all($ids);
            if($rows>0){
                echo "success";
            }
            else {
                echo "fail";
            }
        }

        public function combo_del_all(){
            admin_log("删除套餐");
            $ids = $this -> input -> get("ids");
            $rows = $this -> combo_model -> del_combo_all($ids);
            if($rows>0){
                echo "success";
            }
            else {
                echo "fail";
            }
        }

    }


?>