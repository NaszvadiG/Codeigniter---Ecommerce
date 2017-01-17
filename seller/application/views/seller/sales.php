<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header");?>
<div class="container main-container headerOffset">

    <!-- Main component call to action -->

    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <?php draw_seller_breadcrumb($this->uri->segment_array()); ?>
            </ul>
        </div>
    </div>
    <!-- /.row  -->

    <div class="product_table">
        <table style="width:100%" class="cartTable">
          <tr class="CartProduct cartTableHeader">
            <th class="hidden-xs">ORDER DATE</th>
            <th class="hidden-xxs">IMAGE</th>
            <th class="hidden-xs">PRODUCT CODE</th>
            <th class="hidden-xs">SERVICE AGREEMENT</th>
            <th class="hidden-xs">DAYS LAPSED</th>
            <th class="show-xs">INFO</th>
          </tr>
          <?php
          	if($sales['status'] == 'SUCCESS'){
				foreach($sales['products_list'] AS $k=>$v){ 
				$order = array();
				$order['date'] = '28 SEP 2016';
				$order['imgref'] = base_url('seller/sales/confirmation/'.$v['id']);
				$order['imgsrc'] = $v['image_full_path'];
				$order['id'] = $v['id'];
				$order['sa'] = rand(2,5);
				$order['dayslapsed'] = rand(2,7);
				$order['lapsecolor'] = ($order['dayslapsed'] > $order['sa']) ? 'color:red' : '';
				
				?>
					<tr class="CartProduct">
			            <td class="hidden-xs"><h3><?php echo $order['date']; ?></h3>
			            <h3>Order No: 1234567</h3></td>
			            <td><div class="item">
			                    <div class="product">
			                        <div class="image">
			                            <a href="<?php echo $order['imgref']; ?>"><img src="<?php echo $order['imgsrc']; ?>" alt="img" class="img-responsive"></a>
			                        </div>
			                    </div>
			                </div>
			            </td>
			            <td class="hidden-xs"><h3><?php echo $order['id']; ?></h3></td>
			            <td class="hidden-xs"><h3><?php echo $order['sa']; ?> DAYS</h3></td>
			            <td class="hidden-xs"><h3 style="<?php echo $order['lapsecolor']; ?>"><?php echo $order['dayslapsed']; ?> DAYS</h3></td>
			            <td class="show-xs">
			                <h3><span>ORDER DATE: <p> <?php echo $order['date']; ?> </p></span></h3>
			                <h3><span>PRODUCT CODE: <p> <?php echo $order['id']; ?> </p></span></h3>
			                <h3><span>SERVICE AGREEMENT: <p> <?php echo $order['sa']; ?> DAYS </p></span></h3>
			                <h3><span>DAYS LAPSED: <p style="<?php echo $order['lapsecolor']; ?>"> <?php echo $order['dayslapsed']; ?> DAYS </p></span></h3>
			            </td>
			          </tr>
				<?php }
			}
			else{
				
			}
          ?>
        </table>
    </div>
</div>
<!-- /main container -->
<div class="gap"></div>

<!-- Product Details Modal  -->
<div class="modal fade" id="productSetailsModalAjax" tabindex="-1" role="dialog"
     aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php $this->view("common/seller/footer"); ?>