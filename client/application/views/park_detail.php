<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="孟昊阳20134200"/>
    <meta name="description" content="孟昊阳20134200"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>车位详情</title>
    <base href="<?php echo site_url(); ?>"/>
    <!-- 引入样式 -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <link rel="stylesheet" href="css/parkDetail.css">
    <link rel="stylesheet" href="css/parkMap.css">
    <!-- 引入组件库 -->
    <script src="js/vue.min.js"></script>
    <script src="js/mintUI.min.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="js/rem.js"></script>
</head>
<body>

<div id="app">
    <?php include "header.php" ?>
    <!--车库详情-->
    <div class="park_detail">
        <!--焦点图-->
        <div class="swipe">
            <div class="favorite" @click="checkLogin('add_favorite')" :class="sel"></div>
            <mt-swipe :show-indicators="true" :auto="2500">
                <?php foreach ($park->park_imgs as $img) { ?>
                    <mt-swipe-item><img src="<?php echo ADMINPATH . $img->img_src; ?>" alt=""></mt-swipe-item>
                <?php } ?>
            </mt-swipe>
        </div>
        <!--标题-->
        <ul class="park-title">
            <li class="base-info">
                <h2><?php echo $park->title ?></h2>
                <div class="price"><em id="spnDisplayPrice"><sub>¥</sub><?php echo $park->price ?>/小时</em></div>
            </li>
        </ul>
        <div class="fd mod-support">
            <h3 class="title">
                <?php echo $park->plot_name ?>停车场
            </h3>
            <ul>
                <!--                <li class="s-hx">-->
                <!--                    --><?php //echo $park->bedroom ?><!--m宽--><?php //echo $park->livingroom ?>
                <!--                    m长--><?php //echo $park->lavatory ?><!--个车锁-->
                <!--                </li>-->

                <li class="s-mj"><?php echo $park->area ?>㎡</li>
            </ul>
        </div>

        <div class="fd mod-management">
            <div class="icon" data-name="hotel_avatar" data-url="/hotel/index/3054/">
                <img src="<?php echo ADMINPATH . $park->logo ?>">
                <span><?php echo $park->developer_name ?></span>
            </div>

            <h2 class="title">车位可售<span class="sale_price"><?php echo $park->sale_price ?></span>万</h2>

            <div class="hotline">
                <em>4008-123-123</em><i>转</i><em>20134200</em>
            </div>
            <div class="link">
                <a href="tel:4008123123">电话咨询</a>
            </div>
        </div>
    </div>
    <!--点评-->
    <div class="mod-comments">
        <div class="bd">
            <ul class="score">
                <li id="overall"><em>{{totalScore}}</em>评分</li>
                <li id="totalCount" class="border-l"><em>{{totalComment}}</em>点评</li>

            </ul>
            <div id="sampleComment" class="quote">
                <div class="quote-content">
                    <p>{{latestComment}}</p>
                </div>
            </div>
            <div class="button-orange-l">
                <span id="commentsInfo" @click="getComment">全部</span>
            </div>
        </div>
    </div>
    <!--停车离开时间-->
    <div class="sec-content mod-park DatePicker">
        <!-- 修改停车时间 -->
        <div class="hd date">
            <div class="edi"><span>停车时间：</span><span>{{formatStart}}点</span></div>
            <div class="button-orange-l" @click="openStartPicker"><span>修改</span></div>
            <template>
                <mt-datetime-picker
                        ref="pickerStart"
                        type="datetime"
                        v-model="startDate">
                </mt-datetime-picker>
            </template>
        </div>
        <!-- 修改离开时间 -->
        <div class="hd date">
            <div class="edi"><span>离开时间：</span><span>{{formatEnd}}点</span></div>
            <div class="button-orange-l" @click="openEndPicker"><span>修改</span></div>
            <template>
                <mt-datetime-picker
                        ref="pickerEnd"
                        type="datetime"
                        v-model="endDate">
                </mt-datetime-picker>
            </template>
        </div>
    </div>
    <!--车位图-->
    <div id="main">
        <div class="demo">
            <div id="seat-map">
                <div class="front">车位状态图</div>
            </div>
            <div id="legend"></div>
            <div style="clear:both"></div>
        </div>

        <br/>
    </div>
    <!--订购-->
    <ul class="product-list">
        <li class="panel unitproduct ">
            <div class="panel-hd folder-title folder-title-fold">
                <div class="info">
                    <h3>
                        按小时收费
                    </h3>
                    <p class="service">
                        <span>预付全额</span>
                        <span>可退</span>
                    </p>
                </div>
                <div class="price">

                    <div class="price-member">
                        <em>¥<?php echo $park->price ?></em>
                    </div>

                    <button @click="checkLogin('checkDate')" class="aCreateOrder book button-orange">
                        立即预订
                    </button>
                </div>
            </div>
        </li>
        <?php if (count($park->park_combos) > 0) {
            foreach ($park->park_combos as $index => $combo) {
                echo '<li class="panel unitproduct">';
                echo '<div class="panel-hd folder-title folder-title-fold">';
                echo '<div class="info">';
                echo '<h3>' . $combo->title . '</h3>';
                echo '<p class="service"><span>预付全额</span><span>可退</span></p>';
                echo '</div>';
                echo '<div class="price">';
                echo '<div class="price-member"><em>¥' . $combo->price . '</em></div>';
                echo '<button @click="checkDate" class="aCreateOrder book button-orange">立即预订</button>';
                echo '</div>';
                echo '</div>';
                echo '</li>';
            }

        } ?>
    </ul>
    <!--地图-->
    <div class="title"><?php echo $park->title ?></div>
    <div id="bMap"></div>
    <!--房源信息-->
    <section class="sec-content mod-park-info">
        <h3>车位信息</h3>
        <div class="info" v-html="parkDetail"></div>
        <div class="button-orange-l">
            <span @click="show">详情</span>
        </div>
    </section>
    <!--房屋设施-->
    <section class="mod-facality">
        <h3>车位设施与服务</h3>
        <div class="service-icons">
            <?php
            foreach ($park->free_facilities as $facility) {
                echo '<span class="icon-facility">' . $facility->name . '<img src= "' . ADMINPATH . $facility->icon . '" alt=""></span>';
            }
            ?>
        </div>
    </section>
    <!--提供服务-->
    <ul class="list">
        <li class="support">
            <h3>可付费服务</h3>
            <div class="able-list">
                <?php
                foreach ($park->pay_facilities as $facility) {
                    echo '<span>' . $facility->name . '</span>';
                }
                ?>
                <span v-if="!<?php echo count($park->pay_facilities) ?>">暂时没有付费服务...</span>
            </div>
        </li>

    </ul>

    <!--错误弹层-->
    <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1000;">
        <div class="mint-msgbox" v-show="msgShow" style="display:none;">
            <div class="mint-msgbox-header">
                <div class="mint-msgbox-title">{{errTitle}}</div>
            </div>
            <div class="mint-msgbox-content">
                <div class="mint-msgbox-message" v-html="errMsg"></div>
                <mt-spinner v-show="spinnerShow" type="snake" color="#ff4081" :size="30"></mt-spinner>
            </div>
            <div class="mint-msgbox-btns" v-show="btnShow">
                <button @click="closeMsg" class="mint-msgbox-btn mint-msgbox-confirm ">确定</button>
            </div>
        </div>
    </div>
    <div class="v-modal" v-show="modalShow" style="z-index: 999;display: none"></div>

    <div v-show="isShow" style="display: none;">
        <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1011;">
            <div class="mint-msgbox">
                <div class="mint-msgbox-header">
                    <div class="mint-msgbox-title">提示</div>
                </div>
                <div class="mint-msgbox-content">
                    <div class="mint-msgbox-message">您尚未登录,请先登录?</div>
                    <div class="mint-msgbox-input" style="display: none;"><input placeholder="" type="text">
                        <div class="mint-msgbox-errormsg" style="visibility: hidden;"></div>
                    </div>
                </div>
                <div class="mint-msgbox-btns">
                    <button class="mint-msgbox-btn mint-msgbox-cancel " @click="isConfirm(false)">取消</button>
                    <button class="mint-msgbox-btn mint-msgbox-confirm " @click="isConfirm(true)">确定</button>
                </div>
            </div>
        </div>
        <div class="v-modal" style="z-index: 1010;"></div>
    </div>

