    

    // $('#subscribe-btn').click (function(e) {
    //     var x = $('.email-bottom').val();
    //     var atpos = x.indexOf("@");
    //     var dotpos = x.lastIndexOf(".");
    //     if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
    //         return false;
    //     } else {

    //         $('#subscribePop').modal('show');
    //         return true;
    //     }
    // });

    $('.subscribe form').on('submit', function(e){
        e.preventDefault();
        if ($('.subscribe form').valid()){
            $('#subscribePop').modal('show');
        };
    })

    var nCount = 0;
    $('body').click (function(e) {
        /*console.log($(e.target)[0]);
        console.log($('.back')[0].children);
        console.log(e);
        console.log($(e.target));
        console.log($('.arrow_box input')[0]);*/
        if(e.target == $('i.fa.fa.clicktarget')[0]) {
            nCount += 1;
            if(nCount % 2 == 0) {
                $('.search-mobile .arrow_box').slideUp(100); 
                $('i.fa.fa.clicktarget').removeClass('color-red');
            } else {
                $('.search-mobile .arrow_box').slideDown(100);    
                $('i.fa.fa.clicktarget').addClass('color-red');
            }
            
        } else if($(e.target)[0] == $('.search-mobile .arrow_box')[0] || $(e.target)[0] == $('.search-mobile .arrow_box input')[0] || $(e.target)[0] == $('.search-mobile .arrow_box button')[0]) {
            
        } else {
            $('.search-mobile  .arrow_box').slideUp(100);
            $('i.fa.fa.clicktarget').removeClass('color-red');            
        }

        if($(e.target)[0] == $('a.has-sub')[0] ) {
            $('.mainmenu button.navbar-toggle').attr('data-target',".navbar-collapsemm-sub");    
        }
        //else if ($(e.target)[0] == $('.back')[0].children[0]) {
        //    $('.mainmenu button.navbar-toggle').attr('data-target',".navbar-collapsem");
        //}

    });

    

    $(window).scroll(function() {
        if($(window).scrollTop() >= 50) {
            $(".topbar").slideUp(300);
        } else {
            $(".topbar").slideDown(300);
        }
    });

    $('.mobile-menu.arrow_box').scroll(function() {
        //console.log('scroll');
    });
    var nButtonClick = 0;

