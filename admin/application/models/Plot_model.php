<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plot_model extends CI_Model{
    public function insert_plot_from_park($plot_name,$deve,$plot_description,$plot_video){
        $arr=array(
            'plot_name'=>$plot_name,
            'developer_id'=>$deve,
            'description'=>$plot_description,
            'video'=>$plot_video,
            'plot_delete'=>0
        );
        $this->db->insert('t_plot',$arr);
        return $this -> db -> insert_id();
    }

    public function get_plot_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('t_plot');
        $this->db->join('t_developer','t_developer.developer_id=t_plot.developer_id');
        $this->db->where('plot_id',$id);
        return $this->db->get()->row();
    }

    public function get_developer()
    {
        return $this->db->get_where('t_developer',array("is_delete"=>0))->result();
    }
    public function delete_plot($plot_id){
//        $this->db->delete('t_plot',array('plot_id' => $plot_id));
        $this->db->where('plot_id',$plot_id);
        $this->db->update('t_plot', array('plot_delete' => 1));
        return $this->db->affected_rows();
    }
    public function get_total_count(){
        $this->db->select('*');
        $this->db->from('t_plot');
        $this->db->where('plot_delete',0);
        return $this->db->count_all_results();
    }
    public function get_filterd_count($search){
        $sql = "SELECT * FROM t_plot WHERE plot_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (plot_name LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }
    public function get_paginated_plot($limit, $offset, $search){
        $sql = "SELECT * FROM t_plot,t_developer WHERE t_plot.plot_delete=0 and t_plot.developer_id=t_developer.developer_id";
        if (strlen($search) > 0) {
            $sql .= " and (plot_name LIKE '%" . $search . "%')";
        }
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }
    public function get_plot(){
        $this->db->select('*');
        $this->db->from('t_plot');
        return $this->db->get()->result();
    }
    public function insert_plot_name($plot_name,$deve,$plot_description,$plot_video,$plot_pos){
        $arr=array(
            'plot_name'=>$plot_name,
            'developer_id'=>$deve,
            'description'=>$plot_description,
            'video'=>$plot_video,
            'plot_pos'=>$plot_pos,
            'plot_delete'=>0
        );
        $query=$this->db->insert('t_plot',$arr);
        return $query;
    }
    public function del_all_name($namearr){
        $this->db->where_in('plot_id',$namearr);
        $this->db->update('t_plot', array('plot_delete' => 1));
        return $this->db->affected_rows();
    }

    public function get_del_plot($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_plot,t_developer WHERE t_plot.plot_delete=1 and t_plot.developer_id=t_developer.developer_id";
        if (strlen($search) > 0) {
            $sql .= " and (plot_name LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY $order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";
        return $this->db->query($sql)->result();
    }
    public function plot_recover($id){
        $this->db->where_in('plot_id',$id);
        $this->db->update('t_plot', array('plot_delete' => 0));
        return $this->db->affected_rows();
    }
    public function get_total_del_count(){
        $this->db->select('*');
        $this->db->from('t_plot');
        $this->db->where('plot_delete',1);
        return $this->db->count_all_results();
    }
    public function get_filterd_del_count($search){
        $sql = "SELECT * FROM t_plot WHERE plot_delete=1";
        if (strlen($search) > 0) {
            $sql .= " and (plot_name LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }
    public function update_plot_name($id,$name,$deve){
        $this->db->where_in('plot_id',$id);
        $this->db->update('t_plot', array('plot_name' => $name,'developer_id'=>$deve));
        return $this->db->affected_rows();
    }
}