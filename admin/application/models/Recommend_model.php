<?php
/**
 * Created by PhpStorm.
 * User: 王双丽
 * Date: 2017/2/22
 * Time: 0:08
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Recommend_model extends CI_Model{
    public function insert_rec_from_house($id,$reason)
    {
        $time = date('y-m-d h:i:s');
        $arr=array(
            'house_id'=>$id,
            'rec_reason'=>$reason,
            'rec_time'=>$time,
            'rec_status'=>'未结束'
        );
        $this->db->insert('t_recommend',$arr);
        return $this -> db -> insert_id();
    }
    public function del_rec_from_house($id)
    {
//            $this->db->where('house_id',$id);
//            $data = array('rec_status'=>'已结束');
//            $this->db->update('t_recommend', $data);

        $sql="UPDATE t_recommend SET rec_status = '已结束' WHERE house_id = $id";
        return $this->db->query($sql)->result();
    }
    public function insert_some_rec_from_house($rec_some,$rec_reason){
        $time = date('y-m-d h:i:s');
        $data=array(
            'house_id'=>$rec_some,
            'rec_reason'=>$rec_reason,
            'rec_time'=>$time,
            'rec_status'=>'未结束'
        );
        $this->db->insert('t_recommend',$data);
        return $this -> db -> insert_id();
    }
}