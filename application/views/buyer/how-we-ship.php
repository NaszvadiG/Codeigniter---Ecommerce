<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/18/16 10:36 PM
 * Description:
 */
?>
<title>ONENOW - How We Ship</title>
<?php $this->view('common/header'); ?>
<style type="text/css">
    h1 {
        font-size: 32px;
    }

    h1, h3 {
        color: #454545;
        font-weight: 700;
    }

    .container p {
        padding-bottom: 20px;
    }

</style>

<div class="content-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>How We Ship</h1>
                <p>When you buy 2 or more items, chances are that it may be from different sellers.</p>

                <h3>ONE Checkout</h3>
                <p>To keep it easy for you, we create one payment only.</p>

                <h3>ONE Shipment</h3>
                <p>Next we do the hard work to ship everything to you in one shipment. <br/>
                  That is how we keep you shipping charges low.</p>

                <img src="<?php echo base_url('assets/images/how-we-ship.png'); ?>" class="img-responsive" />
                <p>Because we wait until all your packages arrive, pack them into one box before we ship.<br/>
                    Please understand that your delivery depends on all the sellers' (involved in your order) delivery timing.
                </p>

                <a href="javascript:prompt_box('#sign-up',true);" class="btn btn-danger">READY TO SIGN UP</a>
            </div>
        </div>
    </div>
    <br /><br /><br />

</div>

<?php $this->view('common/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>