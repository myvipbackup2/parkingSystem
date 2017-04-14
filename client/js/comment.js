$(function ($) {
    $.fn.slideDown = function (duration) {
        var position = this.css('position');
        this.show();
        this.css({
            position: 'absolute',
            visibility: 'hidden'
        });
        var height = this.height();
        this.css({
            position: position,
            visibility: 'visible',
            overflow: 'hidden',
            height: 0
        });
        this.css({
            height: height
        }, duration);
    };
    $.fn.slideUp = function (duration) {
        this.css({
            height: 0
        }, duration);
    };
});

$('.left-all').on('tap', function () {
    $(this).addClass('current').siblings('div').removeClass('current');
    $('.commentcontent').css('display', 'block');
    $('.pic-content').css('display', 'none');

});
$('.right-pic').on('tap', function () {
    $(this).addClass('current').siblings('div').removeClass('current');
    $('.commentcontent').css('display', 'none');
    $('.pic-content').css('display', 'block');
});

$('.hd').on('tap', function () {

    $(this).toggleClass('rotate').siblings().toggleClass('hide');

});


$(function () {
    var $imgShow = $('#img-show');
    var $tab = $('.table');
    var iNow = 0;
    $('.pics-list li').on('tap', function (e) {
        var index = $(this).index();
        iNow = index;
        $imgShow.show();
        $tab.css({
            background: '#fff url(imgs/' + (index + 5) + '.jpg) no-repeat center',
            backgroundSize: 'contain',
            // opacity: '1'
        });
        e.preventDefault();
    });
    $imgShow.on('tap', function (e) {
        $imgShow.hide();
        e.preventDefault();
    }).on('swipeleft', function () {
        alert(1);
        iNow++;
        if (iNow == 4) {
            return;
        }
        $imgShow.css({
            background: 'url(imgs/' + (iNow + 5) + '.jpg) no-repeat center',
            backgroundSize: 'contain'
        });
    }).on('swiperight', function () {
        iNow--;
        if (iNow == -1) {
            return;
        }
        $imgShow.css({
            background: 'url(imgs/' + (iNow + 5) + '.jpg) no-repeat center',
            backgroundSize: 'contain'
        });
    });

});