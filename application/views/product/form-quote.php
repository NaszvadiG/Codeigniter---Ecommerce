<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 11/10/16 1:43 PM
 * Description:
 */
?>
<style type="text/css">
    #product-get-qoute .content-quote {
        width: 480px;
    }
    .content-quote .content-buttons {
        background: #ebedef none repeat scroll 0 0;
        border-top: 1px solid #ddd;
        padding: 15px;
        text-align: center;
        margin-top: 5px;
    }
    .content-quote p:first-child {
        margin-top: 30px;
    }
    .content-quote input[type=text] {
        width: 70%;
        margin: 20px auto 15px;
    }
</style>
<div id="product-get-qoute" class="prompt prompt-form" role="form">
    <div class="prompt-content">
        <a href="javascript:prompt_box('#product-get-qoute', false);" class="prompt-close">&times;</a>
        <div class="content-quote">
            <div class="container-fluid">
                <p>Thank you for your interest.</p>
                <p>We will contact the artist to quote you on the price and time to produce your order.</p>
                <p>The quotation will be sent to your email.</p>
                <input type="text" class="form-control" name="email" placeholder="Enter email address" value="<?php echo $this->authuser->email; ?>" />
            </div>
            <div class="content-buttons">
                <a href="javascript:getQuote();" class="btn btn-danger">Get Quote</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getQuote()
    {
        if(! /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test($('#product-get-qoute input[name=email]').val()))
        {
            return alert('Invalid email address');
        }

        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '');
        product.request('product/quote', {
            id: <?php echo $this->product->getId(); ?>,
            quantity: $('#product-quantity').val(),
            email: $('#product-get-qoute input[name=email]').val()
        }, function(data){
            alert('Your request was sent successfully.');
            prompt_box('#product-get-qoute', false);
        }).error(function(){
            alert('Sorry unable to process your request.');
        });
    }
</script>