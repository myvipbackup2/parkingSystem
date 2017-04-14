/**
 * Created by apple on 17/2/11.
 */
$(function(){


    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "invoice/invoice_create",
        "columns": [
            {"data": "order_id"},
            {"data": "add_time"},
            {"data": "invoice_title"},
            {"data": "price"},
            {"data": "username"},
            {"data": null}
        ],
        "columnDefs": [
            {"orderable": false, "targets": [0,2,3,4,5]},
            {"className": 'clicked-cell', "targets": [0,1,2,3,4]},
            {
                "targets": -1,
                "data": null,
                "render": function (data, type, row) {
                    if(row.is_invoice==0){
                        return "<span style='color: #f00;'>发票信息不完整</span>";
                    }else{
                        if(row.invoice_created==0){
                            return "<a href='javascript:;' class='get_invoice'>索取 <i class='fa fa-archive'></i></a>";
                        }else{
                            return "已索取";
                        }
                    }
                },
            }
        ],
        "order": [1, "desc"]
    });

    $("#example tbody").on('click','.get_invoice',function(e){
        e.stopPropagation();
        var orderId = $(this).parents('tr').data('id');
        var $self = $(this);
        $.get('invoice/update_voiced_state', {
            orderId: orderId
        }, function(data){
            if(data == 'success'){
                $self.parent().html('已索取');
            }
        }, 'text');
    });


    $('#example tbody').css({cursor: 'pointer'})
        .on('click', '.clicked-cell',function () {
            var orderId = $(this).parent().data('id');
            var $self = $(this);
            $.sidepanel({
                width: 700,
                title: '订单详情',
                tpl: 'order_detail-tpl',
                dataSource: 'order/order_detail',
                data: {
                    orderId: orderId
                },
                callback: function () {
                    $('#invoice_create').click(function (e) {
                        $that = $(this);
                        $.get('invoice/update_voiced_state', {
                            orderId: orderId
                        }, function(data){
                            if(data == 'success') {
                                $that.parents('.form-group').prev('.form-group').find('p').text('已索取');
                                $that.parents('.form-group').remove();
                                $self.parents('tr').find('.get_invoice').parent().text('已索取');
                            }
                        }, 'text');
                        $(this).tab('show');
                        e.preventDefault();
                    });
                }

            });
        });

});