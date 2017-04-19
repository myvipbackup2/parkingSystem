$(function(){
    $('.menu-btn').on('click',function(e){
        $('#menu-top').toggle();
        // e.preventDefault();
    });
    $(document).on('click',function(e){
        if(!$(e.target).is('.menu-btn') && !$(e.target).is('#menu-top') && $(e.target).parent('#menu-top').length === 0){
            $('#menu-top').css('display','none');
        }
        // e.preventDefault();
    });
});


function goBack(){
    document.referrer === '' ?
        window.location.href = 'http://127.0.0.1/parkingSystem/client/' : window.history.go(-1);
}

