<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        $this->load->view('index');

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
