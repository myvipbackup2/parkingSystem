<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get_all_count()
    {
        $this->db->select('*');
        $this->db->from('t_user');
        $this->db->where('is_delete', 0);
        $this->db->where(array(
            'is_delete' => 0,
            'user_id !=' => -1
        ));


        return $this->db->count_all_results();
    }

    /**
     * 根据用户id获取用户基本信息，根据后面的$inc_xxx参数来判定是需同时包含关联的其它数据。
     *
     * @param   boolean $inc_orders 是否在用户信息中包含关联的订单信息，默认值FALSE(不包含)
     * @param   boolean $inc_messages 是否在用户信息中包含关联的留言信息，默认值FALSE(不包含)
     * @return  object 用户信息
     */
    public function get_by_id($user_id, $options = array('inc_orders' => FALSE, 'inc_messages' => FALSE))
    {
        $row = $this->db->get_where('t_user', array('user_id' => $user_id))->row();
        if (isset($options['inc_orders']) && $options['inc_orders']) {
            //$row->orders = $this->db->get_where('t_order', array('user_id' => $user_id))->result();
            $this->db->select('order.*, house.title as house_title');
            $this->db->from('t_order order');
            $this->db->join('t_house house', 'order.house_id=house.house_id');
            $this->db->where('order.user_id', $user_id);
            $row->orders = $this->db->get()->result();
        }
        if (isset($options['inc_messages']) && $options['inc_messages']) {
            $this->db->select('message.*, receiver.rel_name');
            $this->db->from('t_message message');
            $this->db->join('t_user sender', 'message.sender=sender.user_id');
            $this->db->join('t_user receiver', 'message.receiver=receiver.user_id');
            $this->db->where('message.sender', $user_id);
            $row->messages = $this->db->get()->result();
        }
        return $row;
    }

    public function get_all()
    {
        $this->db->where('is_delete', 0);
        $this->db->order_by('addtime', 'desc');
        $this->db->limit(6);
        return $this->db->get("t_user")->result();
    }

    public function get_by_page($user_name, $limit = 6, $offset = 0)
    {
        if ($user_name) {
            $this->db->like('t_user.username', $user_name);
        }
        $this->db->order_by('addtime', 'desc');
        $this->db->limit($limit, $offset);
        $this->db->where('is_delete', 0);

        $query = $this->db->get('t_user')->result();
        return $query;
    }

    public function update_by_del($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->update('t_user', array(
            'is_delete' => 1
        ));
    }

    public function update_by_del_all($ids)
    {
        $this->db->where_in('user_id', explode(",", $ids));
        return $this->db->update('t_user', array(
            'is_delete' => 1
        ));
    }

    public function get_by_username($username)
    {
        return $this->db->get_where('t_user', array('username' => $username))->row();

    }

    public function save_user($data)
    {
        if($data["user_id"]){
            $this->db->where('user_id', $data["user_id"]);
            $this->db->update('t_user', $data);
        }else{
            $this -> db -> insert('t_user',$data);
        }
        return $this -> db -> affected_rows();
    }

    public function get_paginated_users($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_user WHERE is_delete=0 and user_id != -1";
        if (strlen($search) > 0) {
            $sql .= " and (username LIKE '%" . $search . "%' or rel_name LIKE '%" . $search . "%' or tel LIKE '%" . $search . "%' or email LIKE '%" . $search . "%')";
        }
        $sql .= " order by $order_col $order_col_dir";
        $sql .= " limit $offset, $limit";

        return $this->db->query($sql)->result();
    }

    public function get_filterd_count($search)
    {
        $sql = "SELECT * FROM t_user WHERE is_delete=0 and user_id != -1";
        if (strlen($search) > 0) {
            $sql .= " and (username LIKE '%" . $search . "%' or rel_name LIKE '%" . $search . "%' or tel LIKE '%" . $search . "%' or email LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_total_user_orders_count($user_id)
    {
        $this->db->select('*');
        $this->db->from('t_order order');
        $this->db->join('t_user user', 'order.house_id=user.user_id');
        $this->db->where('user.user_id', $user_id);
        return $this->db->count_all_results();
    }

    public function get_filterd_user_orders_count($user_id, $search)
    {
        $sql = "SELECT * FROM t_order WHERE is_delete=0 and user_id=$user_id";
        if (strlen($search) > 0) {
            $sql .= " and (price LIKE '%" . $search . "%' or status LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_user_orders($user_id, $limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_order ord, t_user user, t_house house WHERE ord.user_id=user.user_id and ord.is_delete=0 and ord.house_id=house.house_id and ord.user_id=$user_id";
        if (strlen($search) > 0) {
            $sql .= " and (ord.price LIKE '%" . $search . "%' or ord.status LIKE '%" . $search . "%')";
        }
        $sql .= " order by ord.$order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function get_total_user_messages_count($user_id)
    {
        $this->db->select('*');
        $this->db->from('t_message message');
        $this->db->join('t_user user', 'message.sender=user.user_id');
        $this->db->where('user.user_id', $user_id);
        return $this->db->count_all_results();
    }

    public function get_filterd_user_messages_count($user_id, $search)
    {
        $sql = "SELECT * FROM t_message WHERE sender=$user_id";
        if (strlen($search) > 0) {
            $sql .= " and (content LIKE '%" . $search . "%' or add_time LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_user_messages($user_id, $limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_message msg, t_user user WHERE msg.sender=user.user_id and msg.sender=$user_id";
        if (strlen($search) > 0) {
            $sql .= " and (content LIKE '%" . $search . "%' or add_time LIKE '%" . $search . "%')";
        }
        $sql .= " order by user.$order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    //订单管理
    public function add_new_user($name,$pwd,$tel)
    {
        $this -> db -> insert("t_user", array(
            "username" => $name,
            "password" => $pwd,
            "tel" => $tel
        ));
        return $this->db->affected_rows();
    }
    public function add_new_user_get_id($name,$pwd,$tel)
    {
        $this -> db -> insert("t_user", array(
            "username" => $name,
            "password" => $pwd,
            "tel" => $tel
        ));
        return $this->db->insert_id();
    }
    public function user_help($name)
    {
        return $this -> db -> get_where("t_user",array(
            "username" => $name
        )) -> row();
    }
    public function tel_search($tel){
        return $this->db->get_where('t_user',array(
            'tel' =>$tel
        ))->result();
    }



}