var imageupload = {
	onReady: function(){
		// imageupload.initCroppie();
		imageupload.initCropper();
	},
	initCroppie: function(){
		var $uploadCrop, tempFiles = [], rawImg, imageId;
		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('.upload-demo').addClass('ready');
					$('#cropImagePop').modal({
						backdrop: 'static',
						keyboard: false
					});
		            rawImg = e.target.result;
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}

		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: 250,
				height: 250,
			},
			enforceBoundary: true,
			enableExif: true
		});
		$('#cropImagePop').on('shown.bs.modal', function(){
			// alert('Shown pop');
			$uploadCrop.croppie('bind', {
        		url: rawImg
        	}).then(function(){
        		console.log('jQuery bind complete');
        	});
		});
		$('.item-img').on('blur', function(){$(this).val('')});
		$('.item-img').on('change', function () {
			var filename = $(this).val().split('\\').pop();
			imageId = $(this).attr('id');
			// tempFilename = $(this).val();
			readFile(this);
		});
		$('#cropImageBtn').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'base64',
				format: 'jpeg',
				size: {width: 300, height: 300}
			}).then(function (resp) {
						var selector = '#'+imageId+'-img-output';
						$('input[name='+imageId+'-img]').hide();
						$(selector).nextAll('h3').hide();
						$(selector).attr('src', resp);
						$(selector).addClass('active');


				$('#cropImagePop').modal('hide');
			});
		});
		$('.item_img_remove').on('click', function(ev){
			$(this).parents('.thumbnail-upload').find('input[type=file]').show()
			.val('');
			$(this).nextAll('h3').show();
			$(this).prev('img.image-thumb').attr('src', '')
			.removeClass('active');
		})
		$('#cancelCropBtn').on('click', function (ev) {
			$('input[name='+itemId+'-img]').val('');
		});
	},
	initCropper: function(){

		var $uploadCrop, tempFiles = [], rawImg, imageId;
		var $image = $('#upload-image'),
		initFromModal = false,
		$scaleRange = $('#cropperPop #scaleRange'),
		$container = $('#cropper-container'),
	    $button = $('#cropperPop .cropImg');
		// ctx = $canvas[0].getContext('2d');
		$image.hide();

		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('#cropperPop').modal({
						backdrop: 'static',
						keyboard: false
					});
		            rawImg = e.target.result;
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}
		$('#cropperPop').on('shown.bs.modal', function(){
			// alert('Shown pop');
			$scaleRange.val('100');
			$image.attr('src', rawImg);
			$image.cropper({
				viewMode: 0,
				aspectRatio: 1 / 1,
				minCropBoxWidth: 200,
				minCropBoxHeight: 200
			});
			// $image.show();
		});

		$('#cropperPop').on('hidden.bs.modal', function(){
			if(initFromModal == true){
				$('#ModalSignup2').modal('show');
			}
			$image.cropper('destroy');
		});
		$('.item-img').on('blur', function(){});
		$('.item-img').on('change', function () {
			var filename = $(this).val().split('\\').pop();
			imageId = $(this).data('id');
			// tempFilename = $(this).val();
			console.log($(this).data());
			if ($(this).data('onmodal') == true){
				initFromModal = true;
				$('#ModalSignup2').modal('hide');
			}
			readFile(this);
		});
		$button.on('click', function (ev) {
			var croppedCanvas;
			croppedCanvas = $image.cropper('getCroppedCanvas');
			
			var resizedCanvas = document.createElement('canvas'),
			resizedContext = resizedCanvas.getContext('2d');

			resizedCanvas.height = "1000";
			resizedCanvas.width = "1000";
			resizedContext.fillStyle="white";
			resizedContext.fillRect(0,0,1000,1000);
			resizedContext.drawImage(croppedCanvas,0,0,1000,1000);
			
			var selector = '#seller-img-output';
			$('input[name=seller-img]').hide();
			$(selector).nextAll('h3').hide();
			$(selector).attr('src', resizedCanvas.toDataURL('image/jpeg'));
			$(selector).addClass('active');
			
			$('#cropperPop').modal('hide');
		});
		$('.item_img_remove').on('click', function(ev){
			// console.log($(this).prev('img.image-thumb'));
			tempFiles.splice(parseInt(imageId)-1,1);
			$('input[name=seller-img]').show()
			.val('');
			$(this).nextAll('h3').show();
			$(this).prev('img.image-thumb').attr('src', '')
			.removeClass('active');
		})
		$('#cropperPop .cancelCropBtn').on('click', function (ev) {
			$('input[name=seller-img]').val('');
		});
		
	}
}

imageupload.initCropper();