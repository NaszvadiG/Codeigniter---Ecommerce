var itemsadd = {
	itemForm: ".formAddItem ",
	itemHiddenForm: "#itemForm ",
	item_images: [],
	current_item_images: [],
	item_images_remove: [],
	updateItems: {
		colors: '',
		sizes: '',
		sib: 'true'
	},
	cat: $.parseJSON($('#cat-json').val()),
	product: function (type, product_id, name, desc, producer_id, cat_id, subcat_id, subsubcat_id, subsubsubcat_id, price, quantity, discount, bulk_discount, min_order_size, color, size, weight, ship_in_box, length, width, height, sku, merchant_sku, merchant_sla,images){
		this.type = type;
		this.product_id = product_id;
		this.name = name;
		this.desc = desc;
		this.producer_id = producer_id;
		this.cat_id = cat_id;
		this.subcat_id = subcat_id;
		this.subsubcat_id = subsubcat_id;
		this.subsubsubcat_id = subsubsubcat_id;
		this.price = price;
		this.quantity = quantity;
		this.discount = discount;
		this.bulk_discount = bulk_discount;
		this.minimum_order_size = min_order_size;
		this.color = color;
		this.size = size;
		this.weight = weight;
		this.ship_in_a_box = ship_in_box;
		this.length = length;
		this.width = width;
		this.height = height;
		this.sku = sku;
		this.merchant_sku = merchant_sku;
		this.merchant_sla = merchant_sla;
		this.images = images;
		this.stringify = function(){
			return 'type='+this.type+'&product_id='+this.product_id+'&name='+this.name+'&desc='+this.desc+'&producer_id='+this.producer_id+'&cat_id='+this.cat_id+'&subcat_id='+this.subcat_id+'&subsubcat_id='+this.subsubcat_id+'&subsubsubcat_id='+this.subsubsubcat_id+'&price='+this.price+'&quantity='+this.quantity+'&discount='+this.discount+'&bulk_discount='+this.bulk_discount+'&min_order_size='+this.minimum_order_size+'&color='+this.color+'&size='+this.size+'&weight='+this.weight+'&ship_in_box='+this.ship_in_a_box+'&length='+this.length+'&width='+this.width+'&height='+this.height+'&sku='+this.sku+'&merchant_sku='+this.merchant_sku+'&merchant_sla='+this.merchant_sla+'&images='+this.images;
		};
		this.jsonString = function(){
			return JSON.stringify({type: this.type,product_id: this.product_id,name: this.name,desc: this.desc,producer_id: this.producer_id,cat_id: this.cat_id,subcat_id: this.subcat_id,subsubcat_id: this.subsubcat_id,subsubsubcat_id: this.subsubsubcat_id,price: this.price,quantity: this.quantity,discount: this.discount,bulk_discount: this.bulk_discount,min_order_size: this.minimum_order_size,color: this.color,size: this.size,weight: this.weight,ship_in_box: this.ship_in_a_box,length: this.length,width: this.width,height: this.height,sku: this.sku,merchant_sku: this.merchant_sku,merchant_sla: this.merchant_sla,images: this.images});
		};
	},
	onReady: function(images){
		// itemsadd.initDropZone(images);
		// itemsadd.initCroppie();
		itemsadd.initCropper();
		itemsadd.initWysihtml5();
		itemsadd.initItemActions();
		$('.product-colors input').iCheck('destroy');
		$('.add-img').click(itemsadd.addImg);
		$('.category').click(itemsadd.categoryClick);
		
		//Input Number only
		var numInput = document.querySelector('input');

		// Listen for input event on numInput.
		var numVal = $('#product_sla').val();
		$(document).on('keyup','#product_sla', function(){
			var numregex = new RegExp(/^\d+$/);
			if ($('#product_sla').val() == ''){
			}
		    else if (!numregex.test($('#product_sla').val())){
		    console.log(numVal);
		        // If we have no match, value will be empty.
		        $('#product_sla').val(numVal);
		    }
		    else{
		    	numVal = $('#product_sla').val();
		    }
		})	
		$('#product_sla').blur(function(){
			if ($('#product_sla').val() == ''){
				$('#product_sla').val('1');
			}
		});

		$('#itemsubmitPop .dismissBtn').click(function(){window.location.href="/seller/items/listing"});
		$('.addItem.enabled').live("click", function(e){
			console.log('clikc additem');
			var validation = itemsadd.validateItem.isValid();
			if (validation.status){
				itemsadd.addItem(e);
			}
			else{
				$('#alertNotif').modal('show');
				$('#alertNotif .modal-title').text('Error');
				$('#alertNotif .message').html('<p>Please check the following sections:</p><ul class="error-validation"></ul>');
				for (var key in validation.results){
					$('#alertNotif .message ul').append('<li>-'+key+': '+validation['results'][key]['msg']+'</li>')
				}
				$('#alertNotif .modal-footer').show();
			}
			
		});
		$('.clearItemForm').click(itemsadd.clearForm);
	
		$('.updateItem').click(function(e){
			var $updateBtn = $(this);
			var validation = itemsadd.validateItem.isValid();
			if (validation.status){
				$updateBtn.prop('disabled', true);
				$updateBtn.html('<i class="fa fa-pencil">Updating...');
				$(document).on('update.completed', function(){
					$updateBtn.prop('disabled', false);
					$updateBtn.html('Update');
				});
				itemsadd.updateDetail(e, $(this).data('itemdetail'))
			}
			else{
				$('#alertNotif').modal('show');
				$('#alertNotif .modal-title').text('Error');
				$('#alertNotif .message').html('<p>Please check the following sections:</p><ul class="error-validation"></ul>');
				for (var key in validation.results){
					$('#alertNotif .message ul').append('<li>-'+key+': '+validation['results'][key]['msg']+'</li>')
				}
				$('#alertNotif .modal-footer').show();
			}
		});


		// if($('.updateItem').length){$('.updateItem').click(itemsadd.updateDetail($(this).data('itemdetail')));};
		$(itemsadd.itemForm+'select').select2().on('change', function(e){
			itemsadd.updateItemForm($(this).attr('name'));
		});
		$(itemsadd.itemForm+'input:not([type=file])').on('change', function(e){
			// itemsadd.updateItemForm($(this).attr('name')); 
		});
		$(itemsadd.itemForm+'textarea').on('change', function(e){
			// itemsadd.updateItemForm($(this).attr('name'));
		});

		$('input[name=checkSIB]').on('ifChecked', function(e){
			$('#collapseSIB').addClass('in');
			$('#collapseSIB input').val('');
			$(itemsadd.itemHiddenForm+'input[name=item_ship_in_a_box]').val('true');
		});

		$('input[name=checkSIB]').on('ifUnchecked', function(e){
			$('#collapseSIB').removeClass('in');
			$('#collapseSIB input').val('');
			$(itemsadd.itemHiddenForm+'input[name=item_ship_in_a_box]').val('false');
		});

		$('.image-thumb').on('load', function(e) {
			itemsadd.detectPhotoAdded();
		});

		$('.val-list-detail').on('keyup', function(ev) {
			itemsadd.detectDetailCompleted();
		});
		$('.val-list-desc').on('keyup', function(ev) {
			itemsadd.detectDescCompleted();
		});
		$('.val-list-ship').on('keyup', function(ev) {
			console.log("sdfsdf");
			itemsadd.detectShipCompleted();
		});
		itemsadd.updateItems.colors = $(itemsadd.itemHiddenForm+'input[name=item_color]').val();
		itemsadd.updateItems.sizes = $(itemsadd.itemHiddenForm+'input[name=item_size]').val();
		itemsadd.updateItems.sib = $(itemsadd.itemHiddenForm+'input[name=item_ship_in_a_box]').val();
		$('.item_images img.img-responsive').each(function(i,v){
			itemsadd.current_item_images.push($(v).data('imageid'));
		});
	},
	initItemActions(){
		$('.actionBtn').click(function(){
			$('#actionWarnPop').modal('show');
			$('#actionWarnPop .modal-title').text($(this).data('type') == 'unpublish' ? 'Unpublish Item' : 'Delete Item');
			$('#actionWarnPop .message').text($(this).data('type') == 'unpublish' ? 'Are you sure to unpublish this item from the store?' : 'Are you sure to delete this item from the store?');
			$('#actionWarnPop .actionItem').data('itemid', $(this).data('itemid'));
			$('#actionWarnPop .actionItem').data('type', $(this).data('type'));
			$('#actionWarnPop .actionItem').data('suite', $(this).data('suite'));
		});
		$('#actionWarnPop .actionItem').click(function(){
			itemsadd.actionItem($(this).data('type'), $(this).data('suite'),$(this).data('itemid'));
		});
	},
	onReadyListings(){
		itemsadd.initDatatables();
		$('.deleteBtn').click(function(){
			$('#deleteWarnPop').modal('show');
			$('#deleteWarnPop #deleteItem').data('itemid', $(this).data('itemid'));
		});
		$('#deleteWarnPop .deleteItem').click(function(){
			// itemsadd.deleteItem(''.$_SESSION['suite'].'',$(this).data('itemid'));
		});
	},
	addImg: function(){
		//$('#img-upload').click();
	},
	removeInit: function(){
		if(itemsadd.cat == ''){
			itemsadd.cat = $.parseJSON($('#cat-json').val());
		}
		$('#cat-json').remove();
	},
	detectPhotoAdded: function() {
		if($("#list-photo .image-thumb").hasClass('active')) {
			$('#list-photo .panel-heading').addClass('completed');
		} else {
			$('#list-photo .panel-heading').removeClass('completed');
		}
		itemsadd.detectFormCompleted();
	},
	detectDetailCompleted: function() {
		itemsadd.detectListOptionAdded('#list-detail', Array('#product_name', '#product_price', '#product_qty', '#merchant_sku', '#item_category'));
	},
	detectDescCompleted: function() {
		itemsadd.detectListOptionAdded('#list-description', Array('#product_desc'));
	},
	detectShipCompleted: function() {
		if($('#ship_product_dimensions').css('display') == 'none')
			itemsadd.detectListOptionAdded('#list-ship', Array('#product_weight'));
		else
			itemsadd.detectListOptionAdded('#list-ship', Array('#product_weight', '#product_dimension_0', '#product_dimension_1', '#product_dimension_2'));
	},
	detectListOptionAdded: function(parentId, inputIdsArray) {
		if(itemsadd.validateInputs(inputIdsArray))
			$(parentId + ' .panel-heading').addClass('completed');
		else {
			$(parentId + ' .panel-heading').removeClass('completed');
		}
		itemsadd.detectFormCompleted();
	},
	detectFormCompleted: function() {
		// if($('.completed').length == 5) {
		// 	$('.addItem').removeClass('disabled');
		// 	$('.addItem').addClass('enabled');
		// 	//itemsadd.onReady();
		// } else {
		// 	$('.addItem').addClass('disabled');
		// 	$('.addItem').removeClass('enabled');
		// }
	},
	validateInputs: function(ids) {
		var isValid = false;
		console.log('"'+$(ids[4]).text()+'"', '"Select Category"');

		for(var i = 0; i < ids.length; i++) {
			if($(ids[i]).val() != "" || ( $(ids[i]).text().indexOf("Select Category") < 0  && $(ids[i]).text() != "" ) ) {
				isValid = true;
			} else {
				isValid = false;
				break;
			}
		}
		return isValid;
	},
	initDropZone: function(images){
		var mockFile = { name: "Item", size: 12345 };
		console.log(images);
		Dropzone.autoDiscover = false;
		$('.img-drop').dropzone({
			maxFiles: 5,
			addRemoveLinks: true,
			acceptedFiles: 'image/*',
			paramName: 'file',
			autoProcessQueue: false,
			accept: function(file, done){
				reader = new FileReader();
				reader.onload = function(e){
					var base64URL = e.target.result;
					console.log(base64URL);
				}
				reader.readAsDataURL(file);
			},
			init: function(){
				this.on("addedfile", function() {
					if(this.files[5]!=null){
						this.removeFile(this.files[0]);
					}
				});
			},
			drop: function(){
				$(this.element).children('.drop-hide').css('display','none');
			},
		});
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
		$('.item-img').on('blur', function(){});
		$('.item-img').on('change', function () {
			var filename = $(this).val().split('\\').pop();
			imageId = $(this).data('id');
			// tempFilename = $(this).val();
			readFile(this);
		});
		$('#cropImageBtn').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'base64',
				format: 'jpeg',
				size: {width: 1000, height: 1000}
			}).then(function (resp) {
				$.each($('.item_images .image-thumb'),function(i,v){
					if($(v).attr('src') == ''){
						var selector = '#item-img-output'+(i+1);
						$('input[name=item-img'+(i+1)+']').hide();
						$(selector).nextAll('h3').hide();
						$(selector).attr('src', resp);
						$(selector).addClass('active');
						return false;
					}
				});
				$('#cropImagePop').modal('hide');
			});
		});
		$('.item_img_remove').on('click', function(ev){
			// console.log($(this).prev('img.image-thumb'));
			tempFiles.splice(parseInt(imageId)-1,1);
			$(this).parents('.product').find('input').show()
			.val('');
			$(this).nextAll('h3').show();
			$(this).prev('img.image-thumb').attr('src', '')
			.removeClass('active');
			itemsadd.detectPhotoAdded();
		})
		$('#cancelCropBtn').on('click', function (ev) {
			$('input[name=item-img'+imageId+']').val('');
			tempFiles.splice(parseInt(imageId)-1,1);
		});
	},
	initCropper: function(){

		var $uploadCrop, tempFiles = [], rawImg, imageId;
		var $image = $('#upload-image'),
		$scaleRange = $('#cropperPop #scaleRange'),
		$container = $('#cropper-container'),
	    $button = $('#cropperPop .cropImg'),
		$image = $('#upload-image');
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
			$image.cropper('destroy');
		});
		$('.item-img').on('blur', function(){});
		$('.item-img').on('change', function () {
			var filename = $(this).val().split('\\').pop();
			imageId = $(this).data('id');
			// tempFilename = $(this).val();
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
			
			$.each($('.item_images .image-thumb'),function(i,v){
				if($(v).attr('src') == ''){
					var selector = '#item-img-output'+(i+1);
					$('input[name=item-img'+(i+1)+']').hide();
					$(selector).nextAll('h3').hide();
					$(selector).attr('src', resizedCanvas.toDataURL('image/jpeg'));
					$(selector).data('imageid', 'new');
					$(selector).addClass('active');
					return false;
				}
			});
			$('#cropperPop').modal('hide');
		});
		$('.item_img_remove').on('click', function(ev){
			// console.log($(this).prev('img.image-thumb'));
			tempFiles.splice(parseInt(imageId)-1,1);
			$(this).parents('.product').find('input').show()
			.val('');
			$(this).nextAll('h3').show();
			itemsadd.item_images_remove.push($(this).prev('img.image-thumb').data('imageid'));
			$(this).prev('img.image-thumb').attr('src', '')
			.removeClass('active')
			.data('imageid', '');
			console.log(itemsadd.item_images_remove);

			var images = {'src':[],'imageid':[]};
			$('.item_images img.img-responsive').each(function(i,v){
				if ($(v).attr('src')){
					images['src'].push($(v).attr('src'));
					images['imageid'].push($(v).data('imageid'));
					$(v).parents('.product').find('input').show()
					$(v).nextAll('h3').show();
					$(v).attr('src','')
					.removeClass('active')
					.data('imageid', '');
				}
			});

			$.each(images['src'],function(i,v){
					var selector = '#item-img-output'+(i+1);
					$('input[name=item-img'+(i+1)+']').hide();
					$(selector).nextAll('h3').hide();
					$(selector).attr('src', v);
					$(selector).data('imageid', images['imageid'][i]);
					$(selector).addClass('active');
			});
			console.log(images)
			itemsadd.detectPhotoAdded();
		})
		$('#cropperPop .cancelCropBtn').on('click', function (ev) {
			$('input[name=item-img'+imageId+']').val('');
			tempFiles.splice(parseInt(imageId)-1,1);
		});
		
	},
	initWysihtml5: function(){
		var myCustomTemplates = {
			'font-styles' : function(locale) {
	        return false
		    },
			'emphasis' : function(locale) {
	        return "<li>"+
				  "<div class=\"btn-group\">"+
				    "<a class=\"btn  btn-default\" data-wysihtml5-command=\"bold\" title=\"CTRL+B\" tabindex=\"-1\" href=\"javascript:;\" unselectable=\"on\">Bold</a>"+
				    "<a class=\"btn  btn-default\" data-wysihtml5-command=\"italic\" title=\"CTRL+I\" tabindex=\"-1\" href=\"javascript:;\" unselectable=\"on\">Italic</a>"+
				    "<a class=\"btn  btn-default\" data-wysihtml5-command=\"underline\" title=\"CTRL+U\" tabindex=\"-1\" href=\"javascript:;\" unselectable=\"on\">Underline</a>"+
				  "</div>"+
				"</li>";
		    },
		    'image' : function(locale) {
	        return false
		    },
		    'blockquote' : function(locale) {
	        return false
		    },
		    'lists' : function(locale) {
		        return "<li>" +
		            "<a data-wysihtml5-command='insertUnorderedList' title='Unordered list' class='btn btn-none btn-default' ><span class='fa fa-list-ul'></span></a>" +
		            "</li><li>"+
		            "<a data-wysihtml5-command='insertOrderedList' title='Ordered list' class='btn btn-none btn-default' ><span class='fa fa-list-ol'></span></a>" +
		            "</li>";
		    }
		}
		$('#product_desc').wysihtml5({
			customTemplates: myCustomTemplates
		});
		var editor = $('#product_desc').data('wysihtml5').editor;
		 editor.on('load', function() {
		      var $doc = $(editor.composer.doc);
		      var out  = (function(){
		          return function(msg){  };
		      })();
		      $doc.keydown(function(evt){
		      	console.log();
		      });
		      $doc.keyup(function(evt){
		          if(evt.target.textContent.length > 0){
		          	$('#list-description .panel-heading').addClass('completed');
		          }
		          else{
		          	$('#list-description .panel-heading').removeClass('completed');
		          }
		          itemsadd.detectFormCompleted();
		      });
		  });
	},
	initDatatables: function(){
		var selectedItems = [],
		items_table = $('.product_table').DataTable({
			dom: 'frtp',
			ordering: false,
			searching: false,
			lengthChange: false,
			paging: false,
			responsive: true,
			fixedHeader: {
				headerOffset: 120
			},
			// buttons: [
			//  {
   //              text: '<i class="fa fa-plus"></i>Add Item',
   //              className: 'addItem',
   //              action: function ( e, dt, node, config ) {
   //                  window.location.href='/seller/items/add';
   //              }
   //          },
   //          {
   //              text: '<i class="fa fa-trash"></i>Delete Items(s)',
   //              className: 'deleteItems',
   //              action: function ( e, dt, node, config ) {
   //              	$('#deleteWarnPop').modal('show');
   //              	$('#deleteWarnPop .modal-title').text(selectedItems.length > 1 ? 'Unpublish Items' : 'Unpublish Item');
   //              	$('#deleteWarnPop .message').text('Are you sure to unpublish '+(selectedItems.length > 1 ? selectedItems.length+' items' : '1 item')+' from the store?');
  	// 				$('#deleteWarnPop #deleteItem').data('itemid', selectedItems.join(','));
   //              }
   //          }
	  //       ],
			// select: {
			// 	style: 'os',
			// 	selector: 'td:not(:nth-child(1))td:not(:nth-child(7))',
			// 	blurable: true
			// }

		});
		// deleteBtn = items_table.button(1);
		// items_table.buttons().container().appendTo($('.listing-options'));
		// items_table.on('select', function(e,dt,type,indexes){		
		// 	countSelected();
		// });
		// items_table.on('deselect', function(e,dt,type,indexes){
		// 	countSelected();
		// });

		function countSelected(){
			selectedItems = [];
			$.each(items_table.rows({selected: true}).nodes(), function(i,v){
				selectedItems.push($(v).data('itemid'));
			})
			console.log(selectedItems.length)
			if(selectedItems.length == 0){
				deleteBtn.disable();
				deleteBtn.text('<i class="fa fa-trash"></i> Delete Item');
			}
			else if (selectedItems.length == 1){
				deleteBtn.enable();
				deleteBtn.text('<i class="fa fa-trash"></i> Delete Item');
			}
			else {
				deleteBtn.enable();
				deleteBtn.text('<i class="fa fa-trash"></i> Delete '+selectedItems.length+' Items');
			}
		}
	},
	categoryClick: function(){
		var num = $(this).data('num'),
		id = String($(this).data('id')),
		collapse = '#collapse'+num,
		parent = '#select-cat-'+num,
		value = $(this).html();
		// $('#cat-dropdown button').html('');
		// $(parent).attr('data-id',id).html(value);
		// $(collapse).collapse('toggle');
		// itemsadd.renderCategory(id,num);
		var cats = id.split(','),
		outstr = '';
		$(itemsadd.itemHiddenForm+'input[name^="item_"][name$="cat_id"]').val('');
		for(var i=0; i<cats.length;i++){
			outstr += $('#cat-dropdown a[data-id="'+cats.slice(0,i+1)+'"]').text();
			if(i < cats.length-1){
				outstr += '>';
			}
			$('#cat-dropdown button').data(Array(i+1).join('sub')+'cat_id', parseInt(cats[i]));
			// $(itemsadd.itemHiddenForm+'input[name=item_'+Array(i+1).join('sub')+'cat_id]').val(parseInt(cats[i]));
		}
		$('#cat-dropdown button').html(outstr);
		itemsadd.detectListOptionAdded('#list-detail', Array('#product_name', '#product_price', '#product_qty', '#merchant_sku', '#item_category'));
	},
	listCategory: function(id,num){
		var catnum = (id+'').split(','),
		category = null,
		catprefix = '',
		returnlist = '',
		ct = 0;
		if(catnum.length == 1){
			category = itemsadd.cat[catnum[0]];
			catprefix = catnum[0]+',';
		}
		else if(catnum.length == 2){
			category = itemsadd.cat[catnum[0]][catnum[1]];
			catprefix = catnum[0]+','+catnum[1]+',';
		}
		else if(catnum.length == 3){
			category = itemsadd.cat[catnum[0]][catnum[1]][catnum[2]];
			catprefix = catnum[0]+','+catnum[1]+','+catnum[2]+',';
		}
		else if(catnum.length == 4){
			category = itemsadd.cat[catnum[0]][catnum[1]][catnum[2]][catnum[3]];
			catprefix = catnum[0]+','+catnum[1]+','+catnum[2]+','+catnum[3]+',';
		}
		$.each(category,function(k,v){
				if(k != 'name'){
					returnlist += '<h3 class="category" data-id="'+catprefix+k+'" data-num="'+num+'">'+v.name+'</h3>';
					ct++;
				}
			});
		if(ct <= 0){
			returnlist = '';
		}
		return returnlist;
	},
	renderCategory: function(id,num){
		if(num < $('.category-holder').data('num')){
			for(var i = (num+1); i< 10; i++){
				$('.addtl-category-'+i).slideUp(function(){
						$(this).remove();
					});
			}
		}
		var num = num + 1,
		apndh3 = itemsadd.listCategory(id,num);
		$('.category-holder').data('num',num);
		if(apndh3 != ''){
			$('<div/>',{
					'class': 'panel panel-default addtl-category-'+num
				}).append(
				$('<div/>',{
						'class': 'panel-heading'
					}).append(
					$('<h4/>',{
							'class': 'panel-title'
						}).append(
						$('<a/>',{
								'href': '#collapse'+num,
								'id': 'select-cat-'+num,
								'data-toggle': 'collapse',
								'data-id': '',
							}).html('Select Category')
					)
				)
			).append(
				$('<div/>',{
						'id': 'collapse'+num,
						'class': 'panel-collapse collapse cPanel'
					}).append(
					$('<div/>',{
							'class': 'panel-body padding-left80'
						}).html(apndh3)
				)
			).appendTo('.category-holder');
			$('.category').unbind('click').click(itemsadd.categoryClick)
		}
	},
	updateItemForm: function(name){
		var selector = "";
		if(name == 'product_desc'){
			selector = "textarea[name="+name+"]";
		}
		else if (name == 'producer_id'){
			selector = "select[name="+name+"]";
		}
		else{
			selector = "input[name="+name+"]";
		}
		var itemVal = $(itemsadd.itemForm+selector).val(),
		isValNum = false;

		// alert(itemVal);
		
		switch (name){
			case 'product_name':
			hiddenSelector = "input[name=item_name]";
			isValNum = false;
			break;
			case 'product_desc':
			hiddenSelector = "input[name=item_desc]";
			isValNum = false;
			break;
			case 'producer_id':
			hiddenSelector = "input[name=item_producer_id]";
			isValNum = false;
			break;
			case 'product_price':
			hiddenSelector = "input[name=item_price]";
			isValNum = true;
			break;
			case 'product_qty':
			hiddenSelector = "input[name=item_quantity]";
			isValNum = true;
			break;
			case 'discount':
			hiddenSelector = "input[name=item_discount]";
			isValNum = true;
			break;
			case 'bulk_qty':
			hiddenSelector = "input[name=item_minimum_order_size]";
			isValNum = true;
			break;
			case 'bulk_discount':
			hiddenSelector = "input[name=item_bulk_discount]";
			isValNum = true;
			break;
			case 'product_size':
			hiddenSelector = "input[name=item_size]";
			isValNum = false;
			break;
			case 'prod_sku':
			hiddenSelector = "input[name=item_sku]";
			isValNum = false;
			break;
			case 'merchant_sku':
			hiddenSelector = "input[name=item_merchant_sku]";
			isValNum = false;
			break;
			case 'product_weight':
			hiddenSelector = "input[name=item_weight]";
			isValNum = true;
			break;
			case 'product_length':
			hiddenSelector = "input[name=item_length]";
			isValNum = true;
			break;
			case 'product_width':
			hiddenSelector = "input[name=item_width]";
			isValNum = true;
			break;
			case 'product_height':
			hiddenSelector = "input[name=item_height]";
			isValNum = true;
			break;
			default:
			break;
		}
		$(itemsadd.itemHiddenForm+hiddenSelector).val(itemVal ? itemVal : isValNum ? '0' : '');
	},
	
	addItem: function(e){
		// var product = new item.product("Title", "Description");
		var form = function(input){
			return $(itemsadd.itemHiddenForm+'input[name='+input+']');
		},
		imgs = $('.item_images img.image-thumb');

		form('item_name').val($('input[name=product_name]').val());
		form('item_desc').val($('textarea[name=product_desc]').val());
		form('item_price').val($('input[name=product_price]').val());
		form('item_quantity').val($('input[name=product_qty]').val());
		form('item_discount').val($('input[name=discount]').val());
		form('item_bulk_discount').val($('input[name=bulk_discount]').val());
		itemsadd.updateItemForm('producer_id');
		itemsadd.updateItemForm('bulk_qty');
		var tempCatArr = [];
		[$('#cat-dropdown button').data('cat_id'),$('#cat-dropdown button').data('subcat_id'),$('#cat-dropdown button').data('subsubcat_id'),$('#cat-dropdown button').data('subsubsubcat_id')].forEach(function(cat_id){
				if(cat_id) tempCatArr.push(cat_id);
		});
		form('item_merchant_sku').val($('input[name=merchant_sku]').val());
		form('item_sku').val("TH"+(['HL','CA','HB','FO'][(parseInt(tempCatArr[0]))-7])+$('input[name=item_merchant_sku]').val()+tempCatArr[(tempCatArr.length-1)]);
		tempCatArr = tempCatArr.reverse();
		form('item_minimum_order_size').val($('input[name=bulk_qty]').val());
		form('item_color').val(itemsadd.updateItems.colors);
		form('item_size').val(itemsadd.updateItems.sizes);
		form('item_weight').val($('input[name=product_weight]').val());
		form('item_merchant_sla').val($('input[name=product_sla]').val());
		form('item_ship_in_a_box').val(itemsadd.updateItems.sib);
		if (itemsadd.updateItems.sib == 'true'){
			form('item_length').val($('input[name=product_length]').val());
			form('item_width').val($('input[name=product_width]').val());
			form('item_height').val($('input[name=product_height]').val());
		}
		var item_images = [];
		$.each(imgs, function(i,v){
			if($(v).attr('src').indexOf('data:image/jpeg;base64') !== -1){
				item_images.push($(v).attr('src'));
			}
		});
		var product = new itemsadd.product('add',form('item_product_id').val(), form('item_name').val(),form('item_desc').val(),form('item_producer_id').val(),tempCatArr.length > 0 ? tempCatArr[0] : 0,tempCatArr.length > 1 ? tempCatArr[1] : 0,tempCatArr.length > 2 ? tempCatArr[2] : 0,tempCatArr.length > 3 ? tempCatArr[3] : 0,form('item_price').val(),form('item_quantity').val(),form('item_discount').val(),form('item_bulk_discount').val(),form('item_minimum_order_size').val(),form('item_color').val(),form('item_size').val(),form('item_weight').val(),form('item_ship_in_a_box').val(),form('item_length').val(),form('item_width').val(),form('item_height').val(),form('item_sku').val(),form('item_merchant_sku').val(),form('item_merchant_sla').val(),item_images.join('|'));
		// console.log(product.jsonString());
		var form = $('#secretForm');
		form.validate({
			submitHandler: function(form){
				return false;
			}
		});
		if(form.valid()){
			itemsadd.postItem(product.jsonString());

		};
	},
	actionItem: function(type, ste, item){
		console.log(type);
		console.log(ste);
		console.log(item);
		$('#actionWarnPop').modal('hide');
		$('#alertNotif').modal('show');
		$('#alertNotif .modal-title').text(type == 'unpublish'? 'Unpublish Item':'Delete Item');
		$('#alertNotif .message').text(type == 'unpublish'? 'Unpublishing Item...':'Deleting Item...');
		$('#alertNotif .modal-footer').hide();
		var data = JSON.stringify({type: type, suite: ste, product_id: item});
		$.ajax({
		    type:'POST',
		    url:'/seller/items/actionItem',
		    data: data,
		    contentType: 'application/json',
		    success: function(ev){
				var json = $.parseJSON(ev);
				if (json['status']){
					window.location.href=(window.location.pathname.indexOf("/seller/items/edit/")) == 0 ? "/seller/items/listing/1" : window.location.pathname;
				}
				else{
					$('#alertNotif').modal('hide');
					setTimeout(function() {
						$('#alertNotif').modal('show');
						$('#alertNotif .modal-title').text('Item Unpublish Error');
						$('#alertNotif .message').html('<p>An error occurred on the server</p><p>Please try again later</p>');
						$('#alertNotif .modal-footer').show();
					}, 400);
				}
				console.log(json['msg']);
			},
		    fail: function(){
		    	$('#alertNotif').modal('hide');
				setTimeout(function() {
					$('#alertNotif').modal('show');
					$('#alertNotif .modal-title').text('Item Unpublish Error');
					$('#alertNotif .message').html('<p>An error occurred on the server</p><p>Please try again later</p>');
					$('#alertNotif .modal-footer').show();
				}, 400);
		    }
		});
	},
	clearForm: function(){
		console.log('Clear Form');
		$.each($('#itemForm input'), function(i,v){
			$(v).val('');
		});
		$('input[name=product_name]').val('');
		$('textarea[name=product_desc]').val('');
		$('input[name=product_price]').val('');
		$('input[name=product_qty]').val('');
		$('input[name=discount]').val('');
		$('input[name=bulk_discount]').val('');
		$('input[name=bulk_qty]').val('');
	},
	updateDetail: function(e, section){
		var form = function(input){
			return $(itemsadd.itemHiddenForm+'input[name='+input+']');
		},
		imgs = $('.item_images img.image-thumb');
		var item_images = [],
		image_id = [],
		tempCatArr = [];
		
		switch (section){
			case 1:
			console.log('Updating Images');
			$.each(imgs, function(i,v){
				if($(v).data('edit') == false){
					item_images.push(null);
				}
				else if($(v).attr('src').indexOf('data:image/jpeg;base64') !== -1){
					item_images.push($(v).attr('src'));
				}
			});
			break;
			case 2:
			form('item_name').val($('input[name=product_name]').val());
			form('item_desc').val($('textarea[name=product_desc]').val());
			form('item_price').val($('input[name=product_price]').val());
			form('item_quantity').val($('input[name=product_qty]').val());
			form('item_discount').val($('input[name=discount]').val());
			form('item_bulk_discount').val($('input[name=bulk_discount]').val());
			form('item_minimum_order_size').val($('input[name=bulk_qty]').val());

			[$('#cat-dropdown button').data('cat_id'),$('#cat-dropdown button').data('subcat_id'),$('#cat-dropdown button').data('subsubcat_id'),$('#cat-dropdown button').data('subsubsubcat_id')].forEach(function(cat_id){
				if(cat_id) tempCatArr.push(cat_id);
			});
			form('item_merchant_sku').val($('input[name=merchant_sku]').val());
			form('item_sku').val("TH"+(['HL','CA','HB','FO'][(parseInt(tempCatArr[0]))-7])+$('input[name=item_merchant_sku]').val()+tempCatArr[(tempCatArr.length-1)]);
			tempCatArr = tempCatArr.reverse();
			$.each(tempCatArr, function(i, v){
				form('item_'+Array(i+1).join('sub')+'cat_id').val(v);
			});
			break;
			case 4:
			form('item_color').val(itemsadd.updateItems.colors);
			form('item_size').val(itemsadd.updateItems.sizes);
			break;
			case 5:
			form('item_weight').val($('input[name=product_weight]').val());
			form('item_ship_in_a_box').val(itemsadd.updateItems.sib);
			if (itemsadd.updateItems.sib == 'true'){
				form('item_length').val($('input[name=product_length]').val());
				form('item_width').val($('input[name=product_width]').val());
				form('item_height').val($('input[name=product_height]').val());
			}
			else{
				form('item_length').val('');
				form('item_height').val('');
				form('item_width').val('');
			}
			break;
			default:
			$.each(imgs, function(i,v){
				if($(v).data('imageid') == itemsadd.current_item_images[i]){
					item_images.push(null);
				}
				else if($(v).attr('src').indexOf('data:image/jpeg;base64') !== -1){
					item_images.push($(v).attr('src'));
					image_id.push($(v).attr('src'));
				}
			});
			$.each(itemsadd.current_item_images, function(i,v){

			});
		
			form('item_name').val($('input[name=product_name]').val());
			form('item_desc').val($('textarea[name=product_desc]').val());
			form('item_price').val($('input[name=product_price]').val());
			form('item_quantity').val($('input[name=product_qty]').val());
			form('item_discount').val($('input[name=discount]').val());
			form('item_bulk_discount').val($('input[name=bulk_discount]').val());
			form('item_minimum_order_size').val($('input[name=bulk_qty]').val());
			form('item_color').val(itemsadd.updateItems.colors);
			form('item_size').val(itemsadd.updateItems.sizes);
			form('item_weight').val($('input[name=product_weight]').val());
			form('item_merchant_sla').val($('input[name=product_sla]').val());
			form('item_ship_in_a_box').val(itemsadd.updateItems.sib);
			form('item_merchant_sku').val($('input[name=merchant_sku]').val());
			form('item_sku').val("TH"+(['HL','CA','HB','FO'][(parseInt(tempCatArr[0]))-7])+$('input[name=item_merchant_sku]').val()+tempCatArr[(tempCatArr.length-1)]);
			if (itemsadd.updateItems.sib == 'true'){
				form('item_length').val($('input[name=product_length]').val());
				form('item_width').val($('input[name=product_width]').val());
				form('item_height').val($('input[name=product_height]').val());
			}
			else{
				form('item_length').val('');
				form('item_height').val('');
				form('item_width').val('');
			}
			[$('#cat-dropdown button').data('cat_id'),$('#cat-dropdown button').data('subcat_id'),$('#cat-dropdown button').data('subsubcat_id'),$('#cat-dropdown button').data('subsubsubcat_id')].forEach(function(cat_id){
				if(cat_id) tempCatArr.push(cat_id);
			});
			tempCatArr = tempCatArr.reverse();
			$.each(tempCatArr, function(i, v){
				form('item_'+Array(i+1).join('sub')+'cat_id').val(v);
			});

			break;
		}
		console.log(tempCatArr.length > 0 ? tempCatArr[0] : 0,tempCatArr.length > 1 ? tempCatArr[1] : 0,tempCatArr.length > 2 ? tempCatArr[2] : 0);
		var product = new itemsadd.product('update',form('item_product_id').val(),form('item_name').val(),form('item_desc').val(),form('item_producer_id').val(),form('item_cat_id').val() ? form('item_cat_id').val() : 0,form('item_subcat_id').val() ? form('item_subcat_id').val() : 0,form('item_subsubcat_id').val() ? form('item_subsubcat_id').val() : 0,form('item_subsubsubcat_id').val() ? form('item_subsubsubcat_id').val() : 0,form('item_price').val(),form('item_quantity').val(),form('item_discount').val(),form('item_bulk_discount').val(),form('item_minimum_order_size').val(),form('item_color').val(),form('item_size').val(),form('item_weight').val(),form('item_ship_in_a_box').val(),form('item_length').val(),form('item_width').val(),form('item_height').val(),form('item_sku').val(),form('item_merchant_sku').val(),form('item_merchant_sla').val(),item_images.join('|'));
		var secretForm = $('#secretForm');
		secretForm.validate({
			submitHandler: function(form){
				return false;
			}
		});
		console.log(form('item_product_id').val());
		if(secretForm.valid() && $('textarea[name=product_desc]').valid()){
			if (itemsadd.item_images_remove.length > 0){
				$.each(itemsadd.item_images_remove, function(i,v){
					var query = "product_id="+form('item_product_id').val()+"&image_id="+v,
					alertPop = '#alertNotif';
					$(alertPop + ' .modal-title').text('Update Error');
					$.post('/seller/items/deleteImage', query)
					.success(function(e){
						if (e.status != 'SUCCESS'){
							$(alertPop + ' .message').text(e.message);
							$(alerPop).modal('show');
							return false;
						}
					})
					.fail(function(e){
						$(alertPop + ' .message').text(e.message);
						$(alerPop).modal('show');
						return false;
					});
				});
				itemsadd.postItem(product.jsonString());
			}
			else{
				itemsadd.postItem(product.jsonString());
			}
		};
	},
	postItem: function(product){
		console.log(JSON.parse(product)['type']);
		$('.addItem').prop('disabled', true);
		var ret = false;
		$.ajax({
		    type:'POST',
		    url: '/seller/items/formAddItem',
		    data: product,
		    contentType: 'application/json',
		    success: function(e){
		    	console.log(e);
				var json = $.parseJSON(e);
				if (json['status']){
					$('#itemsubmitPop').modal('show')
					if(JSON.parse(product)['type'] == 'update'){
						$('#itemsubmitPop .modal-title').text('Item Edited');
						$('#itemsubmitPop .modal-body').html('<p class="text-center message">Your item will be temporarily unpublished while we review the changes made. Please check again in 24-48 hours.</p><p class="text-center message">Thank you.</p>');
						$('#itemsubmitPop .modal-footer button').removeClass('dismissBtn');
						$('#itemsubmitPop .modal-footer button').attr('onclick', 'window.location.href="/seller/items/"');
						$('#itemsubmitPop .modal-footer button').attr('data-dismiss', '');
					}
						
					// window.location.href="/product/view/"+json['msg'];
				}
				else{
					alert('Item failed to add\n'+json['msg']);
					$('.addItem').prop('disabled', false);
					$('.addItem').html('Add Item');
				}
				console.log(json['msg']);
				$(document).trigger('update.completed');
			},
		    fail: function(){
		    	console.log('fail');
		    	$('.addItem').prop('disabled', false);
				$('.addItem').html('Add Item');
				$(document).trigger('update.completed');
		    }
		});
	    return ret;
		// $.post('/seller/items/formAddItem', product)
		// .success(function(event){
		// 	var json = $.parseJSON(event);
		// 	if (json['status']){
		// 		alert('Item Added');
		// 	}
		// 	else{
		// 		alert('Item failed to add\n'+json['msg']);
		// 	}
		// 	console.log(json['msg']);
		// })
		// .fail(function(event){
		// 	alert('Item Fail to Add');
		// 	console.log(event)
		// });
	},
	validateItem: {
		isValid: function(){
			var ret = {};
			ret['results'] = {
				'Photos':
				{
					'status':false,
					'msg': 'Please include at least one photo of the item'
				}
			};
			ret['status'] = true;
			ret['results']['Photos']['status'] = this.hasImages();
			for (var key in ret['results']){
				if (!ret['results'][key]['status']){
					ret['status'] = false;
					break;
				}
			}
			return ret;
		},
		hasImages: function(){
			var ret = false;
			$('.item_images img.img-responsive').each(function(i,v){
				if ($(v).attr('src')){
					ret = true;
					return false;
				}
			});
			return ret;
		}
	}
};

