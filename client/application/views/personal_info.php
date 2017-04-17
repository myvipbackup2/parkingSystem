<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>个人中心</title>
    <base href="<?php echo site_url(); ?>"/>
    <script src="js/rem.js"></script>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/mint-ui.min.css">
    <link rel="stylesheet" href="css/information.css"/>
    <link rel="stylesheet" href="css/webuploader.css">
    <style>
        .imgWrap {
            position: absolute;
            right: 0;
            width: .85rem;
            height: .85rem;
            opacity: 0;
            z-index: 99;
        }
    </style>
</head>
<body>
<div id="header">
    <a class="back" id="leftTopBtn" href="javascript:goBack()">&lt;&nbsp;随心停</a>
    <div class="title">
        个人中心
    </div>
    <a href="javascript:;" class="menu-btn">
    </a>
    <div id="menu-top">
        <ul>
            <li class="menu-home">
                <i class="iconfont icon-home"></i>
                <a href="welcome/index" data-stat-label="首页">
                    首页
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
                <i class="iconfont icon-message"></i><a href="Welcome/message" data-stat-label="消息">消息</a>
                <span class="msg">&nbsp;</span>
            </li>
        </ul>
    </div>
</div>
<div id="app" class="container">
    <div class="c-information">
        <div class="infor-photo clearfix" style="position: relative;">
            <span>头像</span>
            <div id="uploader-demo" class="clearfix">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div class="imgWrap">
                    <div id="filePicker"></div>
                </div>
            </div>
            <img id="imgHeader" src="<?php echo $row->portrait ?>" alt="">
        </div>
        <mt-field label="用户名" disabled="disabled" placeholder="请输入用户名" v-model="username"></mt-field>
        <mt-field label="手机号" disabled="disabled" placeholder="请输入手机号" v-model="usertel" type="tel"></mt-field>
        <mt-field label="邮箱" placeholder="请输入邮箱" v-model="useremail" :state="emailState" type="email"></mt-field>
    </div>
    <h2 class="infor-title">个人资料</h2>
    <div class="c-information">
        <mt-field label="真实姓名" placeholder="请输入真实姓名" v-model="relname" :state="relNameState"></mt-field>
        <mt-field label="性别" v-model="sex" disabled="disabled"></mt-field>
        <mt-radio
                v-model="sex"
                :options="['男', '女']">
        </mt-radio>
        <mt-field label="身份证号" placeholder="请输入身份证号" v-model="idcard" :state="relIdCardState"></mt-field>
        <mt-cell title="修改密码" to="Welcome/pwdManage" is-link></mt-cell>
        <input class="infor-btn" @click="handleClick" type="submit" value="确定"/>
    </div>
    <!--错误弹层-->
    <div class="mint-msgbox-wrapper" style="position: absolute; z-index: 1000;">
        <div class="mint-msgbox" v-show="msgShow" style="display:none;">
            <div class="mint-msgbox-header">
                <div class="mint-msgbox-title">{{errTitle}}</div>
            </div>
            <div class="mint-msgbox-content">
                <div class="mint-msgbox-message">
                    {{errMsg}}
                    <mt-spinner v-show="spinnerShow" type="snake" color="#ff4081" :size="30"></mt-spinner>
                </div>
            </div>
            <div class="mint-msgbox-btns" v-show="btnShow">
                <button @click="closeMsg" class="mint-msgbox-btn mint-msgbox-confirm ">确定</button>
            </div>
        </div>
    </div>
    <div class="v-modal" v-show="modalShow" style="z-index: 999;display: none"></div>
</div>

