<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/18/16 10:36 PM
 * Description:
 */
?>
<title>ONENOW - FAQ</title>
<?php $this->view('common/header'); ?>
<style type="text/css">
    h3 {
        margin-top: 30px;
        margin-bottom: 30px;
    }
    h3:not(:first-child) {
        margin-top: 60px;
    }
    .panel,
    .panel-body,
    .panel-group .panel,
    .panel-heading {
        background: #fff;
        border-radius: 0;
        border: 0;
    }
    .panel-heading {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }
    .panel-default > .panel-heading {
        background: #fff;
    }
    .panel-title strong,
    .panel-body{
        font-size: 14px;
    }
    .panel-body {
        padding: 15px 30px;
    }
    .panel-title a {
        text-decoration: none;
    }
    .panel-title a[aria-expanded=true],
    .panel-title a:hover {
        color: #F24B4B;
    }
</style>

<div class="content-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <h3>Orders, Shipping & Payments</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>When will I receive my orders?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <p>Most orders are processed within 1-2 business days. However, due to stock availability as well as the location and operating business days of the various distribution centres around Thailand, this may vary.  Additional processing days will be indicated during product checkout.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <strong>Can I cancel my order(s)?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p>
                                    You can only cancel before the order is processed. <br/><br/>
                                    If you have a OneNow account, click 'Cancel Order' on your My Orders page.  If you do not see the link, the order has already been processed and cannot be changed.
                                    <br/><br/>
                                    If you don't have a OneNow account, send an email to <a href="mailto:customerservice@onenow.com">customerservice@onenow.com</a> with your order number and we will do our best to update or cancel your order in time.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>Can I change my delivery address?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <p>You may change your delivery address before your order is processed. <br/><br/>
                                    Send an email to <a href="mailto:customerservice@onenow.com">customerservice@onenow.com</a> to request for the change.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>What is a custom-made order and in those cases, when will my order ship?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">
                                <p>We offer items made by Thai master craftsmen and artisans. These items may take a longer time to ship depending on the production time of the product needs. The estimated production and delivery times will be indicated on the product page.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>I placed my order under Guest Check Out; how do I link it to my OneNow account?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body">
                                <p>If you've placed an order as a Guest, please send an email to <a href="mailto:customerservice@onenow.com">customerservice@onenow.com</a> with your order number and the email address of your OneNow account. We will link your order to your account.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingSix">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>How can I track my orders?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                            <div class="panel-body">
                                <p>We will send two notification emails to inform customers about their orders. The first is a confirmation email sent once the order is placed. The second is a shipping confirmation with a tracking number once the items have been processed for shipping and delivery.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingSeven">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>Do you ship internationally?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                            <div class="panel-body">
                                <p>We ship worldwide door-to-door through DHL, our official logistics partner.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingEight">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>Are customs, duties and taxes included in the shipping?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                            <div class="panel-body">
                                <p>All shipping rates, customs, duties and taxes are calculated before check-out. What is shown on your invoice is the final amount you have to pay.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingNine">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>What if my items arrive damaged, defective or incorrect?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                            <div class="panel-body">
                                <p>Please contact us immediately at <a href="mailto:customerservice@comgateway.com">customerservice@comgateway.com</a> with a photo (and description?) of the damaged or wrong item received. We will rectify the order as soon as possible.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTen">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>Is my order covered by insurance?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                            <div class="panel-body">
                                <p>Yes, all orders are covered by insurance for product values up to US$10,000. All orders include a nominal insurance fee of 1%.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingEleven">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>What payment methods do you accept and what currency are your products listed in?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                            <div class="panel-body">
                                <p>We accept payment by Visa, Masterard, American Express, PayPal and Visa Checkout.  All prices are in U.S Dollars.</p>
                            </div>
                        </div>
                    </div>

                    <!--- end of part one --->
                    <h3>Returns & Refunds</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingPart2-1of2">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePart2-1of2" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>What is your return policy? </strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapsePart2-1of2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPart2-1of2">
                            <div class="panel-body">
                                <p>
                                    Returns have to be initiated seven calendar days from the date the item was received. To initiate a return, contact us at customerservice@onenow.com. The customer is responsible for all return shipping fees.<br/><br/>
                                    Please ensure that items are returned new, unused and intact with all tags still attached. We are unable to accept items that have been used, are soiled or without sales tags.<br/><br/>
                                    Once the items have been received, refund will be made via the original payment method. Please allow up to 14 business days or depending on your credit card billing cycle for the refund to be reflected in your statement.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingPart2-2of2">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePart2-2of2" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>How do I make an exchange?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapsePart2-2of2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPart2-2of2">
                            <div class="panel-body">
                                <p>
                                    We do not facilitate exchanges. Please return your order and place a new order.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--- end of part two --->
                    <h3>General Enquiries & Account Settings</h3>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingPart3-1of2">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePart3-1of2" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>How do I update my personal details, shipping address and payment methods? </strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapsePart3-1of2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPart3-1of2">
                            <div class="panel-body">
                                <p>
                                    Please create an account with OneNow and login to <u>My Account</u> to make the changes.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingPart3-2of2">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePart3-2of2" aria-expanded="false" aria-controls="collapseThree">
                                    <strong>How do I contact you for any other enquiries?</strong>
                                </a>
                            </h4>
                        </div>
                        <div id="collapsePart3-2of2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPart3-2of2">
                            <div class="panel-body">
                                <p>
                                    You can email us at <a href="mailto:customerservice@onenow.com">customerservice@onenow.com</a>. We respond within 24 hours. Alternatively, you can also reach us via Live Chat from 7am to 6pm (GMT+8) for real-time assistance.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="javascript:prompt_box('#sign-up',true);" class="btn btn-danger">READY TO SIGN UP</a>
            </div>
        </div>
    </div>
<!-- FAQ Content --->

    <br /><br /><br />
<!-- /.FAQ -container -->

</div>
<?php $this->view('common/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/3.3.7/js/bootstrap.min.js'); ?>"></script>