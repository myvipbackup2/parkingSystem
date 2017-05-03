<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Park_model extends CI_Model
{
    // 所有停车位查询
    public function get_all_park($region,$content,$min_price,$max_price,$plot_id,$redroom,$is_sale)
    {
        $sql = "select park.park_id,park.title, park.price, park.street, img.img_thumb_src 
                from t_park park left join (select * from t_park_img img where img.is_main=1) img
                on park.park_id=img.park_id where park.is_delete=0 ";
        if($region != '区域' && $region != '不限'){
            $sql .= " and park.region = '$region' ";
        }

        if($content != ''){
            $sql .= " and (park.title like '%$content%' or park.description like '%$content%' or park.street like '%$content%' or park.region like '%$content%') ";
        }

        if($min_price != null){
            $sql .= "and park.price >= $min_price ";
        }

        if($max_price != null){
            $sql .= "and park.price <= $max_price ";
        }

        if($plot_id !=null){
            $sql .= "and park.plot_id = $plot_id";
        }
        if($redroom != null){
            if($redroom == 4){
                $sql .= "and park.bedroom >= $redroom ";
            }else{
                $sql .= "and park.bedroom = $redroom ";
            }
        }
        if($is_sale == '可售'){
            $sql.= " and park.is_sale = 1";
        }
        if($is_sale == '不可售'){
            $sql.= " and park.is_sale = 0";
        }

        return $this->db->query($sql)->result();

    }


    public function count_all_recommend_park()
    {
        $res =  $this->db->get_where('t_recommend',array('rec_status'=>'未结束'))->result();
        return count($res);
    }

    // //微信开发-首页-热门停车位
    public function get_recommend_park()
    {
        $sql = "select park.park_id,park.title, park.price, park.street,park.description,park.region, img.img_thumb_src 
                from t_park park, t_recommend rec,
                (select * from t_park_img img where img.is_main=1) img
                where park.park_id=rec.park_id and park.is_delete = 0 and park.park_id=img.park_id and rec.rec_status='未结束'";
        return $this->db->query($sql)->result();

    }


    public function count_index_search($content)
    {
        $sql = "select park.park_id,park.title, park.price, park.street, img.img_thumb_src 
                from t_park park left join (select * from t_park_img img where img.is_main=1) img
                on park.park_id=img.park_id where park.is_delete=0 and (park.title like '%$content%' or park.description like '%$content%' or park.street like '%$content%' or park.region like '%$content%')";
        return $this->db->query($sql)->result();
    }

    public function get_index_search($content)
    {
        $sql = "select park.park_id,park.title, park.price, park.street, img.img_thumb_src,park.description,park.region
                from t_park park left join (select * from t_park_img img where img.is_main=1) img
                on park.park_id=img.park_id where park.is_delete=0 and (park.title like '%$content%' or park.description like '%$content%' or park.street like '%$content%' or park.region like '%$content%')";
        return $this->db->query($sql)->result();
    }
    

    // 轮播图片部分
    // 大图片
    public function get_by_parkBigImg($park_id)
    {
        $this->db->select("t_park_img.img_src");
        $this->db->from("t_park,t_park_img");
        $this->db->where("t_park_img.park_id = t_park.park_id ");
//			$this -> db -> where("t_park_img.is_main= 1");
        $this->db->where("t_park.park_id", $park_id);
        $query = $this->db->get();
        return $query->result();
    }

    // 小图片
    public function get_imgs_by_park_id($park_id)
    {
        $this->db->select("img.*");
        $this->db->from("t_park park,t_park_img img");
        $this->db->where("img.park_id=park.park_id");
        $this->db->where("park.park_id", $park_id);
        return $query = $this->db->get()->result();
    }

    // 车位信息部分
    public function get_park_by_id($park_id)
    {
        $this->db->select("park.*,dev.developer_id,dev.developer_name,dev.logo,plot.plot_name,plot.plot_pos,comment.content");
        $this->db->from("t_park park");
        $this->db->join('t_developer dev', 'park.developer_id=dev.developer_id', 'left');
        $this->db->join('t_plot plot', 'park.plot_id=plot.plot_id', 'left');
        $this->db->join('t_comment comment', 'comment.park_id=park.park_id', 'left');
        $this->db->where("park.park_id", $park_id);
        $this->db->where("park.is_delete", 0);
        return $query = $this->db->get()->row();
    }

    // 车位信息部分
    public function get_park_by_plotid($plot_id)
    {
        $this->db->select("park.*");
        $this->db->from("t_park park");
        $this->db->where("park.plot_id", $plot_id);
        $this->db->where("park.is_delete", 0);
        return $query = $this->db->get()->result();
    }

    // 小区信息
    public function get_plot()
    {
        return $this->db->get('t_plot')->result();
    }

    // 设备信息  免费
    public function get_free_facilities_by_park_id($park_id)
    {
        $this->db->select("t_facility_type.name,t_facility_type.icon");
        $this->db->from("t_park,t_facility_type,t_facility");
        $this->db->where("t_facility.park_id = t_park.park_id");
        $this->db->where("t_facility.type_id = t_facility_type.type_id");
        $this->db->where("t_facility_type.is_free=0");
        $this->db->where("t_park.park_id", $park_id);
        return $query = $this->db->get()->result();
    }

    // 设备信息  付费
    public function get_pay_facilities_by_park_id($park_id)
    {
        $this->db->select("t_facility_type.name,t_facility_type.icon");
        $this->db->from("t_park,t_facility_type,t_facility");
        $this->db->where("t_facility.park_id = t_park.park_id");
        $this->db->where("t_facility.type_id = t_facility_type.type_id");
        $this->db->where("t_facility_type.is_free=1");
        $this->db->where("t_park.park_id", $park_id);
        return $query = $this->db->get()->result();
    }

    // 车位评论
    public function get_comments_by_park_id($park_id)
    {
        $this->db->select("t_comment.*,t_user.*");
        $this->db->from("t_park");
        $this->db->join('t_comment', 't_comment.park_id = t_park.park_id');
        $this->db->join('t_user', 't_comment.user_id = t_user.user_id');
        $this->db->where("t_park.park_id", $park_id);
        return $query = $this->db->get()->result();
    }

    //车位套餐
    public function get_combos_by_park_id($park_id)
    {
        $this->db->select('t_combo.*,t_combo_type.type_name');
        $this->db->from('t_combo');
        $this->db->join('t_combo_type', 't_combo_type.type_id = t_combo.combo_type_id');
        $this->db->where('t_combo.park_id', $park_id);
        return $this->db->get()->result();

    }

    //根据评论ID查找所有评论
    public function get_comment_by_ids($ids)
    {
        $this->db->select('t_comment_img.*');
        $this->db->from('t_comment_img');
        $this->db->where_in('comm_id', $ids);
        return $this->db->get()->result();

    }

    public function get_park_img($ids)
    {
        $this->db->select('t_park_img.*');
        $this->db->from('t_park_img');
        $this->db->where_in('park_id', $ids);
        return $this->db->get()->result();

    }

    public function add_collect($userId, $parkId)
    {
        $this->db->insert("t_collect", array(
            "user_id" => $userId,
            "park_id" => $parkId
        ));
        return $this->db->affected_rows();
    }

    public function remove_collect($userId, $parkId)
    {
        $this->db->delete('t_collect', array(
            "user_id" => $userId,
            "park_id" => $parkId
        ));
        return $this->db->affected_rows();
    }

    public function get_developer($id)
    {
        return $this->db->get_where('t_developer', array("developer_id" => $id))->row();
    }


    public function is_free_park($parkId, $startTime, $endTime)
    {
        $sql = "select * from t_order where park_id = " . $parkId . " and ((unix_timestamp('" . $startTime . "')>=unix_timestamp(start_time) and unix_timestamp('" . $startTime . "') <= unix_timestamp(end_time) and (status = '已支付' or status = '入住中' or status = '未支付')) or (unix_timestamp('" . $endTime . "') >= unix_timestamp(start_time) and unix_timestamp('" . $endTime . "') <= unix_timestamp(end_time) and (status = '已支付' or status = '入住中' or status = '未支付')) or (unix_timestamp('" . $startTime . "') <= unix_timestamp(start_time) and unix_timestamp('" . $endTime . "') >= unix_timestamp(end_time) and (status = '已支付' or status = '入住中' or status = '未支付')))";

        return $this->db->query($sql)->result();
    }

    /*public function get_recommend_parks($limit)
    {
        $this->db->select('t_recommend.*,t_park.*');
        $this->db->from('t_recommend');
        $this->db->join('t_park', 't_park.park_id=t_recommend.park_id');
        $this->db->where('rec_status', '未结束');
        $this->db->order_by('rec_id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }*/

    public function get_recommend_detail_img($id)
    {
        $this->db->select('*');
        $this->db->from('t_park_img');
        $this->db->where('park_id', $id);
        $this->db->order_by('is_main', 'DESC');
        return $this->db->get()->row();
    }

    //车位入住日期,退房日期
    public function get_by_park_time($park_id)
    {
        $data = date("Y-m-d");
        $sql = "select * from t_order where park_id='$park_id'and unix_timestamp(end_time)>unix_timestamp('$data') and (status ='已支付' or status ='进行中')";
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function count_comments($park_id)
    {
        $this->db->select('comm.*, usr.username, usr.portrait');
        $this->db->from('t_comment comm');
        $this->db->join('t_user usr', 'usr.user_id=comm.user_id');
        $this->db->where('comm.park_id', $park_id);
        return $this->db->count_all_results();
    }

    public function get_comments($park_id)
    {
        $this->db->select('comm.*, usr.username, usr.portrait');
        $this->db->from('t_comment comm');
        $this->db->join('t_user usr', 'usr.user_id=comm.user_id');
        $this->db->where('comm.park_id', $park_id);

        $comments = $this->db->get()->result();

        foreach ($comments as $comment) {
            $comment_imgs = $this->db->get_where('t_comment_img', array('comm_id' => $comment->comm_id))->result();
            $comment->comment_imgs = $comment_imgs;
        }

        return $comments;
    }

    public function get_comments_parkId($park_id)
    {
        $this->db->select('comm.*, usr.username, usr.portrait,or.start_time,or.end_time');
        $this->db->from('t_comment comm');
        $this->db->join('t_user usr', 'usr.user_id=comm.user_id');
        $this->db->join('t_order or', 'or.order_id=comm.order_id');
        $this->db->where('comm.park_id', $park_id);

        $comments = $this->db->get()->result();

        foreach ($comments as $comment) {
            $comment_imgs = $this->db->get_where('t_comment_img', array('comm_id' => $comment->comm_id))->result();
            $comment->comment_imgs = $comment_imgs;
        }

        return $comments;
    }

    public function get_comments_score($park_id)
    {
        $sql = "select avg(score) total_score,avg(clean_score) clean_score,avg(traffic_score) traffic_score,avg(manage_score) manage_score,avg(facility_score) facility_score from t_comment group by park_id having park_id = $park_id";
        $row = $this->db->query($sql)->row();

        return $row;
    }

    public function get_combo_by_id($combo_id){
        $this->db->select('park.*, combo.title com_title, combo.price com_price');
        $this->db->from('t_park park');
        $this->db->join('t_combo combo', 'combo.park_id=park.park_id');
        $this->db->where('combo.combo_id', $combo_id);
        return $this->db->get()->row();
    }
    public function is_collect($user_id,$park_id){
        return $this->db->get_where('t_collect', array("user_id" => $user_id,'park_id'=>$park_id))->row();
    }


}