<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/2/16
 * Time: 9:38
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class House extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('house_model');
    }

    public function index()
    {
        $rs = $this->house_model->get_plot();
        $image = $this->captcha();
        $this->load->view('house_center', array('plots' => $rs, 'image' => $image));
    }

    public function get_all_house($region, $content, $min_price, $max_price, $plot_id, $redroom, $is_sale)
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $house = $this->house_model->get_all_house($region, $content, $min_price, $max_price, $plot_id, $redroom, $is_sale);
        $image = $this->captcha();

        echo json_encode(array(
            'data' => $house,
            'image' => $image
        ));
    }

    public function get_hot_house()
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

        $hot_house = $this->house_model->get_recommend_house();
        $image = $this->captcha();

        echo json_encode(array(
            'data' => $hot_house,
            'image' => $image
        ));

    }

    public function get_houses()
    {
        $region = $this->input->get('region');
        $plot_id = $this->input->get('plotId');
        $content = $this->input->get('content');
        $min_price = $this->input->get('minPrice');
        $max_price = $this->input->get('maxPrice');
        $redroom = $this->input->get('redroom');
        $is_sale = $this->input->get('isSale');
        $is_hot = $this->input->get('isHot');
        if ($is_hot == 'all') {
            $this->get_all_house($region, $content, $min_price, $max_price, $plot_id, $redroom, $is_sale);
        } else {
            $this->get_hot_house();
        }
    }

//    public function get_search_house($page,$page_size,$region,$start_time,$end_time,$content,$min_price,$max_price,$plot,$house_style,$is_sale){
//        header('Access-Control-Allow-Origin:* ');
//        header('Access-Control-Allow-Headers: X-Requested-With');
//
//        $total = $this->house_model->count_search_house($region,$start_time,$end_time,$content,$min_price,$max_price,$plot,$house_style,$is_sale);
//
//        $hot_house =$this -> house_model -> get_search_house(($page-1)*$page_size, $page_size,$region,$start_time,$end_time,$content,$min_price,$max_price,$plot,$house_style,$is_sale);
//        $image = $this->captcha();
//
//        echo json_encode(array(
//            'total' => $total,
//            'data' => $hot_house,
//            'region'=>$region,
//            'image' => $image
//        ));
//
//
//    }
    public function index_search()
    {
        $content = $this->input->post('content');

        if ($content) {
            $this->session->content = $content;
        }
        $plots = $this->house_model->get_plot();

        $rs = $this->house_model->get_index_search($content);
        $image = $this->captcha();

        $this->load->view('house_center', array('data' => json_encode($rs), 'image' => $image, 'plots' => json_encode($plots), 'content' => $content));

    }

    public function detail($house_id)
    {
        $house_info = $this->house_model->get_house_by_id($house_id);
        $is_collect = false;
        $userinfo = $this->session->userdata('userinfo');
        //$this->session->unset_userdata('userinfo');清空session
        if (isset($userinfo)) {
            $row = $this->house_model->is_collect($userinfo->user_id, $house_id);
            if ($row != null) {
                $is_collect = true;
            }
        }
        if ($house_info) {
            $house_info->house_imgs = $this->house_model->get_imgs_by_house_id($house_id);
            $house_info->house_combos = $this->house_model->get_combos_by_house_id($house_id);
            $house_info->free_facilities = $this->house_model->get_free_facilities_by_house_id($house_id);
            $house_info->pay_facilities = $this->house_model->get_pay_facilities_by_house_id($house_id);
            $result_house_time = $this->house_model->get_by_house_time($house_id);
            //计算禁止日期
            $dataArr = [];
            foreach ($result_house_time as $order) {
                $start = strtotime($order->start_time);
                $end = strtotime($order->end_time);
                while ($start <= $end) {
                    $dataArr[] = date('Y-m-d', $start);
                    $start = strtotime('+1 day', $start);
                }
            }

            $rec_houses = $this->house_model->get_recommend_house(0, 3);
            $image = $this->captcha();
            $this->load->view("house_detail", array('house' => $house_info, 'image' => $image, 'rec_houses' => $rec_houses, 'all_times' => json_encode($dataArr), 'is_collect' => $is_collect));
        } else {
            echo '未找到指定房源信息!';
        }

    }

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

    public function add_collect()
    {
        //需要先登录才能收藏
        $houseId = $this->input->get("houseId");
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo)) {
            $userId = $this->session->userdata('userinfo')->user_id;
            $row = $this->house_model->add_collect($userId, $houseId);

            echo "success";

        } else {
            echo "login";
        }

    }

    public function remove_collect()
    {
        //需要先登录才能收藏
        $houseId = $this->input->get("houseId");
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo)) {
            $userId = $this->session->userdata('userinfo')->user_id;
            $row = $this->house_model->remove_collect($userId, $houseId);
            echo "success";

        } else {
            echo "login";
        }
    }

    public function get_developer()
    {
        $id = $this->input->get('developerId');
        $row = $this->house_model->get_developer($id);
        $image = $this->captcha();

        $this->load->view('developer_detail', array('row' => $row, 'image' => $image));
    }


    public function is_free_house()
    {
        $houseId = $this->input->post("houseId");
        $startTime = $this->input->post("startDate");
        $endTime = $this->input->post("endDate");
        $now = date('y-m-d');

        if(strtotime($startTime)<strtotime($now) || strtotime($endTime)<strtotime($now)){
            echo "un-sale";
        }else{
            $result = $this->house_model->is_free_house($houseId, $startTime, $endTime);
            if (count($result) > 0) {
                //不能订房
                echo "un-sale";
            } else {
                echo "on-sale";
            }
        }
    }

    public function get_plot()
    {
        $id = $this->input->get('plotId');
        $row = $this->house_model->get_plot($id);
        $this->load->view('plot_detail', array('row' => $row));
    }

    public function get_comments($house_id)
    {

//        $total = $this->house_model->count_comments($house_id);

        $comments = $this->house_model->get_comments($house_id);

        $score = $this->house_model->get_comments_score($house_id);

        echo json_encode(array(
            'data' => $comments,
            'score' => $score,
            'total' => count($comments)
        ));
    }

    public function get_comment_houseId()
    {
        $house_id = $this->input->get('house_id');

        $comments = $this->house_model->get_comments_houseId($house_id);

        $score = $this->house_model->get_comments_score($house_id);

        $this->load->view('house_comment_all', array(
            'data' => $comments,
            'score' => $score,
            'total' => count($comments)
        ));
//
//        echo json_encode(array(
//            'data' => $comments,
//            'score' => $score,
//            'total' => count($comments)
//        ));
    }

}