function appendColor(color){
	var textArr = itemsadd.updateItems.colors.split(',');
	if(textArr[0]=='') textArr.splice(0,1);
	console.log(color);
	var textArrPos = $.inArray(color,textArr);
	console.log(textArrPos);
	if (textArrPos != -1){
		textArr.splice(textArrPos, 1);
	}
	else{
		textArr.push(color);
	}
	console.log(textArr);
	itemsadd.updateItems.colors = textArr.join(',');
	console.log(itemsadd.updateItems);
	// $(itemsadd.itemHiddenForm+'input[name=item_color]').val(textArr.join(','));
}

function appendSizes(size){
	var textArr = itemsadd.updateItems.sizes.split(',');
	if(textArr[0]=='') textArr.splice(0,1);
	var textArrPos = $.inArray(size,textArr);
		console.log(textArr);
		console.log(textArrPos);
	if (textArrPos != -1){
		textArr.splice(textArrPos, 1);
	}
	else{
		textArr.push(size);
	}
	itemsadd.updateItems.sizes = textArr.join(',');
	// $(itemsadd.itemHiddenForm+'input[name=item_size]').val(textArr.join(','));
}

$('.product-colors').on('change','input',function(){
	appendColor($(this).val());
});

$('.product-sizes').on('change','input',function(){
	appendSizes($(this).val());
});


