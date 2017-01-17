<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/18/16 10:36 PM
 * Description:
 */
?>
<title>ONENOW - Email Preference</title>

<?php $this->view('common/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/icheck-1.x/icheck.css'); ?>" />
<style type="text/css">
.email-content-main ul {
    list-style: none;
}
.email-content ul li {
    width: 40%;
    float: left;
}
.email-content-main {
    max-width: 900px;
}
.email-content-main .title p {
    font-size: 20px;
}
.email-content-main .title h3 {
    margin-bottom: 20px;
}
.email-content-main .title {
    margin-bottom: 30px;
}
.email-address h4 {
    margin-bottom: 0;
}
.email-address p {
    margin-bottom: 20px;
}
.email-address input {
    padding-left: 10px;
    margin-left: 30px;
    margin-bottom: 30px;
}
.email-gift select {
    width: 100px;
}
.email-gift .selection {
    display: flex;
}
.email-gift .selection select {
    margin-right: 20px;
}
.email-gift .selection label {
    margin-right: 20px;
    margin-top: 5px;
}
.email-content-main label {
    display: flex;
    position: relative;
}
label .iChk {
    margin-right: 10px;
    float: left;
    position: absolute !important;
}
label p {
    font-weight: lighter;
    padding-left: 30px;
}
.frequency-content ul{
    padding: 0;
}

.email-content ul {
    padding-left: 15px;
}
.frequency-content > p {
    margin-bottom : 20px;
}
.email-content-main button{
    width: 150px;
    margin-right: 50px;
}
.btn-update {
    background: #F24B4B;
}
.btn-unsubscribe {
    background: #666666;
}
.email-button-content {
    margin-bottom: 50px;
}
.notification-category .icheckbox_square-green {
    background-position: -120px 0 !important;
}
.notification-category .icheckbox_square-green.checked {
    background-position: -168px 0 !important;
}

.notification-category label > div {
    position: absolute !important;
}
@media (max-width: 425px) {
    .email-content ul li {
        width: 50%;
    }
    .email-content-main button {
        width: 130px;
        margin-right: 10px;
    }
}
</style>
<div class="email-content-main container">
    <div class="title">
        <h3><strong>ONENOW COMMUNICATIONS</strong></h3>
        <p>Personalize how you would like to stay in touch - we are constantly adding new shopping sources and special offers.</p>
    </div>

    <div class="email-address">
        <h4><strong>Please help us understand what you might like better </strong></h4>
        <p>We promise that it is confidential and we will never share it</p>
        <p>Your current email is danny.lim@comgateway.com</p>
        <input type="email" placeholder="New email address">
    </div>

    <div class="email-gift">
        <h4><strong>We would send you a birthday gift on your special day</strong></h4>
        <div class="selection">
            <select class="form-control day">
                <option>DD</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <select class="form-control month">
                <option>MMM</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <label>
                <input type="radio" checked="" value="option1" name="gender">
                 <p> Male </p>
            </label>
            <label>
                <input type="radio" value="option1" name="gender">
                <p> Female </p>
            </label>
        </div>

    </div>

    <div class="email-content">
        <h4><strong>Content Preference</strong><h4>
        <p>Send me notifications from the following categories</p>

        <div class="row">
            <ul class="notification-category">
                <li>
                    <label class="select-all-category">
                       <input type="checkbox" value="option1">
                       <p>All</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox"  value="option6">
                       <p>HEALTH @ BEAUTY</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox" value="option2">
                       <p>Support Arts and Crafts Int'l Centre of Thailand(SATICT) </p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox"  value="option7">
                       <p>FOOD</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox"  value="option3">
                       <p>LEADING BRANDS</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox" value="option8">
                       <p>CURATED PICKS</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox"  value="option4">
                       <p>HOME & LIVING</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox" value="option9">
                       <p>F&B OUTFITTING</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox"  value="option5">
                       <p>CLOTHING @ ACCESSORIES</p>
                    </label>
                </li>
                <li>
                    <label>
                       <input type="checkbox" value="option10">
                       <p>WEDDING SUPPLIES</p>
                    </label>
                </li>
            </ul>
        </div>
    </div>

    <div class="frequency-content">
        <h4><strong>Frequency Preference</strong></h4>
        <p>Change the frequency to suit your needs</p>
        <ul>
            <li>
                <label>
                    <input type="radio" checked=""  value="option9" name="frequency">
                    <p>ONCE EVERY 2 WEEKS</p>
                </label>
            </li>
            <li>
                <label>
                    <input type="radio"  value="option5" name="frequency">
                       <p>ONCE A MONTH</p>
                </label>
            </li>
            <li>
                <label>
                    <input type="radio" value="option10" name="frequency">
                       <p>BIRTHDAY OFFER ONLY</p>
                </label>
            </li>
        </ul>
    </div>

    <div class="email-button-content">
        <button class="btn btn-update">Update</button>
        <button class="btn btn-unsubscribe">Unsubscribe</button>
    </div>
</div>
<script type="text/javascript">
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-green iCheck-margin',
        radioClass: 'iradio_square-green iChk iCheck-margin'
    });

    $('.notification-category').on('bulkClick', function(e) {

        if($('.select-all-category > div').hasClass('checked')) {
            $('.notification-category label div').removeClass('checked');
        } else {
             $('.notification-category label div').addClass('checked');
        }
    });

    $('.notification-category').on('bulkUncheck', function(e, selectedElement) {

        if($('.select-all-category > div').hasClass('checked')) {
            $('.select-all-category > div').removeClass('checked');
        }

        if($(selectedElement.firstChild).hasClass('checked')) {
            $(selectedElement.firstChild).removeClass('checked');
        } else {
            $(selectedElement.firstChild).addClass('checked');
        }
    });

</script>

<?php $this->view('common/footer'); ?>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/icheck-1.x/icheck.js'); ?>"></script>