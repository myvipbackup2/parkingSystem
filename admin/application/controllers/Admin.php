<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin_model");
    }

    public function index()
    {
        admin_log('管理员管理的列表查询');
        $this->load->view('admin_mgr');
    }

    public function update()
    {
        $this->load->view('update_am_info');
    }

    public function query_info()
    {
        $adminId = $this->session->userdata('admininfo')->admin_id;
        $Pwd = $this->input->get('password');
        $row = $this->Admin_model->query($Pwd, $adminId);
        if ($row) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function update_info()
    {

        $config['upload_path'] = './uploads/admin_head';//上传图片的路径
        $config['allowed_types'] = 'gif|jpg|png';//上传图片的类型
//        $config['file_name']=data('YmdHis').'_'.rand(10000.99999);//文件名，因为文件名有可能重复。
        $config['max_size'] = '30760';//最大大小，以kb为单位
        $config['max_width'] = '10200';//最大宽度
        $config['max_height'] = '7680';//最大高度
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('img')) {
            $upload_data = $this->upload->data();
            $img = 'uploads/admin_head/' . $upload_data['raw_name'] . $upload_data['file_ext'];
            $adminId = $this->session->userdata('admininfo')->admin_id;
            $oldPwd = $this->session->userdata('admininfo')->password;
            $newPwd = $this->input->post('new_pass');
            $row = $this->Admin_model->updateimg($img, $adminId);//只更改头像
            if ($newPwd == '') {
                $newPwd = $oldPwd;
            }
            $row1 = $this->Admin_model->update($adminId, $newPwd, $img);//更改头像密码
            if ($row) {
                $row1 = $this->Admin_model->query1($img, $adminId);
                $this->session->set_userdata(array(
                    "admininfo" => $row1
                ));
                redirect('Admin/update');//更改成功返回首页
            } else if ($row1) {
                $adminId = $this->session->userdata('admininfo')->admin_id;
                $newPwd = $this->input->post('new_pass');
                $row2 = $this->Admin_model->query1($newPwd, $adminId);
                $this->session->set_userdata(array(
                    "admininfo" => $row2
                ));
                redirect('Admin/update');//更改成功返回首页
            } else {
                echo "更改个人信息失败";
            }
        } else if (!$this->upload->do_upload('img')) {
            $newPwd = $this->input->post('new_pass');
            $adminId = $this->session->userdata('admininfo')->admin_id;
            $row = $this->Admin_model->update1($adminId, $newPwd);
            if ($row) {
                $row1 = $this->Admin_model->query($newPwd, $adminId);
                $this->session->set_userdata(array(
                    "admininfo" => $row1
                ));
                redirect('Admin/update');//更改成功返回首页
            } else {
                echo "更改个人信息失败";
            }
        }
    }


    //退出登录
    public function logout()
    {
        $this->session->unset_userdata("admininfo");
        redirect('login');
    }

//登录
    public function check_login()
    {
        $adminName = $this->input->post('name');
        $password = $this->input->post('pwd');
        $row = $this->admin_model->get_name_pwd($adminName, $password);
        if ($row) {
            $adminId = -1;
            $message = $this->admin_model->is_read($adminId);//header查看未读message
            if ($message) {
                $this->session->set_userdata(array(
                    "admininfo" => $row,
                    "unread" => $message
                ));
            } else {
                $this->session->set_userdata(array(
                    "admininfo" => $row
                ));
                echo "success";
            }
        } else {
            echo "fail";
        }
    }

    //获取所有管理员信息
    public function admin_mgr()
    {
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

        $order_col = array('0' => 'admin_id', '1' => 'src_img', '2' => 'username', '3' => 'tel', '4' => 'level', '5' => 'open_id');

        $recordsTotal = $this->admin_model->get_total_count();
        $recordsFiltered = $this->admin_model->get_filterd_count($search);


        $datas = $this->admin_model->get_paginated_parks($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->admin_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);

    }

    //删除单条信息
    public function delete_admin()
    {
        $admin_id = $this->input->get('adminId');

        $row = $this->admin_model->delete_admin($admin_id);
        if ($row > 0) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    //批量删除
    public function delete_more_admin()
    {
        $admin = $this->input->get("admin");
        $row = $this->admin_model->delete_more_admin($admin);
        if ($row) {
            echo "success";
        }
    }

    //管理员详情页面
    public function admin_detail()
    {
        $admin_id = $this->input->get('adminId');
        $admin = $this->admin_model->get_admin_by_id($admin_id);
        if ($admin) {
            echo json_encode($admin);
        } else {
            echo json_encode(array('err' => '未找到指定信息!'));
        }
    }

    //修改信息
    public function change_admin()
    {
        $id = $this->input->post("id");
        $lev = $this->input->post("lev");
        $pwd = $this->input->post("pwd");
        $row = $this->admin_model->change_admin($id, $lev, $pwd);
        if ($row) {
            redirect("manage/index");
        } else {
            echo "file";
        }
    }

    //添加管理员
    public function add_admin()
    {
        $config['upload_path'] = './uploads/head';//上传图片的路径
        $config['allowed_types'] = 'gif|jpg|png';//上传图片的类型
//        $config['file_name']=data('YmdHis').'_'.rand(10000.99999);//文件名，因为文件名有可能重复。
        $config['max_size'] = '30760';//最大大小，以kb为单位
        $config['max_width'] = '10200';//最大宽度
        $config['max_height'] = '7680';//最大高度
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('img')) {
            $name = $this->input->post('name');
            $pwd = $this->input->post('pwd');
            $lev = $this->input->post('lev');

            $upload_data = $this->upload->data();
            $img = 'uploads/head/' . $upload_data['raw_name'] . $upload_data['file_ext'];
            $row = $this->admin_model->add_admin($name, $pwd, $lev, $img);
            if ($row) {
                redirect("manage/index");
            } else {
                echo "添加失败";
            }
        } else {
            echo "图片未找到";
        }
    }

    //添加管理员是检测管理员名字是否重复
    public function check_admin_name()
    {
        $name = $this->input->get("name");
        $row = $this->admin_model->check_admin_name($name);
        if ($row) {
            echo "file";
        }
    }

    public function log(){
        $this->load->view('log_mgr');
    }

    public function log_mgr(){
        $draw = $this->input->get('draw');

        //分页
        $start = $this->input->get('start');//从多少开始
        $length = $this->input->get('length');//数据长度
        $search = $this->input->get('search[value]');//搜索内容
        $order_col_no = $this->input->get('order[0][column]');//排序的列
        $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

        $order_col = array('0' => 'admin_name', '1' => 'log_time', '2' => 'log_content');

        $recordsTotal = $this->admin_model->get_log_total_count();
        $recordsFiltered = $this->admin_model->get_log_filterd_count($search);


        $datas = $this->admin_model->get_paginated_logs($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

        foreach ($datas as $data) {
            $data->DT_RowData = array('id' => $data->admin_id);
        }

        echo json_encode(array(
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $datas
        ), JSON_UNESCAPED_UNICODE);
    }
}