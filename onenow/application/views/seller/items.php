<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<div class="container main-container headerOffset">

    <!-- Main component call to action -->

    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li class="active"><?php echo $this->translations->web_seller_listings; ?></li>
            </ul>
        </div>
    </div>
    <!-- /.row  -->
    <!-- <div class="row listing-options">
        <div class="button-container col-xs-12 col-sm-offset-8 col-sm-2">
            <button class="btn btn-primary col-xs-12 squarebtn addItem" onclick="window.location.href='/seller/items/add' "><i class="fa fa-plus"></i>Add Item</button>
        </div>
        <div class="button-container col-xs-12 col-sm-2">
            <button class="btn btn-primary col-xs-12 squarebtn deleteItems"><i class="fa fa-trash-o"></i>Delete Item(s)</button>
        </div>
    </div> -->
    <div class="row categoryProduct xsResponse clearfix">
        <!-- CHECK HERE IF ITEMS EXISTS, SHOW TABLE IF TRUE -->
        <?php
            if($products['status'] == 'SUCCESS' && !empty($products['list'])){
        ?>
        <table style="width:100%" class="cartTable product_table listing">
            <thead>
                <tr class="CartProduct cartTableHeader">
                    <th><?php echo strtoupper($this->translations->web_seller_image); ?></th>
                    <th><?php echo strtoupper($this->translations->web_seller_item_name); ?></th>
                    <th class="hidden-480"><?php echo strtoupper($this->translations->web_seller_qty_stock); ?></th>
                    <th class="hidden-480"><?php echo strtoupper($this->translations->web_price); ?></th>
                    <th class="hidden-480"><?php echo strtoupper($this->translations->web_seller_date_added); ?></th>
                    <th class="hidden-480"><?php echo strtoupper($this->translations->web_seller_status); ?></th>
                    <th class="hidden-480"><?php echo strtoupper($this->translations->web_seller_edit_unpublish); ?>/<?php echo strtoupper($this->translations->web_delete); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($products['list'] AS $k=>$v){
                ?>
                <tr data-itemId="<?php echo $v['id'] ?>">
                    <td class="col-md-1">
                        <div class="product">
                            <div class="image">
                                <a href="<?php echo base_url('product/view/'.$v['id']); ?>" target="_blank"><img src="<?php echo $v['image'] ? $v['image'] : base_url('seller/assets/images/noimg.jpg'); ?>" alt="img" class="img-responsive"></a>
                            </div>
                        </div>
                    </td>
                    <td class="col-md-2">
                        <?php echo $v['name'] ?>
                        <button class="link-btn show-480">View More</button>
                        <div class="modal-detail show-480">
                            <div class="overlay"><button class="close-btn"><i class="fa fa-close"></i></button></div>
                            <div class="detail-view">
                                <div class="item_img">
                                    <img src="<?php echo $v['image'] ? $v['image'] : base_url('seller/assets/images/image-not-found/380x285.png'); ?>" alt="img" class="img-responsive">
                                </div>
                                <p><?php echo $v['name'] ?></p>
                                <p><?php $prc = $v['price']; echo "THB ".$prc ?></p>
                                <p><?php echo "QTY: ".$v['qty']; ?></p>
                                <p><?php  $coeff = 60 * 5;
                                    $date = ceil(strtotime(date($v['created'])) / $coeff) * $coeff;
                                    $pickupDate = date('d M Y - g:iA' ,$date);
                                    echo $pickupDate; ?>
                                </p>
                                <p class="item_status">
                                 <?php
                                      switch (implode(',', array($v['available'],$v['published']))) {
                                          case '0,0':
                                              $statusTxt = 'For Deletion';
                                              break;
                                          case '1,0':
                                              $statusTxt = 'Unpublished';
                                              break;
                                          case '1,1':
                                              $statusTxt = 'Published';
                                              break;
                                          default:
                                              $statusTxt = '';
                                              break;
                                      }
                                      echo isset($statusTxt) ? $statusTxt : ""; ?>
                                 </p>
                                 <ul class="list-inline text-center">
                                    <li><a class="btn btn-edit" href="<?php echo base_url('seller/items/edit/'.$v['id']); ?>">EDIT</a></li>
                                    <li><a href="javascript:void(0)" class="btn btn-delete deleteBtn" data-name="<?php echo $v['name'] ?>" data-itemId="<?php echo $v['id'] ?>">DELETE</a></li>
                                 </ul>

                            </div>
                        </div>
                    </td>
                    <td class="col-md-1 hidden-480">
                        <?php echo $v['qty']; ?>
                    </td>
                    <td class="hidden-480">
                        <?php 
                        $prc = $v['price'];

                        echo $prc." THB" ?>
                    </td>
                    <td class="col-md-2  hidden-480">
                        <?php 
                            $coeff = 60 * 5;                        
                            $date = ceil(strtotime(date($v['created'])) / $coeff) * $coeff;
                            $pickupDate = date('d M Y - g:iA' ,$date);
                            echo $pickupDate;
                         ?>
                    </td>
                    <td class="col-md-2  hidden-480">
                    <?php 
                        switch (implode(',', array($v['available'],$v['published']))) {
                            case '0,0':
                                $statusTxt = $this->translations->web_seller_for_deletion;
                                break;
                            case '1,0':
                                 $statusTxt = $this->translations->web_seller_unpublished;
                                break;
                            case '1,1':
                                $statusTxt = $this->translations->web_seller_published;
                                break;
                            default:
                                $statusTxt = '';
                                break;
                        }

                        echo isset($statusTxt) ? $statusTxt : "";
                     ?>
                    </td>
                    <td class="col-md-1  hidden-480">
                        <ul class="list-inline text-center">
                            <li><a href="<?php echo base_url('seller/items/edit/'.$v['id']); ?>"><i class="fa fa-lg fa-pencil" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0)" class="actionBtn" data-name="<?php echo $v['name'] ?>" data-suite="<?php echo $this->authuser->suite; ?>" data-type="unpublish" data-itemId="<?php echo $v['id'] ?>"><i class="fa fa-lg fa-eye-slash" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0)" class="actionBtn" data-name="<?php echo $v['name'] ?>" data-suite="<?php echo $this->authuser->suite; ?>" data-type="delete" data-itemId="<?php echo $v['id'] ?>"><i class="fa fa-lg fa-trash" aria-hidden="true"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <!-- END LOOP -->
                <?php
                    }
                ?>
            </tbody>
        </table>
        <?php 
            }
            else {
         ?>
        <!-- END IF STATEMENT, SHOW NO ITEMS LISTED IF ITEMS IN ARRAY HERE -->
        <div class="no-items">
            <img src="<?php echo base_url('seller/assets/images/noItems_toDisplay.jpg'); ?>" alt="No items to display">
        </div>
        <?php 
            }
        ?>
        
    	<!-- <?php
    	if($products['status'] == 'SUCCESS'){
			foreach($products['products_list'] AS $k=>$v){
				$new = rand(0,1);
				?>
				<div class="item col-sm-3 col-lg-3 col-md-3 col-xs-6">
		            <div class="product">
		                <div class="image">
		                    <a href="<?php echo base_url('seller/items/preview/'.$v['id']); ?>"><img src="<?php echo $v['images'][0]['fullpath']; ?>" alt="img" class="img-responsive"></a>
		                    <div class="promotion">
		                    <?php if($new){?>
		                    	<span class="new-product"> <?php echo ($new) ? 'NEW' : ''; ?></span>
							<?php }
							if($v['product_discount'] > 0){?>
		                    	<span class="discount"> <?php echo $v['product_discount']; ?>%</span>
							<?php } ?>
							</div>
		                </div>
		            </div>
		        </div>
				<?php
			}
		}
		else{
			
		}
    	?> -->
    </div>
    <!--/.categoryProduct || product content end-->

    <div class="w100 categoryFooter">
        <div class="pagination pull-right no-margin-top">
            <ul class="pagination no-margin-top paginator">
                
            </ul>
        </div>
    </div>
