<?php
/**
 * Created by PhpStorm.
 * User: 孟昊阳
 * Date: 2017/2/16
 * Time: 10:26
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Park extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('park_model');
    }

    public function index()
    {
        $rs = $this->park_model->get_plot();
        $image = $this->captcha();
        $this->load->view('park_center', array('plots' => $rs, 'image' => $image));
    }

    //显示所有停车场
    public function get_all_park($region, $content, $min_price, $max_price, $plot_id, $redroom, $is_sale)
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $park = $this->park_model->get_all_park($region, $content, $min_price, $max_price, $plot_id, $redroom, $is_sale);
        $image = $this->captcha();

        echo json_encode(array(
            'data' => $park,
            'image' => $image
        ));
    }

    //显示热门推荐停车场
    public function get_hot_park()
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

        $hot_park = $this->park_model->get_recommend_park();
        $image = $this->captcha();

        echo json_encode(array(
            'data' => $hot_park,
            'image' => $image
        ));

    }

    //返回停车场的json数据
    public function get_parks()
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
            $this->get_all_park($region, $content, $min_price, $max_price, $plot_id, $redroom, $is_sale);
        } else {
            $this->get_hot_park();
        }
    }

    //停车位搜索
    public function index_search()
    {
        $content = $this->input->post('content');

        if ($content) {
            $this->session->content = $content;
        }
        $plots = $this->park_model->get_plot();

        $rs = $this->park_model->get_index_search($content);
        $image = $this->captcha();

        $this->load->view('park_center', array('data' => json_encode($rs), 'image' => $image, 'plots' => json_encode($plots), 'content' => $content));
    }

    //停车场详情
    public function detail($park_id)
    {
        $park_info = $this->park_model->get_park_by_id($park_id);
        $is_collect = false;
        $userinfo = $this->session->userdata('userinfo');
        //$this->session->unset_userdata('userinfo');//清空session 测试使用
        if (isset($userinfo)) {
            $row = $this->park_model->is_collect($userinfo->user_id, $park_id);
            if ($row != null) {
                $is_collect = true;
            }
        }
        if ($park_info) {
            $park_info->park_imgs = $this->park_model->get_imgs_by_park_id($park_id);
            $park_info->park_combos = $this->park_model->get_combos_by_park_id($park_id);
            $park_info->free_facilities = $this->park_model->get_free_facilities_by_park_id($park_id);
            $park_info->pay_facilities = $this->park_model->get_pay_facilities_by_park_id($park_id);
            $result_park_time = $this->park_model->get_by_park_time($park_id);
            //计算禁止停车日期
            $dataArr = [];
            foreach ($result_park_time as $order) {
                $start = strtotime($order->start_time);
                $end = strtotime($order->end_time);
                while ($start <= $end) {
                    $dataArr[] = date('Y-m-d', $start);
                    $start = strtotime('+1 day', $start);
                }
            }

            $rec_parks = $this->park_model->get_recommend_park(0, 3);
            $image = $this->captcha();
            $this->load->view("park_detail", array('park' => $park_info, 'image' => $image, 'rec_parks' => $rec_parks, 'all_times' => json_encode($dataArr), 'is_collect' => $is_collect));
        } else {
            echo '未找到指定车位信息!';
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

    //收藏
    public function add_collect()
    {
        //需要先登录才能收藏
        $parkId = $this->input->get("parkId");
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo)) {
            $userId = $this->session->userdata('userinfo')->user_id;
            $row = $this->park_model->add_collect($userId, $parkId);
            echo "success";
        } else {
            echo "login";
        }

    }

    //删除收藏
    public function remove_collect()
    {
        //需要先登录才能收藏
        $parkId = $this->input->get("parkId");
        $userinfo = $this->session->userdata('userinfo');
        if (isset($userinfo)) {
            $userId = $this->session->userdata('userinfo')->user_id;
            $row = $this->park_model->remove_collect($userId, $parkId);
            echo "success";
        } else {
            echo "login";
        }
    }

    //车位开发商信息
    public function get_developer()
    {
        $id = $this->input->get('developerId');
        $row = $this->park_model->get_developer($id);
        $image = $this->captcha();
        $this->load->view('developer_detail', array('row' => $row, 'image' => $image));
    }

    //ajax查询此时段是否可以停车
    public function is_free_park()
    {
        $parkId = $this->input->post("parkId");
        $startTime = $this->input->post("startDate");
        $endTime = $this->input->post("endDate");
        $now = date('y-m-d');

        if (strtotime($startTime) < strtotime($now) || strtotime($endTime) < strtotime($now)) {
            echo "un-sale";
        } else {
            $result = $this->park_model->is_free_park($parkId, $startTime, $endTime);
            if (count($result) > 0) {
                //不能停车
                echo "un-sale";
            } else {
                echo "on-sale";
            }
        }
    }

    public function get_plot()
    {
        $id = $this->input->get('plotId');
        $row = $this->park_model->get_plot($id);
        $this->load->view('plot_detail', array('row' => $row));
    }

    //获取评论和评分
    public function get_comments($park_id)
    {
        $comments = $this->park_model->get_comments($park_id);

        $score = $this->park_model->get_comments_score($park_id);

        echo json_encode(array(
            'data' => $comments,
            'score' => $score,
            'total' => count($comments)
        ));
    }

    //评论详情页面
    public function get_comment_parkId()
    {
        $park_id = $this->input->get('park_id');

        $comments = $this->park_model->get_comments_parkId($park_id);

        $score = $this->park_model->get_comments_score($park_id);

        $this->load->view('park_comment_all', array(
            'data' => $comments,
            'score' => $score,
            'total' => count($comments)
        ));
    }

}