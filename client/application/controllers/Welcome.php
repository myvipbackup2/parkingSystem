<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('house_model');
    }

    //微信开发-首页
    public function index()
    {
        //查询推荐房源

        $result = $this->house_model->get_recommend_house(6, 0);
        $ids = [];
        foreach ($result as $house) {
            $ids[] = $house->house_id;
        }
        if (count($ids) > 0) {
            $result_house_img = $this->house_model->get_house_img($ids);
            foreach ($result_house_img as $img) {
                foreach ($result as $house) {
                    if ($img->house_id == $house->house_id) {
                        $house->imgs[] = $img;
                    }
                }
            }
        }
        $image = $this->captcha();
        $this->load->view('index', array(
            'result' => $result,
            'image' => $image
        ));
    }

    public function yueju_detail()
    {
        $image = $this->captcha();
        $this->load->view('yueju_detail', array('image' => $image));
    }

    public function yueju_team()
    {
        $image = $this->captcha();
        $this->load->view('yueju_team', array('image' => $image));
    }

    public function yueju_organize()
    {
        $image = $this->captcha();
        $this->load->view('yueju_organize', array('image' => $image));
    }

    public function yueju_target()
    {
        $image = $this->captcha();
        $this->load->view('yueju_target', array('image' => $image));
    }

    public function yueju_business()
    {
        $image = $this->captcha();
        $this->load->view('yueju_business', array('image' => $image));
    }

    public function yueju_rose()
    {
        $image = $this->captcha();
        $this->load->view('business/yueju_rose', array('image' => $image));
    }

    public function yueju_shore()
    {
        $image = $this->captcha();
        $this->load->view('business/yueju_shore', array('image' => $image));
    }

    public function yueju_bainian()
    {
        $image = $this->captcha();
        $this->load->view('business/yueju_bainian', array('image' => $image));
    }

    public function yueju_connect()
    {
        $image = $this->captcha();
        $this->load->view('yueju_connect_us', array('image' => $image));
    }

    public function yueju_status()
    {
        $image = $this->captcha();
        $this->load->view('yueju_status', array('image' => $image));
    }

    public function yueju_status1()
    {
        $image = $this->captcha();
        $this->load->view('status/yueju_status1', array('image' => $image));
    }

