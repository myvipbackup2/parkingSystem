<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wxpay extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
	}

	function printf_info($data)
	{
	    foreach($data as $key=>$value){
	        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
	    }
	}

    function do_pay(){
        ini_set('date.timezone','Asia/Shanghai');
        $order_no = $this->input->get('orderNo');
        $yueju_order = $this->order_model->select_order($order_no);

        $arr = array(
            'fee' => $yueju_order->price,
            'orderno'=>$order_no
        );
        $this->load->view('wxpay',$arr);
    }

	function yueju_notify(){
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		$array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

		if($array!=null)
		{
			$out_trade_no = $array['out_trade_no'];
			$trade_no = $array['transaction_id'];
			$payinfo = $this->order_model->get_order_by_no($out_trade_no);
			if ($payinfo) {
				$data['orderno'] = $out_trade_no;
				$data['money'] = $array['total_fee'];
				$data['tradeno'] = $trade_no;
				//添加处理订单的业务逻辑
				$rs=$this->order_model->add_wechat_pay_order($out_trade_no,$trade_no);//1,更改订单状态,付款方式,
				if($rs>0)
				{//告知微信我成功了
					send_success_msg($out_trade_no);
					$this->wechatpay->response_back();
				}else{//告知微信我失败了继续发
					$this->wechatpay->response_back("FAIL");
				}
			}else{
				$this->wechatpay->response_back();
			}
		}
	}

	public function pay_success(){
		$order_no = $this->input->get('orderNo');
		$order = $this->order_model->select_order($order_no);
		$this->order_model->add_wechat_pay_order($order_no);
		$this->load->view('pay_success',array('order'=>$order));
	}
//     订单完成更新order表中的状态
    public function order_finished(){
        $order_no = $this->input->get('orderNo');
        $rs=  $this->order_model->empty_wechat_pay_order($order_no);
	}

	//预订成功,发送短信
	private function send_success_msg($orderno){
		$order = $this->order_model->select_order($orderno);
		$park = $this->order_model->get_manage($order->park_id);
		date_default_timezone_set('Asia/Shanghai');
		require_once(APPPATH."libraries/alidayu/TopSdk.php");
		$c = new TopClient;
		$c->appkey = "23742326";
		$c->secretKey = "8621bcd8b81313dd25c5b4fb7c034911";
		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req->setSmsType("normal");
		$req->setSmsFreeSignName("孟昊阳毕设随心停");
		$req->setSmsParam("{'time':'".date("Y年m月d日")."','address':'".$park->city.$park->region.$park->street.$park->plot_name."','starttime':'".$order->start_time."','tel':'".$park->tel."'}");
		$req->setRecNum($order->invoice_person_tel);
		$req->setSmsTemplateCode('SMS_61355153');
		$resp = $c->execute($req);
	}


}