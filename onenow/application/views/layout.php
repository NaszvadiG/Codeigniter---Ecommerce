<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/25/16 4:23 PM
 * Description:
 */
$classseller = (isset($css)) ? 'class="seller index"' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Onenow - BuyThai</title>

    <link type="text/css" rel="stylesheet" href="<?php echo base_url('seller/assets/vendor/bootstrap/3.3.7/css/bootstrap.min.css');?>" />
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <?php echo (isset($css)) ? $css : ''; ?>
</head>
<body <?php echo $classseller; ?>>
    <?php $this->view($document, $parameters); ?>
    
    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo base_url('seller/assets/vendor/jquery/1.10.1/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('seller/assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript">
        $(function(){
            $('.overlay').click(function(){
                if ($('.overlay').hasClass('active-alert') || $('.overlay').hasClass('active-form'))
                {
                    return false;
                }

                $('body, .overlay, .menubar').removeClass('active');
            });

            $('.titlebar a[href="#menubar"]').click(function(e){
                e.preventDefault();
                $('body, .overlay, .'+$(this).attr("href").substring(1)).addClass('active');
            });

            $('.menubar a[href^="#shop"]').click(function(e){
                e.preventDefault();
                $('.menubar a[href^="#shop"], .menubar ul[id^="shop"]').removeClass('active');
                $(this).addClass('active');
                $($(this).attr('href')).addClass('active');
            });

            $(window).resize(function() {
                $('.menubar .menu a > span').unbind('click');
                if( $(this).width() < 768 )
                {
                    $('.menubar .menu a > span').click(function(e){
                        e.preventDefault();
                        $(this).parent().parent().toggleClass('active');
                    });
                }

                if( $(this).width() > 767 ) $('body, .overlay, .menubar').removeClass('active');
            }).trigger('resize');

            $(window).scroll(function(e){
                if($(this).scrollTop() > 200) {
                    $('#scrollTopContainer').addClass('show');
                }
                else{
                    $('#scrollTopContainer').removeClass('show');
                }
            });
            $('.scrollTopBtn').click(function(){
                $(this).parent().addClass('up');
                $('html, body').animate({
                    scrollTop: "0px"
                }, 600, function(){
                    $('#scrollTopContainer').removeClass('up');
                });
            });
        });
    </script>
    <?php echo (isset($js)) ? $js : ''; ?>
</body>
</html>