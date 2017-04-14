<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combo_model extends CI_Model {

	public function get_type_total_count()
	{
		$this -> db -> select('t_combo_type');
		$this -> db -> from('t_user');
		return $this->db->count_all_results();
	}
	public function get_total_count()
	{
		$this -> db -> select('t_combo.*,t_combo_type.type_name,t_house.title house_title');
		$this -> db -> from('t_combo');
		$this -> db -> join('t_combo_type','t_combo_type.type_id = t_combo.combo_type_id');
		$this -> db -> join('t_house','t_house.house_id = t_combo.house_id');
		return $this->db->count_all_results();
	}
	public function get_filterd_count($search)
	{
		$sql = "SELECT t_combo.*,t_combo_type.type_name,t_house.title house_title FROM t_combo JOIN t_combo_type on t_combo_type.type_id = t_combo.combo_type_id JOIN t_house on t_house.house_id = t_combo.house_id where 1";
		if (strlen($search) > 0) {
			$sql .= " and (t_combo.title LIKE '%" . $search . "%' or t_house.title LIKE '%" . $search . "% or t_combo.days LIKE '%" . $search . "% or t_combo.price LIKE '%" . $search . "%')";
		}
		return $this->db->query($sql)->num_rows();
	}

	public function get_type_filterd_count($search)
	{
		$sql = "SELECT * FROM t_combo_type where 1";
		if (strlen($search) > 0) {
			$sql .= " and (t_combo_type.type_name LIKE '%" . $search . "%' or t_combo_type.description LIKE '%" . $search . "%')";
		}
		return $this->db->query($sql)->num_rows();
	}

	public function get_paginated_combo($limit, $offset, $search, $order_col, $order_col_dir)
	{
		$sql = "SELECT t_combo.*,t_combo_type.type_name,t_house.title house_title FROM t_combo JOIN t_combo_type on t_combo_type.type_id = t_combo.combo_type_id JOIN t_house on t_house.house_id = t_combo.house_id where 1";
		if (strlen($search) > 0) {
			$sql .= " and (t_combo.title LIKE '%" . $search . "%' or t_house.title LIKE '%" . $search . "% or t_combo.days LIKE '%" . $search . "% or t_combo.price LIKE '%" . $search . "%')";
		}
		$sql .= " order by $order_col $order_col_dir";
		$sql .= " limit $offset, $limit";
		return $this->db->query($sql)->result();
	}

	public function get_paginated_combo_type($limit, $offset, $search, $order_col, $order_col_dir)
	{
		$sql = "SELECT * FROM t_combo_type where 1";
		if (strlen($search) > 0) {
			$sql .= " and (t_combo_type.type_name LIKE '%" . $search . "%' or t_combo_type.description LIKE '%" . $search . "%')";
		}
		$sql .= " order by $order_col $order_col_dir";
		$sql .= " limit $offset, $limit";
		return $this->db->query($sql)->result();
	}

	public function add_combo_type($typeName,$description){

		$this -> db -> insert('t_combo_type',array(
			'type_name'=>$typeName,
			'description'=>$description
		));
		return $this -> db -> affected_rows();
	}

	public function add_combo($data){

		$this -> db -> insert('t_combo',$data);
		return $this -> db -> affected_rows();
	}

	public function delete_combo_type($type_id){
		$this->db->where_in('type_id',$type_id);
		$this->db->delete('t_combo_type');
		return $this->db->affected_rows();
	}

	public function delete_combo($combo_id){
		$this->db->where_in('combo_id',$combo_id);
		$this->db->delete('t_combo');
		return $this->db->affected_rows();
	}

	public function get_type_detail($type_id){
		$row = $this->db->get_where('t_combo_type', array('type_id' => $type_id))->row();
		return $row;
	}

	public function get_detail($combo_id){

		$this -> db -> select('t_combo.*,t_combo_type.type_name,t_house.title house_title');
		$this -> db -> from('t_combo');
		$this -> db -> join('t_combo_type','t_combo_type.type_id = t_combo.combo_type_id');
		$this -> db -> join('t_house','t_house.house_id = t_combo.house_id');
		$this->db->where('t_combo.combo_id', $combo_id);
		$row = $this->db->get()->row();
		$types = $this->db->get('t_combo_type')->result();
		if($types){
			$row->types = $types;
		}
		return $row;
	}

	public function get_combo_type(){
		$result = $this->db->get_where('t_combo_type')->result();
		return $result;
	}

	public function edit_combo_type($type_id,$data){
		$this->db->where('type_id', $type_id);
		$this->db->update('t_combo_type', $data);
		return $this -> db -> affected_rows();
	}

	public function edit_combo($combo_id,$data){
		$this->db->where('combo_id', $combo_id);
		$this->db->update('t_combo', $data);
		return $this -> db -> affected_rows();
	}

	public function del_type_all($ids){
		$this->db->where_in('type_id',explode(",", $ids));
		$this->db->delete('t_combo_type');
		return $this -> db -> affected_rows();
	}
	public function del_combo_all($ids){
		$this->db->where_in('combo_id',explode(",", $ids));
		$this->db->delete('t_combo');
		return $this -> db -> affected_rows();
	}
}

