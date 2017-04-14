<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class House_model extends CI_Model
{
    // 所有房源
    public function get_all_house($region,$content,$min_price,$max_price,$plot_id,$redroom,$is_sale)
    {
        $sql = "select house.house_id,house.title, house.price, house.street, img.img_thumb_src 
                from t_house house left join (select * from t_house_img img where img.is_main=1) img
                on house.house_id=img.house_id where house.is_delete=0 ";
        if($region != '区域' && $region != '不限'){
            $sql .= " and house.region = '$region' ";
        }

        if($content != ''){
            $sql .= " and (house.title like '%$content%' or house.description like '%$content%' or house.street like '%$content%' or house.region like '%$content%') ";
        }

        if($min_price != null){
            $sql .= "and house.price >= $min_price ";
        }

        if($max_price != null){
            $sql .= "and house.price <= $max_price ";
        }

        if($plot_id !=null){
            $sql .= "and house.plot_id = $plot_id";
        }
        if($redroom != null){
            if($redroom == 4){
                $sql .= "and house.bedroom >= $redroom ";
            }else{
                $sql .= "and house.bedroom = $redroom ";
            }
        }
        if($is_sale == '可售'){
            $sql.= " and house.is_sale = 1";
        }
        if($is_sale == '不可售'){
            $sql.= " and house.is_sale = 0";
        }

        return $this->db->query($sql)->result();

    }


    public function count_all_recommend_house()
    {
        $res =  $this->db->get_where('t_recommend',array('rec_status'=>'未结束'))->result();
        return count($res);
    }

    // //微信开发-首页-热门房源
    public function get_recommend_house()
    {
        $sql = "select house.house_id,house.title, house.price, house.street,house.description,house.region, img.img_thumb_src 
                from t_house house, t_recommend rec,
                (select * from t_house_img img where img.is_main=1) img
                where house.house_id=rec.house_id and house.is_delete = 0 and house.house_id=img.house_id and rec.rec_status='未结束'";
        return $this->db->query($sql)->result();

    }

//    //根据条件查询房源
//    public function count_search_house($region,$start_time,$end_time,$content,$min_price,$max_price,$plot,$house_style,$is_sale)
//    {
//        $sql = "select house.house_id,house.title, house.price, house.street, img.img_thumb_src
//                from t_house house,
//                (select * from t_house_img img where img.is_main=1) img
//                where img.house_id = house.house_id and house.is_delete = 0 ";
//        if($region != '区域'){
//            $sql .= " and house.region = '$region' ";
//        }
//        if($start_time!= null && $end_time != null){
//            $sql .= " and house.house_id not in (select o.house_id from t_order o where (unix_timestamp('" . $start_time . "')>=unix_timestamp(o.start_time) and unix_timestamp('" . $start_time . "') <= unix_timestamp(o.end_time) and (o.status = '已支付' or o.status='进行中')) or (unix_timestamp('" . $end_time . "') >= unix_timestamp(o.start_time) and unix_timestamp('" . $end_time . "') <= unix_timestamp(o.end_time) and (o.status = '已支付' or o.status='进行中')) or (unix_timestamp('" . $start_time . "') < unix_timestamp(o.start_time) and unix_timestamp('" . $end_time . "') > unix_timestamp(o.end_time) and (o.status = '已支付' or o.status='进行中')))";
//        }
//        if($content != null){
//            $sql .= " and (house.title like '%$content%' or house.description like '%$content%' or house.street like '%$content%' or house.region like '%$content%') ";
//        }
//
//        if($min_price != null){
//            $sql .= "and house.price >= $min_price ";
//        }
//
//        if($max_price != null){
//            $sql .= "and house.price <= $max_price ";
//        }
//
//        if(count($plot) > 0){
//            $plot_str = implode(",",$plot);
//            $sql .= "and house.plot_id in (".$plot_str.") ";
//        }
//        if(count($house_style) > 0){
//            $house_str = implode(",",$house_style);
//
//            $sql .= "and house.bedroom in(".$house_str.") ";
//        }
//        if(count($is_sale) > 0){
//            $sale_str = implode(",",$is_sale);
//            $sql.= " and house.is_sale in ($sale_str) ";
//        }
//
//        $result = $this->db->query($sql)->result();
//        return count($result);
//    }
//    //根据条件查询房源
//    public function get_search_house($offset, $limit,$region,$start_time,$end_time,$content,$min_price,$max_price,$plot,$house_style,$is_sale)
//    {
//        $sql = "select house.house_id,house.title, house.price, house.street, img.img_thumb_src
//                from t_house house,
//                (select * from t_house_img img where img.is_main=1) img
//                where img.house_id = house.house_id and house.is_delete = 0 ";
//        if($region != '区域'){
//            $sql .= " and house.region = '$region' ";
//        }
////        if($startTime != null && $endTime != null){
////            $sql .= " and house.region = $region ";
////        }
//        if($content != null){
//            $sql .= "and (house.title like '%$content%' or house.description like '%$content%' or house.street like '%$content%' or house.region like '%$content%') ";
//        }
//
//        if($min_price != null){
//            $sql .= "and house.price >= $min_price ";
//        }
//
//        if($max_price != null){
//            $sql .= "and house.price <= $max_price ";
//        }
//
//        if(count($plot) > 0){
//            $plot_str = implode(",",$plot);
//            $sql .= "and house.plot_id in (".$plot_str.") ";
//        }
//        if(count($house_style) > 0){
//            $house_str = implode(",",$house_style);
//            $sql .= "and house.bedroom in (".$house_str.") ";
//        }
//        if(count($is_sale) > 0){
//            $sale_str = implode(",",$is_sale);
//            $sql.= " and house.is_sale in ($sale_str) ";
//        }
//        $sql.= "limit $offset , $limit";
//        return $this->db->query($sql)->result();
//    }

    public function count_index_search($content)
    {
        $sql = "select house.house_id,house.title, house.price, house.street, img.img_thumb_src 
                from t_house house left join (select * from t_house_img img where img.is_main=1) img
                on house.house_id=img.house_id where house.is_delete=0 and (house.title like '%$content%' or house.description like '%$content%' or house.street like '%$content%' or house.region like '%$content%')";
        return $this->db->query($sql)->result();
    }

    public function get_index_search($content)
    {
        $sql = "select house.house_id,house.title, house.price, house.street, img.img_thumb_src,house.description,house.region
                from t_house house left join (select * from t_house_img img where img.is_main=1) img
                on house.house_id=img.house_id where house.is_delete=0 and (house.title like '%$content%' or house.description like '%$content%' or house.street like '%$content%' or house.region like '%$content%')";
        return $this->db->query($sql)->result();
    }

//    public function count_time_search($city, $region, $begin_time, $end_time, $content)
//    {
//        $sql = "select count(*) as number from t_house where title like '%$content%' and city = '$city' and region = '$region' and house_id not in (select house_id from t_order where start_time<'$begin_time' and end_time>'$end_time')";
//        return $this->db->query($sql)->row();
////        return $sql;
//    }

//    public function get_time_search($city, $region, $begin_time, $end_time, $index, $perpage, $content)
//    {
//        $sql = "select * from t_house where title like '%$content%' and city = '$city' and region = '$region' and house_id not in (select house_id from t_order where start_time<'$begin_time' and end_time>'$end_time') limit $index,$perpage";
//        return $this->db->query($sql)->result();
//    }

    // 轮播图片部分
    // 大图片
    public function get_by_houseBigImg($house_id)
    {
        $this->db->select("t_house_img.img_src");
        $this->db->from("t_house,t_house_img");
        $this->db->where("t_house_img.house_id = t_house.house_id ");
//			$this -> db -> where("t_house_img.is_main= 1");
        $this->db->where("t_house.house_id", $house_id);
        $query = $this->db->get();
        return $query->result();
    }

    // 小图片
    public function get_imgs_by_house_id($house_id)
    {
        $this->db->select("img.*");
        $this->db->from("t_house house,t_house_img img");
        $this->db->where("img.house_id=house.house_id");
        $this->db->where("house.house_id", $house_id);
        return $query = $this->db->get()->result();
    }

    // 房源信息部分
    public function get_house_by_id($house_id)
    {
        $this->db->select("house.*,dev.developer_id,dev.developer_name,dev.logo,plot.plot_name,plot.plot_pos,comment.content");
        $this->db->from("t_house house");
        $this->db->join('t_developer dev', 'house.developer_id=dev.developer_id', 'left');
        $this->db->join('t_plot plot', 'house.plot_id=plot.plot_id', 'left');
        $this->db->join('t_comment comment', 'comment.house_id=house.house_id', 'left');
        $this->db->where("house.house_id", $house_id);
        $this->db->where("house.is_delete", 0);
        return $query = $this->db->get()->row();
    }

    // 小区信息
    public function get_plot()
    {
        return $this->db->get('t_plot')->result();
    }

    // 设备信息  免费
    public function get_free_facilities_by_house_id($house_id)
    {
        $this->db->select("t_facility_type.name,t_facility_type.icon");
        $this->db->from("t_house,t_facility_type,t_facility");
        $this->db->where("t_facility.house_id = t_house.house_id");
        $this->db->where("t_facility.type_id = t_facility_type.type_id");
        $this->db->where("t_facility_type.is_free=0");
        $this->db->where("t_house.house_id", $house_id);
        return $query = $this->db->get()->result();
    }

    // 设备信息  付费
    public function get_pay_facilities_by_house_id($house_id)
    {
        $this->db->select("t_facility_type.name,t_facility_type.icon");
        $this->db->from("t_house,t_facility_type,t_facility");
        $this->db->where("t_facility.house_id = t_house.house_id");
        $this->db->where("t_facility.type_id = t_facility_type.type_id");
        $this->db->where("t_facility_type.is_free=1");
        $this->db->where("t_house.house_id", $house_id);
        return $query = $this->db->get()->result();
    }

    // 房源评论
    public function get_comments_by_house_id($house_id)
    {
        $this->db->select("t_comment.*,t_user.*");
        $this->db->from("t_house");
        $this->db->join('t_comment', 't_comment.house_id = t_house.house_id');
        $this->db->join('t_user', 't_comment.user_id = t_user.user_id');
        $this->db->where("t_house.house_id", $house_id);
        return $query = $this->db->get()->result();
    }

    //房源套餐
    public function get_combos_by_house_id($house_id)
    {
        $this->db->select('t_combo.*,t_combo_type.type_name');
        $this->db->from('t_combo');
        $this->db->join('t_combo_type', 't_combo_type.type_id = t_combo.combo_type_id');
        $this->db->where('t_combo.house_id', $house_id);
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

    public function get_house_img($ids)
    {
        $this->db->select('t_house_img.*');
        $this->db->from('t_house_img');
        $this->db->where_in('house_id', $ids);
        return $this->db->get()->result();

    }

    public function add_collect($userId, $houseId)
    {
        $this->db->insert("t_collect", array(
            "user_id" => $userId,
            "house_id" => $houseId
        ));
        return $this->db->affected_rows();
    }

    public function remove_collect($userId, $houseId)
    {
        $this->db->delete('t_collect', array(
            "user_id" => $userId,
            "house_id" => $houseId
        ));
        return $this->db->affected_rows();
    }

    public function get_developer($id)
    {
        return $this->db->get_where('t_developer', array("developer_id" => $id))->row();
    }


    public function is_free_house($houseId, $startTime, $endTime)
    {
        $sql = "select * from t_order where house_id = " . $houseId . " and ((unix_timestamp('" . $startTime . "')>=unix_timestamp(start_time) and unix_timestamp('" . $startTime . "') <= unix_timestamp(end_time) and (status = '已支付' or status = '入住中' or status = '未支付')) or (unix_timestamp('" . $endTime . "') >= unix_timestamp(start_time) and unix_timestamp('" . $endTime . "') <= unix_timestamp(end_time) and (status = '已支付' or status = '入住中' or status = '未支付')) or (unix_timestamp('" . $startTime . "') <= unix_timestamp(start_time) and unix_timestamp('" . $endTime . "') >= unix_timestamp(end_time) and (status = '已支付' or status = '入住中' or status = '未支付')))";

        return $this->db->query($sql)->result();
    }

    /*public function get_recommend_houses($limit)
    {
        $this->db->select('t_recommend.*,t_house.*');
        $this->db->from('t_recommend');
        $this->db->join('t_house', 't_house.house_id=t_recommend.house_id');
        $this->db->where('rec_status', '未结束');
        $this->db->order_by('rec_id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }*/

    public function get_recommend_detail_img($id)
    {
        $this->db->select('*');
        $this->db->from('t_house_img');
        $this->db->where('house_id', $id);
        $this->db->order_by('is_main', 'DESC');
        return $this->db->get()->row();
    }

    //房源入住日期,退房日期
    public function get_by_house_time($house_id)
    {
        $data = date("Y-m-d");
        $sql = "select * from t_order where house_id='$house_id'and unix_timestamp(end_time)>unix_timestamp('$data') and (status ='已支付' or status ='进行中')";
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function count_comments($house_id)
    {
        $this->db->select('comm.*, usr.username, usr.portrait');
        $this->db->from('t_comment comm');
        $this->db->join('t_user usr', 'usr.user_id=comm.user_id');
        $this->db->where('comm.house_id', $house_id);
        return $this->db->count_all_results();
    }

    public function get_comments($house_id)
    {
        $this->db->select('comm.*, usr.username, usr.portrait');
        $this->db->from('t_comment comm');
        $this->db->join('t_user usr', 'usr.user_id=comm.user_id');
        $this->db->where('comm.house_id', $house_id);

        $comments = $this->db->get()->result();

        foreach ($comments as $comment) {
            $comment_imgs = $this->db->get_where('t_comment_img', array('comm_id' => $comment->comm_id))->result();
            $comment->comment_imgs = $comment_imgs;
        }

        return $comments;
    }

    public function get_comments_houseId($house_id)
    {
        $this->db->select('comm.*, usr.username, usr.portrait,or.start_time,or.end_time');
        $this->db->from('t_comment comm');
        $this->db->join('t_user usr', 'usr.user_id=comm.user_id');
        $this->db->join('t_order or', 'or.order_id=comm.order_id');
        $this->db->where('comm.house_id', $house_id);

        $comments = $this->db->get()->result();

        foreach ($comments as $comment) {
            $comment_imgs = $this->db->get_where('t_comment_img', array('comm_id' => $comment->comm_id))->result();
            $comment->comment_imgs = $comment_imgs;
        }

        return $comments;
    }

    public function get_comments_score($house_id)
    {
        $sql = "select avg(score) total_score,avg(clean_score) clean_score,avg(traffic_score) traffic_score,avg(manage_score) manage_score,avg(facility_score) facility_score from t_comment group by house_id having house_id = $house_id";
        $row = $this->db->query($sql)->row();

        return $row;
    }

    public function get_combo_by_id($combo_id){
        $this->db->select('house.*, combo.title com_title, combo.price com_price');
        $this->db->from('t_house house');
        $this->db->join('t_combo combo', 'combo.house_id=house.house_id');
        $this->db->where('combo.combo_id', $combo_id);
        return $this->db->get()->row();
    }
    public function is_collect($user_id,$house_id){
        return $this->db->get_where('t_collect', array("user_id" => $user_id,'house_id'=>$house_id))->row();
    }


}