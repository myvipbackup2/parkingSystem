<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model {


	public function get_total_count()
	{
		$this -> db -> select('t_comment.*,t_user.username,t_park.title');
		$this -> db -> from('t_comment');
		$this -> db -> join('t_user','t_user.user_id = t_comment.user_id');
		$this -> db -> join('t_park','t_park.park_id = t_comment.park_id');
		return $this->db->count_all_results();
	}
	public function get_filterd_count($search)
	{
		$sql = "SELECT t_comment.*,t_user.username,t_park.title FROM t_comment JOIN t_user on t_comment.user_id = t_user.user_id JOIN t_park on t_park.park_id = t_comment.park_id where 1";
		if (strlen($search) > 0) {
			$sql .= " and (t_comment.content LIKE '%" . $search . "%' or t_park.title LIKE '%" . $search . "% or t_comment.comm_time LIKE '%" . $search . "% or t_user.username LIKE '%" . $search . "%')";
		}
		return $this->db->query($sql)->num_rows();
	}

	public function get_paginated_comment($limit, $offset, $search, $order_col, $order_col_dir)
	{
		$sql = "SELECT t_comment.*,t_user.username,t_park.title FROM t_comment JOIN t_user on t_comment.user_id = t_user.user_id JOIN t_park on t_park.park_id = t_comment.park_id where 1";
		if (strlen($search) > 0) {
			$sql .= " and (t_comment.content LIKE '%" . $search . "%' or t_park.title LIKE '%" . $search . "% or t_comment.comm_time LIKE '%" . $search . "% or t_user.username LIKE '%" . $search . "%')";
		}
		$sql .= " order by $order_col $order_col_dir";
		$sql .= " limit $offset, $limit";
		return $this->db->query($sql)->result();
	}


	public function get_comment_detail($comm_id){

		$this -> db -> select('t_comment.*,t_user.username,t_park.*');
		$this -> db -> from('t_comment');
		$this -> db -> join('t_user','t_user.user_id = t_comment.user_id');
		$this -> db -> join('t_park','t_park.park_id = t_comment.park_id');
		$this -> db -> where('t_comment.comm_id',$comm_id);
		$row = $this->db->get()->row();
		$result = $this->db->get_where('t_comment_img', array('comm_id' => $comm_id))->result();
		$row->imgs = $result;
		return $row;
	}

}