<script src="js/zepto.js"></script>
<script src="js/vue.min.js"></script>
<script src="js/axios.min.js"></script>
<script src="js/mintUI.min.js"></script>
<script src="js/header.js"></script>
<script src="js/webuploader.custom.min.js"></script>
<script>
    //    头像上传功能
    $(function () {
        var $list = $('#fileList'),
            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,

            // 缩略图大小
            thumbnailWidth = 100 * ratio,
            thumbnailHeight = 100 * ratio,

            // Web Uploader实例
            uploader;

        // 初始化Web Uploader
        uploader = WebUploader.create({

            // 自动上传。
            auto: true,

            // swf文件路径
//            swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '<?php echo site_url(); ?>/welcome/user_head_upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 当有文件添加进来的时候
        uploader.on('fileQueued', function (file) {
            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
//                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                ),
                $img = $li.find('img');

//            $list.append($li);

            $('#imgHeader').remove();
            $list.html($li); //替换原来上传的头像

            // 创建缩略图
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $img.replaceWith('<span>预览出错</span>');
                    return;
                }

                $img.attr('src', src);
            }, thumbnailWidth, thumbnailHeight);
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function (file, percentage) {
            var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo($li)
                    .find('span');
            }

            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function (file, response) {
            var imgurl = response.url;
            vm.headImg = imgurl;
            $('#' + file.id).addClass('upload-state-done');
        });

        // 文件上传失败，现实上传出错。
        uploader.on('uploadError', function (file) {
            var $li = $('#' + file.id),
                $error = $li.find('div.error');

            // 避免重复创建
            if (!$error.length) {
                $error = $('<div class="error"></div>').appendTo($li);
            }

            $error.text('上传失败');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function (file) {
            $('#' + file.id).find('.progress').remove();
        });
    });
</script>
<script>
    var vm = new Vue({
        el: "#app",
        data: {
            username: "<?php echo $row->username ?>",
            usertel: "<?php echo $row->tel ?>",
            useremail: "<?php echo $row->email ?>",
            relname: "<?php echo $row->rel_name ?>",
            sex: "<?php echo $row->sex ?>",
            idcard: "<?php echo $row->id_card ?>",
            msgShow: false,
            modalShow: false,
            spinnerShow: false,
            btnShow: false,
            errTitle: '修改失败',
            errMsg: '',
            headImg: '<?php echo $row->portrait?>'
        },
        methods: {
            checkEmail: function () {
                if (!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(this.useremail))) {
                    return false;
                }
                return true;
            },
            checkRealName: function () {
                if (!(/^([\u4e00-\u9fa5]{1,10}|[a-zA-Z\.\s]{1,10})$/.test(this.relname))) {
                    return false;
                }
                return true;
            },
            checkrelIdCard: function () {
                if (!(/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/.test(this.idcard))) {
                    return false;
                }
                return true;
            },
            handleClick: function () {
                if (!this.checkEmail()) {
                    this.errTitle = '邮箱错误';
                    this.errMsg = '请填写正确邮箱!';
                    this.showMsg();
                } else if (!this.checkRealName()) {
                    this.errTitle = '姓名错误';
                    this.errMsg = '请填写真实姓名!';
                    this.showMsg();
                } else if (!this.checkrelIdCard()) {
                    this.errTitle = '身份证错误';
                    this.errMsg = '请填写正确身份证号!';
                    this.showMsg();
                } else {
                    this.errTitle = '正在提交修改';
                    this.errMsg = '';

                    this.btnShow = false;
                    this.spinnerShow = true;
                    var _this = this;
                    var params = new URLSearchParams();
                    params.append('useremail', this.useremail);
                    params.append('relname', this.relname);
                    params.append('sex', this.sex);
                    params.append('idcard', this.idcard);
                    params.append('headImg', this.headImg);
                    axios.post('user/update_user_info', params).then(function (response) {
                        if (response.data === 'fail') {
                            _this.errTitle = '修改失败';
                            _this.errMsg = '网络异常，请重试!';
                            _this.showMsg();
                        } else if (response.data === 'success') {
                            _this.errTitle = '修改成功';
                            _this.errMsg = 'ok!';
                            _this.showMsg();
                        } else {
                            _this.errTitle = '网络异常';
                            _this.errMsg = '请重新再试!';
                            _this.showMsg();

                        }
                    }).catch(function (error) {
                        _this.errTitle = '未知错误';
                        _this.errMsg = '请重新再试!';
                        _this.showMsg();
                        console.log(error);
                    });
                }

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
            }
        },
        computed: {
            emailState: function () {
                if (this.useremail === '') {
                    return 'warning';
                } else if (!this.checkEmail()) {
                    return 'error';
                }
                return 'success';
            },
            relNameState: function () {
                if (this.relname === '') {
                    return 'warning';
                } else if (!this.checkRealName()) {
                    return 'error';
                }
                return 'success';
            },
            relIdCardState: function () {
                if (this.idcard === '') {
                    return 'warning';
                } else if (!this.checkrelIdCard()) {
                    return 'error';
                }
                return 'success';
            }
        }
    })
</script>
</body>
</html>