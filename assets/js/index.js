/**
 * Created with IntelliJ IDEA.
 * User: CGW-IT
 * Date: 10/26/16
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */

$(function() {
    var product = new Product();
    product.construct('.JSProduct', '<?php echo base_url(); ?>', '<?php print($this->category->getTags()); ?>');
    product.controller(function(data) {
        $('#shopping-cart .badge').text(data.cart);
        $("#product-alert p").text(data.message);
        prompt_bar('alert', true);
    });
    product.request('product/get/popularity', {limit: 8,page: 1}, function(data) {
        product.features('#popularity', data);
        $('#popularity .owl-carousel').owlCarousel({
            items: 4,
            itemsTabletSmall: [480, 1],
            itemsTablet: [768, 2],
            itemsDesktopSmall: [1024, 3],
            pagination: false
        });
        $('#popularity .owl-item > div').removeAttr('class');
    });

    product.request('product/get/limited', {limit: 8,page: 1}, function(data) {
        product.features('#limited', data);
        for(var i in data.list)
        {
            $('<img src="'+ data.list[i].seller_photo +'" alt="'+ data.list[i].seller +'" />').insertAfter('#limited .product-info a[href="#view"]:eq('+i+')');
        }

        $('#limited .owl-carousel').owlCarousel({
            items: 4,
            itemsTabletSmall: [480, 1],
            itemsTablet: [768, 2],
            itemsDesktopSmall: [1024, 3],
            pagination: false
        });
        $('#limited .owl-item > div').removeAttr('class');
    });

    $('.owl-btn').click(function(e){
        e.preventDefault();
        $('#'+ $(this).parent().prop('id') + ' .owl-carousel').trigger($(this).attr('aria-action'));
    });

    product.request('product/get/explored', {limit: 8,page: 1}, function(data) {
        var content = "";
        for(var i in data.list)
        {
            content += '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><img src="'+ data.list[i].image +'" /><a href="product/view/'+ data.list[i].id+'">'+ data.list[i].name +'</a></div>';
        }
        $('#content-explore .row').html(content);
    });
});