<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("TOKEN", "weixin");
define("APPID", "wx6fb7b0dfbe25ccd9");
define("APPSECRET", "f17c7c670077fc7d019cb6b21ee990ab");
define("PC_APPID", "wxde93adae9bc614fc");
define("PC_APPSECRET", "632b0f5d7fc829eb503921eae9c39cac");
class CI_Wechat {

    private $_CI;
    private $access_token;

    public function __construct() {

        $this->_CI =& get_instance();
        $this->_CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

    }

    /**
     * 向用户推送消息
     * @param array 其中msgtype代表消息类型：text为文本，news为图文
     */
    function push_message($msg_data) {

        $access_token = $this->checkAuth();
        //测试发布信息
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=" . $access_token;
        //正式发布信息
        //$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $this->access_token;

        $result = $this -> http_post($url, json_encode($msg_data));
        return json_decode($result);
    }

    /**
     * 构造http请求，可以是post和get方式
     * @param url string 请求路径
     * @param post_data json格式的字符串，不传是get方式
     * @return http请求结果
     */
    private function http_post($url, $post_data = '') {
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         if ($post_data) {
             curl_setopt($curl, CURLOPT_POST, 1);
             curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
         }
         $result = curl_exec($curl);
         if (curl_errno($curl)) {
             return 'Errno' . curl_error($curl);
         }
         curl_close($curl);
         return $result;
     }
    /**
     * GET 请求
     * @param string $url
     */
    private function http_get($url){
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }




