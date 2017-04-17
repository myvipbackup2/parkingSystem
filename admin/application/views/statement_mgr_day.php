<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'meta.php'; ?>

    <title>悦居后台管理系统 - 发票管理</title>

    <base href="<?php echo site_url(); ?>">

    <!--bootstrap-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">

    <!--jQuery UI-->
    <link href="css/jquery-ui-1.10.3.css" rel="stylesheet">

    <!--font awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!--datatables-->
    <link href="js/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!--icheck-->
    <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="js/iCheck/skins/minimal/red.css" rel="stylesheet">

    <!--gritter-->
    <link href="js/gritter/css/jquery.gritter.css" rel="stylesheet"/>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <style>
        #app table{
            width: 80%;
            margin: 50px auto 0;
        }
        #app .panel{
            margin-left: 20px;
            background: none;
        }
        #app table td,th{
            text-align: center;
            padding: 5px 10px;
            width: 250px;
            height: 10px;
            margin: 10px;
            border: 1px solid;
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

    <![endif]-->
</head>
<body class="sticky-header">
<section>
    <!-- left side start-->
    <?php include 'sidebar.php'; ?>
    <!-- left side end-->
    <div class="main-content">

        <!-- header section start-->
        <?php include 'header.php'; ?>
        <!-- header section end-->

        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                数据报表
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">首页</a>
                </li>
                <li class="active">
                    营业日报
                </li>
                <li><a href="statement/each_month_index"> 营业月报</a></li>
                <li><a href="statement/each_year_index">营业年报</a></li>
            </ul>
        </div>
        <!-- page heading end-->
        <div id="app">
            <my-statement></my-statement>
        </div>
    </div>
</section>
<script type="text/x-template" id="my-table">
    <div>
        <div class="panel">
            <select class="which-year" @click="getDays">
                <option :value="n" v-for="n in year">{{n}}</option>
            </select>
            <select class="which-month" @click="getDays">
                <option :value="n" v-for="n in month">{{n}}</option>
            </select>
            <select class="which-day">
                <option :value="n" v-for="n in day">{{ n }}</option>
            </select>
            <button class="query-statement" @click="test">查询</button>
            <button type="button" class="export">
                导出到Excel
            </button>
        </div>
        <table id="statement-table">
            <tr>
                <th>订单号</th>
                <th>生成时间</th>
                <th>订单状态</th>
                <th>支付方式</th>
                <th>退款方式</th>
                <th>房间信息</th>
                <th>用户姓名</th>
                <th>订单金额</th>
            </tr>
            <tr v-for="val in data">
                <td>{{ val.order_no }}</td>
                <td>{{ val.add_time }}</td>
                <td>{{ val.status }}</td>
                <td>{{ val.order_type }}</td>
                <td>{{ val.return_cash_pledge }}</td>
                <td>{{ val.title }}</td>
                <td>{{ val.rel_name }}</td>
                <td>{{ val.price }}</td>
            </tr>
            <tr>
                <td colspan="8">总金额:{{ allMount }}</td>
            </tr>
        </table>
    </div>

</script>
<script src="js/vue.js"></script>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
<script>
    $(function () {
        var dataArr = [];
        <?php foreach ($rs as $val){?>
        var data = {};
        data.order_no = '<?php echo $val->order_no?>';
        data.add_time = '<?php echo $val->add_time?>';
        data.status = '<?php echo $val->status?>';
        data.title = '<?php echo $val->title?>';
        data.rel_name = '<?php echo $val->rel_name?>';
        data.price = '<?php echo $val->price?>';
        data.order_type = '<?php echo $val->order_type?>';
        data.return_cash_pledge = '<?php echo $val->return_cash_pledge?>'
        dataArr.push(data);
        <?php }?>
        console.log(dataArr);
        Vue.component('my-statement',{
            template:'#my-table',
            data:function () {
                return {
                    data:dataArr,
                    year:['2017','2018','2019'],
                    month:12,
                    days:[31,28,31,30,31,30,31,31,30,30,31], //每个月对应天数的数组
                    day:31
                }
            },
            computed:{
                allMount:function () {
                    var all = 0;
                    for(var i=0;i<this.data.length;i++){
                        all += parseInt(this.data[i].price);
                    }
                    return all;
                }
            },
            //点击查询进行ajax查询
            methods:{
                test:function () {
                    //给单位的数字前面补零
                    var day = $('.which-day').val()<10?'0'+$('.which-day').val():$('.which-day').val();
                    var month = $('.which-month').val()<10?'0'+$('.which-month').val():$('.which-month').val();
                    var date = $('.which-year').val()+'-'+month+'-'+day;
                    console.log(date);
                    $.get('statement/get_each_day',{date:date},function (data) {
                        this.data = JSON.parse(data);
                    }.bind(this));
                },
                getDays:function () {
                    var year = $('.which-year').val();
                    //判断是否是闰年
                    if((year%4==0 && year%100!=0)&&(year%400==0)){
                        this.days[1] = 29;
                    }else{
                        this.days[1] = 28;
                    }
                    this.day = this.days[parseInt($('.which-month').val())];

                }
            }

        });
        new Vue({
            el:"#app",

        });
        $('.export').on('click',function () {
            $('#statement-table').table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "日度数据报表",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            })
        });
    });

</script>
</body>
</html>
