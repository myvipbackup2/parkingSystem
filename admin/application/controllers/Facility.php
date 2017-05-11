<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Facility extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('facility_model');
            
        }

        public function facility_upload(){
            
            $typeArr = array("jpg", "png", "ico");
            //允许上传文件格式
            $path = "uploads/";
            //上传路径

            //if (!file_exists($path)) {
            //  mkdir($path);
            //}
            if (isset($_POST)) {
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $name_tmp = $_FILES['file']['tmp_name'];
                if (empty($name)) {
                    echo json_encode(array("error" => "您还未选择图片"));
                    exit;
                }
                $type = strtolower(substr(strrchr($name, '.'), 1));
                //获取文件类型

                if (!in_array($type, $typeArr)) {
                    echo json_encode(array("error" => "请上传jpg,png,ico类型的图片！"));
                    exit;
                }
                if ($size > (500 * 1024)) {
                    echo json_encode(array("error" => "图片大小已超过500KB！"));
                    exit;
                }
                $pic_name = time() . rand(10000, 99999) . "." . $type;
                //图片名称
                $pic_url = $path . $pic_name;
                //上传后图片路径+名称
                if (move_uploaded_file($name_tmp, $pic_url)) {//临时文件转移到目标文件夹
                    echo json_encode(array("error" => "0", "pic" => $pic_url, "name" => $pic_name));
                } else {
                    echo json_encode(array("error" => "上传有误，请稍后重试！"));
                }
            }
        }

        public function facility_del(){
            $facility_id = $this->input->get('facilityId');
            admin_log('设备管理删除设备编号'.$facility_id);
            //echo $facility_id;
            $row =$this->facility_model->delete_facility($facility_id);
            if($row > 0){
                echo 'success';
            }else{
                echo 'fail';
            }
        }

        public function facility_mgr(){
            //header("Access-Control-Allow-Origin:*");
            admin_log('设备管理列表查询');
            $draw = $this->input->get('draw');

            //分页
            $start = $this->input->get('start');//从多少开始
            $length = $this->input->get('length');//数据长度
            $search = htmlspecialchars($this->input->get('search[value]'));//搜索内容
            $order_col_no = $this->input->get('order[0][column]');//排序的列
            $order_col_dir = $this->input->get('order[0][dir]');//排序的方向(asc|desc)

            $order_col = array('1'=>'type_id','2' => 'name', '3' => 'icon','4' => 'is_free','5' => 'price');
            //$order_col=array('0'=>'name');
            $recordsTotal = $this->facility_model->get_total_count();
            $recordsFiltered = $this->facility_model->get_filterd_count($search);


            $datas = $this->facility_model->get_paginated_facility($length, $start, $search, $order_col[$order_col_no], $order_col_dir);

            foreach ($datas as $data) {
                $data->DT_RowData = array('id' => $data->type_id);
            }
            echo json_encode(array(
                "draw" => intval($draw),
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $datas
            ), JSON_UNESCAPED_UNICODE);
        }

        public function get_facility(){
            $datas = $this->facility_model->get_facility();
            echo json_encode(array(
                "datas" => $datas
            ), JSON_UNESCAPED_UNICODE);
        }

        public function add_facility(){
            admin_log('设备管理添加设备');
            $facility_name=htmlspecialchars($this->input->post('add_facility_name'));
            $facility_url=$this->input->post('upload_img');
            $facility_free = htmlspecialchars($this->input->post('free'));
            $facility_price = htmlspecialchars($this->input->post('price'));
            $facility_remark = htmlspecialchars($this->input->post('editorValue'));

            //1:写入数据库
            $this->load->model('Facility_model');
            $query=$this->Facility_model->insert_fac_name($facility_name,$facility_url[0],$facility_free[0],$facility_price,$facility_remark);
            if($query){
                redirect('facility');
            }

        }

        public function index(){
            
            $this->load->view('facility_mgr.php');

        }

        public function del_all(){
        	$namearr=$this->input->post('name');
            admin_log('管理员删除设备');
        	//var_dump($namearr);
        	$this->load->model('Facility_model');
        	$result=$this->Facility_model->del_all_name($namearr);
        	if($result){
        		echo "success";
        	}else{
        		echo "error";
        	}
        }


    }

?>