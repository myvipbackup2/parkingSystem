<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{

    public function get_total_count($date_search)
    {
        $this->db->select('*');
        $this->db->from('t_order');
        $this->db->where('is_delete', 0);
        $times = explode(",",$date_search);
//        $this->db->where("add_time between '$times[0]' and '$times[1]' ");
        return $this->db->count_all_results();
    }

    public function get_total_checkin_count()
    {
        $this->db->select('*');
        $this->db->from('t_order');
        $this->db->where('is_delete', 0);
        $this->db->where('status',"入住中");
        return $this->db->count_all_results();
    }

    public function get_filterd_checkin_count($search)
    {
        $sql = "SELECT t_order.*,t_park.title FROM t_park join t_order on t_park.park_id = t_order.park_id WHERE t_order.is_delete=0 and t_order.status = '入住中'";

        if (strlen($search) > 0) {
            $sql .= " and (t_order.start_time LIKE '%" . $search . "%' or t_order.end_time LIKE '%" . $search . "%' or t_order.order_type LIKE '%" . $search . "%' or t_park.title LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_checkin_order($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT t_order.*,t_park.title FROM t_park join t_order on t_park.park_id = t_order.park_id WHERE t_order.is_delete=0 and t_order.status = '入住中'";

        if (strlen($search) > 0) {
            $sql .= " and (t_order.start_time LIKE '%" . $search . "%' or t_order.end_time LIKE '%" . $search . "%' or t_order.order_type LIKE '%" . $search . "%' or t_park.title LIKE '%" . $search . "%')";
        }
        $sql .= " order by $order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function get_filterd_count($search,$status,$date_search)
    {
        $this->db->select('t_order.*,t_user.username,t_user.tel,t_park.title');
        $this->db->from('t_user');
        $this->db->join('t_order', 't_order.user_id = t_user.user_id');
        $this->db->join('t_park', 't_order.park_id = t_park.park_id');

        if ($status && $status=='回收站') {
            $this->db->where('t_order.is_delete', 1);
        }else if($status){
            $this->db->where('t_order.is_delete', 0);
            $this->db->where('t_order.status', $status);
        }else{
            $this->db->where('t_order.is_delete', 0);

        }
        if (strlen($search) > 0) {
            $this->db->like('t_user.username', $search);
            $this->db->or_like('t_order.price', $search);
            $this->db->or_like('t_park.title', $search);
            $this->db->or_like('t_order.order_id', $search);
        }
        $times = explode(",",$date_search);
//        $this->db->where("add_time between '$times[0]' and '$times[1]' ");
        return $this->db->count_all_results();

    }

    public function get_order_by_id($id)
    {
        $this->db->select('t_order.*,t_user.username,t_user.tel,t_park.park_id,t_park.title');
        $this->db->from('t_user');
        $this->db->join('t_order', 't_order.user_id = t_user.user_id');
        $this->db->join('t_park', 't_order.park_id = t_park.park_id');
        $this->db->where('t_order.order_id', $id);
        $this->db->where('t_order.is_delete', 0);
        return $this->db->get()->row();
    }

    public function get_order($limit, $offset, $search, $order_col, $order_col_dir, $status,$date_search)
    {
        $this->db->select('t_order.*,t_user.username,t_user.tel,t_park.title');
        $this->db->from('t_user');
        $this->db->join('t_order', 't_order.user_id = t_user.user_id');
        $this->db->join('t_park', 't_order.park_id = t_park.park_id');

        if ($status && $status=='回收站') {
            $this->db->where('t_order.is_delete', 1);
        }else if($status){
            $this->db->where('t_order.is_delete', 0);
            $this->db->where('t_order.status', $status);
        }else{
            $this->db->where('t_order.is_delete', 0);
        }
        if (strlen($search) > 0) {
            $this->db->like('t_user.username', $search);
            $this->db->or_like('t_order.price', $search);
            $this->db->or_like('t_park.title', $search);
            $this->db->or_like('t_order.order_id', $search);
            $this->db->or_like('t_order.status', $search);
        }

        $times = explode(",",$date_search);
//        $this->db->where("add_time between '$times[0]' and '$times[1]' ");

        $this->db->limit($limit, $offset);
        $this->db->order_by($order_col, $order_col_dir);
        return $this->db->get()->result();
    }
    public function update_order_by_id($order_id,$status){
        $arr = array(
            'status'=>$status
        );
        $this->db->where('order_id',$order_id);
        $this->db->update('t_order',$arr);
        return $this->db->affected_rows();
    }
    public function delete_order($order_id)
    {
//        $this->db->delete('t_park', array('park_id' => $park_id));
        $this->db->where('order_id', $order_id);
        $this->db->update('t_order', array('is_delete' => 1));
        return $this->db->affected_rows();
    }
    public function del_all_name($namearr){
        //var_dump($namearr);
        $arrkeys=array_keys($namearr);
        //var_dump($arrkeys);
        for($i=0;$i<count($arrkeys);$i++){
            $key=$arrkeys[$i];
            $this->db->where('order_id',$namearr[$key]);
            $this->db->update('t_order', array('is_delete' => 1));

//            $this->db->delete('t_order', array('type_id' => $namearr[$key]));
//
//            $this->db->delete('t_order', array('type_id' => $namearr[$key]));
//            $result=$this->db->delete('t_facility_type', array('type_id' => $namearr[$key]));
            //$result=$this->db->delete('t_facility_type', array('facility_type_id' => $namearr[$i]));
            //$result=$this->db->query(" delete from t_facility_type where facility_type_id= '$namearr[$i]'");
        }

        return $this->db->affected_rows();
    }
    public function recover_order($order_id){
        $this->db->where('order_id', $order_id);
        $this->db->update('t_order', array('is_delete' => 0));
        return $this->db->affected_rows();
    }
    //入住操作start
        //获取负责人姓名
    public function enter_manage($lev)
    {
        $sql = "select admin.* from t_admin admin where admin.level = ?";
        return $this->db->query($sql,array($lev))->result();
    }
        //添加入住信息
    public function add_checkin($arr)
    {
        $this->db->insert_batch('t_checkin',$arr);
        return $this->db->affected_rows();
    }
    //办理入住，更改order表信息
    public function manage_enter($id,$pledge,$enter_mask,$pay)
    {
        $this->db->where('order_id', $id);
        $this->db->update('t_order', array("cash_pledge"=>$pledge,"checkin_memo"=>$enter_mask,"return_way"=>$pay,"status"=>"入住中"));
        return $this->db->affected_rows();
    }
    //入住操作end
    //添加订单
    public function add_order($order_no, $price,$status,$park_id,$user_id,$dpd1,$dpd2,$pay){
        $arr = array(
            'order_no'=>$order_no,
            'park_id'=>$park_id,
            'user_id'=>$user_id,
            'start_time'=>$dpd1,
            'end_time'=>$dpd2,
            'status'=>$status,
            'price'=>$price,
            'cash_pledge_pay_way'=>$pay
        );
        $this->db->insert('t_order',$arr);
        return $this->db->affected_rows();
    }

    public function check_by_date($start_date,$end_date,$park_id)
    {
        $this->db->select('*');
        $this->db->from('t_order');
        $this->db->where('park_id',$park_id);
        $this->db->where("add_time between '$start_date' and '$end_date' ");
        return $this->db->count_all_results();
    }

    public function get_date_by_park($park_id)
    {
        $this->db->select('*');
        $this->db->from('t_order');
        $this->db->where('park_id',$park_id);
        $this->db->where_in('status', ["进行中","已支付"]);
        return $this->db->get()->result();
    }

    public function get_only_order_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('t_order');
        $this->db->where('order_id', $id);
        $this->db->where('t_order.is_delete', 0);
        return $this->db->get()->row();
    }

    public function add_order_keep($order)
    {
        $arr = array(
            'park_id'=>$order->park_id,
            'user_id'=>$order->user_id,
            'order_no'=>$order->order_no,
            'start_time'=>$order->start_time,
            'end_time'=>$order->end_time,
            'invoice_title'=>$order->title,
            'invoice_no'=> $order->invoice_no,
            'invoice_address'=>$order->invoice_address,
            'invoice_person_tel'=>$order->tel,
            'status'=>"入住中",
            'price'=>$order->price,
            'order_type'=>$order->order_type
        );
        $this->db->insert('t_order',$arr);
        return $this->db->affected_rows();
    }

    public function order_update($orderId,$data){
        $this->db->where('order_id', $orderId);
        $this->db->update('t_order', $data);
        return $this->db->affected_rows();
    }
    public function checkin_detail($orderId){
        //获取订单信息
        $order = $this->db->get_where("t_order",array('order_id'=>$orderId))->row();
        //获取房屋负责人
        $this->db->select('t_admin.real_name,t_admin.tel');
        $this->db->from('t_admin');
        $this->db->join('t_park','t_park.manager_id=t_admin.admin_id');
        $this->db->where('t_park.park_id', $order->park_id);
        $order->manager = $this->db->get()->row();
        //获取入住人信息

        $sql = "select * from t_checkin where checkin_time = (select checkin_time from t_checkin where order_id=$orderId order by checkin_time desc limit 0,1)";
        $order->checkins = $this->db->query($sql)->result();
        return $order;
    }

    public function cancel_order($order_id, $pledge, $cancelMemo){
        $arr = array(
            'return_cash_pledge'=>$pledge,
            'cancel_memo'=>$cancelMemo,
            'status'=>"用户取消"
        );
        $this->db->where('order_id',$order_id);
        $this->db->update('t_order',$arr);
        return $this->db->affected_rows();
    }

    public function get_order_by_no($orderno){
        return $this->db->get_where('t_order',array("order_no"=>$orderno))->row();
    }

    public function update_order_status($id){
        $arr = array(
            'status'=>"退款成功"
        );
        $this->db->where('order_no',$id);
        $this->db->update('t_order',$arr);
        return $this->db->affected_rows();
    }
}