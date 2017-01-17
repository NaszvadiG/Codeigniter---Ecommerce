<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<!-- /.Fixed navbar  -->
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <?php draw_seller_breadcrumb($this->uri->segment_array()); ?>
            </ul>
        </div>
    </div>
    <div class="row transitionfx margin-top50">

        <!-- left column -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <!-- product Image and Zoom -->
            <div class="button-div">
                <button class="transbutton">EDIT</button>
                <button class="transbutton">SAVE</button>
                <button class="transbutton">DELETE</button>
            </div>
            <div class="main-image sp-wrap col-lg-12 no-padding">

                <a href="<?php echo $product['image_full_path']; ?>"><img src="<?php echo $product['image_full_path']; ?>" class="img-responsive" alt="img"></a>
                <a href="<?php echo $product['image_full_path']; ?>"><img src="<?php echo $product['image_full_path']; ?>" class="img-responsive" alt="img"></a>
                <a href="<?php echo $product['image_full_path']; ?>"><img src="<?php echo $product['image_full_path']; ?>" class="img-responsive" alt="img"></a></div>
        </div>
        <!--/ left column end -->

        <!-- right column -->
        <div class="col-lg-6 col-md-6 col-sm-5">
            <h1 class="product-title"> <?php echo $product['name']; ?></h1>



                <div class="rating">
                    <p><span><i class="fa fa-star"></i></span> <span><i class="fa fa-star"></i></span> <span><i
                            class="fa fa-star"></i></span> <span><i class="fa fa-star"></i></span> <span><i
                            class="fa fa-star-o "></i></span> <span class="ratingInfo">   </span></p>
                </div>
                <div class="product-price"><span class="price-sales"> $<?php echo $product['price']; ?></span> <span class="price-standard">$<?php echo $product['price'] * $product['product_discount']; ?></span>
                </div>
                <div class="details-description">
                    <p><?php echo $product['description']; ?> </p>
                </div>

                <div class="productFilter productFilterLook2">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <div class="filterBox">
                                <select class="form-control">
                                    <option value="strawberries" selected>Quantity</option>
                                    <option value="mango">1</option>
                                    <option value="bananas">2</option>
                                    <option value="watermelon">3</option>
                                    <option value="grapes">4</option>
                                    <option value="oranges">5</option>
                                    <option value="pineapple">6</option>
                                    <option value="peaches">7</option>
                                    <option value="cherries">8</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <div class="filterBox">
                                <select class="form-control">
                                	<?php
                                	$sz = explode(',',$product['size']); 
                                	foreach($sz AS $v){
										echo '<option value="'.$v.'">'.$v.'</option>';
									}
                                	?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- productFilter -->

                <div class="cart-actions">
                    <div class="addto row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button onclick="productAddToCartForm.submit(this);"
                                    class="button btn-block btn-cart cart first" title="Add to Cart" type="button">Add
                                to Cart
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a class="link-wishlist wishlist btn-block ">Add
                            to Wishlist</a></div>
                    </div>
                    <div style="clear:both"></div>
                    <h3 class="incaps"><i class="fa fa fa-check-circle-o color-in"></i> In stock</h3>

                    <h3 style="display:none" class="incaps"><i class="fa fa-minus-circle color-out"></i> Out of stock
                    </h3>

                    <h3 class="incaps"><i class="glyphicon glyphicon-lock"></i> Secure online ordering</h3>
                </div>
                <!--/.cart-actions-->

                <div class="clear"></div>
                <div class="product-tab w100 clearfix">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                        <li><a href="#sellerinfo" data-toggle="tab">About the seller</a></li>
                        <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
                        <li><a href="#bulkdiscount" data-toggle="tab">Bulk discount</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="details">
                        	<?php echo $product['description']; ?>
                        </div>
                        <div class="tab-pane" id="sellerinfo">
                            Seller information goes here
                        </div>
                        <div class="tab-pane" id="shipping">
                            <table>
                                <colgroup>
                                    <col style="width:33%">
                                    <col style="width:33%">
                                    <col style="width:33%">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td>Standard</td>
                                    <td>1-5 business days</td>
                                    <td>$7.95</td>
                                </tr>
                                <tr>
                                    <td>Two Day</td>
                                    <td>2 business days</td>
                                    <td>$15</td>
                                </tr>
                                <tr>
                                    <td>Next Day</td>
                                    <td>1 business day</td>
                                    <td>$30</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">* Free on orders of $50 or more</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane" id="bulkdiscount">
                            Discount for <?php echo $product['bulk_discount']; ?> items or more!
                        </div>
                    </div>
                    <!-- /.tab content -->

                </div>
                <!--/.product-tab-->

                <div style="clear:both"></div>
                <div class="product-share clearfix">
                    <p> SHARE </p>

                    <div class="socialIcon"><a href="#"> <i class="fa fa-facebook"></i></a> <a href="#"> <i
                            class="fa fa-twitter"></i></a> <a href="#"> <i class="fa fa-google-plus"></i></a> <a
                            href="#">
                        <i class="fa fa-pinterest"></i></a></div>
                </div>
                <!--/.product-share-->

        </div>
        <!--/ right column end -->

    </div>
    <!--/.row-->

    <div class="row recommended">
        <h1> YOU MAY ALSO LIKE </h1>

        <div class="row  categoryProduct xsResponse clearfix">
            <div class="item col-sm-3 col-lg-3 col-md-3 col-xs-6">
                <div class="product">
                    <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
                       data-placement="left">
                        <i class="glyphicon glyphicon-heart"></i>
                    </a>

                    <div class="image">
                        <div class="quickview">
                            <a data-toggle="modal" class="btn btn-xs btn-quickview" href="ajax/product.html"
                               data-target="#productSetailsModalAjax">Quick View </a>

                        </div>
                        <a href="product-details.html"><img src="<?php echo base_url('onenow/assets/images/seller/product/'); ?>34.jpg" alt="img"
                                                            class="img-responsive"></a>

                        <div class="promotion"><span class="new-product"> NEW</span> <span
                                class="discount">15% OFF</span></div>
                    </div>
                    <div class="description">
                        <h4><a href="product-details.html">CONSECTETUER ADIPISCING</a></h4>

                        <div class="grid-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                        <div class="list-description">
                            <p> Sed sed rutrum purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Pellentesque risus lacus, iaculis in ante vitae, viverra hendrerit ante. Aliquam vel
                                fermentum elit. Morbi rhoncus, neque in vulputate facilisis, leo tortor sollicitudin
                                odio, quis pellentesque lorem nisi quis enim. In dolor mi, hendrerit at blandit
                                vulputate, congue a purus. Sed eget turpis sit amet orci euismod accumsan. Praesent
                                sit amet placerat elit. </p>
                        </div>
                        <span class="size">XL / XXL / S </span></div>
                    <div class="price"><span>$25</span></div>
                    <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
                            class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
                </div>
            </div>
            <!--/.item-->
            <div class="item col-sm-3 col-lg-3 col-md-3 col-xs-6">
                <div class="product">
                    <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
                       data-placement="left">
                        <i class="glyphicon glyphicon-heart"></i>
                    </a>

                    <div class="image">
                        <div class="quickview">
                            <a data-toggle="modal" class="btn btn-xs btn-quickview" href="ajax/product.html"
                               data-target="#productSetailsModalAjax">Quick View </a>
                        </div>
                        <a href="product-details.html"><img src="<?php echo base_url('onenow/assets/images/seller/product/'); ?>30.jpg" alt="img"
                                                            class="img-responsive"></a>

                        <div class="promotion"><span class="discount">15% OFF</span></div>
                    </div>
                    <div class="description">
                        <h4><a href="product-details.html">LUPTATUM ZZRIL DELENIT</a></h4>

                        <div class="grid-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                        <div class="list-description">
                            <p> Sed sed rutrum purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Pellentesque risus lacus, iaculis in ante vitae, viverra hendrerit ante. Aliquam vel
                                fermentum elit. Morbi rhoncus, neque in vulputate facilisis, leo tortor sollicitudin
                                odio, quis pellentesque lorem nisi quis enim. In dolor mi, hendrerit at blandit
                                vulputate, congue a purus. Sed eget turpis sit amet orci euismod accumsan. Praesent
                                sit amet placerat elit. </p>
                        </div>
                        <span class="size">XL / XXL / S </span></div>
                    <div class="price"><span>$25</span></div>
                    <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
                            class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
                </div>
            </div>
            <!--/.item-->
            <div class="item col-sm-3 col-lg-3 col-md-3 col-xs-6">
                <div class="product">
                    <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
                       data-placement="left">
                        <i class="glyphicon glyphicon-heart"></i>
                    </a>

                    <div class="image">
                        <div class="quickview">
                            <a data-toggle="modal" class="btn btn-xs btn-quickview" href="ajax/product.html"
                               data-target="#productSetailsModalAjax">Quick View </a>
                        </div>
                        <a href="product-details.html"><img src="<?php echo base_url('onenow/assets/images/seller/product/'); ?>9.jpg" alt="img"
                                                            class="img-responsive"></a>

                        <div class="promotion"><span class="new-product"> NEW</span></div>
                    </div>
                    <div class="description">
                        <h4><a href="product-details.html">ELEIFEND OPTION</a></h4>

                        <div class="grid-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                        <div class="list-description">
                            <p> Sed sed rutrum purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Pellentesque risus lacus, iaculis in ante vitae, viverra hendrerit ante. Aliquam vel
                                fermentum elit. Morbi rhoncus, neque in vulputate facilisis, leo tortor sollicitudin
                                odio, quis pellentesque lorem nisi quis enim. In dolor mi, hendrerit at blandit
                                vulputate, congue a purus. Sed eget turpis sit amet orci euismod accumsan. Praesent
                                sit amet placerat elit. </p>
                        </div>
                        <span class="size">XL / XXL / S </span></div>
                    <div class="price"><span>$25</span> <span class="old-price">$75</span></div>
                    <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
                            class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
                </div>
            </div>
            <!--/.item-->
            <div class="item col-sm-3 col-lg-3 col-md-3 col-xs-3">
                <div class="product">
                    <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"
                       data-placement="left">
                        <i class="glyphicon glyphicon-heart"></i>
                    </a>

                    <div class="image">
                        <div class="quickview">
                            <a data-toggle="modal" class="btn btn-xs btn-quickview" href="ajax/product.html"
                               data-target="#productSetailsModalAjax">Quick View </a>
                        </div>
                        <a href="product-details.html"><img src="<?php echo base_url('onenow/assets/images/seller/product/'); ?>36.jpg" alt="img"
                                                            class="img-responsive"></a></div>
                    <div class="description">
                        <h4><a href="product-details.html">MUTATIONEM CONSUETUDIUM</a></h4>

                        <div class="grid-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                        <div class="list-description">
                            <p> Sed sed rutrum purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Pellentesque risus lacus, iaculis in ante vitae, viverra hendrerit ante. Aliquam vel
                                fermentum elit. Morbi rhoncus, neque in vulputate facilisis, leo tortor sollicitudin
                                odio, quis pellentesque lorem nisi quis enim. In dolor mi, hendrerit at blandit
                                vulputate, congue a purus. Sed eget turpis sit amet orci euismod accumsan. Praesent
                                sit amet placerat elit. </p>
                        </div>
                        <span class="size">XL / XXL / S </span></div>
                    <div class="price"><span>$25</span></div>
                    <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i
                            class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
                </div>
            </div>
        </div>
        <!--/.recommended-->

    </div>
    <div style="clear:both"></div>
</div>
<!-- /main-container -->

<div class="gap"></div>
<?php $this->view("common/seller/footer"); ?>