<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Facility_model extends CI_Model{

		public function delete_facility($facility_id){
			//var_dump(123);
			$this->db->delete('t_facility',array('type_id' => $facility_id));
			$rs=$this->db->delete('t_facility_type', array('type_id' => $facility_id));
			//var_dump($rs);
			return $this->db->affected_rows();
		}

		public function get_total_count(){
			$this->db->select('*');
	        $this->db->from('t_facility_type');
	        //$this->db->where('is_delete', 0);
	        return $this->db->count_all_results();
		}

		public function get_facility(){
			$this->db->select('*');
			$this->db->from('t_facility_type');
			return $this->db->get()->result();
		}

		public function save_house_facility($facilityArr){
			$this -> db -> insert_batch('t_facility',$facilityArr);
			return $this -> db -> affected_rows();
		}

		public function get_filterd_count($search){
			$sql = "SELECT * FROM t_facility_type WHERE 1";
	        if (strlen($search) > 0) {
	//            $sql .= " and (title||street||price) LIKE '%" . $search . "%'";
	            $sql .= " and (name LIKE '%" . $search . "%')";
	        }
	        return $this->db->query($sql)->num_rows();
		}

		public function get_paginated_facility($limit, $offset, $search, $order_col, $order_col_dir){
			$sql = "SELECT * FROM t_facility_type WHERE 1";
	        if (strlen($search) > 0) {
	//            $sql .= " and (title||street||price) LIKE '%" . $search . "%'";
	            $sql .= " and (name LIKE '%" . $search . "%')";
	        }
	        $sql .= " order by $order_col $order_col_dir";
	        $sql .= " limit $offset, $limit";
	        return $this->db->query($sql)->result();
		}


		public function get_facility_data(){
			$query=$this->db->get('t_facility_type');
			return $query->result();
		}

		public function insert_fac_name($facility_name,$fac_url_name,$fac_free,$fac_price,$facility_remark){
			$arr=array(
					'name'=>$facility_name,
					'icon'=>$fac_url_name,
					'is_free'=>$fac_free,
					'price'=>$fac_price,
					'remark'=>$facility_remark
				);
			$query=$this->db->insert('t_facility_type',$arr);
			return $query;
		}

		public function insert_fac_from_house($facility_name,$fac_url_name,$facility_free,$facility_price,$facility_remark){
			$arr=array(
				'name'=>$facility_name,
				'icon'=>$fac_url_name,
				'is_free'=>$facility_free,
				'price'=>$facility_price,
				'remark'=>$facility_remark
			);
			$this->db->insert('t_facility_type',$arr);
			return $this -> db -> insert_id();
		}

		public function get_facility_by_houseid($house_id){
			$this -> db -> select('t_facility_type.*');
			$this -> db -> from('t_facility');
			$this -> db -> join('t_facility_type','t_facility_type.type_id = t_facility.type_id');
			$this -> db -> where('t_facility.house_id',$house_id);
			return $this->db->get()->result();
		}


		public function del_facility_id($delid){
			//echo 123;
			//die();
			$facility_type_res=$this->db->delete('t_facility', array('type_id' => $delid));
			if($facility_type_res){
				$result=$this->db->delete('t_facility_type',array('type_id' => $delid));
				if($result){
					return $result;
				}
			}
		}

		public function get_search_count($searchname){
			if($searchname){
				$this->db->select('*');
				$this->db->from('t_facility_type');
				$this->db->like('t_facility_type.name',$searchname);
				//$number=$this->db->count_all_results();
				return $number=$this->db->count_all_results();
			}else{
				$this->db->select('*');
        		$this->db->from('t_facility_type');

        		return $number=$this->db->count_all_results();
			}
		}

		public function get_all_count(){
			$this->db->select('*');
        	$this->db->from('t_facility_type');
        	return $number=$this->db->count_all_results();
		}

		public function get_all($searchname,$limit=7,$offset=0){
			if($searchname){
				$this->db->select("t_facility_type.*");
	        	$this->db->from("t_facility_type");
	        	$this->db->where("t_facility_type.name",$searchname);
		        $this->db->limit($limit,$offset);
		        $query=$this->db->get();
		        return $query->result();
			}else{
				$this->db->select("t_facility_type.*");
	        	$this->db->from("t_facility_type");
		        $this->db->limit($limit,$offset);
		        $query=$this->db->get();
		        return $query->result();
			}
			
		}

		public function del_all_name($namearr){
			//var_dump($namearr);
			$arrkeys=array_keys($namearr);
			//var_dump($arrkeys);
			for($i=0;$i<count($arrkeys);$i++){
				$key=$arrkeys[$i];
				$this->db->delete('t_facility', array('type_id' => $namearr[$key]));
				$result=$this->db->delete('t_facility_type', array('type_id' => $namearr[$key]));
				//$result=$this->db->delete('t_facility_type', array('facility_type_id' => $namearr[$i]));
				//$result=$this->db->query(" delete from t_facility_type where facility_type_id= '$namearr[$i]'");
			}

			return $result;
		}

		public function update_house_for_facility($houseId,$facilityArr){
			$this->db->delete('t_facility', array('house_id' => $houseId));
			$this -> db -> insert_batch('t_facility',$facilityArr);
			return $this -> db -> affected_rows();
		}
	}

?>