</div>
<!-- /main container -->

<div class="gap"></div>

<!-- Product Details Modal  -->
<div class="modal fade" id="productSetailsModalAjax" tabindex="-1" role="dialog" aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php $this->view("common/seller/footer"); ?>

<!-- Delete Item Modal  -->
<div class="modal fade" id="actionWarnPop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Unpublish Item</h4>
            </div>
            <div class="modal-body">
                <p class="text-center message">Are you sure to unpublish this item from the store?</p>
                <div id="boxLabels">
                    <div id="boxLabels-contents"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-4 popPrintBtnContainer">
                    <button type="button" id="deleteItem" class="btn btn-primary onenowBtn newredBtn actionItem" data-itemId="" style="width: 100%;"><?php echo $this->translations->web_yes; ?></button>
                </div>
                <div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
                    <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_no; ?></button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Delete Item Modal  -->
<div class="modal fade" id="actionWarnPop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center"><?php echo form_label($this->translations->web_seller_delete_item); ?></h4>
            </div>
            <div class="modal-body">
                <p class="text-center message"><?php echo form_label($this->translations->web_seller_are_you_sure_to_delete_this_item); ?><span class="itemName"></span> ?</p>
                <div id="boxLabels">
                    <div id="boxLabels-contents"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-4 popPrintBtnContainer">
                    <button type="button" id="actionItem" class="btn btn-primary onenowBtn newredBtn deleteItem" data-itemId="" data-type="" style="width: 100%;"><?php echo $this->translations->web_yes; ?></button>
                </div>
                <div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
                    <button type="button" id="pickupConfirmBtn" class="btn btn-primary onenowBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_no; ?></button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Delete Item Modal  -->
<div class="modal fade" id="alertNotif" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="alertNotifModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Unpublish Item</h4>
            </div>
            <div class="modal-body">
                <p class="text-center message">Unpublishing item...</p>
                <div id="boxLabels">
                    <div id="boxLabels-contents"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4 popDismissBtnContainer">
                    <button type="button" class="btn btn-primary onenowBtn newredBtn" data-dismiss="modal" style="width: 100%;"><?php echo $this->translations->web_seller_ok; ?></button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>