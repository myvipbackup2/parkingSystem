/**
 * 侧面面板
 */
;(function ($) {
    var $html = $("html");//获得html根元素

    var panel = {
        width: 700,
        init: function () {
            $html.getNiceScroll().hide();//获取niceScoll自定义滚动条组件并隐藏，防止弹出的mask层不能全部覆盖屏幕

            //构造dom对象
            this.mask = $('<div class="side-panel-mask"></div>');
            this.content = $('<div class="side-panel"></div>');
            this.header = $('<div class="side-panel-header panel-heading"><span class="tools panel-close"><a href="javascript:;" class="fa fa-times"></a></span></span></div>');
            this.body = $('<div class="side-panel-body"></div>');
            this.closeBtn = this.header.children('.panel-close');
            this.loading = $('<div class="side-panel-loading"></div>');


            if (panel.dataSource) {
                //加载数据
                panel.loadData();
            } else {
                panel.render();
            }

        },
        close: function () {//关闭sidepanel
            this.content.animate({right: -panel.width}, function () {
                panel.content.remove();
                panel.mask.remove();
                $html.getNiceScroll().show();//重新显示niceScoll
            });
        },
        loadData: function (render) {
            $.get(panel.dataSource, panel.data, function (tplData) {
                if (tplData.err) {
                    $.gritter.add({
                        title: '信息提示!',
                        text: tplData.err
                    });
                } else {
                    panel.render(tplData);
                }
            }, 'json');
        },
        render: function (tplData) {

            var tplHtml = $('#' + panel.tpl).html();
            if (tplData) {
                tplHtml = template(panel.tpl, tplData);//填充模板
            }

            //生成dom结构
            panel.loading.appendTo(this.body);//显示loading提示
            panel.header.append(panel.title).appendTo(panel.content);
            panel.closeBtn.on('click', function () {
                panel.close();
            });
            panel.body.append(tplHtml).appendTo(panel.content);
            panel.content.css({
                width: panel.width,
                right: -panel.width
            }).appendTo(document.body);
            panel.body.niceScroll({
                styler: "fb",
                cursorcolor: "#65cea7",
                cursorwidth: '6',
                cursorborderradius: '0px',
                background: '#424f63',
                spacebarenabled: false,
                cursorborder: '0'
            });

            panel.mask.on('click', function () {
                panel.close();
            }).appendTo(document.body);

            panel.callback && panel.callback();

            //从侧边滑出
            panel.content.animate({
                right: 0
            });

            //关闭loading提示
            panel.loading.remove();
        }
    };

    $.sidepanel = function (option) {

        panel = $.extend(panel, option);

        panel.init();

    };

})(jQuery);
