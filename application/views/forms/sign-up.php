<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/26/16 3:47 PM
 * Description:
 */
?>
<div id="sign-up" class="prompt prompt-form" role="form">
    <div class="prompt-content">
        <a href="javascript:prompt_box('#sign-up', false);" class="prompt-close">&times;</a>
        <div class="content-auth">
            <form method="POST" action="http://tpayment.staging.onenow.com/checkout/continueregister.do">
                <div class="container-fluid">
                    <h3>Register</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="firstName" class="form-control" placeholder="Enter your first name" />
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lastName" class="form-control" placeholder="Enter your last name" />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <label>Country</label>
                                        <select name="country" class="form-control">
                                        <?php foreach ($this->config->item('countries') as $code => $name): ?>
                                            <option value="<?php echo $code; ?>"><?php echo $name; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4" style="position:relative;">
                                        <span class="sr-only">Mobile Country Code</span>
                                        <input type="text" name="mobileCountryCode" class="form-control" style="padding-left:15px;" />
                                        <span style="position:absolute;top:4px;left:20px;">+</span>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <span class="sr-only">Mobile Number</span>
                                        <input type="text" name="hpnum" class="form-control " placeholder="Enter your mobile" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" placeholder="Enter your password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="retypepass" class="form-control" placeholder="Re-enter your password to confirm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-buttons">
                    <p>Already member? <a href="javascript:prompt_box('#sign-up',false);prompt_box('#sign-in',true);">Sign in</a><br /></p>
                    <input type="hidden" name="portal" value="gck"/>
                    <input type="hidden" name="currenturl" value="<?php echo base_url(); ?>" />
                    <input type="hidden" name="returnurl" value="<?php echo base_url('buyer/auth'); ?>"/>
                    <button type="button" class="btn btn-danger" onclick="validate_registration_form();">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validate_registration_form() {
        var $form = $('#sign-up form');
        var error = '';
        $form.find('input[type=text]').each(function() {
            if ($(this).val().length < 1)
            {
                error += 'Please enter your '+ $(this).prev().text() +'\n';
            }
        });

        if (error.length > 0)
            return alert(error);

        var response = $.get('http://tpayment.staging.onenow.com/checkout/checkemail.do', { email: $('#sign-up input[name=email]').val() }, function(data) {
            if (data.checkuser.status == "FAILURE")
            {
                return alert('Email is already exists');
            }

            $('#sign-up form').submit();
        });
    }



    $(function(){
        $('#sign-up select[name=country]').change(function() {
            var country = $(this).find('option[value='+ $('#sign-up select[name=country]').val() +']').text();
            $.get('https://restcountries.eu/rest/v1/name/'+ country.toLowerCase(), {}, function(data) {
                var ndd = data[0].callingCodes[0];
                if (!ndd || ndd === undefined)
                    ndd = '';

                $('#sign-up input[name=mobileCountryCode]').val(ndd);
            }).error(function(){
                $('#sign-up input[name=mobileCountryCode]').val('');
            });
        });


<?php if($this->session->has_userdata('locale')): ?>
        var cgwgeoresponse = <?php echo $this->session->locale; ?>;
<?php endif; ?>
        $('#sign-up select[name=country]').val(cgwgeoresponse.countrycode);
        $('#sign-up input[name=mobileCountryCode]').val(cgwgeoresponse.countryphonecode);
    });




</script>