</div>
<script src="js/jquery.min.js"></script>
<script src="js/header.js"></script>
<script>
    document.oncontextmenu = new Function("event.returnValue=false;");
    document.onselectstart = new Function("event.returnValue=false;");
</script>
<script type="text/javascript" src="js/jquery.seat-charts.min.js"></script>
<script type="text/javascript">
    var price = 80; //票价
    var clickCount = 0;
    var hasSelect = false;
    $(document).ready(function () {
        var $cart = $('#selected-seats'), //座位区
            $counter = $('#counter'), //票数
            $total = $('#total'); //总计金额

        var sc = $('#seat-map').seatCharts({
            map: <?php echo $arr;?> ,
//            map:
//                [//座位图
//                'aaaaaaaaaa',
//                'aaaaaaaaaa',
//                '__________',
//                'aaaaaaaa__',
//                'aaa____aaa',
//                'aaaaaaaaaa',
//                'aaaaaaaaaa',
//                'aaaaaaaaaa',
//                'aaaaaaaaaa',
//                'aa__aa'
//            ],
            naming: {
                top: false,
                getLabel: function (character, row, column) {
                    return column;
                }
            },
            legend: { //定义图例
                node: $('#legend'),
                items: [
                    ['a', 'available sal', '可选座'],
                    ['a', 'unavailable out', '已售出']
                ]
            },
            click: function () { //点击事件
                if (this.status() == 'available') { //可选座
                    $('<li>' + (this.settings.row + 1) + '排' + this.settings.label + '号</li>')
                        .attr('id', 'cart-item-' + this.settings.id)
                        .data('seatId', this.settings.id)
                        .appendTo($cart);
                    clickCount++;
                    console.log(clickCount);
                    $counter.text(sc.find('selected').length + 1);
                    $total.text(recalculateTotal(sc) + price);
                    return 'selected';
                } else if (this.status() == 'selected') { //已选中
                    //更新数量
                    $counter.text(sc.find('selected').length - 1);
                    //更新总计
                    $total.text(recalculateTotal(sc) - price);
                    clickCount--;
                    console.log(clickCount);
                    //删除已预订座位
                    $('#cart-item-' + this.settings.id).remove();
                    //可选座
                    return 'available';
                } else if (this.status() == 'unavailable') { //已售出
                    return 'unavailable';
                } else {
                    return this.style();
                }
            }
        });
        //已售出的座位
        sc.get(['1_1', '4_4', '4_5', '6_6', '6_7', '8_5', '8_6', '8_7', '8_8', '10_1', '10_2']).status('unavailable');
    });
    //计算总金额
    function recalculateTotal(sc) {
        var total = 0;
        sc.find('selected').each(function () {
            total += price;
        });
        return total;
    }


    new Vue({
        el: '#app',
        data: {
            startDate: "<?php echo date("Y-m-d H"); ?>",
            endDate: "<?php echo date("Y-m-d H", strtotime("+1 hour")); ?>",
            showDetail: false,
            parkDetail: '<?php echo $park->description ?>',
            sel: '<?php echo $is_collect ? "sel" : "" ?>',
            parkId: <?php echo $park->park_id?>,
            totalScore: 5,
            totalComment: 0,
            popupVisible: true,
            latestComment: "暂时没有人评论...",
            msgShow: false,
            modalShow: false,
            spinnerShow: false,
            btnShow: false,
            errTitle: '预订失败',
            errMsg: '该时段车位不可用!',
            isShow: false,
            isSale : <?php echo $park->is_sale?>
        },
        methods: {
            getComment: function () {
                if (this.latestComment === "暂时没有人评论...") {
                    this.errTitle = '没有评论';
                    this.errMsg = '暂时没有人评论...';
                    this.showMsg();
                } else {
                    this.errTitle = '评论加载中';
                    this.errMsg = '';
                    this.showMsg();
                    this.btnShow = false;
                    this.spinnerShow = true;
                    window.location = 'park/get_comment_parkId?park_id=<?php echo $park->park_id?>';
                }
            },
            openStartPicker: function () {
                this.$refs.pickerStart.open();
            },
            openEndPicker: function () {
                this.$refs.pickerEnd.open();
            },
            show: function () {
                this.errTitle = '车库详情';
                this.errMsg = this.parkDetail;
                this.showMsg();
            },
            closeMsg: function () {
                this.msgShow = false;
                this.modalShow = false;
            },
            showMsg: function () {
                this.msgShow = true;
                this.modalShow = true;
                this.btnShow = true;
                this.spinnerShow = false;
            },
            post: function (URL, PARAMS) {  //自己封装的post方法
                var temp = document.createElement("form");
                temp.action = URL;
                temp.method = "post";
                temp.style.display = "none";
                for (var x in PARAMS) {
                    var opt = document.createElement("textarea");
                    opt.name = x;
                    opt.value = PARAMS[x];
                    temp.appendChild(opt);
                }
                document.body.appendChild(temp);
                temp.submit();
                return temp;
            },
            formatDate: function (DateStr) {
                DateStr = Date.parse(DateStr); //字符串转成时间戳
                var oDate = new Date();
                oDate.setTime(DateStr);
                var y = oDate.getFullYear();
                var M = oDate.getMonth() + 1;
                var d = oDate.getDate();
                var h = oDate.getHours();
                var dateFormat = y + '-' + M + '-' + d + ' ' + h;
                return dateFormat;
            },
            computeDays: function (s, e) {  //前端验证预约车位日期
                var sdate = new Date(s.replace(/-/g, "/"));
                var edate = new Date(e.replace(/-/g, "/"));
                var days = edate.getTime() - sdate.getTime();
                return parseInt(days / (1000 * 60 * 60 * 24));
            },
            add_favorite: function () {  //收藏
                var _this = this;
                if (this.sel === '') {
                    axios.get('park/add_collect', {
                        params: {
                            parkId: _this.parkId
                        }
                    }).then(function (res) {
                        if (res.data === 'success') {
                            _this.sel = 'sel';
                        } else {
                            var ret = window.confirm("您尚未登录，请先登录！ ");
                            if (ret) {
                                window.location.href = "welcome/loginView";
                            }
                        }
                    });
                } else {
                    axios.get('park/remove_collect', {
                        params: {
                            parkId: _this.parkId
                        }
                    }).then(function (res) {
                        if (res.data === 'success') {
                            _this.sel = '';
                        } else {
                            var ret = window.confirm("您尚未登录，请先登录！ ");
                            if (ret) {
                                window.location.href = "welcome/loginView";
                            }
                        }
                    });
                }
            },
            checkLogin: function (callback) {
                _this = this;
                axios.get('user/check_login', {
                    params: {}
                }).then(function (res) {
                    var result = res.data;
                    if (result === 'fail') {
                        _this.isShow = true;
                    } else {
                        _this[callback]();
                    }
                });
            },
            isConfirm: function (isGo) {
                var _this = this;
                if (isGo) {
                    //点击确定登录按钮 跳到登录页
                    window.location.href = "welcome/loginView";
                } else {
                    _this.isShow = false;
                }
            },
            checkDate: function () {  //检测车位是否可定
                this.errTitle = '正在预订中';
                this.errMsg = '';
                this.showMsg();
                this.btnShow = false;
                this.spinnerShow = true;
                if (this.computeDays(this.formatStart, this.formatEnd) < 1) {
                    this.errTitle = '预订失败';
                    this.errMsg = '停车时间段错误!';
                    this.showMsg();
                    return;
                }
                var _this = this;
                var params = new URLSearchParams();
                params.append('startDate', this.formatStart);
                params.append('endDate', this.formatEnd);
                params.append('parkId', <?php echo $park->park_id?>);
                axios.post('park/is_free_park', params).then(function (response) {
                    if (response.data === 'un-sale') {
                        _this.errTitle = '预订失败';
                        _this.errMsg = '该时段车位已被预订!';
                        _this.showMsg();
                    } else if (response.data === 'on-sale') {
                        _this.post('order/park_order', {
                            'startDate': _this.formatStart,
                            'endDate': _this.formatEnd,
                            'parkId': <?php echo $park->park_id?>,
                            'clickCount': _this.clickCount
                        });
                    } else {
                        _this.errTitle = '网络错误';
                        _this.errMsg = '预订失败，请重新再试!';
                        _this.showMsg();
                    }
                }).catch(function (error) {
                    _this.errTitle = '未知错误';
                    _this.errMsg = '预订失败，请重新再试!';
                    _this.showMsg();
                    console.log(error);
                });
            }
        },
        mounted: function () {  //页面加载完成获取评分
            var _this = this;
            this.$nextTick(function () {
                axios.get('park/get_comments/' +<?php echo $this->uri->segment(3);?>, {
                    params: {}
                }).then(function (res) {
                    var result = res.data;
                    _this.latestComment = result.data[0].content;
                    _this.totalScore = result.score.total_score.substr(0, 3); //评分截取3位包括小数点
                    _this.totalComment = result.total;
                });
            });
        },
        computed: {
            formatStart: function () {
                return this.formatDate(this.startDate);
            },
            formatEnd: function () {
                return this.formatDate(this.endDate);
            }
        }
    });
</script>
<!--百度地图-->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=9w3UCQ9fjQApIUUGxwUu2YDArBsGanOG"></script>
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("bMap");    // 创建Map实例
    var point = new BMap.Point(<?php echo $park->plot_pos?>); //默认定位的坐标
    map.centerAndZoom(point, 20);//中心点和缩放级别
    // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint("<?php echo $park->title ?>", function (point) { //这里输入房源地址，百度地图自动定位坐标
        if (point) {
            map.centerAndZoom(point, 20);
            map.addOverlay(new BMap.Marker(point));
        } else {
            console.log("百度地图地址没有解析到结果!");
        }
    }, "哈尔滨");
</script>

</body>
</html>