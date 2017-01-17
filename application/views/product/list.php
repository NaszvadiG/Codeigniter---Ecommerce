<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/9/16 9:58 AM
 * Description:
 */
?>
<article class="JsTemplate" id="tpl-product-box">
    <div class="product" data-path="<?php echo base_url('products'); ?>">
        <button type="button" class="product-wish"><span class="glyphicon glyphicon-heart"></span></button>
        <div class="product-image">
            <button type="button" class="btn btn-default">Quick View</button>
            <a href="#"><img src="<?php echo base_url('assets/images/spinner.gif'); ?>" onerror="this.src='<?php echo base_url('assets/images/image-not-found/380x285.png'); ?>'" alt="picture-not-found" class="img-responsive" /></a>
        </div>
        <div class="product-promotion">
            <span>NEW</span><span class="product-discount">{PRODUCT_DISCOUNT}</span>
        </div>
        <div class="product-info">
            <a href="#">{PRODUCT_NAME}</a>
            <p class="product-short-description">{PRODUCT_SHORT_DESCRIPTION}</p>
        </div>
        <div class="product-price">
            {PRODUCT_PRICE} <span>{PRODUCT_PRICE_OLD}</span>
        </div>
        <button type="button" class="btn btn-default">View Detail</button>
    </div>
</article>

<div class="product-modal product-modal-form modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="#close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="product-image-preview">
                        <img src="<?php echo base_url('assets/images/image-not-found/380x285.png'); ?>" alt="picture-not-found" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3 class="product-name">{PRODUCT_NAME}</h3>
                    <div class="product-stars">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                    </div>
                    <div class="product-price">
                        {PRODUCT_PRICE} <span>{PRODUCT_PRICE_OLD}</span>
                    </div>
                    <p class="product-short-description">{PRODUCT_DESCRIPTION}</p>
                    <div class="product-options">
                        <label>COLOR</label>
                        <div class="product-colors">
                            <input type="radio" name="product-color" id="F1F40E" value="Yellow" />
                            <label for="F1F40E"><span class="glyphicon glyphicon-ok"></span></label>

                            <input type="radio" name="product-color" id="ADADAD" value="Gray" />
                            <label for="ADADAD"><span class="glyphicon glyphicon-ok"></span></label>

                            <input type="radio" name="product-color" id="4EC67F" value="Green" />
                            <label for="4EC67F"><span class="glyphicon glyphicon-ok"></span></label>
                        </div>
                    </div>
                    <div class="product-options">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="product-size">
                                    <option value="none">Size</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="product-quantity">
                                    <option value="none">Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="product-options">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><button class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">ADD TO WISHLIST</button></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><button class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">ADD TO CART</button></div>
                        </div>
                    </div>
                    <p>
                        <span class="glyphicon glyphicon-ok-circle"></span> IN STOCK <span class="glyphicon glyphicon-lock"></span> SECURE ONLINE ORDERING
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-modal product-modal-alert modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="#close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                </div>
            </div>
            <div class="row">
                <div class="product-message col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    (CONTENT_MESSAGE}
                </div>
            </div>
        </div>
    </div>
</div>

