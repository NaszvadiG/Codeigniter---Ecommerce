<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
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

	<h1>Sale Confirmation</h1>
    <div class="sale-description">
        <div class="row">
            <div class="col-sm-3 col-lg-3 col-md-3 col-xs-6">
                <div class="product">
                    <div class="image">
                        <a>
                            <img src="images/product/9.jpg" alt="img"
                                 class="img-responsive">
                        </a>
                        <div class="promotion"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-lg-9 col-md-9 col-xs-6">
                <h1>Product Name</h1>
                <h3 style="padding:0">Product Description</h3>
                <h3>Vestibulum efficitur eu ante sed rhoncus. Cum socils natoque penatibus et magnis dis parturient montes,
                nascetur ridiculus mus. Integer eget erat cursus, flnlbus lacus slt amet, colutpat est. Etiam justo dui,
                ultrics pulvinar libero nec, placerat sodales dolor. Integer risus leo, volutpat non condimentum a, tempor non purus.
                Donec consequat ipsum non felis sagittis, sit amet vulputate neque eleifend. Nunc laoreet rhoncus
                turpis, tristique laoreet metus iaculis sed. Donec sit amet eros et ex eleifend porttior quis ut orci. Integer lacinia facilisis nunc ornare auctor.</h3>
            </div>
        </div>
        <div class="row margin-top20 total-description">
            <div class="col-sm-6 col-md-6 col-xs-6">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-xs-6">
                        <h2>Price:</h2>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-6">
                        <h2 style="color: #990000">$23.08</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-xs-6">
                        <h2>Quantity Bought:</h2>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-6">
                        <h2 style="color: #990000">1</h2>
                    </div>
                </div>
                <div class="static-pan margin-top20">
                    <h1>Ship To:</h1>
                    <div>
                        <h2>Consolidation Center</h2>
                        <h2>c/o Order: 123456789</h2>
                        <h2>Address 1</h2>
                        <h2>Address 1</h2>
                        <h2>City</h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-6">
                <div class="row">
                    <div class="col-sm-6col-md-6 col-xs-6">
                        <h2>Color:</h2>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-6">
                        <h2 style="color: #990000">GREEN</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-xs-6">
                        <h2>Size:</h2>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-6">
                        <h2 style="color: #990000">L</h2>
                    </div>
                </div>
                <div class="margin-top20 select-reason">
                    <div class="panel-group">
                        <div class="panel panel-default " id="reason_selection">
                            <div class="panel-heading">
                                <h4 class="panel-title" >
                                    <a data-toggle="collapse" href="#collapse1" >Select Reason</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse cPanel">
                                <div class="panel-body"><h3 value="reason1">Reasone1</h3><h3 value="reason2">Reasone2</h3><h3 value="reason3">Reasone3</h3><h3 value="reason4">Reasone4</h3><h3 value="reason5">Reasone5</h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row button-div margin-top-10">
            <div class="col-sm-6 col-md-6 col-xs-6">
                <a class="btn btn-primary float-right redbtn squarebtn">Confirm</a>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-6">
                <a class="btn btn-primary float-right grey-btn squarebtn" id="cancel_sale">Cancel</a>
            </div>
        </div>
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

<div class="subscribe">
	<div class="row">
		<div class="inputdiv col-md-8 col-sm-8 col-xs-8" >
			<input style="padding: 0 20px;" type="text" class="email-bottom" placeholder="Enter email to receive a welcome gift" />
		</div>
		<div class="buttondiv col-md-4 col-sm-4 col-xs-4" >
			<button id="subscribe-btn">Subscribe</button>
		</div>
	</div>
</div>
<?php $this->view("common/seller/footer"); ?>