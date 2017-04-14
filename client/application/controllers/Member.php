<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17/3/31
 * Time: 上午11:14
 */
class Member extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $CI->config->load('wechat_setting');
        $this->wechat_set= $CI->config->item('inc_info');
        $this->load->model('user_model');
    }
//qq用户登陆
    public function qq_login(){
        $this->load->library('tencent/Oauth','oauth');
        if(!isset($_GET['code'])){
            $this->oauth->redirect_to_login();//登陆腾讯qq,并返回到回调地址
        }else{
            $code = $_GET['code'];
            $openid =  $this->oauth->wget_openid($code);

            if(!empty($openid)) {

                $user = $this->user_model->get_user_by_qq($openid);//通过connectid获取会员信息
                if(isset($user)){
                    $this->session->set_userdata('userinfo',$user);
                    redirect($this->input->cookie("prev_url"));

                }else{
                    $username = $this->oauth->get_user_info();//获取用户信息
                    $id = $this->user_model->add_user_qq($username,$openid);
                    $new_row = $this->user_model->get_by_id($id);
                    $this->session->set_userdata('userinfo', $new_row);
                    redirect($this->input->cookie("prev_url"));
                }
            }
        }

    }
    //微信登录
    public function wechat_login(){
        if(!isset($_GET['code'])){
            $appid = $this->wechat_set['appid'];
            $redirect_uri = $this->wechat_set['callback'];
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_login&state=1#wechat_redirect';
            header("Location:".$url);
        }else{
            $appid = $this->wechat_set['appid'];
            $secret = $this->wechat_set['appsecret'];
            $code = $_GET["code"];
            $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$get_token_url);
            curl_setopt($ch,CURLOPT_HEADER,0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            $res = curl_exec($ch);
            curl_close($ch);
            $json_obj = json_decode($res,true);

            //根据openid和access_token查询用户信息
            $access_token = $json_obj['access_token'];
            $openid = $json_obj['openid'];
            $user = $this->user_model->get_user_by_wechat($openid);//通过connectid获取会员信息
            if(isset($user)){
                $this->session->set_userdata('userinfo',$user);
                redirect($this->input->cookie("prev_url"));
            }else{
                $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
                curl_setopt($ch,CURLOPT_HEADER,0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                $res = curl_exec($ch);
                curl_close($ch);
                //解析json得到用户信息
                $user_obj = json_decode($res,true);
                $id = $this->user_model->add_user_wechat($user_obj["nickname"],$openid);
                $new_row = $this->user_model->get_by_id($id);
                $this->session->set_userdata('userinfo',$new_row);
                redirect($this->input->cookie("prev_url"));
            }
        }
    }

    private function get_content_by_url($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
        return curl_exec($curl);
    }
}