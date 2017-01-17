(function(){

	'use strict';

	//Fix select2 on bootstrap modal - CGW-IT-Renz - 10192016 - 1630
	//$('#ModalSignup2 select').select2('destroy');


	function login(form){
		var query = $(form).serialize(),
		$signinButton = $('#ModalLogin button#submit');
		$signinButton.prop('disabled', true);
		$signinButton.html('<i class="fa fa-sign-in"></i>Signing in...');
		console.log(query);
		$.post('/seller/account/login', query)
		.success(function(e){
			if (e['status'] == 'SUCCESS'){
				if (e['seller_status'] == 'S' || e['seller_status'] == 'P'){
					window.location.reload();
				}
				else{
					$('#ModalSignup').modal('hide');
					$('#ModalSignup2').modal('show');
				}
			}
			else{
				$('#ModalLogin').animateCss('shake');
				$('#ModalLogin .alert').show();
				$('#ModalLogin .alert-msg').html(e['msg']);
			}
			$signinButton.prop('disabled', false);
			$signinButton.html('<i class="fa fa-sign-in"></i>Sign in');
		})
		.fail(function(e){
			$('#ModalLogin').animateCss('shake');
			$('#ModalLogin .alert').show();
			$('#ModalLogin .alert-msg').html('Failed to connect to server. Please try again.');
			$signinButton.prop('disabled', false);
			$signinButton.html('<i class="fa fa-sign-in"></i>Sign in...');
		});
	}

	$(document).on('submit', '#loginForm', function(e){
		e.preventDefault();
		login('#loginForm');
	});

	$(document).on('submit', '#buyerLogin', function(e){
		e.preventDefault();
		login('#buyerLogin');
	});

	function submitStore(selector){
		var query = {};
		$.each($('#signup-store').serializeArray(), function(i,v){
			query[v["name"]] = v["value"];
		});
		query['regstorephoto'] = $('#signup-store .reg-storephoto #seller-img-output').attr('src');
		$.ajax({
			    type:'POST',
			    url: '/seller/account/create_store',
			    data: JSON.stringify(query),
			    contentType: 'application/json',
			    success: function(e){
			    	console.log(e);
					var json = $.parseJSON(e);
					if (json['status']){
						$('#successPop .modal-title').text('Account Created');
						$('#successPop .modal-body .message').text(json['msg']);
						$('#successPop .modal-footer button').html('OK');
						$('#successPop .modal-footer button').data('dismiss', 'modal');
						$('#successPop .modal-footer button').attr('onClick', 'window.location.href="/seller/account"');					
						$('#successPop').modal('show');
						$('#ModalSignup2').modal('hide');
					}
					else{
						$('#alertPop .modal-title').text('Registration failed');
						$('#alertPop .modal-body .message').text(json['msg']);
						$('#alertPop').modal('show');
					}
					console.log(json['msg']);
				},
			    fail: function(){
			    	console.log('fail');
			    	$('#alertPop .modal-body .message').text('Failed to connect to server. Please try again.');
					$('#alertPop').modal('show');
			    }
			});
	}

	function submitRegistration(selector){
		var form = selector == 'regForm' ? '#regForm' : '#signup-seller';
		if (confirmPasswords(form+' #regpassword', form+' #regconfirmpassword')) {
			var query = {};
			var formArray = $('#signup-seller').serializeArray();
			$.each(formArray.concat($('#signup-store').serializeArray()), function(i,v){
			query[v["name"]] = v["value"];
			});
			query['regstorephoto'] = $('#signup-store .reg-storephoto #seller-img-output').attr('src');
			$.ajax({
			    type:'POST',
			    url: '/seller/account/create',
			    data: JSON.stringify(query),
			    contentType: 'application/json',
			    success: function(e){
			    	console.log(e);
					var json = $.parseJSON(e);
					if (json['status']){
						$('#successPop .modal-title').text('Account Created');
						$('#successPop .modal-body .message').text(json['msg']);
						$('#successPop .modal-footer button').html('OK');
						$('#successPop .modal-footer button').data('dismiss', 'modal');
						$('#successPop .modal-footer button').attr('onClick', 'window.location.href="/seller/account"');					
						$('#successPop').modal('show');
						$('#ModalSignup2').modal('hide');
					}
					else{
						$('#alertPop .modal-title').text('Registration failed');
						$('#alertPop .modal-body .message').text(json['msg']);
						$('#alertPop').modal('show');
					}
					console.log(json['msg']);
				},
			    fail: function(){
			    	console.log('fail');
			    	$('#alertPop .modal-body .message').text('Failed to connect to server. Please try again.');
					$('#alertPop').modal('show');
			    }
			});
		}
		else{
			$('#alertPop .modal-body .message').text('Passwords did not match.');
			$('#alertPop').modal('show');
		}
	}

	$(document).on('submit', '#regForm', function(e){
		e.preventDefault();
		submitRegistration('regForm');
	});

	$(document).on('submit', '#signup-store', function(e){
		e.preventDefault();
		if ($('#signup-seller input').valid() && $('#signup-store input').valid()){
			// alert('Registering User...');
			submitRegistration('signup');
		}
	});

	$('.changepwd').click(function(e){
		e.preventDefault();

		if (confirmPasswords('#newPass', '#retypePass')) {
			$.post('account/changepass', $('#changepwdform').serialize())
			.success(function(e){
				var json = JSON.parse(e);
				if (json['status'] == 'SUCCESS'){
					$('#successPop .modal-title').text('Password updated');
					$('#successPop .modal-body .message').text('You have successfully changed your password');
					$('#successPop .modal-footer button').html('OK');
					$('#successPop').modal('show');
				}
				else{
					$('#alertPop .modal-title').text('Update failed');
					$('#alertPop .modal-body .message').text(json['message']);
					$('#alertPop').modal('show');
				} 
			})
			.fail(function(e){
				var json = JSON.parse(e);
				$('#alertPop .modal-title').text('Update failed');
				$('#alertPop .modal-body .message').text(json['message']);
				$('#alertPop').modal('show');
			});
		}
		else{
			$('#alertPop .modal-body .message').text('Passwords did not match');
			$('#alertPop').modal('show');
		}
	});

	$('#updateProfile').click(function(e){
		e.preventDefault();
		var form = '#changeprofileinfoform';
		$(form+' input[name=regfirstname]').val($(form+' input[name=regfirstname]').val() == '' ? $(form+' input[name=regfirstname]').attr('placeholder') : $(form+' input[name=regfirstname]').val());
		$(form+' input[name=reglastname]').val($(form+' input[name=reglastname]').val() == '' ? $(form+' input[name=reglastname]').attr('placeholder') : $(form+' input[name=reglastname]').val());
		var jsonStr = {
			regfirstname: $(form+' input[name=regfirstname]').val(),
			reglastname: $(form+' input[name=reglastname]').val(),
			base64string: $('#seller-img-output').attr('src')
		}
		$.ajax({
			type: 'POST',
			url: '/seller/account/update',
			data: JSON.stringify(jsonStr),
			contentType: 'application/json',
			success: function(ev){
				console.log(ev);
				var json = JSON.parse(ev);
				if (json['status'] == 'SUCCESS'){
					$('#successPop .modal-title').text('Profile Updated');
					$('#successPop .modal-body .message').text('Your profile changes has been saved.');
					$('#successPop .modal-footer button').html('OK');
					$('#successPop').modal('show');
				}
				else{
					$('#alertPop .modal-title').text('Update failed');
					$('#alertPop .modal-body .message').text("We've failed to update your profile. Please Try Again");
					$('#alertPop').modal('show');
				} 
			},
			fail: function(ev){
				var json = JSON.parse(e);
				$('#alertPop .modal-title').text('Update failed');
				$('#alertPop .modal-body .message').text("We've failed to update your profile. Please Try Again");
				$('#alertPop').modal('show');
			}
		});
	});

	$('select[name=regcountry]').select2({
		dropdownParent: $('#ModalSignup')
	}).on('change', function(e){
		var ctryCode = 66;
		switch($(this).val()){
			case 'TH':
				ctryCode = 66;
			break;
			case 'SG':
				ctryCode = 65;
			break;
			default:
			break;
		}
		$('#countryCodeLbl').text('+'+ctryCode.toString());
		$('input[name=regmobileCountryCode]').val(ctryCode);
	});

	$('.createStoreBtn').click(function(e){
		e.preventDefault();
		$(this).prop('disabled', true);
		$(this).html('<i class="fa fa-plus"></i> Adding Store...');
		var jsonStr = {
			regstorename: $('#createStoreForm input[name=regstorename]').val(),
			base64string: $('#merchant-img-output').attr('src')
		}
		console.log(JSON.stringify(jsonStr));
		$.ajax({
			type: 'POST',
			url: '/seller/account/create_store',
			data: JSON.stringify(jsonStr),
			contentType: 'application/json',
			success: function(ev){
				console.log(ev);
				var json = JSON.parse(ev);
				if (json['status'] == 'SUCCESS'){
					$('#successPop .modal-title').text('Profile Updated');
					$('#successPop .modal-body .message').text('Your profile changes has been saved.');
					$('#successPop .modal-footer button').html('OK');
					$('#successPop').modal('show');
				}
				else{
					$('#alertPop .modal-title').text('Update failed');
					$('#alertPop .modal-body .message').text("We've failed to update your profile. Please Try Again");
					$('#alertPop').modal('show');
				} 
			},
			fail: function(ev){
				var json = JSON.parse(e);
				$('#alertPop .modal-title').text('Update failed');
				$('#alertPop .modal-body .message').text("We've failed to update your profile. Please Try Again");
				$('#alertPop').modal('show');
			}
		});

			// $.post('account/create_store', $('#createStoreForm').serialize())
			// .success(function(e){
			// 	var json = JSON.parse(e);
			// 	if (json['status'] == 'SUCCESS'){
			// 		$('#successPop .modal-title').text('Store created');
			// 		$('#successPop .modal-body .message').text('You have successfully added a store');
			// 		$('#successPop .modal-footer button').html('OK');
			// 		$('#successPop').modal({
			// 			backdrop: 'static',
			// 			keyboard: false
			// 		});
			// 	}
			// 	else{
			// 		$('#alertPop .modal-title').text('Create failed');
			// 		$('#alertPop .modal-body .message').text(json['message']);
			// 		$('#alertPop').modal({
			// 			backdrop: 'static',
			// 			keyboard: false
			// 		});
			// 	} 
			// 	$(this).prop('disabled', false);
			// 	$(this).html('<i class="fa fa-plus"></i> Add Store');
			// })
			// .fail(function(e){
			// 	var json = JSON.parse(e);
			// 	$('#alertPop .modal-title').text('Create failed');
			// 	$('#alertPop .modal-body .message').text(json['message']);
			// 	$('#alertPop').modal({
			// 		backdrop: 'static',
			// 		keyboard: false
			// 	});
			// 	$(this).prop('disabled', false);
			// 	$(this).html('<i class="fa fa-plus"></i> Add Store');
			// });
	});

	function confirmPasswords(a, b){
		return $(a).val() === $(b).val() ? true : false;
	}

	$(document).on('click', '#resetPWBtn', function(){
		console.log($(this).parents('form').find('input#email').val())
		$(this).prop('disabled', true);
		$(this).html('Submitting...');
		$.ajax({
			type: 'POST',
			url: '/seller/account/forgetPassword',
			data: "email="+$(this).parents('form').find('input#email').val(),
			dataType: 'json',
			success: function(ev){
				$('#ModalForget').modal('hide');
				$('#resetPWBtn').prop('disabled', false);
				$('#resetPWBtn').html('Submit');
				if (ev['status'] == true){
					$('#alertPop .modal-title').text('Request sent');
					$('#alertPop .modal-body .message').text('Check your email for the confirmation link to reset your OneNow password.');
					$('#alertPop .modal-footer button').html('OK');
					$('#alertPop').modal('show');
				}
				else{
					$('#alertPop .modal-title').text('Request failed');
					$('#alertPop .modal-body .message').text("We don't see your account on our servers. Please check your email address and try again.");
					$('#alertPop').modal('show');
				} 
			},
			fail: function(ev){
				$('#resetPWBtn').prop('disabled', false);
				$('#resetPWBtn').html('Submit');
				$('#ModalForget').modal('hide');
				$('#alertPop .modal-title').text('Request failed');
				$('#alertPop .modal-body .message').text("We don't see your account on our servers. Please check your email address and try again.");
				$('#alertPop').modal('show');
			}
		});
	});


	$.each(['#regForm', '#signup', '#signup-seller', '#signup-store'], function(i,v){

		$(v).validate({
			rules: {
				regpassword: {
					minlength: 5,
					maxlength: 12
				},
				regconfirmpassword: {
					minlength: 5,
					maxlength: 12,
					equalTo: v+' #regpassword'
				}
			},
			errorPlacement: function(error, element) {
			  var placement = $(element).data('error');
			  console.log(element);
			  if (placement) {
				console.log(placement);
				error.insertAfter($(element).parents('.form-group'));
			  } else {
				error.insertAfter(element);
			  }
			}
		});
	});
	//Registration
    $('#regnext').click(function(){
        if ($('#signup-seller').valid()){
            $('#ModalSignup').modal('hide');
            $('#ModalSignup2').modal('show');
        }
    });


}());

// Create store form (If Seller status is Blank)
    function showCreateStoreModal(){
    	$('#ModalSignup2 .modal-title-site').text('Create your Store Now');
    	$('#ModalSignup2 #regprev').hide();
    	$('#ModalSignup2 #regskip').show();
    	$('#ModalSignup2 .modal-footer').hide();
    	$('#ModalSignup2').modal('show');
    }