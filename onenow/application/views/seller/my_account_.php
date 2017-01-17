<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<div class="container main-container headerOffset">

	<div class="row">
		<div class="breadcrumbDiv col-lg-12">
			<ul class="breadcrumb">
				<?php draw_seller_breadcrumb($this->uri->segment_array()); ?>
			</ul>
		</div>
	</div>

	<div class="row">

		<div class="col-lg-9 col-md-9 col-sm-7">
			<h1 class="section-title-inner"><span><i class="fa fa-unlock-alt"></i> My account </span></h1>

			<div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <p> Your account has been created. </p>

                    <h2 class="block-title-2"><span>Welcome to your account. Here you can manage all of your personal information and orders.</span>
                    </h2>
                    <ul class="myAccountList row">
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight">
	                            <a title="Personal information" href="user-information.html">
		                            <i class="fa fa-cog"></i>Personal Information
                                </a>
                            </div>
                        </li>
                        <!-- <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight"><a title="My addresses" href="my-address.html"><img src="images/addressbook-icon.png" style="margin-bottom: 16px;"> Address Book</a></div>
                        </li>
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight"><a title="Add  address" href="payment-method.html"> <i
                                    class="fa fa-credit-card"> </i> Payment Methods</a></div>
                        </li>
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight"><a title="Orders" href="order-list.html"><img src="images/orderhistory-icon.png" style="margin-bottom: 1px;"> Order history </a></div>
                        </li>


                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight"><a title="My wishlists" href="wishlist.html"><i
                                    class="fa fa-heart"></i> My wishlists </a></div>
                        </li> -->
                    </ul>
                    <div class="clear clearfix"></div>
                </div>
                <div class="col-xs-12">
	                <div class="row">
	                	<div class="col-xs-6">
		                	<div class="row">
		                		<h3 class="block-title-2">Your Basic Information</h3>
		                	</div>
	                	</div>
	                	<div class="col-xs-6">
	                		<button class="btn btn-primary pull-right">Update</button>
	                	</div>
	                </div>
                	<div class="row">
                		<div class="col-xs-12">
                			<h3>NAME</h3>
                			<div class="form-group col-xs-6">
                				<input type="text" class="form-control" name="firstName" placeholder="First Name">
                			</div>
                			<div class="form-group col-xs-6">
                				<input type="text" class="form-control" name="lastName" placeholder="Last Name">
                			</div>
                		</div>
                		<div class="col-xs-12">
                			
                			<div class="form-group col-xs-6">
                				<div class="row">
	                				<h3>Email</h3>
                				</div>
                				<input type="text" class="form-control" name="email" placeholder="Email">
                			</div>
                			<div class="form-group col-xs-6">
                				<div class="row">
	                				<h3>Gender</h3>
                				</div>
								<select name="" id="" disabled>
									<option value="PH">Male</option>
									<option value="SG">Female</option>
								</select>
                			</div>
                		</div>
                	</div>
                </div>
                <div class="col-xs-12">
                	<div class="row">
	                	<div class="col-xs-6">
		                	<div class="row">
		                		<h3 class="block-title-2">Change Password</h3>
		                	</div>
	                	</div>
	                	<div class="col-xs-6">
	                		<button class="btn btn-primary pull-right">Change</button>
	                	</div>
	                </div>
                	<div class="row">
                		<div class="col-xs-12">
                			<h3>Old Password</h3>
                			<div class="form-group col-xs-12">
                				<input type="text" class="form-control" name="oldPass" placeholder="Old Password">
                			</div>
                			<h3>New Password</h3>
                			<div class="form-group col-xs-12">
                				<input type="text" class="form-control" name="pass" placeholder="New Password">
                			</div>
                			<h3>Retype New Password</h3>
                			<div class="form-group col-xs-12">
                				<input type="text" class="form-control" name="retypePass" placeholder="Retype New Password">
                			</div>
                		</div>
                	</div>
                </div>
            </div>
            <!--/row end-->

		</div>

		<div class="col-lg-3 col-md-3 col-sm-5"></div>
	</div>
	<!--/row-->

	<div style="clear:both"></div>
</div>
<!-- /wrapper -->

<div class="gap"></div>
<?php $this->view("common/seller/footer"); ?>