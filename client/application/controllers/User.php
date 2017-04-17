<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    /**
     * 微信开发 - 个人中心
     */
    public function index()
    {
        //需要先登录才能进入个人中心
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo)) {
            $this->load->view("my_yueju", array('userinfo' => $userinfo));
        } else {
            $this->input->set_cookie("prev_url",$_SERVER['HTTP_REFERER'],3600);
            redirect("welcome/loginView");
        }
    }

    /**
     * 微信开发 - 获得订单接口
     */
    public function loadOrder()
    {

        $orderType = $this->input->get("orderType");
        //获取用户信息
        $userId = $this->session->userdata('userinfo')->user_id;
        if (isset($userId) && $orderType == 'order') {
            $results = $this->user_model->query_done_order($userId);//获取该用户所有已完成订单
            foreach ($results as $row) {
                $donepark = $this->user_model->query_park_info($row->park_id);
                $comment = $this->user_model->is_comment($userId, $row->order_id);
                $row->comment = true;
                $row->park = $donepark;
                if ($comment != null) {
                    $row->comment = false;
                }
            };
            echo json_encode(array(
                'data' => $results,
            ));
//            echo "success";

        } else if (isset($userId) && $orderType == 'un_order') {
            $results2 = $this->user_model->query_undone_order($userId);//获取该用户所有未完成订单
            foreach ($results2 as $row) {
                $undonepark = $this->user_model->query_park_info($row->park_id);
                $row->park = $undonepark;
            };
            echo json_encode(array(
                'data' => $results2,
            ));

        } else {
            echo "fail";
        }
    }

    public function img_upload()
    {

        $typeArr = array("jpg", "png", "ico");
        //允许上传文件格式
        $path = "uploads/comment/";
        //上传路径

        if (isset($_POST)) {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $name_tmp = $_FILES['file']['tmp_name'];
            if (empty($name)) {
                echo json_encode(array("error" => "您还未选择图片"));
                exit;
            }
            $type = strtolower(substr(strrchr($name, '.'), 1));
            //获取文件类型

            if (!in_array($type, $typeArr)) {
                echo json_encode(array("error" => "请上传jpg,png,ico类型的图片！"));
                exit;
            }
            if ($size > (500 * 1024)) {
                echo json_encode(array("error" => "图片大小已超过500KB！"));
                exit;
            }
            $pic_name = time() . rand(10000, 99999) . "." . $type;
            //图片名称
            $pic_url = $path . $pic_name;


            //上传后图片路径+名称
            if (move_uploaded_file($name_tmp, $pic_url)) {//临时文件转移到目标文件夹
                echo json_encode(array("error" => "0", "pic" => $pic_url, "name" => $pic_name));

            } else {
                echo json_encode(array("error" => "上传有误，请稍后重试！"));
            }
        }
    }

    public function check_login()
    {
        $login_user = $this->session->userdata('userinfo');
        if ($login_user) {
            echo "success";
        } else {
            $this->input->set_cookie("prev_url",'http://www.hrbyueju.com/yuejum/park/detail/28',3600);
            echo "fail";
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userinfo');
        redirect('welcome/index');
    }

    public function login_phone()
    {
        $phone = $this->input->get('phone');
        $phone_code = $this->input->get('phoneCode');
        $captcha = $this->input->get('captcha');
        if ($phone_code != $this->session->userdata('phone_code')) {
            echo "phoneError";
        } else if ($captcha != $this->session->userdata('captcha')) {
            echo "captchaError";
        } else {
            //判断是否有电话号
            $row = $this->user_model->get_user_by_phone($phone);
            if ($row == null) {
                //没有注册过
                $user_id = $this->user_model->add_user_phone($phone, $phone);
                $new_row = $this->user_model->get_by_id($user_id);
                $this->session->set_userdata('userinfo', $new_row);
                echo "success";
            } else {
                $this->session->set_userdata('userinfo', $row);
                echo "success";
            }
        }
    }

    public function update_user_info()
    {
        $useremail = $this->input->post("useremail");
        $relname = $this->input->post("relname");
        $sex = $this->input->post("sex");
        $idcard = $this->input->post("idcard");
        $head_img = $this->input->post("headImg");
        $user_id = $this->session->userdata('userinfo')->user_id;
        $result = $this->user_model->update_user_info($useremail, $relname, $sex, $idcard, $user_id,$head_img);
        if (count($result) > 0) {
            echo "success";
        } else {
            echo "fail";
        }
    }

}