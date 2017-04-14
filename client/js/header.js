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
})

/*
var vm = new Vue({
    el: '#header',
    data: {
        show:false
    },
    methods: {
        slide:function () {
            // console.log(1111);
            this.show = !this.show;
        }
    },
    mounted:function () {

    }
});
*/
function goBack(){ //暂时写死
    document.referrer === '' ?
        window.location.href = 'http://127.0.0.1/yuejum/' :
        window.history.go(-1);
}

