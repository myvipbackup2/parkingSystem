<?php

/**
 * Created by PhpStorm.
 * User: xiaotingzhang
 * Date: 2017/2/10
 * Time: 16:11
 */
class Admin_model extends CI_Model
{

    public function query1($img, $adminId)
    {
        return $this->db->get_where('t_admin', array(
            "admin_id" => $adminId,
            "img_src" => $img,
        ))->row();
    }

    public function query_admin_manager()
    {
        return $this->db->get('t_admin')->result();
    }



    public function query($Pwd, $adminId)
    {
        return $this->db->get_where('t_admin', array(
            "admin_id" => $adminId,
            "password" => $Pwd,
        ))->row();
    }

    //更新密码，头像;
    public function update($adminId, $newPwd, $img)
    {
        $this->db->where('admin_id', $adminId);
        $this->db->update('t_admin', array(
            "password" => $newPwd,
            "img_src" => $img
        ));
        return $this->db->affected_rows();
    }

    //更新密码，头像不变
    public function update1($adminId, $newPwd)
    {
        $this->db->where('admin_id', $adminId);
        $this->db->update('t_admin', array(
            "password" => $newPwd,
        ));
        return $this->db->affected_rows();
    }

    //更换头像不换密码
    public function updateimg($img, $adminId)
    {
        $this->db->where('admin_id', $adminId);
        $this->db->update('t_admin', array(
            "img_src" => $img
        ));
        return $this->db->affected_rows();
    }

    //登录
    public function get_name_pwd($adminName, $password)
    {
        return $this->db->get_where("t_admin", array(
            "username" => $adminName,
            "password" => $password
        ))->row();
    }

    //header查看未读message
    public function is_read($adminId)
    {
        $sql = "select t_message.*, t_user.user_id from t_message ,t_user
                where t_message.receiver=t_user.user_id
                and t_message.is_read=0
                and t_message.receiver=?";
        return $this->db->query($sql, array($adminId))->result();

    }

    //获取所有管理员信息
    public function get_total_count()
    {
        $this->db->select('*');
        $this->db->from('t_admin');
        return $this->db->count_all_results();
    }

    public function get_filterd_count($search)
    {
        $sql = "SELECT * FROM t_admin";
        if (strlen($search) > 0) {
            $sql .= " WHERE (username LIKE '%" . $search . "%' OR level LIKE '%" . $search . "%' OR tel LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_houses($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_admin";
        if (strlen($search) > 0) {
            $sql .= " WHERE (username LIKE '%" . $search . "%' OR level LIKE '%" . $search . "%' OR tel LIKE '%" . $search . "%')";
        }
        //$sql .= " order by $order_col $order_col_dir";
        //$sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    //管理员详细信息
    public function get_admin_by_id($admin_id)
    {
        $row = $this->db->get_where('t_admin', array('admin_id' => $admin_id))->row();
        return $row;
    }

    //修改信息
    public function change_admin($id, $lev, $pwd)
    {
        $this->db->where("admin_id", $id);
        $this->db->update("t_admin", array(
            "level" => $lev,
            "password" => $pwd
        ));
        return $this->db->affected_rows();
    }

    //删除单个管理员
    public function delete_admin($admin_id)
    {
        $this->db->delete('t_admin', array('admin_id' => $admin_id));
        return $this->db->affected_rows();
    }

    //批量删除
    public function delete_more_admin($id)
    {
        return $this->db->query("delete from t_admin where admin_id in ($id)");
    }

    //添加管理员
    public function add_admin($name, $pwd, $level, $img)
    {
        $this->db->insert('t_admin', array(
            "username" => $name,
            "password" => $pwd,
            "level" => $level,
            "img_src" => $img
        ));
        return $this->db->affected_rows();
    }

    //查重
    public function check_admin_name($name)
    {
        return $this->db->get_where("t_admin", array(
            "username" => $name
        ))->row();
    }


    public function get_log_total_count()
    {
        $this->db->select('*');
        $this->db->from('t_admin admin');
        $this->db->join('t_log log', 'admin.admin_id=log.admin_id');
        return $this->db->count_all_results();
    }

    public function get_log_filterd_count($search)
    {
        $sql = "SELECT * FROM t_log log, t_admin admin WHERE log.admin_id=admin.admin_id";
        if (strlen($search) > 0) {
            $sql .= " and (admin.real_name LIKE '%" . $search . "%' OR log.log_content LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_logs($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_log log, t_admin admin WHERE log.admin_id=admin.admin_id";
        if (strlen($search) > 0) {
            $sql .= " and (admin.real_name LIKE '%" . $search . "%' OR log.log_content LIKE '%" . $search . "%')";
        }
        $sql .= " order by $order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }
}