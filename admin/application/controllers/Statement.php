<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Statement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Statement_model');
    }

    public function each_day_index()
    {
        $date = date('Y-m-d');
        $rs = $this->Statement_model->get_statement_by_day($date);
        $arr['rs'] = $rs;
        $this->load->view('statement_mgr_day', $arr);
    }

    public function get_each_day()
    {
        $date = $this->input->get('date');
        $rs = $this->Statement_model->get_statement_by_day($date);
        echo json_encode($rs);
    }

    public function each_month_index()
    {
        $date = date('Y-m');
        $rs = $this->Statement_model->get_statement_by_month($date);
        $arr['rs'] = $rs;
        $this->load->view('statement_mgr_month', $arr);
    }

    public function get_each_month()
    {
        $date = $this->input->get('date');
        $rs = $this->Statement_model->get_statement_by_month($date);
        echo json_encode($rs);
    }

    public function each_year_index()
    {
        $date = date('Y');
        $rs = $this->Statement_model->get_statement_by_year($date);
        $arr['rs'] = $rs;
        $this->load->view('statement_mgr_year', $arr);
    }

    public function get_each_year()
    {
        $date = $this->input->get('date');
        $rs = $this->Statement_model->get_statement_by_year($date);
        echo json_encode($rs);
    }
}