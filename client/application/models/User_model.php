<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get_by_username_pwd($username, $password)
    {
        return $this->db->get_where('t_user', array(
            'username' => $username,
            'password' => $password,
        ))->row();
    }

    public function save_message($username, $password, $number)
    {
        $this->db->insert('t_user', array(
            'username' => $username,
            'password' => $password,
            'tel' => $number
        ));
        return $this->db->affected_rows();
    }

    public function get_by_username($username)
    {
        return $this->db->get_where('t_user', array(
            'username' => $username
        ))->row();
    }

//wangyue
    public function get_message_by_userId($user_id)
    {
//        $sql="select * from t-message where user_id=?";
//        return $this->db->query($sql)->result();
        return $this->db->get_where("t_message", array(
            "receiver" => $user_id
        ))->result();
    }

    public function delete_comment_by_comment_id($commentId)
    {
        $this->db->delete("t_comment", array(
            "comment_id" => $commentId
        ));
        return $this->db->affected_rows();
    }

    public function get_by_page($user_id)
    {
        $this->db->select('t_park.*,t_order.*,t_park_img.*,t_comment.*');
        $this->db->from('t_comment');
        $this->db->join('t_park', 't_park.park_id=t_comment.park_id');
        $this->db->join('t_user', 't_user.user_id=t_comment.user_id');
        $this->db->join('t_order', 't_order.park_id=t_comment.park_id');
        $this->db->join("t_park_img", "t_park_img.park_id=t_comment.park_id");
        $this->db->where('t_park_img.is_main', 1);
        $this->db->where('t_order.user_id', $user_id);
        $this->db->where('t_comment.user_id', $user_id);
        return $this->db->get()->result();
    }

    public function get_all_count($user_id)
    {
        $this->db->select('t_park.*,t_order.*,t_park_img.*,t_comment.*');
        $this->db->from('t_comment');
        $this->db->join('t_park', 't_park.park_id=t_comment.park_id');
        $this->db->join('t_user', 't_user.user_id=t_comment.user_id');
        $this->db->join('t_order', 't_order.park_id=t_comment.park_id');
        $this->db->join("t_park_img", "t_park_img.park_id=t_comment.park_id");
//        $this->db->where('t_park_img.is_main','1');
        $this->db->where('t_order.user_id', $user_id);
        $this->db->where('t_comment.user_id', $user_id);
        return $this->db->count_all_results();
    }

//用户留言给管理员
    public function leave_word($sender, $content)
    {
        $this->db->insert('t_message', array(
            "content" => $content,
            "sender" => $sender,
            "receiver" => '-1'
        ));
        return $this->db->affected_rows();
    }

    public function update_user_details($userId, $email, $tel, $rel_name, $id, $sex, $img)
    {
        $this->db->where('user_id', $userId);
        $this->db->update('t_user', array(
            "email" => $email,
            "tel" => $tel,
            "rel_name" => $rel_name,
            "sex" => $sex,
            "id_card" => $id,
            "portrait" => $img
        ));
        return $this->db->affected_rows();
    }

    public function get_by_id($user_id)
    {
        return $this->db->get_where('t_user', array(
            'user_id' => $user_id
        ))->row();
    }

    public function query_done_order($uid)
    {
        $result = $this->db->get_where("t_order", array("user_id" => $uid, "status" => '已完成'))->result();
        return $result;
    }

    public function query_undone_order($uid)
    {
        $result = $this->db->query("select * from t_order WHERE user_id in($uid) and status!='已完成'")->result();
        return $result;
    }

    public function query_park_info($hid)
    {
        $row = $this->db->get_where("t_park", array("park_id" => $hid))->row();
        $row->imgs = $this->db->get_where("t_park_img", array("park_id" => $hid))->result();
        return $row;
    }

    public function delete_order($oid)
    {
        return $this->db->delete("t_order", array("order_id" => $oid));
    }

    public function query_park_collection($uid)
    {
        $this->db->select('t_collect.*,t_park.*,t_park_img.img_thumb_src');
        $this->db->from('t_collect');
        $this->db->join('t_park', 't_park.park_id=t_collect.park_id');
        $this->db->join('t_park_img', 't_park.park_id=t_park_img.park_id');
        $this->db->where('t_collect.user_id', $uid);
        $this->db->where('t_park_img.is_main', 1);
        return $this->db->get()->result();
    }

    public function delete_collection($cid)
    {
        return $this->db->delete("t_collect", array("collect_id" => $cid));
    }

    //通过qq_id查询qq登录用户
    public function get_user_by_qq($qq_id)
    {
        $row = $this->db->get_where("t_user", array("qq_id" => $qq_id))->row();
        return $row;
    }

    public function get_user_by_wechat($wechat_id)
    {
        $row = $this->db->get_where("t_user", array("wechat_id" => $wechat_id))->row();
        return $row;
    }

    public function add_user_qq($username, $qq_id)
    {
        $this->db->insert('t_user', array(
            "username" => $username,
            "qq_id" => $qq_id
        ));
        return $this->db->insert_id();
    }

    public function add_user_wechat($username, $wechat_id)
    {
        $this->db->insert('t_user', array(
            "username" => $username,
            "wechat_id" => $wechat_id
        ));
        return $this->db->insert_id();
    }

    public function is_comment($user_id, $order_id)
    {
        return $this->db->get_where('t_comment', array(
            'user_id' => $user_id,
            'order_id' => $order_id
        ))->row();
    }

    public function get_user_by_phone($phone)
    {
        $row = $this->db->get_where("t_user", array("tel" => $phone))->row();
        return $row;
    }

    public function add_user_phone($username, $phone)
    {
        $this->db->insert('t_user', array(
            "username" => $username,
            "tel" => $phone
        ));
        return $this->db->insert_id();
    }

    public function update_password($user_id, $password)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('t_user', array(
            "password" => $password,
        ));
        return $this->db->affected_rows();
    }

    public function update_user_info($useremail, $relname, $sex, $idcard, $user_id,$head_img)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('t_user', array(
            "email" => $useremail,
            "rel_name" => $relname,
            "sex" => $sex,
            "id_card" => $idcard,
            'portrait'=>$head_img
        ));
        return $this->db->affected_rows();
    }
}