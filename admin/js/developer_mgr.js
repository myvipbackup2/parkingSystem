$(function () {
    var table = $('#developer-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "developer/developer_mgr",
        "columns": [
            {
                "data": null, "orderable": false, width: "16px", "render": function (data, type, row) {
                return '<input type="checkbox" value="' + row.developer_id + '" class="developer-check"/>'
            }
            },
            {"data": "developer_id"},
            {"data": "logo"},
            {"data": "developer_name"},
            {"data": "address"},
            {"data": "telephone"},
            null
        ],
        "columnDefs": [
            {"orderable": false, "targets": [1,2,5,6]},
            {
                "targets": 2,
                "data": null,
                "render": function (data, type, row) {
                    return "<img style='width: 50px;height: 50px;' src=" + data + ">";
                },
            },
            {
                "targets": -1,
                "data": null,
                "render": function (data, type, row) {
                    return '<a href="javascript:;" class="developer-edit">编辑</a>';
                },
            }
        ]
    });


    //增加
    $('#btn-new').on('click', function () {
        $.sidepanel({
            width: 700,
            title: '添加开发商',
            tpl: 'new-developer-tpl',
            callback: function () {
                $(".founding-time").datepicker({
                    format: 'yyyy-mm-dd'
                });
                //实例化编辑器
                UE.delEditor('new-container');
                var ue = UE.getEditor('new-container');
                //用户名是否重复
                var $user_tip = $('#user-tip');
                $('#developer-name').on('blur', function () {
                    var $developernameVal = $(this).val().trim();
                    $.get('developer/developer_check_name', {
                        'developer_name': $developernameVal
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

                //验证组件开始
                $.validator.setDefaults({
                    submitHandler: function () {
                        $('#add-developer-form').submit();
                    }
                });

                $().ready(function () {
                    // validate the comment form when it is submitted
                    $("#add-developer-form").validate({
                        rules: {
                            developer_name: {
                                required: true,
                                rangelength: [2, 30]
                            }
                        },
                        messages: {
                            developer_name: {
                                required: "忘记填写开发商名称啦",
                                rangelength: "标题长度要在1-20个字之间"
                            }
                        }
                    });

                });
                //验证组件结束
            }
        });
    });

    //编辑
    $('#developer-table tbody').on("click", ".developer-edit", function (e) {

        var dataId = $(this).parent().parent().data('id');
        $.sidepanel({
            width: 700,
            title: '修改开发商',
            tpl: 'edit-developer-tpl',
            dataSource: 'developer/developer_edit',
            data: {
                developerId: dataId
            },
            callback: function () {
                $(".founding-time").datepicker({
                    format: 'yyyy-mm-dd'
                });
                //实例化编辑器
                UE.delEditor('new-container');
                var ue = UE.getEditor('new-container');
                ue.ready(function() {
                    //设置编辑器的内容
                    ue.setContent($('#description').val());
                });

            }
        });
        e.preventDefault();
        e.stopPropagation();
    });

    //详情
    $('#developer-table tbody').css({cursor: 'pointer'})
        .on('click', 'tr', function () {
            var dataId = $(this).data('id');
            $.sidepanel({
                width: 800,
                title: '开发商详情',
                tpl: 'developer-tpl',
                dataSource: 'developer/developer_detail',
                data: {
                    developerId: dataId
                },
                callback: function () {//sidepanel显示后的后续操作，主要是针对sidepanel中的元素的dom操作
                    $('#house-table').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "developer/developer_house?developerId=" + dataId,
                        "columns": [
                            {"data": "title"},
                            {"data": "price"},
                            {"data": "area"}
                        ],
                        "pageLength": 2
                    });
                }
            });
        }).on("click", ".developer-check", function (e) {
            e.stopPropagation();
    });

    //全选checkbox
    var $rowsCheckbox;
    $("#check-all").on("click", function () {
        $rowsCheckbox = $("#developer-table .developer-check");
        if (this.checked) {
            $rowsCheckbox.attr("checked", true);
        } else {
            $rowsCheckbox.attr("checked", false);
        }
    });

    //全部删除
    $("#btn-del").on("click", function () {
        if (confirm('是否删除记录，删除后可以在回收站恢复!')) {
            $rowsCheckbox = $("#developer-table .developer-check");
            var ids = "";
            $rowsCheckbox.each(function (index, elem) {
                if (this.checked) {
                    ids += this.value + ",";
                }
            });
            $.get('developer/developer_del_all', {ids: ids}, function (data) {
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