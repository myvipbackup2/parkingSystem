<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 管理员操作记录日志 helper
 */

// ------------------------------------------------------------------------

if (!function_exists('element')) {
    /**
     * 管理员操作记录日志
     *
     * @param    string
     * @param    array
     * @param    mixed
     * @return    mixed    depends on what the array contains
     */
    function admin_log($content)
    {
        $CI =& get_instance();
        $login_admin = $CI->session->userdata('admininfo');
        $CI->db->insert('t_log', array(
            'admin_id' => $login_admin->admin_id,
            'log_content' => '进行了 ' . $content . ' 操作'
        ));
    }
}