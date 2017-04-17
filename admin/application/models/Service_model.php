<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Welcome_model');
    }
    public function add($plot_name,$park_name,$facility_name,$question_dec,$service_time){
        $arr=array(
            'plot_name'=>$plot_name,
            'park_name'=>$park_name,
            'facility_name'=>$facility_name,
            'question_dec'=>$question_dec,
            'service_time'=>$service_time
        );
        $query=$this->db->insert('t_service',$arr);
        return $query;
    }

    public function get_total_count(){
        $this->db->select('*');
        $this->db->from('t_service');
        //$this->db->where('is_delete', 0);
        return $this->db->count_all_results();
    }

    public function get_filterd_count($search){
        $sql = "SELECT * FROM t_service WHERE 1";
        if (strlen($search) > 0) {
            //            $sql .= " and (title||street||price) LIKE '%" . $search . "%'";
            $sql .= " and (plot_name LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_facility($limit, $offset, $search, $order_col, $order_col_dir){
        $sql = "SELECT * FROM t_service WHERE 1";
        if (strlen($search) > 0) {
            //            $sql .= " and (title||street||price) LIKE '%" . $search . "%'";
            $sql .= " and (plot_name LIKE '%" . $search . "%')";
        }
        $sql .= " order by $order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function get_facility(){
        $this->db->select('*');
        $this->db->from('t_service');
        return $this->db->get()->result();
    }

    public function del_all_name($namearr){
        //var_dump($namearr);
        $arrkeys=array_keys($namearr);
        //var_dump($arrkeys);
        for($i=0;$i<count($arrkeys);$i++){
            $key=$arrkeys[$i];
            $this->db->delete('t_service', array('service_id' => $namearr[$key]));
            $result=$this->db->delete('t_service', array('service_id' => $namearr[$key]));
            //$result=$this->db->delete('t_facility_type', array('facility_type_id' => $namearr[$i]));
            //$result=$this->db->query(" delete from t_facility_type where facility_type_id= '$namearr[$i]'");
        }

        return $result;
    }


    public function delete_facility($facility_id){
        //var_dump(123);
        //$this->db->delete('t_facility',array('type_id' => $facility_id));
        $rs=$this->db->delete('t_service', array('service_id' => $facility_id));
        //var_dump($rs);
        return $this->db->affected_rows();
    }

    public function order_search_plot($street)
    {
        return $this->db->query("select * from t_plot where plot_name like '%$street%'")->result();
    }
    public function order_search_park($street,$plot_id){
        $sql="select * from t_park where plot_id='$plot_id' and title like'%$street%'";
        return $this->db->query($sql)->result();
    }
    public function order_search_facility($street,$park_id){
        $sql="select * from t_facility,t_facility_type where t_facility.park_id='$park_id' and t_facility.type_id=t_facility_type.type_id and t_facility_type.name like '%$street%'";
        return $this->db->query($sql)->result();
    }
}
?>