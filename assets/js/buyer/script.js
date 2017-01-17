/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/28/16 4:35 AM
 * Description: script.js
 */

function prompt_bar(type, toggle)
{
    if (toggle)
    {
        $('.prompt.prompt-overlay').addClass('prompt-'+ type +'-active');
        $('.prompt.prompt-'+type).addClass('active');
    }
    else
    {
        $('.prompt.prompt-overlay').removeClass('prompt-'+ type +'-active');
        $('.prompt.prompt-'+type).removeClass('active');
    }

    return void(0);
}

// Header
$(function(){
    $('.searchbar input').focus(function(){
        $(this).parent().addClass('focused');
    }).blur(function(){
        $(this).parent().removeClass('focused');
    });
    $('a[href="#menu"]').click(function(e){
        e.preventDefault();
        $($(this).attr('href')).toggleClass('active-menu');
    });
    $(window).scroll(function(){
        if($(document).scrollTop() > ($('.notice').height()+3))
        {
            if(! $('.menubar').hasClass('active')) {
                $('.menubar').addClass('active');
                $('article.notice').css('margin-bottom', $('.content-head').height());
                $('.content-head').css('position', 'fixed');
            }
        }
        else
        {
            if($('.menubar').hasClass('active')) {
                $('.menubar').removeClass('active');
                $('article.notice').css('margin-bottom', 0);
                $('.content-head').css('position', 'static');
            }

        }
    }).resize(function(){
        if($(document).width() >= 992)
        {
            $('a[href="#menu"]').parent().removeClass('active-menu');
        }
    });

    function customPager() {
        var self = this.$elem;
        $.each(this.owl.userItems, function (i) {
            var pagination1 = self.find('.owl-controls .owl-pagination > div:first-child');
            var pagination = self.find('.owl-controls .owl-pagination');

            $(pagination[i]).append("<div class=' owl-has-nav owl-next'><img src='assets/images/test-image/arrow-right.png'>  </div>");
            $(pagination1[i]).before("<div class=' owl-has-nav owl-prev'><img src='assets/images/test-image/arrow-left.png'> </div>");
        });

    };
    var popularProductSlider = $(".slider-popular");
    var limitedProductSlider = $(".slider-limited");
    var curatorProductSlider = $(".slider-curator");
    popularProductSlider.owlCarousel({
        navigation: false, // Show next and prev buttons
        items: 4,
        itemsTabletSmall: [480, 1],
        itemsTablet: [768, 2],
        itemsDesktopSmall: [1024, 3],
        afterInit: customPager,
        afterUpdate: customPager
    });
    limitedProductSlider.owlCarousel({
        navigation: false, // Show next and prev buttons
        items: 4,
        itemsTabletSmall: [480, 1],
        itemsTablet: [768, 2],
        itemsDesktopSmall: [1024, 3],
        afterInit: customPager,
        afterUpdate: customPager
    });
    curatorProductSlider.owlCarousel({
        navigation: false, // Show next and prev buttons
        items: 2,
        itemsTablet: [768, 1],
        itemsDesktopSmall: [1024, 2],
        afterInit: customPager,
        afterUpdate: customPager
    });

        // Custom Navigation Events
    $(document).on('click', '.slider-popular .owl-next', function (e) {
        popularProductSlider.trigger('owl.next');
    });

    $(document).on('click', '.slider-popular .owl-prev',function () {
        popularProductSlider.trigger('owl.prev');
    });

    $(document).on('click', '.slider-limited .owl-next', function (e) {
        limitedProductSlider.trigger('owl.next');
    });

    $(document).on('click', '.slider-limited .owl-prev',function () {
        curatorProductSlider.trigger('owl.prev');
    });

    $(document).on('click', '.slider-curator .owl-next', function (e) {
        curatorProductSlider.trigger('owl.next');
    });

    $(document).on('click', '.slider-curator .owl-prev',function () {
        limitedProductSlider.trigger('owl.prev');
    });


    if($(window).width() <= 768) {
        var bhistoryProductSlider = $(".mirek-bhistory-slider");
        bhistoryProductSlider.owlCarousel({
            navigation: false, // Show next and prev buttons
            items: 4,
            itemsTabletSmall: [480, 3],
            itemsTablet: [768, 4],
            afterInit: customPager,
            afterUpdate: customPager
        });
        $(document).on('click', '.mirek-bhistory-slider .owl-next', function (e) {
            bhistoryProductSlider.trigger('owl.next');
        });

        $(document).on('click', '.mirek-bhistory-slider .owl-prev',function () {
            bhistoryProductSlider.trigger('owl.prev');
        });

    }

});