//    微信开发-消息中心
    public function message()
    {
        //需要先登录才能进入消息中心
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo)) {
            $user_id = $userinfo->user_id;
            $result = $this->user_model->get_message_by_userId($user_id);

            $this->load->view('message', array(
                "result" => $result
            ));
        } else {
            redirect("welcome/loginView");
        }

    }


    public function order_detail()
    {
        $this->load->view('order_details');
    }

    public function housecenter()
    {
        $this->load->view('house_center');
    }

    //刘福静-----登录注册时弹出层里load的界面
    public function login7()
    {
        $image = $this->captcha();
        $this->load->view("login7", array('image' => $image));
    }


    public function delete_order()
    {
        $this->load->model("user_model");
        $orderId = $this->input->get("orderId");
        $result = $this->user_model->delete_order($orderId);
        if ($result) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }
    //	任东旭——订单管理页面结束
    //微信开发-收藏
    public function collection_manage()
    {
        //需要先登录才能进入个人中心
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo)) {
            $user_id = $userinfo->user_id;
            $this->load->model("User_model");
            $results = $this->User_model->query_house_collection($user_id);//获取该用户所有收藏
//            $array = [];
//            foreach ($results as $row) {
//                $row2 = $this->User_model->query_house_info($row->house_id);
//                $array[] = $row2;
//            };
            $this->load->view("collection_manage", array("house_collection" => json_encode($results)));
        } else {
            redirect("welcome/loginView");
        }

    }

    public function delete_collection()
    {
        $this->load->model("User_model");
        $collectionId = $this->input->get("collectId");
        $result = $this->User_model->delete_collection($collectionId);
        if ($result) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }
    //	任东旭——收藏管理页面结束
    //	任东旭——订单详情页面结束
    public function order_details()
    {

    }
    //任东旭——订单详情页面结束
    //房源详情页面
    public function house_detail()
    {
        $this->load->view("house_details");
    }

    //微信开发- 个人资料开始
    public function personalInfo()
    {
        $user_id = $this->session->userdata('userinfo')->user_id;

        $row = $this->user_model->get_by_id($user_id);

        $this->load->view('personal_info', array(
            'row' => $row
        ));
    }
    //个人资料结束

    //密码管理开始
    public function pwdManage()
    {
        $captcah = $this->captcha();
        $user = $this->session->userdata('userinfo');
        $this->load->view('pwd_manage', array("image" => $captcah, 'user' => $user));
    }

    public function user_head_upload()
    {
        $typeArr = array("jpg", "png", "ico");
        //允许上传文件格式
        $path = "uploads/headImg/";
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
                echo json_encode(array("error" => "0", "url" => $pic_url, "name" => $pic_name));

            } else {
                echo json_encode(array("error" => "上传有误，请稍后重试！"));
            }
        }
    }

    //密码管理结束
    public function update_password()
    {
        $captcha = $this->input->post('captchaVal');
        $password = $this->input->post('password');
        $phone_code = $this->input->post('phoneCode');
        $user_id = $this->input->post('userId');

        if ($phone_code != $this->session->userdata("phone_code")) {
            echo '手机验证码错误';
        } else if ($captcha != $this->session->userdata("captcha")) {
            echo '验证码错误';
        } else {
            $row = $this->user_model->update_password($user_id, md5($password));
            if ($row > 0) {
                echo 'success';
            } else {
                echo '修改失败,请再试';
            }
        }
    }

    public function pay_success()
    {

        $this->load->view('pay_success');
    }


    //    微信开发 登录load->view
    public function loginView()
    {
        $image = $this->captcha();
        $this->load->view('login', array('image' => $image)); //image是验证码
    }

    /* 微信开发 登录  存session*/
    public function login()
    {
        $username = $this->input->get('username');
        $password = $this->input->get('password');//输入的用户名和密码
        $row = $this->user_model->get_by_username_pwd($username, md5($password));
        $captchaVal = $this->input->get('captchaVal');
        if ($row) {
            if ($captchaVal == $this->session->userdata("captcha"))/*判断验证码是否正确*/ {
                $this->session->set_userdata(array(
                    'userinfo' => $row  //将当前用户存入一个会话中
                ));
//                redirect("welcome/index");
                echo 'success';
            } else {
                echo '验证码错误';
            }
        } else {
            echo '用户名或密码错误';
        }
    }

    //    微信开发 注册load->view
    public function registerView()
    {
        $image = $this->captcha();
        $this->load->view('register', array('image' => $image)); //image是验证码
    }


    /*弹出层 注册   直接登录跳转到首页 */
    public function regist()
    {
        $number = $this->input->get('phoneNum');
        $username = $this->input->get('username');
        $password = $this->input->get('password');
        $captchaReg = $this->input->get('captchaVal');
        $telCaptcha = $this->input->get('telCaptcha');
        $passwordCode = md5($password);
        if ($captchaReg != $this->session->userdata("captcha")) {
            echo "验证码错误";
        } else if ($telCaptcha != $this->session->userdata("phone_code")) {
            echo '手机验证码错误';
        } else {
            $rows = $this->user_model->save_message($username, $passwordCode, $number);
            if ($rows > 0) {

                $list = $this->user_model->get_by_username_pwd($username, $passwordCode);

                if ($list) {
                    $this->session->set_userdata(array(
                        'userinfo' => $list  //将当前用户存入一个会话中
                    ));
                    echo "success";
                } else {
                    echo "注册失败";
                }
            }
        }
    }

    /* header  退出  */


    //注册 检查用户名是否存在
    public function check_username()
    {
        $username = $this->input->get('username');
        $user = $this->user_model->get_by_username($username);

        if ($user) {
            echo "check_username fail";
        } else {
            echo "check_username success";
        }
    }

    //刘福静  验证码
    public function captcha()
    {
        $this->load->helper('captcha');
        $vals = array(
            'word' => rand(1000, 9999),/*验证码里面数字*/
            'img_path' => './captcha/',
            'img_url' => base_url() . '/captcha/',
            'font_path' => './system/fonts/texb.ttf',
            'font-size' => 20,
            'img_width' => '100',
            'img_height' => 35,
            'expiration' => 60,/*验证码图片保存时间*/
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(153, 102, 102),
                'text' => array(204, 153, 153),
                'grid' => array(192, 192, 192)
            )
        );
        $this->session->set_userdata("captcha", $vals['word']);
        $cap = create_captcha($vals);
        return $cap['image'];
    }

    public function show_captcha()
    {
        echo $this->captcha();
    }


    //微信开发 - 评论页
    public function comment()
    {
        $user_id = $this->session->userdata('userinfo')->user_id;

        /*分页配置开始*/
        $total_rows = $this->user_model->get_all_count($user_id);//获取数据个数
        $page = $this->user_model->get_by_page($user_id);

        //找到comm_id,根据comm_id去找comm_img,查回来根据comm_id分组
        $ids = [];
        foreach ($page as $comment) {
            $ids[] = $comment->comm_id;
        }
        if (count($ids) > 0) {
            $result_comment_img = $this->house_model->get_comment_by_ids($ids);
            foreach ($result_comment_img as $img) {
                foreach ($page as $comment) {
                    if ($img->comm_id == $comment->comm_id) {
                        $comment->imgs[] = $img;
                    }

                }
            }
        }

        $this->load->view('comment', array(
            "page" => $page,
            "total_rows" => $total_rows
        ));
    }

    //    微信开发 添加评论->view
    public function add_comment()
    {
//        $image = $this->captcha();
        $this->load->model('order_model');
        $this->load->model('house_model');

        $orderId = $this->input->get('orderId');
        $houseId = $this->input->get('houseId');

        $order = $this->order_model->get_order_by_id($orderId);
//        $order->house_imgs = $this->house_model->get_imgs_by_house_id($houseId);

        $this->load->view('add_comment', array('order' => $order));
    }

    public function delete_comment()
    {
        $commentId = $this->input->get("comment_id");
        $row = $this->user_model->delete_comment_by_comment_id($commentId);
        if ($row > 0) {
            redirect("comment");
        } else {
            echo "fail";
        }
    }

    //用户给管理员留言
    public function leave_word()
    {
//		$sender=$this->session->userdata('userInfo')->user_id;
        $userinfo = $this->session->userdata('userinfo');
        if ($userinfo) {
            $sender = $userinfo->user_id;
            $content = $this->input->get('content');
            $row = $this->user_model->leave_word($sender, $content);
            if ($row > 0) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            echo "login";
        }


    }

    //留言弹出层
    public function postMessage()
    {
        $this->load->view('postMessage');
    }
    //分享弹出层

    //评论时弹出层里load的界面
    public function commentDialog()
    {
        $this->load->view('comment_dialog');
    }

    //微信开发-订单
    public function order()
    {
        $this->load->view('order');
    }

    //发送手机登录验证码
    public function send_phone_code()
    {
        $code = rand(1000, 9999);
        $this->session->set_userdata("phone_code", $code);
        $phone = $this->input->get('phone');
        $temp_id = $this->input->get('tempId');
        require_once(APPPATH . "libraries/alidayu/TopSdk.php");
        $c = new TopClient;
        $c->appkey = "23742326";
        $c->secretKey = "8621bcd8b81313dd25c5b4fb7c034911";
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("哈尔滨悦居");
        $req->setSmsParam("{'code':'" . $code . "','product':'哈尔滨悦居网'}");
        $req->setRecNum($phone);
        $req->setSmsTemplateCode($temp_id);
        $resp = $c->execute($req);
        echo 'success';
    }

    public function confirmorder()
    {
//        if ($this->input->get('order_no')) {
        $order_num = $this->input->get('order_id');
        $this->load->model('Order_model');
        $rs = $this->Order_model->get_order_by_id($order_num);
        $price = $rs->price;
        $days = floor((strtotime($rs->end_time) - strtotime($rs->start_time)) / 86400);
        $amount = $days * $price;//拿house_id 取price  day* price

        $this->load->view('confirm_order', array(
            'houseInfo' => $rs->title,
            'amount' => $amount,
            'realName' => $rs->invoice_person_name,
            'phone' => $rs->invoice_person_tel,
            'order_num' => $rs->order_no,
            'days' => $days,
            'price' => $rs->price,
            'startTime' => $rs->start_time,
            'endTime' => $rs->end_time
        ));
//        }
    }

    //关于我们
    public function about_us()
    {
        $this->load->view('about_yueju');
    }

}
