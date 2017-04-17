<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developer_model extends CI_Model
{
    public function get_all_count()
    {
        $this->db->select('*');
        $this->db->from('t_developer');
        $this->db->where('is_delete', 0);
        return $this->db->count_all_results();
    }


    public function get_paginated_developers($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_developer WHERE is_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (developer_name LIKE '%" . $search . "%' or address LIKE '%" . $search . "%' or telephone LIKE '%" . $search . "%')";
        }
        $sql .= " order by $order_col $order_col_dir";
        $sql .= " limit $offset, $limit";

        return $this->db->query($sql)->result();
    }

    public function get_filterd_count($search)
    {
        $sql = "SELECT * FROM t_developer WHERE is_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (developer_name LIKE '%" . $search . "%' or address LIKE '%" . $search . "%' or telephone LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function save_developer($data)
    {
        if($data["developer_id"]){
            $this->db->where('developer_id', $data["developer_id"]);
            $this->db->update('t_developer', $data);
        }else{
            $this -> db -> insert('t_developer',$data);
        }
        return $this -> db -> affected_rows();
    }

    public function get_by_developername($developer_name)
    {
        return $this->db->get_where('t_developer', array('developer_name' => $developer_name))->row();
    }

/*    public function get_by_id($developerId)
    {
        $sql = "select  d.*, h.* from t_developer d left join t_park h on h.developer_id = d.developer_id where d.developer_id = ".$developerId;
        return $this->db->query($sql)->result();
    }*/
    public function get_by_id($developerId, $options = array('inc_park' => FALSE))
    {
        $row = $this->db->get_where('t_developer', array('developer_id' => $developerId))->row();
        if (isset($options['inc_park']) && $options['inc_park']) {
            $this->db->select('dvlp.*, park.*');
            $this->db->from('t_developer dvlp');
            $this->db->join('t_park park', 'park.developer_id=dvlp.developer_id');
            $this->db->where('park.developer_id', $developerId);
            $row->orders = $this->db->get()->result();
        }
        return $row;
    }

    public function get_total_developer_park_count($developerId)
    {
        $this->db->select('*');
        $this->db->from('t_park park');
        $this->db->where('park.developer_id', $developerId);
        return $this->db->count_all_results();
    }

    public function get_filterd_developer_park_count($developerId, $search)
    {
        $sql = "SELECT * FROM t_park WHERE developer_id=$developerId";
        if (strlen($search) > 0) {
            $sql .= " and (price LIKE '%" . $search . "%' or title LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_developer_park($developerId, $limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT park.* FROM t_park park, t_developer dvlp WHERE park.developer_id=dvlp.developer_id and dvlp.developer_id=$developerId";
        if (strlen($search) > 0) {
            $sql .= " and (price LIKE '%" . $search . "%' or title LIKE '%" . $search . "%')";
        }
        $sql .= " order by park.$order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function update_by_del_all($ids)
    {
        $this->db->where_in('developer_id', explode(",", $ids));
        return $this->db->update('t_developer', array(
            'is_delete' => 1
        ));
    }

    public function get_by_developer_id($developerId)
    {
        return $this->db->get_where('t_developer', array('developer_id' => $developerId))->row();

    }

    public function get_developer(){
        $query=$this->db->get_where('t_developer',array('is_delete'=>0));
        return $query->result();
    }

}