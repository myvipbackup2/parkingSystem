/**
 * Created by apple on 17/2/11.
 */
$(function(){


    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "invoice/invoice_mgr",
        "columns": [
            {"data": "order_id"},
            {"data": "invoice_no"},
            {"data": "invoice_title"},
            {"data": "invoice_time"},
            {"data": "price"},
            {"data": "username"},
            {
                "data": null,
                "render": function (data, type, row) {
                    if(row.invoice_posted == 1){
                        return "已邮寄";
                    }else{
                        return "<a href='javascript:;' class='is_post'>未邮寄 <i class='fa fa-envelope-o'></i></a>";
                    }
                }
            }
        ],
        "columnDefs": [
            {"orderable": false, "targets": [0,1,2,4,5,6]},
            {"className": "clicked-cell", "targets": [0,1,2,3,4,5]}
        ],
        "order": [3, "desc"]
    });


    $("#example tbody").on('click','.is_post',function(e){
        e.stopPropagation();
        var orderId = $(this).parents('tr').data('id');
        var $self = $(this);
        $.get('invoice/update_post_state', {
            orderId: orderId
        }, function(data){
            if(data == 'success'){
                //$self.parent('.post_state').html('已邮寄');
                $self.parent().html('已邮寄');
            }
        }, 'text');


    });


    $('#example tbody').css({cursor: 'pointer'}).on('click', '.clicked-cell', function () {
            var orderId = $(this).parent().data('id');
            var $self = $(this);
            $.sidepanel({
                width: 700,
                title: '发票详情',
                tpl: 'invoice_detail-tpl',
                dataSource: 'order/order_detail',
                data: {
                    orderId: orderId
                },
                callback: function () {
                    $('#invoice_post').click(function (e) {
                        $that = $(this);
                        $.get('invoice/update_post_state', {
                            orderId: orderId
                        }, function(data){
                            if(data == 'success'){
                                $that.parents('.form-group').prev('.form-group').find('p').text('已邮寄');
                                $that.parents('.form-group').remove();
                                // $self.find('.is_post').parent().html('已邮寄');
                                $self.parents('tr').find('.is_post').parent().html('已邮寄');
                            }
                        }, 'text');
                        $(this).tab('show');
                        e.preventDefault();
                    });
                }

            });
        });


});