    function get_open_id() {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
        } else {
            echo "NO CODE";
        }
        // 运行cURL，请求网页
        $data = $this -> http_post('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . APPID . '&secret=' . APPSECRET . '&code=' . $code . '&grant_type=authorization_code');
        // 获取access_token；
        $reg = "#{.+}#";
        preg_match_all($reg, $data, $matches);
        $json = $matches[0][0];
        $accessArr = json_decode($json, true);
        $openid = $accessArr['openid'];
        return $openid;
    }

    
    //获取用户信息
    function get_user_info($openid=NULL) {
        $access_token = $this -> checkAuth();
        if(!$openid){
            $openid = $this -> get_open_id();
        }
        $user_info = $this -> http_get('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid);
        $user_info = json_decode($user_info);
        return $user_info;
    }



    //开放平台获取个人信息
    function get_pc_info($code) {
        // 运行cURL，请求网页
        $data = $this -> http_get('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.PC_APPID.'&secret='.PC_APPSECRET.'&code='.$code.'&grant_type=authorization_code');
        // 获取access_token；
        $reg = "#{.+}#";
        preg_match_all($reg, $data, $matches);
        $json = $matches[0][0];
        $accessArr = json_decode($json, true);
        if(!isset($accessArr['errcode'])){
            $openid = $accessArr['openid'];
            $access_token = $accessArr['access_token'];
            $refresh_token = $accessArr['refresh_token'];
            $info = $this -> http_get('https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid);
            preg_match_all($reg, $info, $info_res);
            $json_info = $info_res[0][0];
            $info_Arr = json_decode($json_info, true);
            return $info_Arr;
        }else{
            return false;
        }
        
    }
    
    //添加管理员
    function add_admin(){
        $access_token = $this -> checkAuth();
        $url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token=".$access_token;
        $data = '{
                    "kf_account" : "han426826t@gh_4ab0de78c8cc",
                    "nickname" : "金牌客服",
                    "password" : "bb081ff3913aacc41260b6b253e4c8da"
                }';
        return $this -> http_post($url,$data);
    }

    //获取用户openid列表,返回值是数组
    function open_id_list($next_openid = null){
        $access_token = $this -> checkAuth();
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$access_token."&next_openid=".$next_openid;
        $openid_list = $this -> http_get($url);
        $openid_list = json_decode($openid_list);
        return $openid_list -> data->openid;
    }


    //发送模板消息
    function sendTemplateMsg($openid,$tempid,$url){
        $access_token = $this -> checkAuth();
        $send_url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
        $array = array(
            "touser"=>$openid,//用户openid
            "template_id"=>$tempid,//模板id
            "url"=>$url,  //跳转的路径
            "data" => array(
                "name" =>array("value"=>"hello！","color"=>"#173177"),
                "money" =>array("value"=>"111","color"=>"#173177"),
                "date" =>array("value"=>date('Y-m-d H:i:s'),"color"=>"#173177")
            ), 
        );
        $postJson = json_encode($array);
        $res = $this->http_post($send_url,$postJson);
        var_dump($res);
    }

    //生成带参数的二维码票据,
    //参数一代表生成二维码类型，tuer：永久，false：为临时，
    //参数二，为参数
    function getQrcodeTicket($bool,$scene_id){
        if($bool){
            $array = array(
                "action_name"=>"QR_LIMIT_SCENE",
                "action_info" => array(
                    "scene" =>array("scene_id"=>$scene_id)
                )
            );

        }else{
            $array = array(
                "expire_seconds"=>604800,//有效时间
                "action_name"=>"QR_SCENE",//二维码类型
                "action_info" => array(
                    "scene" =>array("scene_id"=>$scene_id)//参数
                ), 
            );
        }
        $access_token = $this -> checkAuth();
        $send_url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        $postJson = json_encode($array);
        $res = $this->http_post($send_url,$postJson);
        $res = json_decode($res);
        return $res->ticket;
    }
    /*

    HTTP GET请求（请使用https协议）
    https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=TICKET
    提醒：TICKET记得进行UrlEncode

    */
    //生成带参数的二维码,
    //参数一代表生成二维码类型，tuer：永久，false：为临时，
    //参数二，为参数
    function getQrcode($bool,$scene_id){
        $qrcode_ticket = $this -> getQrcodeTicket($bool,$scene_id);
        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($qrcode_ticket);
        $res = '<img src="'.$url.'" alt="">';
        return $res;

    }



    /**
     * 获取access_token
     * @param string $appid 如在类初始化时已提供，则可为空
     * @param string $appsecret 如在类初始化时已提供，则可为空
     * @param string $token 手动指定access_token，非必要情况不建议用
     */
    private function checkAuth(){
        $authname = 'wechat_access_token_'.APPID;
        if ($rs = $this->getCache($authname))  {
            $this->access_token = $rs;
            return $rs;
        }



        $result = $this->http_get('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET);
        if ($result)
        {
            $json = json_decode($result,true);
            if (!$json || isset($json['errcode'])) {
                $this->errCode = $json['errcode'];
                $this->errMsg = $json['errmsg'];
                return false;
            }
            $this->access_token = $json['access_token'];
            $expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
            $this->setCache($authname,$this->access_token,$expire);
            return $this->access_token;
        }
        return false;
    }



    /**
     * 获取js_api_token
     * @param string $appid 如在类初始化时已提供，则可为空
     * @param string $appsecret 如在类初始化时已提供，则可为空
     * @param string $token 手动指定access_token，非必要情况不建议用
     */
    private function getJsApiTicket(){
        $jsapi = 'wechat_jsapi_ticket_'.APPID;
        if ($rs = $this->getCache($jsapi)){
            $this->jsapi_ticket = $rs;
            return $rs;
        }

        $access_token = $this->checkAuth();
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
        $result = $this->http_get($url);
        if ($result)
        {
            $json = json_decode($result,true);
            // if (!$json || isset($json['errcode'])) {
            //     $this->errCode = $json['errcode'];
            //     $this->errMsg = $json['errmsg'];
            //     return false;
            // }
            $this->jsapi_ticket = $json['ticket'];
            $expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
            $this->setCache($jsapi,$this->jsapi_ticket,$expire);
            return $this->jsapi_ticket;
        }
        return false;
    }
    //获取16位随机码
    function getRandCode($num = 16){
        $array = array(
            "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"
        );
        $tmpstr = "";
        $max = count($array);
        for($i=1; $i<=$num; $i++){
            $key = rand(0,$max-1);
            $tmpstr .= $array[$key];
        }
        return $tmpstr;
    }

    //微信js-sdk辅助函数
    function jsSdk($url){
        $jsticket = $this->getJsApiTicket();
        $nonceStr = $this->getRandCode();
        $timestamp = time();
        $signature = "jsapi_ticket=".$jsticket."&noncestr=".$nonceStr."&timestamp=".$timestamp."&url=".$url;
        $signature = sha1($signature);
        $arr = array(
            "nonceStr" =>$nonceStr,
            "timestamp" => $timestamp,
            "signature" => $signature,
            "jsticket" => $jsticket,
            "url" => $url
        );
        return $arr;
    }



    /**
     * 重载设置缓存
     * @param string $cachename
     * @param mixed $value
     * @param int $expired
     * @return boolean
     */
    private function setCache($cachename, $value, $expired) {
        return $this->_CI->cache->save($cachename, $value, $expired);
    }

    /**
     * 重载获取缓存
     * @param string $cachename
     * @return mixed
     */
    private function getCache($cachename) {
        return $this->_CI->cache->get($cachename);
    }

    /**
     * 重载清除缓存
     * @param string $cachename
     * @return boolean
     */
    private function removeCache($cachename) {
        return $this->_CI->cache->delete($cachename);
    }

}