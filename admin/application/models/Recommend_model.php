<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recommend_model extends CI_Model{
    public function insert_rec_from_park($id,$reason)
    {
        $time = date('y-m-d h:i:s');
        $arr=array(
            'park_id'=>$id,
            'rec_reason'=>$reason,
            'rec_time'=>$time,
            'rec_status'=>'未结束'
        );
        $this->db->insert('t_recommend',$arr);
        return $this -> db -> insert_id();
    }
    public function del_rec_from_park($id)
    {
//            $this->db->where('park_id',$id);
//            $data = array('rec_status'=>'已结束');
//            $this->db->update('t_recommend', $data);

        $sql="UPDATE t_recommend SET rec_status = '已结束' WHERE park_id = $id";
        return $this->db->query($sql)->result();
    }
    public function insert_some_rec_from_park($rec_some,$rec_reason){
        $time = date('y-m-d h:i:s');
        $data=array(
            'park_id'=>$rec_some,
            'rec_reason'=>$rec_reason,
            'rec_time'=>$time,
            'rec_status'=>'未结束'
        );
        $this->db->insert('t_recommend',$data);
        return $this -> db -> insert_id();
    }
}