<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('developer_model');
    }

    public function index()
    {
        admin_log("开发商管理的列表查询");
        $this->load->view('developer_mgr');
    }

    public function developer_mgr()
    {
        admin_log("开发商管理");
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)


        $order_col = array('0' => 'developer_id', '1' => 'logo', '2' => 'developer_name', '3' => 'address', '4' => 'telephone');
        $recordsTotal = $this->developer_model->get_all_count();
        $recordsFiltered = $this->developer_model->get_filterd_count($search);


        $datas = $this->developer_model->get_paginated_developers($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->developer_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);

    }

    public function developer_add()
    {
        $developer_id = $this->input->post("developer_id");
        if($developer_id){
            admin_log("开发商修改");
        }else{
            admin_log("开发商添加");
        }
        $developer_name = htmlspecialchars($this->input->post("developer_name"));
        $founding_time = htmlspecialchars($this->input->post("founding_time"));
        $telephone = htmlspecialchars($this->input->post("telephone"));
        $address = htmlspecialchars($this->input->post("address"));
        $description = $this->input->post("content");

        /*文件上传*/
        $config['upload_path'] = './uploads/developer/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 3072;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = date("YmdHis") . '_' . rand(10000, 99999);

        //图片上传操作
        $this -> load -> library('upload', $config);
        $this -> upload -> do_upload('logo');
        $upload_data = $this -> upload -> data();

        $tmp_portrait = $this->input->post("tmp_logo");
        if ($upload_data['file_size'] > 0 ) {
            $logo = 'uploads/developer/'.$upload_data['file_name'];
        }else if($tmp_portrait){
            $logo = $tmp_portrait;
        }else{
            //如果不上传图片,则使用默认图片
            $logo = 'images/head-default.png';
        }

        $this -> developer_model -> save_developer(array(
            "developer_id" => $developer_id,
            "developer_name" => $developer_name,
            "description" => $description,
            "telephone" => $telephone,
            "address" => $address,
            "founding_time" => $founding_time,
            "logo" => $logo
        ));
        redirect('developer');
    }

    public function developer_check_name()
    {
        $developer_name = $this->input->get("developer_name");
        $row = $this -> developer_model -> get_by_developername($developer_name);
        if($row){
            echo "fail";
        }else{
            echo "success";
        }
    }

    public function developer_detail()
    {
        admin_log("开发商详情查询");
        $developerId = $this->input->get('developerId');
        $developer = $this->developer_model->get_by_id($developerId, array('inc_park'=>TRUE));
        if ($developer) {
            echo json_encode($developer);
        } else {
            echo json_encode(array('err' => '未找到指定开发商信息!'));
        }
    }

    public function developer_park()
    {
        $developerId = $this->input->get('developerId');

        $draw = $this->input->get('draw');//jquery.datatables用到的数据，类似一个计数器，必须要用到

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

        //定义前台datatables中要显示和排序的列出数据库中字段的关系
        $order_col = array('0' => 'title', '1' => 'price','2' => 'area');

        $recordsTotal = $this->developer_model->get_total_developer_park_count($developerId);//获取所有记录数，必须要用到
        $recordsFiltered = $this->developer_model->get_filterd_developer_park_count($developerId, $search);//获取搜索过滤后的记录数，必须要用到

        //获取要分页的数据
        $datas = $this->developer_model->get_paginated_developer_park($developerId, $length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->developer_id);//jquery.datatables插件要用DT_RowData属性来为每一个tr绑定自定义data-*属性
        }
        echo json_encode(array(//返回的数据，下面这几个参数draw、recordsTotal、recordsFiltered都是jquery.datatables要求必须要传的
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function developer_del_all()
    {
        admin_log("开发商删除");
        $ids = $this -> input -> get("ids");
        $result = $this -> developer_model -> update_by_del_all($ids);
        if($result){
            echo "success";
        }
        else {
            echo "fail";
        }
    }

    public function developer_edit()
    {
        admin_log("开发商修改查询");
        $developerId = $this->input->get('developerId');
        $developer = $this->developer_model->get_by_developer_id($developerId);
        if ($developer) {
            echo json_encode($developer);
        } else {
            echo json_encode(array('err' => '未找到指定开发商信息!'));
        }
    }
}