<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class House_model extends CI_Model
{
    public function get_total_count()
    {
        $this->db->select('*');
        $this->db->from('t_house');
        $this->db->where('is_delete', 0);
        return $this->db->count_all_results();
    }

    public function get_filterd_count($search)
    {
        $sql = "SELECT * FROM t_house WHERE is_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_houses($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT house.*, CASE rec.rec_status WHEN '未结束' THEN 1 ELSE 0 END AS is_rec
                FROM t_house house LEFT JOIN (SELECT rec.* FROM t_recommend rec WHERE rec.rec_id in (SELECT MAX(rec_id) rec_id FROM t_recommend GROUP BY house_id)) rec
                ON house.house_id=rec.house_id 
                WHERE house.is_delete=0";
        if (strlen($search) > 0) {
            $sql .= " and (house.title LIKE '%" . $search . "%' or house.street LIKE '%" . $search . "%' or house.price LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY house.$order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";
        return $this->db->query($sql)->result();
    }

    /**
     * 根据用户id获取房源基本信息，根据后面的$inc_xxx参数来判定是需同时包含关联的其它数据。
     *
     * @param   boolean $inc_orders 是否在房源信息中包含关联的订单信息，默认值FALSE(不包含)
     * @param   boolean $inc_messages 是否在房源信息中包含关联的评论信息，默认值FALSE(不包含)
     * @return  object 房源信息
     */
    public function get_house_by_id($house_id, $options = array('inc_orders' => FALSE, 'inc_comments' => FALSE))
    {
        $this->db->select('house.*, plot.plot_name,developer.developer_name');
        $this->db->from('t_house house');
        $this->db->join('t_plot plot', 'plot.plot_id=house.plot_id','left');
        $this->db->join('t_developer developer', 'developer.developer_id=house.developer_id','left');
        $this->db->where('house.house_id', $house_id);
        $row = $this->db->get()->row();

        $house_imgs = $this->db->get_where('t_house_img', array('house_id' => $house_id))->result();
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
        if($house_imgs){
            $row->imgs = $house_imgs;
        }
        if (isset($options['inc_orders']) && $options['inc_orders']) {
            $this->db->select('house.*, order.*');
            $this->db->from('t_order order');
            $this->db->join('t_house house', 'order.house_id=house.house_id');
            $this->db->where('house.house_id', $house_id);
            $result = $this->db->get()->result();
            if ($result) {
                $row->orders = $result;
            }

        }
        if (isset($options['inc_comments']) && $options['inc_comments']) {
            $this->db->select('comment.*, user.rel_name');
            $this->db->from('t_comment comment');
            $this->db->join('t_user user', 'comment.user_id=user.user_id');
            $this->db->where('comment.house_id', $house_id);
            $result = $this->db->get()->result();
            if ($result) {
                $row->comments = $result;
            }
        }
        return $row;
    }

    public function get_total_house_orders_count($house_id)
    {
        $this->db->select('*');
        $this->db->from('t_order order');
        $this->db->join('t_house house', 'order.house_id=house.house_id');
        $this->db->where('house.house_id', $house_id);
        return $this->db->count_all_results();
    }

    public function get_filterd_house_orders_count($house_id, $search)
    {
        $sql = "SELECT * FROM t_order WHERE is_delete=0 and house_id=$house_id";
        if (strlen($search) > 0) {
            $sql .= " and (price LIKE '%" . $search . "%' or order_status LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function get_paginated_house_orders($house_id, $limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_order ord, t_house house WHERE ord.house_id=house.house_id and ord.is_delete=0 and ord.house_id=$house_id";
        if (strlen($search) > 0) {
            $sql .= " and (ord.price LIKE '%" . $search . "%' or ord.order_status LIKE '%" . $search . "%')";
        }
        $sql .= " order by ord.$order_col $order_col_dir";
        $sql .= " limit $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function get_comments_by_house_id($house_id)
    {
        /*$this->db->select('comment.*, user.rel_name');
        $this->db->from('t_comment comment');
        $this->db->join('t_user user', 'comment.user_id=user.user_id');
        $this->db->where('comment.house_id', $house_id);
        return $this->db->get()->result();*/
    }

    public function save_house($data){
        $this -> db -> insert('t_house',$data);
        return $this -> db -> insert_id();
    }

    public function edit_house($house_id,$data){

        $this->db->where('house_id', $house_id);
        $this->db->update('t_house', $data);
        return $this -> db -> affected_rows();

    }

    public function save_house_img($data){
        //        foreach ($datas as $data){
//            $this -> db -> insert('t_house_img',$data);
//        }
        $this -> db -> insert_batch('t_house_img',$data);
        return $this -> db -> affected_rows();
    }

    public function del_house_img($ids){
        $this->db->where_in('img_id',$ids);
        $this->db->delete('t_house_img');
    }

    public function delete_house($house_id)
    {
//        $this->db->delete('t_house', array('house_id' => $house_id));
        $this->db->where('house_id', $house_id);
        $this->db->update('t_house', array('is_delete' => 1));
        return $this->db->affected_rows();
    }

//订单管理 房源选择
    public function order_search_house($street)
    {
        return $this->db->query("select * from t_house where street like '%$street%' or region like '%$street%'")->result();
    }
//    //获取所有小区
    public function get_plot_by_house()
    {
        return $this->db->get_where('t_plot',array('plot_delete'=>0))->result();
    }
    public function get_paginated_plot_houses($limit, $offset, $search, $order_col, $order_col_dir,$plot_id)
    {
        $sql = "SELECT house.*, CASE rec.rec_status WHEN '未结束' THEN 1 ELSE 0 END AS is_rec
                FROM t_house house LEFT JOIN (SELECT rec.* FROM t_recommend rec WHERE rec.rec_id in (SELECT MAX(rec_id) rec_id FROM t_recommend GROUP BY house_id)) rec
                ON house.house_id=rec.house_id
                WHERE house.is_delete=0 and house.plot_id=$plot_id";
        if (strlen($search) > 0) {
            $sql .= " and (house.title LIKE '%" . $search . "%' or house.street LIKE '%" . $search . "%' or house.price LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY house.$order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";

        return $this->db->query($sql)->result();
    }

    public function get_del_house($limit, $offset, $search, $order_col, $order_col_dir)
    {
        $sql = "SELECT * FROM t_house WHERE is_delete=1";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        $sql .= " ORDER BY $order_col $order_col_dir";
        $sql .= " LIMIT $offset, $limit";
        return $this->db->query($sql)->result();
    }

    public function get_total_del_plot_count()
    {
        $sql = "SELECT * FROM t_house WHERE is_delete=1";
        return $this->db->query($sql)->num_rows();
    }
    public function get_del_filterd_count($search)
    {
        $sql = "SELECT * FROM t_house WHERE is_delete=1";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }
    public function get_total_plot_count($id){
        $sql = "SELECT * FROM t_house WHERE plot_id=$id";
        return $this->db->query($sql)->num_rows();
    }
    public function get_plot_filterd_count($search,$id)
    {
        $sql = "SELECT * FROM t_house WHERE plot_id=$id";
        if (strlen($search) > 0) {
            $sql .= " and (title LIKE '%" . $search . "%' or street LIKE '%" . $search . "%' or price LIKE '%" . $search . "%')";
        }
        return $this->db->query($sql)->num_rows();
    }

    public function del_all_name($namearr){
        $this->db->where_in('house_id', $namearr);
        return $this->db->update('t_house', array(
            'is_delete' => 1
        ));
    }
    public function get_ordered_house(){
        return $this->db->select('*')->from('t_order')->join('t_user','t_order.user_id=t_user.user_id')
            ->join('t_house','t_order.house_id=t_house.house_id')
            ->join('t_house_img','t_house_img.house_id = t_house.house_id')
            ->where('is_main','1')
            ->get()->result();
    }
    public function get_unorder_house(){
        return $this->db->query('select * from t_house,t_house_img where t_house.house_id = t_house_img.house_id and is_main = "1" and t_house.house_id not in(
	select house_id from t_order 
)')->result();
    }
    public function get_ordered_house_by_plot($plot){
        return $this->db->select('*')->from('t_order')->join('t_user','t_order.user_id=t_user.user_id')
            ->join('t_house','t_order.house_id=t_house.house_id')
            ->join('t_house_img','t_house_img.house_id = t_house.house_id')
            ->where('is_main','1')
            ->where('plot_id',$plot)
            ->get()->result();
    }
    public function get_unorder_house_plot($plot){
        return $this->db->query("select * from t_house,t_house_img where t_house.house_id = t_house_img.house_id and is_main = '1' and plot_id = '$plot' and t_house.house_id not in(
	select house_id from t_order 
)")->result();
    }
}