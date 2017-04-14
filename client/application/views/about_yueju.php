<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="悦居租房"/>
    <meta name="description" content="悦居租房"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>悦居租房</title>
    <base href="<?php echo site_url(); ?>">
    <link rel="apple-touch-icon-precomposed" href="">
    <link rel="Shortcut Icon" type="image/x-icon" href="">
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <link rel="stylesheet" href="css/about-yueju.css">
    <script src="js/vue.min.js"></script>
    <script src="js/mintUI.min.js"></script>
</head>
<body>

<div id="app" class="page-welcome">
    <mt-header title="关于悦居租房">
        <mt-button @click="javascript:window.history.go(-1);" icon="back" slot="left">返回</mt-button>
    </mt-header>
    <div style="height: 150px;">
        <mt-swipe :show-indicators="true" :auto="2500">
            <mt-swipe-item><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/s1.jpg" alt="">
            </mt-swipe-item>
            <mt-swipe-item><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/s2.jpg" alt="">
            </mt-swipe-item>
            <mt-swipe-item><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/s3.jpg" alt="">
            </mt-swipe-item>
        </mt-swipe>
    </div>
    <article>
        <div class="photo"><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/photo1.jpg"></div>
        <div class="text">
            <h2>家庭出行首选 多人多天更合算</h2>
            <p>
                悦居租房房屋不仅提供睡觉的房间，还包括客厅、厨房、露台等<br/>
                空间大、可洗衣做饭，出游在外也能享受居家乐趣<br/>
                人均花费比酒店便宜，多人多天更合算
            </p>
        </div>
    </article>

    <article>
        <div class="photo"><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/photo2.jpg"></div>
        <div class="text">
            <h2>OK 就住不一样的</h2>
        </div>
    </article>

    <article class="list">
        <h2 class="title"><span>悦居租房 旅途中的家</span></h2>
        <div class="box">
            <div class="img"><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/tujia1.jpg" alt="">
            </div>
            <div class="txt">
                <ol>
                    <li>传统酒店格局单调、一成不变，缺乏亲近之感</li>
                    <li>在悦居租房你可以烹饪美食，也可以把脏衣服扔进洗衣机</li>
                    <li>热情的房东像久别重逢的老友，与您嘘寒问暖或者谈天说地</li>
                    <li>您可以像当地人一样生活，陌生的地方原来温暖如家</li>
                </ol>
                <div class="comment">
                    <img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/user1.png">
                    <div class="">
                        <p><span>刘女士</span>2015-05-04</p>
                        <q>环境非常好，离海边很近，我比较喜欢这里的宁静，睡觉时特别安逸，让旅行更加精力充沛，洗衣服晾晒也超级方便哦。服务人员很热心，让我有家人的感觉，鼎力推荐给大家！</q>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article class="list">
        <h2 class="title"><span>新奇、有趣、非常规</span></h2>
        <div class="box">
            <div class="img"><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/tujia2.jpg" alt="">
            </div>
            <div class="txt">
                <ol>
                    <li>露营野炊，我们有全国最好的房车营地</li>
                    <li>海边度假，我们有泊在港湾的意大利游艇</li>
                    <li>感受历史，我们有历经百年的古老屋舍</li>
                    <li>携宠旅行，我们有可带宠物的自在居所</li>
                </ol>
                <div class="comment">
                    <img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/user2.png">
                    <div>
                        <p><span>王女士</span>2015-05-18</p>
                        <q>很精致的小客栈，很有格调。在古城的小巷里，闹中取静。客栈设施挺新的，店主也很热情周到呢！赞赞赞！ 也很适合家庭出游，房间有大小床哦！</q>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article class="list">
        <h2 class="title"><span>差旅更体贴 周租月租更省钱</span></h2>
        <div class="box">
            <div class="img"><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/tujia3.jpg" alt="">
            </div>
            <div class="txt">
                <ol>
                    <li>悦居租房城市公寓遍布城市中心、商务地段、生活区域</li>
                    <li>优雅的设计，缓解一天疲惫；宽敞的客厅，自由不再拘束</li>
                    <li>便利的交通，节省出行时间；厨房洗衣机，方便用餐整装</li>
                    <li>公寓周租月租超低折扣，区别于传统酒店，越住越省钱</li>
                </ol>
                <div class="comment">
                    <img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/user3.png">
                    <div>
                        <p><span>习先生</span>2015-07-21</p>
                        <q>非常好的酒店公寓，周围环境很好，是市中心，去各个景点都很方便而且很近，周围吃的东西也多。推开窗就是大海</q>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article class="list">
        <h2 class="title"><span>人均花费便宜50%</span></h2>
        <div class="box">
            <div class="img"><img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/tujia4.jpg" alt="">
            </div>
            <div class="txt">
                <ol>
                    <li>悦居租房房屋比同等酒店多出一倍面积，有客厅有厨房还带露台</li>
                    <li>两室一厅满足多人居住，高性价比让人印象深刻</li>
                    <li>新用户注册即送100元礼品卡，更有APP专享价等您预订</li>
                </ol>
                <div class="comment">
                    <img src="https://staticfile.tujia.com/mobile/images/h5/promotion/yhjy/user4.png">
                    <div>dockform-bg-div
                        <p><span>江女士</span>2014-08-01</p>
                        <q>房间住得很实惠，在网上拿的特惠价，这么好的风景，这么好的房间，总之总体感觉很好，下次还会选择入住悦居租房，去酒店的时候还在路上看到了兔子哦，可惜就是没有拍到照片。</q>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <footer class="about-yueju">

        <div class="info">
            <div class="logo"><img src="images/logo.png" alt="悦居租房-logo"></div>
            <div class="name">悦居租房在线信息技术(哈尔滨)有限公司</div>
            <div class="hotphone">客服热线： <a href="tel:4001881234">400-188-1234</a></div>
            <div class="link">联系我们：010-57619000 (转8000)</div>
        </div>
    </footer>

    <a class="tool-search" href="<?php echo site_url(); ?>">查找<br/>房屋</a>
</div>

<script>
    new Vue({
        el: '#app'
    });
</script>
</body>
</html>