<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome_model extends CI_Model {
    //获取小区分类和和每个小区的房源数量
    public function get_plot(){
        $sql="select count(*)as num ,t_house.plot_id,t_plot.plot_name from t_house,t_plot  where t_house.plot_id=t_plot.plot_id GROUP BY  plot_id";
        $query=$this->db->query($sql);
        return $query->result();
    }
    public function get_message(){
        $sql="select t_message.content,t_user.username,t_user.portrait from t_message,t_user where t_message.reply_id is null and t_user.user_id=t_message.sender order by message_id DESC limit 5";
        $query=$this->db->query($sql);
        return $query->result();
    }
}
?>