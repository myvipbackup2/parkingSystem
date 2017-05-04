<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Park_model extends CI_Model
{
    public function get_total_count()
    {
        $this->db->select('*');
        $this->db->from('t_park');
        $this->db->where('is_delete', 0);
        return $this->db->count_all_results();
    }

    public function get_filterd_count($search)
    {
        $sql = "SELECT * FROM t_park WHERE is_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_parks($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT park.*, CASE rec.rec_status WHEN '未结束' THEN 1 ELSE 0 END AS is_rec
                FROM t_park park LEFT JOIN (SELECT rec.* FROM t_recommend rec WHERE rec.rec_id in (SELECT MAX(rec_id) rec_id FROM t_recommend GROUP BY park_id)) rec
                ON park.park_id=rec.park_id 
                WHERE park.is_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (park.title LIKE '%" . $search . "%' or park.street LIKE '%" . $search . "%' or park.price LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY park.$order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";
        return $this->db->query($sql)->result();
    }

    /**
     * 根据用户id获取车位基本信息，根据后面的$inc_xxx参数来判定是需同时包含关联的其它数据。
     *
     * @param   boolean $inc_orders 是否在车位信息中包含关联的订单信息，默认值FALSE(不包含)
     * @param   boolean $inc_messages 是否在车位信息中包含关联的评论信息，默认值FALSE(不包含)
     * @return  object 车位信息
     */
    public function get_park_by_id($park_id, $options = array('inc_orders' => FALSE, 'inc_comments' => FALSE))
    {
        $this->db->select('park.*, plot.plot_name,developer.developer_name');
        $this->db->from('t_park park');
        $this->db->join('t_plot plot', 'plot.plot_id=park.plot_id','left');
        $this->db->join('t_developer developer', 'developer.developer_id=park.developer_id','left');
        $this->db->where('park.park_id', $park_id);
        $row = $this->db->get()->row();

        $park_imgs = $this->db->get_where('t_park_img', array('park_id' => $park_id))->result();
        $facilitys = $this->db->get('t_facility_type')->result();
        $plot = $this->db->get('t_plot')->result();
        $developer = $this->db->get('t_developer')->result();
        if($facilitys){
            $row->facilitys_data = $facilitys;
        }
        if($plot){
            $row->plots_data = $plot;
        }
        if($developer){
            $row->developers_data = $developer;
        }
        if($park_imgs){
            $row->imgs = $park_imgs;
        }
        if (isset($options['inc_orders']) && $options['inc_orders']) {
            $this->db->select('park.*, order.*');
            $this->db->from('t_order order');
            $this->db->join('t_park park', 'order.park_id=park.park_id');
            $this->db->where('park.park_id', $park_id);
            $result = $this->db->get()->result();
            if ($result) {
                $row->orders = $result;
            }

        }
        if (isset($options['inc_comments']) && $options['inc_comments']) {
            $this->db->select('comment.*, user.rel_name');
            $this->db->from('t_comment comment');
            $this->db->join('t_user user', 'comment.user_id=user.user_id');
            $this->db->where('comment.park_id', $park_id);
            $result = $this->db->get()->result();
            if ($result) {
                $row->comments = $result;
            }
        }
        return $row;
    }

    public function get_total_park_orders_count($park_id)
    {
        $this->db->select('*');
        $this->db->from('t_order order');
        $this->db->join('t_park park', 'order.park_id=park.park_id');
        $this->db->where('park.park_id', $park_id);
        return $this->db->count_all_results();
    }

    public function get_filterd_park_orders_count($park_id, $search)
    {
        $sql = "SELECT * FROM t_order WHERE is_delete=0 and park_id=$park_id";
        if (strlen($search) > 0) {
            $sql .= " and (price LIKE '%" . $search . "%' or order_status LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_park_orders($park_id, $limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_order ord, t_park park WHERE ord.park_id=park.park_id and ord.is_delete=0 and ord.park_id=$park_id";
        if (strlen($search) > 0) {
            $sql .= " and (ord.price LIKE '%" . $search . "%' or ord.order_status LIKE '%" . $search . "%')";
        }
        $sql .= " order by ord.$order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function get_comments_by_park_id($park_id)
    {
        /*$this->db->select('comment.*, user.rel_name');
        $this->db->from('t_comment comment');
        $this->db->join('t_user user', 'comment.user_id=user.user_id');
        $this->db->where('comment.park_id', $park_id);
        return $this->db->get()->result();*/
    }

    public function save_park($data){
        $this -> db -> insert('t_park',$data);
        return $this -> db -> insert_id();
    }

    public function edit_park($park_id,$data){

        $this->db->where('park_id', $park_id);
        $this->db->update('t_park', $data);
        return $this -> db -> affected_rows();

    }

    public function save_park_img($data){
        //        foreach ($datas as $data){
//            $this -> db -> insert('t_park_img',$data);
//        }
        $this -> db -> insert_batch('t_park_img',$data);
        return $this -> db -> affected_rows();
    }

    public function del_park_img($ids){
        $this->db->where_in('img_id',$ids);
        $this->db->delete('t_park_img');
    }

    public function delete_park($park_id)
    {
//        $this->db->delete('t_park', array('park_id' => $park_id));
        $this->db->where('park_id', $park_id);
        $this->db->update('t_park', array('is_delete' => 1));
        return $this->db->affected_rows();
    }

//订单管理 车位选择
    public function order_search_park($street)
    {
        return $this->db->query("select * from t_park where street like '%$street%' or region like '%$street%'")->result();
    }
//    //获取所有小区
    public function get_plot_by_park()
    {
        return $this->db->get_where('t_plot',array('plot_delete'=>0))->result();
    }
    public function get_paginated_plot_parks($limit, $offset, $search, $order_col, $order_col_dir,$plot_id)
    {
        $sql = "SELECT park.*, CASE rec.rec_status WHEN '未结束' THEN 1 ELSE 0 END AS is_rec
                FROM t_park park LEFT JOIN (SELECT rec.* FROM t_recommend rec WHERE rec.rec_id in (SELECT MAX(rec_id) rec_id FROM t_recommend GROUP BY park_id)) rec
                ON park.park_id=rec.park_id
                WHERE park.is_delete=0 and park.plot_id=$plot_id";
        if (strlen($search) > 0) {
            $sql .= " and (park.title LIKE '%" . $search . "%' or park.street LIKE '%" . $search . "%' or park.price LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY park.$order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";

        return $this->db->query($sql)->result();
    }

    public function get_del_park($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_park WHERE is_delete=1";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY $order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function get_total_del_plot_count()
    {
        $sql = "SELECT * FROM t_park WHERE is_delete=1";
        return $this->db->query($sql)->num_rows();
    }
    public function get_del_filterd_count($search)
    {
        $sql = "SELECT * FROM t_park WHERE is_delete=1";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }
    public function get_total_plot_count($id){
        $sql = "SELECT * FROM t_park WHERE plot_id=$id";
        return $this->db->query($sql)->num_rows();
    }
    public function get_plot_filterd_count($search,$id)
    {
        $sql = "SELECT * FROM t_park WHERE plot_id=$id";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function del_all_name($namearr){
        $this->db->where_in('park_id', $namearr);
        return $this->db->update('t_park', array(
            'is_delete' => 1
        ));
    }
    public function get_ordered_park(){
        return $this->db->select('*')->from('t_order')->join('t_user','t_order.user_id=t_user.user_id')
            ->join('t_park','t_order.park_id=t_park.park_id')
            ->join('t_park_img','t_park_img.park_id = t_park.park_id')
            ->where('is_main','1')
            ->get()->result();
    }
    public function get_unorder_park(){
        return $this->db->query('select * from t_park,t_park_img where t_park.park_id = t_park_img.park_id and is_main = "1" and t_park.park_id not in(
	select park_id from t_order 
)')->result();
    }
    public function get_ordered_park_by_plot($plot){
        return $this->db->select('*')->from('t_order')->join('t_user','t_order.user_id=t_user.user_id')
            ->join('t_park','t_order.park_id=t_park.park_id')
            ->join('t_park_img','t_park_img.park_id = t_park.park_id')
            ->where('is_main','1')
            ->where('plot_id',$plot)
            ->get()->result();
    }
    public function get_unorder_park_plot($plot){
        return $this->db->query("select * from t_park,t_park_img where t_park.park_id = t_park_img.park_id and is_main = '1' and plot_id = '$plot' and t_park.park_id not in(
	select park_id from t_order 
)")->result();
    }
}