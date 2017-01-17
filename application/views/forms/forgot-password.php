<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/26/16 3:47 PM
 * Description:
 */
?>
<div id="forgot-password" class="prompt prompt-form" role="form">
    <div class="prompt-content">
        <a href="javascript:prompt_box('#forgot-password', false);" class="prompt-close">&times;</a>
        <div class="content-auth">
            <form>
                <div class="container-fluid">
                    <h3>Reset Password</h3>
                    <p>
                        We will send you an email for verification to reset your password.
                    </p>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter your email">
                    </div>
                </div>
                <div class="content-buttons">
                    <button type="button" onclick="password_reset_request()" class="btn btn-danger">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function password_reset_request()
    {
        $.get('http://tpayment.staging.onenow.com/checkout/sellerresetpassword.do?cgCode='+ $('#forgot-password input[name=email]').val(), {}, function(response) {
            if(alert('Request sent. Please check your inbox now thank you.'))
            {
                prompt_box('#forgot-password', false);
            }
        });
    }
</script>