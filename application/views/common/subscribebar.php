<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/18/16 9:00 PM
 * Description:
 */
?>
<div class="content-subscribe">
    <div class="content-main">
        <input type="text" name="email" placeholder="Enter email to receive a welcome gift" />
        <button>Subscribe</button>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.content-subscribe button').click(function(){
            alert('Thank you for subscribing. Enjoy shopping!');
        });
    });
</script>