$('.sib').on('change','input',function(){
	itemsadd.updateItems.sib = $(this).val();
	var isTrue = $(this).val() == 'true';
	$.each(['height','width','length'], function(i,v){
		$('#ship_product_dimensions').toggle(isTrue);
		$('input[name=product_'+v+']').val('');
		$('input[name=product_'+v+']').prop('disabled', isTrue ? false : true);
		$('input[name=product_'+v+']').prop('required', isTrue ? true : false);
		// $('.vol-weight').text('');
	});
	itemsadd.detectShipCompleted();
	// $(itemsadd.itemHiddenForm+'input[name=item_ship_in_a_box]').val($(this).val());
});

$('input[name=product_length], input[name=product_width], input[name=product_height]').on('change', function(){
	var dimensions = {
		length: $('input[name=product_length]').val(),
		width: $('input[name=product_width]').val(),
		height: $('input[name=product_height]').val()
	},
	weight = Math.ceil(((dimensions.length * dimensions.width * dimensions.height)/5000)/0.5)*0.5;
	if (weight > 0 && weight < 1){
		weight = 1;
	}
	// $('.vol-weight').text('Volumetric Weight: '+weight+' kg');
})

$('.close-btn').on('click', function(e) {
	console.log($(e.currentTarget).parent());
	$($(e.currentTarget).parent().parent()).css('display', 'none');

});

$('.link-btn').on('click', function(e){
	console.log('dialog click');
	$($(e.currentTarget).next()).css('display', 'block');
});
// $(itemsadd.onReady);