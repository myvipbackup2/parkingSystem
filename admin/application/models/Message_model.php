<?php
class Message_model extends CI_Model
{

//把未读变已读
    public function read_message($message_id)
    {
        $this->db->where("message_id",$message_id);
        $this->db->update("t_message",array("is_read"=>1));
        return $this->db->affected_rows();
    }

//
    public function get_total_count()
    {
        $this->db->select('*');
        $this->db->from('t_message,t_user');
        $this->db->where('receiver', -1);
        return $this->db->count_all_results();
    }
    public function get_filterd_count($search)
    {
        $sql = "select t_message.*, t_user.username from t_message ,t_user where t_message.sender=t_user.user_id and t_message.receiver=-1 and t_message.is_delete=0 ";
        if (strlen($search) > 0) {
            $sql .= " and (t_user.username LIKE '%" . $search . "%' or t_message.content LIKE '%" . $search . "%' or t_message.add_time LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }
    public function get_paginated_message($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "select t_message.*, t_user.username from t_message ,t_user where t_message.sender=t_user.user_id and t_message.receiver=-1 and t_message.is_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (t_user.username LIKE '%" . $search . "%' or t_message.content LIKE '%" . $search . "%' or t_message.add_time LIKE '%" . $search . "%')";

        }
        $sql .= " order by $order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function delete_message($message_id)
    {
        $this->db->where('message_id', $message_id);
        $this->db->update('t_message', array('is_delete' => 1));
        return $this->db->affected_rows();
    }
    //批量删除
    public function delete_more_message($id)
    {
        return $this->db->query("delete from t_message where message_id in ($id)");
    }
    //留言详细信息
    public function get_message_detail($messageId)
    {
        $sql = "select message.*, usr.username, reply.content as reply_content
                from t_message message left join t_user usr on message.sender=usr.user_id
                left join t_message reply
                 on reply.reply_id=message.message_id
                where message.receiver=-1 and message.message_id=?";
        return $this->db->query($sql,array($messageId))->row();

    }
    //管理员回复留言
    public function answer_message($id,$content,$receiver,$reply_id)
    {
        $this->db->where("sender",$id);
        $this->db->insert("t_message",array("content"=>$content,"sender"=>$id,"receiver"=>$receiver,"reply_id"=>$reply_id));
        return $this->db->affected_rows();
    }
    public function save_message($sender, $receiver, $content){
        $this -> db -> insert('t_message',array(
            "sender" => $sender,
            "receiver" => $receiver,
            "content" => $content
        ));
        return $this -> db -> affected_rows();
    }


}