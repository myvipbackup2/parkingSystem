<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statement_model extends CI_Model
{
    public function get_statement_by_day($date){
        $sql = "select * from t_order,t_house,t_user where t_user.user_id = t_order.user_id and t_house.house_id = t_order.house_id and date_format(add_time,'%Y-%m-%d') = '$date' and status in ('已完成','入住中','已支付')";
        return $this->db->query($sql)->result();
    }
    public function get_statement_by_month($date){
        $sql = "select * from t_order ,t_house,t_user where t_user.user_id = t_order.user_id and t_house.house_id = t_order.house_id and date_format(add_time,'%Y-%m') = '$date'  and status in ('已完成','入住中','已支付')";
        return $this->db->query($sql)->result();
    }
    public function get_statement_by_year($date){
        $sql = "select * from t_order ,t_house,t_user where t_user.user_id = t_order.user_id and t_house.house_id = t_order.house_id and date_format(add_time,'%Y') = '$date'  and status in ('已完成','入住中','已支付')";
        return $this->db->query($sql)->result();
    }
}