<?php
class Alipay_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function get_alipay_trade_no($id){
        return $this->db->query("select * from t_order where order_no='$id'")->result();
    }
    public function up_alipay_trade_no($id){
        $sql="update t_order set status='退款成功' where trade_no='$id'";
        $this->db->query($sql);
    }
}
?>