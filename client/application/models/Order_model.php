<?php

class Order_model extends CI_Model
{
    public function get_fee_facilities()
    {
        return $this->db->get_where("t_facility_type", array(
            "is_free" => 1
        ))->result();
    }

    public function add_order($order_num, $park_id, $user_id, $startTime, $endTime, $realName, $amount, $phone)
    {

        $status = '未支付';
        $data = array(
            'start_time' => $startTime,
            'end_time' => $endTime,
            'price' => $amount,
            'park_id' => $park_id,
            'user_id' => $user_id,
            'invoice_person_name' => $realName,
            'invoice_person_tel' => $phone,
            'order_no' => $order_num,
            'status' => $status,
            'cash_pledge_pay_way'=>'微信'
        );
        return $this->db->insert('t_order', $data);
    }

    public function add_comment($orderId, $parkId, $val, $score, $user_id, $imgs, $clean_score, $traffic_score, $manage_score, $facility_score)
    {
        $this->db->insert('t_comment', array(
            'order_id' => $orderId,
            'park_id' => $parkId,
            'content' => $val,
            'score' => $score,
            'user_id' => $user_id,
            'clean_score' => $clean_score,
            'traffic_score' => $traffic_score,
            'manage_score' => $manage_score,
            'facility_score' => $facility_score
        ));
        $id = $this->db->insert_id();
        if (count($imgs) > 0) {
            $data = [];
            foreach ($imgs as $img) {
                $data[] = array('img_thumb_src' => $img, 'comm_id' => $id);
            }
            $this->db->insert_batch('t_comment_img', $data);
        }

        return $this->db->affected_rows();

    }
//     将微信成功支付的订单写入数据库
    public function add_wechat_pay_order($orderno){
        $this->db->where('order_no', $orderno);
        $this->db->update('t_order', array('status'=>'已支付','cash_pledge_pay_way'=>'微信'));
        return $this->db->affected_rows();
    }

    //订单时间到期释放该停车位
    public function empty_wechat_pay_order($orderno){
        $this->db->where('order_no', $orderno);
        $this->db->update('t_order', array('status'=>'已完成','cash_pledge_pay_way'=>'微信'));
        return $this->db->affected_rows();
    }

    public function get_order_by_no($orderno){
        return $this->db->get_where('t_order',array('order_no'=>$orderno))->row();
    }
    public function get_order_by_id($order_id)
    {
//        $sql = "select h.*,o.* from t_park h,t_order o where h.park_id = o.park_id and o.order_id = $order_id";
        $sql = "select t_order.*,t_park.*,img.img_thumb_src from t_order join t_park on t_park.park_id = t_order.park_id join (select * from t_park_img img where img.is_main=1) img 
                on img.park_id = t_order.park_id where t_order.is_delete = 0 and t_order.order_id = $order_id";
        return $this->db->query($sql)->row();
    }

    public function get_facility($facility)
    {
        $sql = "select * from t_facility_type where type_id in($facility)";
        return $this->db->query($sql)->result();
    }

    public function select_order($order_num){
        $sql = "select h.*,o.* from t_park h,t_order o where h.park_id = o.park_id and o.order_no = '$order_num'";
        return $this->db->query($sql)->row();
    }
    public function apply_refund($order_num){
        return $this->db->where('order_no',$order_num)->update('t_order',array('status'=>'申请退款'));
    }

    public function get_manage($park_id){
        $this->db->select("t_park.*,t_admin.*,t_plot.plot_name");
        $this->db->from("t_park");
        $this->db->join('t_admin',"t_admin.admin_id=t_park.manager_id");
        $this->db->join('t_plot',"t_plot.plot_id=t_park.plot_id");
        $this->db->where("t_park.park_id", $park_id);
        return $this->db->get()->row();
    }


}