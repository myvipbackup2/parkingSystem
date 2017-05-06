<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>首页</title>
    <base href="<?php echo site_url(); ?>"/>
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/index.css"/>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=9w3UCQ9fjQApIUUGxwUu2YDArBsGanOG"></script>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;随心停</a>
    <div class="title">
        小区停车场管理系统
    </div>
    <a href="javascript:;" class="menu-btn">
    </a>
    <div id="menu-top">
        <ul>
            <li class="menu-home">
                <i class="iconfont icon-home"></i>
                <a href="welcome/index" data-stat-label="随心停">
                    随心停
                </a>
            </li>
            <li class="menu-user">
                <i class="iconfont icon-about"></i>
                <a href="user" data-stat-label="我的随心停">
                    我的随心停
                    <?php
                    $login_user = $this->session->userdata('userinfo');
                    if ($login_user) { ?>
                        (<em class="h-light">已登录</em>)
                    <?php } else { ?>
                        (<em class="h-light">未登录</em>)
                    <?php } ?>
                </a>
            </li>
            <li class="menu-favorites">
                <i class="iconfont icon-collect"></i><a href="welcome/collection_manage" data-stat-label="收藏">收藏</a>
            </li>
            <li class="menu-msg">
                <i class="iconfont icon-message"></i><a href="Welcome/about" data-stat-label="关于设计">关于设计</a>
                <span class="msg">&nbsp;</span>
            </li>
        </ul>
    </div>
</div>
<div class="container">

    <div id="allmap" style="height: 230px;"></div>
    <div class="search">
        <div class="fl search-box">
            <form action="park/index_search" method="post">
                <input class="fl search-box-ipt" placeholder="搜索停车场..." type="text" name="content"/>
                <input class="fl search-box-btn" type="submit" value=""/>
            </form>

        </div>
    </div>
    <div class="content">
        <div class="c-title">
            <h2>推荐小区停车场</h2>
            <p>选择一个您合适的停车位</p>
        </div>
        <div class="c-item-box">
            <?php
            foreach ($result as $index => $park) {
                ?>
                <div class="c-item">
                    <a href="park/detail/<?php echo $park->park_id ?>">
                        <div class="p-img">
                            <img src="<?php echo ADMINPATH . $park->imgs[0]->img_thumb_src; ?>" alt=""/>
                        </div>
                        <div class="p-info">
                            <div class="fl p-title"><?php echo $park->title ?></div>
                            <div class="fr p-address"><?php echo $park->region ?></div>
                            <div class="p-detail"><?php echo $park->description ?></div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>

        </div>

    </div>
    <div class="footer">
        <div class="c-title">
            <h2>随心停便利你的生活</h2>
            <p>选择一个您合适的停车位</p>
        </div>
        <ul class="f-icons clearfix">
            <li>
                <img src="images/footer-1.png" alt=""/>
                <div>安全交易</div>
            </li>
            <li>
                <img src="images/footer-2.png" alt=""/>
                <div>国企认证</div>
            </li>
            <li>
                <img src="images/footer-3.png" alt=""/>
                <div>软件工程</div>
            </li>
            <li>
                <img src="images/footer-4.png" alt=""/>
                <div>便捷省事</div>
            </li>
            <li>
                <img src="images/footer-5.png" alt=""/>
                <div>省心省钱</div>
            </li>
        </ul>
    </div>
</div>
<script src="js/zepto.js"></script>
<script src="js/header.js"></script>
<script type="text/javascript">
    // 百度地图API功能，根据浏览器自动定位
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(126.65771686,45.77322463);//默认黑大位置
    map.centerAndZoom(point, 18);

    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function (r) {
        if (this.getStatus() == BMAP_STATUS_SUCCESS) {
            var mk = new BMap.Marker(r.point);
            map.addOverlay(mk);
            map.panTo(r.point);
//            alert('您的位置：' + r.point.lng + ',' + r.point.lat);
        }
        else {
//            alert('failed' + this.getStatus());
        }
    }, {enableHighAccuracy: true})
    //关于状态码
    //BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
    //BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
    //BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
    //BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
    //BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
    //BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
    //BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
    //BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1 新增)
    //BMAP_STATUS_TIMEOUT	超时。对应数值“8”。(自 1.1 新增)
</script>
</body>
</html>