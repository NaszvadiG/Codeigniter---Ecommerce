<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/26/16 3:47 PM
 * Description:
 */
?>
<div id="sign-in" class="prompt prompt-form" role="form">
    <div class="prompt-content">
        <a href="javascript:prompt_box('#sign-in', false);" class="prompt-close">&times;</a>
        <div class="content-auth">
            <form method="POST" action="http://tpayment.staging.onenow.com/checkout/securitylogin.do">
                    <input type="hidden" name="portal" value="gck"/>
                    <input type="hidden" name="currenturl" value="<?php echo base_url(); ?>" />
                    <input type="hidden" name="returnurl" value="<?php echo base_url('buyer/auth'); ?>"/>
                <div class="container-fluid">
                    <h3>Login</h3>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pwd" class="form-control" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" id="remember" /> Remember me</label>
                    </div>
                </div>
                <div class="content-buttons">
                    <p>
                        Not here before? <a href="javascript:prompt_box('#sign-in',false);prompt_box('#sign-up',true);">Register</a><br />
                        <a href="javascript:prompt_box('#sign-in',false);prompt_box('#forgot-password',true);">Lost your password?</a>
                    </p>

                    <button type="submit" class="btn btn-danger">Login</button>
                    <!--<button type="button" class="btn btn-danger" onclick="authuser('#sign-in')">Login</button>-->
                </div>
            </form>
        </div>
    </div>
</div>
<!--<script type="text/javascript">
    function authuser(a)
    {
        $.post('http://tpayment.staging.onenow.com/checkout/securitylogin.do', {
            currenturl: '<?php /*echo base_url(); */?>',
            returnurl: '<?php /*echo base_url('buyer/auth'); */?>'+($('#sign-in #remember').is(':checked') ? '/remember' : ''),
            portal: 'gck',
            email: $('#sign-in input[name=email]').val(),
            pwd: $('#sign-in input[name=pwd]').val()
        }, function(response) {
            console.log(response);
        });
    }

</script>-->