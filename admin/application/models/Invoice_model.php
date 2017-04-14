<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

	public function get_total_count()
	{
		$this -> db -> select('t_order.*,t_user.username');
		$this -> db -> from('t_user');
		$this -> db -> join('t_order','t_order.user_id = t_user.user_id');
		$this -> db -> where('t_order.is_delete',0);
		$this -> db -> where('t_order.is_invoice',1);
		$this -> db -> where('t_order.invoice_created',1);
		return $this->db->count_all_results();
	}

	public function get_filterd_count($search)
	{
		$sql = "SELECT t_order.*,t_user.username FROM t_user join t_order on t_user.user_id = t_order.user_id WHERE t_order.is_delete=0 and t_order.invoice_created =1";

		if (strlen($search) > 0) {
			$sql .= " and (t_order.invoice_title LIKE '%" . $search . "%' or t_user.username LIKE '%" . $search . "%' or t_order.invoice_no LIKE '%" . $search . "%')";
		}
		return $this->db->query($sql)->num_rows();
	}

	
	public function get_paginated_invoice($limit, $offset, $search, $order_col, $order_col_dir)
	{

		$sql = "SELECT t_order.*,t_user.username FROM t_user join t_order on t_user.user_id = t_order.user_id WHERE t_order.is_delete=0 and t_order.invoice_created =1";

		if (strlen($search) > 0) {
			$sql .= " and (t_order.invoice_title LIKE '%" . $search . "%' or t_user.username LIKE '%" . $search . "%' or t_order.invoice_no LIKE '%" . $search . "%')";

		}
		$sql .= " order by $order_col $order_col_dir";
		$sql .= " limit $offset, $limit";
		return $this->db->query($sql)->result();
	}
	public function get_order_total_count()
	{
		$this -> db -> select('t_order.*,t_user.username');
		$this -> db -> from('t_user');
		$this -> db -> join('t_order','t_order.user_id = t_user.user_id');
		$this -> db -> where('t_order.is_delete',0);
		return $this->db->count_all_results();
	}

	public function get_order_filterd_count($search)
	{
		$sql = "SELECT t_order.*,t_user.username FROM t_user join t_order on t_user.user_id = t_order.user_id WHERE t_order.is_delete=0";
		if (strlen($search) > 0) {
			$sql .= " and (t_order.add_time LIKE '%" . $search . "%' or t_user.username LIKE '%" . $search . "%' or t_order.price LIKE '%" . $search . "%')";
		}
		return $this->db->query($sql)->num_rows();
	}

	public function get_paginated_order($limit, $offset, $search, $order_col, $order_col_dir)
	{
		$sql = "SELECT t_order.*,t_user.username FROM t_user join t_order on t_user.user_id = t_order.user_id WHERE t_order.is_delete=0";

		if (strlen($search) > 0) {
			$sql .= " and (t_order.add_time LIKE '%" . $search . "%' or t_user.username LIKE '%" . $search . "%' or t_order.price LIKE '%" . $search . "%')";
		}
		$sql .= " order by $order_col $order_col_dir";
		$sql .= " limit $offset, $limit";
		return $this->db->query($sql)->result();
	}

	//////////////
	public function get_by_invoice_page($search,$limit = 5,$offset){
		$this -> db -> select('t_order.*,t_user.username');
		$this -> db -> from('t_user');
		$this -> db -> join('t_order','t_order.user_id = t_user.user_id');

		// $this -> db -> join('t_user','t_order.house_id = t_house.house_id');
		$this -> db -> where('t_order.is_delete',0);
		$this -> db -> where('t_order.is_invoice',1);
		$this -> db -> where('t_order.invoice_created',1);
		if($search){
			$this -> db -> like('t_user.username',$search);
		}
		$this -> db -> order_by('t_order.order_id','desc');
		$this -> db -> limit($limit,$offset);
		return $this -> db -> get() -> result();
	}
	public function get_by_page($search,$limit = 5,$offset){
		$this -> db -> select('t_order.*,t_user.username');
		$this -> db -> from('t_user');
		$this -> db -> join('t_order','t_order.user_id = t_user.user_id');

		$this -> db -> where('t_order.is_delete',0);
		if($search){
			$this -> db -> like('t_user.username',$search);
		}
		$this -> db -> order_by('t_order.order_id','desc');
		$this -> db -> limit($limit,$offset);
		return $this -> db -> get() -> result();
	}
	public function get_all_invoice_count($search){

		$this -> db -> select('t_order.*,t_user.username');
		$this -> db -> from('t_user');
		$this -> db -> join('t_order','t_order.user_id = t_user.user_id');
		$this -> db -> where('t_order.is_delete',0);
		$this -> db -> where('t_order.is_invoice',1);
		$this -> db -> where('t_order.invoice_created',1);
		if($search){
			$this -> db -> like('t_user.username',$search);
		}
		return $this -> db -> count_all_results();
	}
	public function get_all_count($search){

		$this -> db -> select('t_order.*,t_user.username');
		$this -> db -> from('t_user');
		$this -> db -> join('t_order','t_order.user_id = t_user.user_id');
		$this -> db -> where('t_order.is_delete',0);
		if($search){
			$this -> db -> like('t_user.username',$search);
		}
		return $this -> db -> count_all_results();
	}

 	public function update_post_by_id($id){
 		$arr=array('invoice_posted'=>1);
 		$this->db->where('order_id',$id);
 		$this->db->update('t_order',$arr);
		return $this->db->affected_rows();
 	}
	public function update_voiced_by_id($id){
		$arr=array('invoice_created'=>1);
		$this->db->where('order_id',$id);
		$this->db->update('t_order',$arr);
		return $this->db->affected_rows();
	}
}

