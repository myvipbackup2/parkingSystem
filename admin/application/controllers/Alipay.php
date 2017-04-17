<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Alipay extends CI_Controller {
    private $alipay_config;
    function __construct(){
        parent::__construct();
        $this->_init_config();
        $this->load->helper('url');
        $this->load->model("Alipay_model");
    }

    function index(){
        $order_no=$this->input->get("id");
        $rs=$this->Alipay_model->get_alipay_trade_no($order_no);
        $arr["price"]=$rs[0]->price;
        $arr["alipay_trade_no"]=$rs[0]->alipay_trade_no."^".$rs[0]->price."^"."退款";
        $arr["time"]=date("YmdHis").rand(0,10000);
        $this->load->view('alipay_index',$arr);//装载支付视图页面，post到do_alipay
    }
    function re_alipay(){
        require_once(APPPATH."third_party/alipay/alipay_notify.class.php");

//计算得出通知验证结果
        $alipayNotify = new AlipayNotify($this->alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //批次号

            $batch_no = $_POST['batch_no'];

            //批量退款数据中转账成功的笔数

            $success_num = $_POST['success_num'];

            //批量退款数据中的详细信息
            $result_details = $_POST['result_details'];
            $state=$result_details.explode("^");
            if($state[2]=="SUCCESS"){
                $this->Alipay_model->up_alipay_trade_no($state[0]);
            }
            //判断是否在商户网站中已经做过了这次通知返回的处理
            //如果没有做过处理，那么执行商户的业务程序
            //如果有做过处理，那么不执行商户的业务程序

            echo "success";		//请不要修改或删除

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }
    function do_alipay(){
         /* *
 * 功能：即时到账批量退款有密接口接入页
 * 版本：3.4
 * 修改日期：2016-03-08
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************注意*************************
 * 如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 * 1、开发文档中心（https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.oxen1k&treeId=66&articleId=103600&docType=1）
 * 2、商户帮助中心（https://cshall.alipay.com/enterprise/help_detail.htm?help_id=473888）
 * 3、支持中心（https://support.open.alipay.com/alipay/support/index.htm）
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 */
        //APPPATH.'third_party/alipay/alipay_notify.class.php

         require_once(APPPATH."third_party/alipay/alipay_submit.class.php");

         /**************************请求参数**************************/

         //批次号，必填，格式：当天日期[8位]+序列号[3至24位]，如：201603081000001

         $batch_no = $_POST['WIDbatch_no'];
         //退款笔数，必填，参数detail_data的值中，“#”字符出现的数量加1，最大支持1000笔（即“#”字符出现的数量999个）

         $batch_num = $_POST['WIDbatch_num'];
         //退款详细数据，必填，格式（支付宝交易号^退款金额^备注），多笔请用#隔开
         $detail_data = $_POST['WIDdetail_data'];


         /************************************************************/

//构造要请求的参数数组，无需改动
         $parameter = array(
             "service" => trim($this->alipay_config['service']),
             "partner" => trim($this->alipay_config['partner']),
             "notify_url"	=> trim($this->alipay_config['notify_url']),
             "seller_user_id"	=> trim($this->alipay_config['seller_user_id']),
             "refund_date"	=> trim($this->alipay_config['refund_date']),
             "batch_no"	=> $batch_no,
             "batch_num"	=> $batch_num,
             "detail_data"	=> $detail_data,
             "_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))

         );
//建立请求
         $alipaySubmit = new AlipaySubmit($this->alipay_config);
         $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
         echo $html_text;
     }
    function do_notify(){
        require_once(APPPATH.'third_party/alipay/alipay_notify.class.php');
    }
     function _init_config(){
         /* *
 * 配置文件
 * 版本：3.4
 * 日期：2016-03-08
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */

//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
// 合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://openhome.alipay.com/platform/keyManage.htm?keyType=partner
         $alipay_config['partner']		= '2088521954493828';

// 卖家支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
         $alipay_config['seller_user_id']=$alipay_config['partner'];

//商户的私钥,此处填写原始私钥去头去尾，RSA公私钥生成：https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.nBDxfy&treeId=58&articleId=103242&docType=1
         $alipay_config['private_key']	= 'MIIEpAIBAAKCAQEAxW0erL8Rr46WbPdyrEp+GWYadKGKQoiniO3vVwMqAGmTTbCc0B2fH58/GWIBZS8lkKYkltMt6ZVRh1PXcK0qsVOmoDLm9vH5rp65dRTEgTKg0THVG6aBRBv4RjgWX1gzjWEbGYUdbrBRd4ZO8SVFf20X9JNbsxuYT5XFcqI24ZZx4SZwOWfXZ0X/TpUAURaC4CTKNCQl/xXbW3D6U5BDhlpOiJoRuQkcX9SSwJpAjiMa/YFV5rbr6yUg+ey+JSX7Ano3GLZYFgWXlwjE9CanVOwlS3bvAGaMoNcrl/EH39/eZP9rR1X0smecFngC8Jdx5QoHU+B/N0/uGzm3ZvKDFQIDAQABAoIBABahI1r5q7VLysJCuso0369ZnL6xpX9q2ok/fKeknTPe5huJmu/f9VVSk5D9QtuuQ8gIwzjmi+SyUN4KJi+sKbCZvgeuzfqQUeZKG0foUX3dp8FSzPKWa0q7SgICe84B9ibGcqzCLVV6sFva8UGC3Cx2/L/0BBbLmvHEYRV6sn+441U0p+y/TND7coNaBwhO/MFUq+FLQCoJhy0j0KclAVLiv3jclK2rx2bh+xWFhvNNhSAYBEJv726BOYwEIX1mulEmr2qhIrUtuh8dGUnt3T2uwd3xf1LZ18XWIh3LjkHfasmEPmVsZQjJ/JtVam/chyw+/q626bzFYMmjZELVqCECgYEA55ZiS1oC3wD+Pcedwqr1bXO+DPPQicBtihiiHOSCE+khpBKzqhihitYBBrCKN5b0AWgCUFkRjIsE4LtMrZgx2aaMv3Z2S/yqPaTlkFTFGVQCTfJ8dIiyLWN/gailB8Ce9u5+tGZsPEJPMpFoSpYxMDWwpDciGDnH5axvmc7rqUcCgYEA2jzcx1AEZ+VRLc1sHjeCPX1Be+OpcHGU61ey2/hEsjU12/TOxQ/lFAmklnCNkLUOGNju7KkJ6NWbemiwgemj/I7gFs4f97WPLMv+7pb1WUPYIrS9gJcEb5u+cnT3EwVu0eSts4zZAZlLwWXpoLogxMs4TI/gMW3ioSOseHCz3sMCgYEA1EIWV1/pj8FWRQOHSdvtVGMoBrEVKpxvCYpoUzjxLBSaG8p0V2t57EkW6a23ERpPDFbq//+SwRDN6LhioB0FW6p2CCooZJ7w3c0cBvxbJkrETfL5NMnxHP675/fNQly+li6jfO7/Nv/DnOJ/BxW/gaNEAk7x9ehHme9A3mUzw5MCgYAYGjyv7pBuAQ+UJWnZdHv32ouO6TffaUvvKgJg9OxxWhsWrdTgQr8kFWSOEOQxpS1nZR4OGSU1B9JiFInZ7znjPMxW+HDjZLPpWKZRJ271at7GBnwfZY5h3SuNbImVGjaBC+Z7PAUDfjC1rVG+JJBV67POEN3L17z92vjDXH8hDQKBgQC6nf3kdlYgnrt3xzw6P1jKiEQoeQKutyuV4Rqg2dxECo/oXDw/OhzlillVsEPIb1gU4sqmGmFVXypRddzK3nJoeJQVv9redo1rFtuaZyQRQ9AhkLVFmQlh3dSCIiiVxQXBVc79QO142J4DXGtPQJdzEKuBlBozvDeiASbV7qwqKQ==';

//支付宝的公钥，查看地址：https://openhome.alipay.com/platform/keyManage.htm?keyType=partner
         $alipay_config['alipay_public_key']= 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRAFljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQEB/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5KsiNG9zpgmLCUYuLkxpLQIDAQAB';

// 服务器异步通知页面路径，需http://格式的完整路径，不能加?id=123这类自定义参数,必须外网可以正常访问
         $alipay_config['notify_url']="http://16377t32d0.iask.in:23457/yuejums3/Alipay/re_alipay";

// 签名方式
         $alipay_config['sign_type']    = strtoupper('RSA');

// 退款日期 时间格式 yyyy-MM-dd HH:mm:ss
//date_default_timezone_set('PRC');//设置当前系统服务器时间为北京时间，PHP5.1以上可使用。
         $alipay_config['refund_date']=date("Y-m-d H:i:s",time());;

// 调用的接口名，无需修改
         $alipay_config['service']='refund_fastpay_by_platform_pwd';

//字符编码格式 目前支持 gbk 或 utf-8
         $alipay_config['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
         $alipay_config['cacert']    = getcwd().'\\cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
         $alipay_config['transport']    = 'http';

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
         $this->alipay_config = $alipay_config;
     }
}


?>