/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/28/16 4:35 AM
 * Description: script.js
 */

function prompt_box(target, toggle)
{
    var activeClass = 'prompt-'+$(target).attr('role')+'-active';

    if (toggle)
    {
        $('.prompt.prompt-overlay').addClass(activeClass);
        $(target).addClass('active');
    }
    else
    {
        $('.prompt.prompt-overlay').removeClass(activeClass);
        $(target).removeClass('active');
    }

    return void(0);
}

// Header
$(function(){
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
});