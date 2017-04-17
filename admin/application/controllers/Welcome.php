<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Welcome_model');
    }
    public function index()
    {
        $result=$this->Welcome_model->get_plot();
        $res=$this->Welcome_model->get_message();
        $arr["message"]=$res;
        $arr["plot"]=$result;
        $this->load->view('index',$arr);
    }
    public function user_mgr()
    {
        $this->load->view('user_mgr');
    }

    public function user_detail()
    {
        $this->load->view('user_detail');
    }

    public function login()
    {
        $this->load->view('login');
    }
}
