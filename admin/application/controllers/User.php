<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }


    public function index()
    {
        admin_log("用户管理的列表查询");
        $this->load->view('user_mgr');
    }

    public function user_detail()
    {
        admin_log("用户详情查询");
        $user_id = $this->input->get('userId');
        $user = $this->user_model->get_by_id($user_id, array('inc_orders'=>TRUE, 'inc_messages'=>TRUE));
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(array('err' => '未找到指定用户信息!'));
        }
    }

    public function user_mgr()
    {
        admin_log("用户管理");
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)


        $order_col = array('0' => 'user_id', '1' => 'img', '2' => 'username', '3' => 'rel_name', '4' => 'tel', '5' => 'email');
        $recordsTotal = $this->user_model->get_all_count();
        $recordsFiltered = $this->user_model->get_filterd_count($search);


        $datas = $this->user_model->get_paginated_users($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->user_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function user_del()
    {
        admin_log("用户删除");
        $id=$this->uri->segment(3);
        $result=$this->user_model->update_by_del($id);
        if($result){
            redirect('user');
            //$this->userall();
        }
        else {
            echo "删除失败";
        }
    }

    public function user_del_all()
    {
        admin_log("用户删除全部");
        $ids = $this -> input -> get("ids");
        $result = $this -> user_model -> update_by_del_all($ids);
        if($result){
            echo "success";
        }
        else {
            echo "fail";
        }
    }

    public function user_check_name()
    {

        $username = $this->input->get("username");
        $row = $this -> user_model -> get_by_username($username);
        if($row){
            echo "fail";
        }else{
            echo "success";
        }
    }

    public function user_add()
    {
        $user_id = $this->input->post("user_id");
        if($user_id){
            admin_log("用户修改");
        }else{
            admin_log("用户添加");
        }
        $username = htmlspecialchars($this->input->post("uname"));
        $password = htmlspecialchars($this->input->post("password"));
        $relname = htmlspecialchars($this->input->post("relname"));
        $sex = $this->input->post("sex");
        $birthday = $this->input->post("birthday");
        $email = htmlspecialchars($this->input->post("email"));
        $tel = htmlspecialchars($this->input->post("tel"));

        /*文件上传*/
        $config['upload_path'] = './uploads/head/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 3072;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = date("YmdHis") . '_' . rand(10000, 99999);

        //图片上传操作
        $this -> load -> library('upload', $config);
        $this -> upload -> do_upload('portrait');
        $upload_data = $this -> upload -> data();

        $tmp_portrait = $this->input->post("tmp_portrait");
        if ($upload_data['file_size'] > 0 ) {
            $photo_url = 'uploads/head/'.$upload_data['file_name'];
        }else if($tmp_portrait){
            $photo_url = $tmp_portrait;
        }else{
            //如果不上传图片,则使用默认图片
            $photo_url = 'images/head-default.png';
        }

//        var_dump($upload_data);
//        die();


        $row = $this -> user_model -> save_user(array(
            "user_id" => $user_id,
            "username" => $username,
            "password" => $password,
            "tel" => $tel,
            "email" => $email,
            "rel_name" => $relname,
            "sex" => $sex,
            "birthday" => $birthday,
            "portrait" => $photo_url,
            "is_delete" => 0
        ));
        redirect('user');
    }

    public function user_orders()
    {
        $user_id = $this->input->get('userId');

        $draw = $this->input->get('draw');//jquery.datatables用到的数据，类似一个计数器，必须要用到

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

        //定义前台datatables中要显示和排序的列出数据库中字段的关系
        $order_col = array('0' => 'order_id', '1' => 'title','2' => 'start_time', '3' => 'end_time', '4' => 'price', '5' => 'status');

        $recordsTotal = $this->user_model->get_total_user_orders_count($user_id);//获取所有记录数，必须要用到
        $recordsFiltered = $this->user_model->get_filterd_user_orders_count($user_id, $search);//获取搜索过滤后的记录数，必须要用到

        //获取要分页的数据
        $datas = $this->user_model->get_paginated_user_orders($user_id, $length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->order_id);//jquery.datatables插件要用DT_RowData属性来为每一个tr绑定自定义data-*属性
        }

        echo json_encode(array(//返回的数据，下面这几个参数draw、recordsTotal、recordsFiltered都是jquery.datatables要求必须要传的
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);

    }

    public function user_messages()
    {
        $user_id = $this->input->get('userId');

        $draw = $this->input->get('draw');//jquery.datatables用到的数据，类似一个计数器，必须要用到

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

        //定义前台datatables中要显示和排序的列出数据库中字段的关系
        $order_col = array('0' => 'username', '1' => 'add_time','2' => 'content');

        $recordsTotal = $this->user_model->get_total_user_messages_count($user_id);//获取所有记录数，必须要用到
        $recordsFiltered = $this->user_model->get_filterd_user_messages_count($user_id, $search);//获取搜索过滤后的记录数，必须要用到

        //获取要分页的数据
        $datas = $this->user_model->get_paginated_user_messages($user_id, $length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->message_id);//jquery.datatables插件要用DT_RowData属性来为每一个tr绑定自定义data-*属性
        }

        echo json_encode(array(//返回的数据，下面这几个参数draw、recordsTotal、recordsFiltered都是jquery.datatables要求必须要传的
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }

    public function user_send_message()
    {
        admin_log("用户发送消息");
        $user_id = $this->input->get('userId');
        $user = $this->user_model->get_by_id($user_id, array('inc_orders'=>FALSE, 'inc_messages'=>FALSE));
        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(array('err' => '未找到指定用户信息!'));
        }
    }

    //订单管理-添加新用户
    public function add_new_user()
    {
        admin_log("用户添加--订单管理");
        $name = $this->input->get("name");
        $pwd = $this->input->get("pwd");
        $tel = $this->input->get("tel");
        $row = $this->user_model->add_new_user($name,$pwd,$tel);
        if($row){
            echo "success";
        }else{
            echo "file";
        }
    }
    public function add_new_user_get_id()
    {
        admin_log("用户添加--订单管理");
        $name = $this->input->get("name");
        $pwd = $this->input->get("pwd");
        $tel = $this->input->get("tel");
        $row = $this->user_model->add_new_user_get_id($name,$pwd,$tel);
        if($row){
            echo $row;
        }else{
            echo "fail";
        }
    }


    //用户名查重
    public function user_help()
    {
        $name = $this->input->get("name");
        $row = $this->user_model->user_help($name);
        if($row){
            echo "yes";
        }else{
            echo "no";
        }
    }
    //桉手机号搜索用户
    public function tel_search(){
        $tel = $this->input->get('tel');
        $row = $this->user_model->tel_search($tel);
        echo json_encode($row);
    }
}
