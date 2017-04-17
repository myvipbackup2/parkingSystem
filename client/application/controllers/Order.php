<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('park_model');
    }

    public function get_fee_facilities()
    {
        $facilities = $this->order_model->get_fee_facilities();
        echo json_encode($facilities);
    }

    public function park_order()
    {
        $park_id = $this->input->post('parkId');
        $start_time = $this->input->post('startDate');
        $end_time = $this->input->post('endDate');
        $park = $this->park_model->get_park_by_id($park_id);
        $days = floor((strtotime($end_time) - strtotime($start_time)) / 86400);
        $this->load->view('submitorder', array('park' => $park, 'title' => $park->title, 'price' => $park->price, 'startTime' => $start_time, 'endTime' => $end_time, 'days' => $days));
    }

    public function confirm_order()
    {
        $park_id = $this->input->post('parkId');
        $park = $this->park_model->get_park_by_id($park_id);
        $price = $park->price;
        $parkInfo = $park->title;
        $startTime = $this->input->post('startDate');
        $endTime = $this->input->post('endDate');
        $days = floor((strtotime($endTime) - strtotime($startTime)) / 86400);
        $realName = $this->input->post('name');
        $phone = $this->input->post('tel');
        $amount = $days * $price;//拿park_id 取price  day* price
        $user_id = $this->session->userdata('userinfo')->user_id;


        $this->session->order_no = '';
        if ($this->session->order_no != '') {
            $order_num = $this->session->order_no;
        } else {
            $randNum = '';
            for ($i = 0; $i < 5; $i++) {
                $randNum .= rand(0, 9);
            }
            $order_num = date("YmdHis") . $randNum;
            $this->order_model->add_order($order_num, $park_id, $user_id, $startTime, $endTime, $realName, $amount, $phone);
            $this->session->order_no = $order_num;
        }
        $this->load->view('confirm_order', array(
            'parkInfo' => $parkInfo,
            'amount' => $amount,
            'realName' => $realName,
            'phone' => $phone,
            'order_num' => $order_num,
            'days' => $days,
            'price' => $price,
            'startTime' => $startTime,
            'endTime' => $endTime
        ));

    }

    public function combo_order()
    {
        $combo_id = $this->input->get('comboId');
        $start_time = $this->input->get('startTime');
        $end_time = $this->input->get('endTime');
        $result = $this->park_model->get_combo_by_id($combo_id);
        $days = floor((strtotime($end_time) - strtotime($start_time)) / 86400);
        $this->load->view('submitorder', array('park' => $result, 'title' => $result->com_title, 'price' => $result->com_price, 'startTime' => $start_time, 'endTime' => $end_time, 'days' => $days));
    }

    public function add_comment()
    {
        $user_id = $this->session->userdata('userinfo')->user_id;
        $orderId = $this->input->get("orderId");
        $parkId = $this->input->get("parkId");
        $val = $this->input->get("val");
        $score = $this->input->get("score");
        $clean_score = $this->input->get("cleanScore");
        $traffic_score = $this->input->get("trafficScore");
        $manage_score = $this->input->get("manageScore");
        $facility_score = $this->input->get("facilityScore");
        $imgs = $this->input->get("imgs");
        $row = $this->order_model->add_comment($orderId, $parkId, $val, $score, $user_id, $imgs, $clean_score, $traffic_score, $manage_score, $facility_score);
        if ($row > 0) {
            redirect("welcome/order");
        } else {
            redirect("welcome/add_comment");
        }
    }

    public function order_detail()
    {
        $orderId = $this->input->get('orderId');
        $order = $this->order_model->get_order_by_id($orderId);
        $facility = [];
        if (isset($order->facility)) {
            $facility = $this->order_model->get_facility($order->facility);
        }
        $this->load->view('order_detail', array('order' => $order, 'facility' => $facility));

    }
    public function apply_refund(){
        $order_no = $this->input->get('order_no');
        $this->order_model->apply_refund($order_no);
        redirect('welcome/order');
    }
}