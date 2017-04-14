$(function () {
    var table = $('#user-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "user/user_mgr",
        "columns": [
            {
                "data": null, "orderable": false, width: "16px", "render": function (data, type, row) {
                return '<input type="checkbox" value="' + row.user_id + '" class="user-check"/>'
            }
            },
            {"data": "user_id"},
            {"data": "portrait"},
            {"data": "username"},
            {"data": "rel_name"},
            {"data": "tel"},
            {"data": "email"},
            null
        ],
        "columnDefs": [
            {"orderable": false, "targets": [1,2,5,6,7]},
            {
                "targets": 2,
                "data": null,
                "render": function (data, type, row) {
                    return "<img style='width: 50px;height: 50px;' src=" + YUEJU.pc.host + data + ">";
                },
            },
            {
                "targets": -1,
                "data": null,
                "render": function (data, type, row) {
                    return '<a href="javascript:;" class="user-edit">编辑</a> | <a href="javascript:;" class="send-message">发送消息</a>';
                },
            }
        ]
    });


    //增加按钮
    $('#btn-new').on('click', function () {
        $.sidepanel({
            width: 700,
            title: '添加新用户',
            tpl: 'new-user-tpl',
            callback: function () {
                $(".birthday").datepicker({
                    format: 'yyyy-mm-dd'
                });
                //用户名是否重复
                var $user_tip = $('#user-tip');
                $('#uname').on('blur', function () {
                    var $usernameVal = $(this).val().trim();
                    $.get('user/user_check_name', {
                        'username': $usernameVal
                    }, function (res) {
                        if (res === "success") {
                            $user_tip.hide();
                            $('#submit').removeAttr("disabled");
                        } else {
                            $user_tip.show();
                            $('#submit').attr("disabled", "true");
                        }
                    }, 'text');
                });

                //密码是否相同
                var $pwd_tip = $("#pwd-tip");
                $("#password2").on("blur", function () {
                    if ($("#password").val() != this.value) {
                        $pwd_tip.show();
                        $('#submit').attr("disabled", "true");
                    } else {
                        $pwd_tip.hide();
                        $('#submit').removeAttr("disabled");
                    }
                });

                //验证组件开始
                $.validator.setDefaults({
                    submitHandler: function () {
                        $('#add-user-form').submit();
                    }
                });

                $().ready(function () {
                    // validate the comment form when it is submitted
                    $("#add-user-form").validate({
                        rules: {
                            uname: {
                                required: true,
                                rangelength: [2, 10]
                            },
                            password: {
                                required: true,
                                rangelength: [2, 20]
                            },
                            email: {required: true},
                            relname: {required: true},
                            birthday: {required: true},
                            tel: {
                                required: true,
                                number: true
                            }
                        },
                        messages: {
                            uname: {
                                required: "忘记填写用户名啦",
                                rangelength: "标题长度要在1-10个字之间"
                            },
                            password: {
                                required: "忘记填写密码啦",
                                rangelength: "标题长度要在1-10个字之间"
                            },
                            relname: {
                                required : '忘记填写真实姓名啦'
                            },
                            name: {
                                required: "忘记填写密码名啦",
                                rangelength: "小区名称长度要在2-20个字之间"
                            },
                            address: "忘记填写小区详细地址啦",
                            birthday: '忘记填写出生日期啦',
                            email: {
                                required : '忘记填写邮箱啦'
                            },
                            tel: {
                                required: "忘记填写手机号码啦",
                                number: "填写有误，请填写数字"
                            }
                        }
                    });

                });
                //验证组件结束
            }
        });
    });

    $('#user-table tbody').on("click", ".user-edit", function (e) {

        var dataId = $(this).parent().parent().data('id');
        $.sidepanel({
            width: 700,
            title: '修改用户',
            tpl: 'edit-user-tpl',
            dataSource: 'user/user_detail',
            data: {
                userId: dataId
            },
            callback: function () {
                $(".birthday").datepicker({
                    format: 'yyyy-mm-dd'
                });
                $("input[name=sex]").each(function () {
                    if (this.value == $("input[name=sex_hidden]").val()) {
                        this.checked = true;
                    }
                });
                //用户名是否重复
                var $user_tip = $('#user-tip');
                $('#uname').on('blur', function () {
                    var $usernameVal = $(this).val().trim();
                    if ($usernameVal != this.defaultValue) {
                        $.get('user/user_check_name', {
                            'username': $usernameVal
                        }, function (res) {
                            if (res === "success") {
                                $user_tip.hide();
                                $('#submit').removeAttr("disabled");
                            } else {
                                $user_tip.show();
                                $('#submit').attr("disabled", "true");
                            }
                        }, 'text');
                    }
                });

                //密码是否相同
                var $pwd_tip = $("#pwd-tip");
                $("#password2").on("blur", function () {
                    if ($("#password").val() != this.value) {
                        $pwd_tip.show();
                        $('#submit').attr("disabled", "true");
                    } else {
                        $pwd_tip.hide();
                        $('#submit').removeAttr("disabled");
                    }
                });

                //...
                $('#btn-save').on('click', function () {
                    alert('save...');
                });


            }
        });
        e.preventDefault();
        e.stopPropagation();
    });

    //用户详情
    $('#user-table tbody').css({cursor: 'pointer'})
        .on('click', 'tr', function () {
            var dataId = $(this).data('id');
            $.sidepanel({
                width: 800,
                title: '用户详情',
                tpl: 'user-tpl',
                dataSource: 'user/user_detail',
                data: {
                    userId: dataId
                },
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作
                    var $sex_hidden = $("#sex_hidden");
                    if ($sex_hidden.val() == 1) {
                        $sex_hidden.next("p").html("男");
                    } else {
                        $sex_hidden.next("p").html("女");
                    }
                    $('#order-table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "user/user_orders?userId=" + dataId,
                        "columns": [
                            {"data": "order_id"},
                            {"data": "title"},
                            {"data": "start_time"},
                            {"data": "end_time"},
                            {"data": "price"},
                            {"data": "status"}
                        ],
                        "pageLength": 2
                    });

                    $('#message-table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "user/user_messages?userId=" + dataId,
                        "columns": [
                            {"data": "username"},
                            {"data": "add_time"},
                            {"data": "content"}
                        ],
                        "pageLength": 2
                    });


                    $('#myTabs a').click(function (e) {
                        //数据需要ajax操作，可以直接在这里$.get(...);

                        $(this).tab('show');
                        e.preventDefault();
                    });
                }
            });
        });

    //全选checkbox
    var $rowsCheckbox;
    $("#check-all").on("click", function () {
        $rowsCheckbox = $("#user-table .user-check");
        if (this.checked) {
            $rowsCheckbox.attr("checked", true);
        } else {
            $rowsCheckbox.attr("checked", false);
        }
    });

    //全部删除
    $("#btn-del").on("click", function () {
        if (confirm('是否删除记录，删除后可以在回收站恢复!')) {
            $rowsCheckbox = $("#user-table .user-check");
            var ids = "";
            $rowsCheckbox.each(function (index, elem) {
                if (this.checked) {
                    ids += this.value + ",";
                }
            });
            $.get('user/user_del_all', {ids: ids}, function (data) {
                if (data == 'success') {
                    table.ajax.reload(null, true);//重新加载数据
                    $.gritter.add({
                        title: '信息提示!',
                        text: '记录删除成功!'
                    });
                }
            }, 'text');
        }
    });

    $('#user-table tbody').on("click", ".send-message", function (e) {
        var dataId = $(this).parent().parent().data('id');
        $.sidepanel({
            width: 700,
            title: '发送消息',
            tpl: 'send-message-tpl',
            dataSource: 'user/user_send_message',
            data: {
                userId: dataId
            },
            callback: function () {
                var that = this;
                $("#send").on("click", function () {
                    $.get("message/message_add", {
                        receiver_id: $("input[name=receiver_id]").val(),
                        content: $("textarea[name=content]").val()
                    }, function (res) {
                        if (res == "success") {
                            $.gritter.add({
                                title: "消息提示!",
                                text: "消息发送成功!"
                            });
                            that.close();
                        } else {
                            $.gritter.add({
                                title: "消息提示!",
                                text: "消息发送失败!"
                            });
                        }
                    });
                });
            }
        });

        e.stopPropagation();
    }).on("click", ".user-check", function (e) {
        e.stopPropagation();
    });

});