<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wechat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
    }

    public function do_wechatpay(){

        $houseInfo = $this->input->get('houseInfo');
        $order_num = $this->input->get('order_num');
        $amount = $this->input->get('amount');


        $this->load->config('wxpay_config');
        $wxconfig['appid']=$this->config->item('appid');
        $wxconfig['mch_id']=$this->config->item('mch_id');
        $wxconfig['apikey']=$this->config->item('apikey');
        $wxconfig['appsecret']=$this->config->item('appsecret');
        $wxconfig['sslcertPath']=$this->config->item('sslcertPath');
        $wxconfig['sslkeyPath']=$this->config->item('sslkeyPath');
        //由于此类库构造函数需要传参，我们初始化类库就传参数给他吧
        $this->load->library('wechatpay',$wxconfig);
        $param['body']=$houseInfo;
        $param['attach']="";
        $param['detail']=$houseInfo;
        $param['out_trade_no']=$order_num;
        $param['total_fee']=0.01 * 100;//如$total_fee*100//$amount
        $param["spbill_create_ip"] ="";//客户端IP地址
        $param["time_start"] = date("YmdHis");//请求开始时间
        $param["time_expire"] =date("YmdHis", time() + 600000);//请求超时时间
        $param["goods_tag"] = "哈尔滨悦居";//商品标签，自行填写
        $param["notify_url"] = APPPATH."wechat/wxnotify";//自行定义异步通知url
        $param["trade_type"] = "NATIVE";//扫码支付模式二
        $param["product_id"] = "123";//正好有产品id就传了个，看文档说自己定义
        //调用统一下单API接口
        $result=$this->wechatpay->unifiedOrder($param);//这里可以加日志输出，log::debug(json_encode($result));
        //成功（return_code和result_code都为SUCCESS）就会返回含有带支付二维码链接的数据
        if (isset($result["code_url"]) && !empty($result["code_url"])) {//二维码图片链接
            $data['wxurl'] = $result["code_url"];
            $data['orderno'] = $order_num;
            $this->load->view('wechatpay', $data);
        }
    }

    public function qrcode(){
        require_once(APPPATH.'libraries/phpqrcode/phpqrcode.php');
        $url = urldecode($_GET["data"]);
        QRcode::png($url);
    }

    function queryorder()
    {
        $this->load->config('wxpay_config');
        $wxconfig['appid']=$this->config->item('appid');
        $wxconfig['mch_id']=$this->config->item('mch_id');
        $wxconfig['apikey']=$this->config->item('apikey');
        $wxconfig['appsecret']=$this->config->item('appsecret');
        $wxconfig['sslcertPath']=$this->config->item('sslcertPath');
        $wxconfig['sslkeyPath']=$this->config->item('sslkeyPath');
        $this->load->library('Wechatpay',$wxconfig);
        $out_trade_no = $_GET['orderno'];//调用查询订单API接口
        $array = $this->wechatpay->orderQuery('',$out_trade_no);
        echo json_encode($array);
    }

    //微信异步通知
    function wxnotify()
    {
        //$postStr = file_get_contents("php://input");//因为很多都设置了register_globals禁止,不能用$GLOBALS["HTTP_RAW_POST_DATA']　　　　 //这部分困扰了好久用上面这种一直接受不到数据，或者接受了解析不正确，最终用下面的正常了，有哪位愿意指点的可以告知一二
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];//这个需要开启;always_populate_raw_post_data = On
        $this->load->config('wxpay_config');
        $wxconfig['appid']=$this->config->item('appid');
        $wxconfig['mch_id']=$this->config->item('mch_id');
        $wxconfig['apikey']=$this->config->item('apikey');
        $wxconfig['appsecret']=$this->config->item('appsecret');
        $wxconfig['sslcertPath']=$this->config->item('sslcertPath');
        $wxconfig['sslkeyPath']=$this->config->item('sslkeyPath');
        $this->load->library('Wechatpay',$wxconfig);
        libxml_disable_entity_loader(true);
        $array= json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        log::debug($xml);
        log::debug(json_encode($array));
        if($array!=null)
        {
            $out_trade_no = $array['out_trade_no'];
            $trade_no = $array['transaction_id'];
            $data['orderid']=$array['attach'];
            $payinfo = $this->order_model->get_order_by_no($out_trade_no);
            if (!$payinfo) {
                $data['orderno'] = $out_trade_no;
                $data['money'] = $array['total_fee'];
                $data['tradeno'] = $trade_no;
                //添加处理订单的业务逻辑
                $rs=$this->order_model->add_wechat_pay_order($data);//1,更改订单状态,付款方式,
                if($rs>0)
                {//告知微信我成功了
                    $this->wechatpay->response_back();
                }else{//告知微信我失败了继续发
                    $this->wechatpay->response_back("FAIL");
                }
            }else{
                $this->wechatpay->response_back();
            }
        }
    }

    public function wechatpay_success(){
        $orderno = $this->input->get('orderno');
        $tradeno = $this->input->get('tradeno');
        $row = $this->order_model->select_order($orderno);
        $this->order_model->add_wechat_pay_order($orderno,$tradeno);
        $this->load->view('pay_success',array('rs'=>$row));
    }

    //申请退款
    function refund()
    {
        $id = $this->input->get('id');
        if($id==""){
            //方便我手动调用退单
            $id = $this->uri->segment(3);
        }
        if (isset($id) && $id != "") {
            //1、取消订单可以退款。2、失败订单可以退款
            $order = $this->order_model->get_order_by_no($id);
            if ($order->status == '申请退款') {
                $trade_no = $order->trade_no;
                $fee = $order->price * 100;

                $this->load->config('wxpay_config');
                $wxconfig['appid']=$this->config->item('appid');
                $wxconfig['mch_id']=$this->config->item('mch_id');
                $wxconfig['apikey']=$this->config->item('apikey');
                $wxconfig['appsecret']=$this->config->item('appsecret');
                $wxconfig['sslcertPath']=$this->config->item('sslcertPath');
                $wxconfig['sslkeyPath']=$this->config->item('sslkeyPath');
                $this->load->library('wechatpay',$wxconfig);

                if (isset($trade_no) && $trade_no != "") {
                    $out_trade_no = $trade_no;
                    $total_fee = $fee;
                    $refund_fee = $fee;
                    //自定义商户退单号
                    $out_refund_no=$wxconfig['mch_id'].date("YmdHis");
                    $result=$this->wechatpay->refundByTransId($out_trade_no,$out_refund_no,$total_fee,$refund_fee,$wxconfig['mch_id']);

//                    log::DEBUG(json_encode($result));
                    if (isset($result["return_code"]) && $result["return_code"]="SUCCESS"&&isset($result["result_code"]) && $result["result_code"]="SUCCESS") {
                        //状态更改为退款成功
                        $this->order_model->update_order_status($id);
                        echo 'success';
                    }else{
                        echo 'fail';
                    }

                }
            }
        }
    }

}
