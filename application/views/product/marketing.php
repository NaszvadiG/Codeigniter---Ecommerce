<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 11/9/16 8:00 PM
 * Description:
 */
?>
<div class="content-main">
    <div id="popular" class="product-ads">
        <h2>Most Popular</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn" aria-action="prev.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-left.png'); ?>" /> </a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-right.png'); ?>" /></i></a>
    </div>

    <div id="curated" class="product-ads">
        <h2>Curator's Picks</h2>
        <div class="row owl-carousel"></div>
        <a href="#" class="owl-btn prev" aria-action="prev.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-left.png'); ?>" /> </a>
        <a href="#" class="owl-btn next" aria-action="next.owl.carousel"><img src="<?php echo base_url('assets/images/arrow-right.png'); ?>" /></i></a>
    </div>
</div>
<script type=text/javascript>
    $(function(){
        var product = new Product();
        product.construct('.JSProduct', '<?php echo base_url(); ?>', '<?php print($this->category->getTags()); ?>');
        product.request('product/get/popularity', {limit: 12,page: 1}, function(data) {
            product.features('#popular', data);
            $('#popular .owl-carousel').owlCarousel({
                responsiveClass: true,
                responsive: {
                    0: {items:1},
                    768: {items:2},
                    1024: {items:3},
                    1300: {items:4}
                },
                pagination: false
            });
            $('#popular .owl-item > div').removeAttr('class');
            if (data.list.length > 4)
            {
                $('#popular .owl-btn').show();
            }
        });

        product.request('product/get/curated', {}, function(data) {
            if (data.rows < 1)
            {
                $('#curated').hide();
                return;
            }

            $('#curated > .row').html('');
            for(var i in data.list)
            {
                product.make('#curated > .row', data.list[i]);
            }

            $('#curated > .row > div').prop('class', 'col-lg-3 col-md-6 col-sm-6');
            $('#curated a[href="#quick-view"]').unbind('click').remove();

            $('#curated .owl-carousel').owlCarousel({
                responsiveClass: true,
                responsive: {
                    0: {items:1},
                    1200: {items:2}
                },
                pagination: false
            });

            $('#curated .owl-item > div').removeAttr('class');
            if (data.list.length > 2)
            {
                $('#curated .owl-btn').show();
            }

            $('#curated .product-info label').remove();
            $('#curated .owl-item .product-price').text('Click on item to buy');
            $('#curated a[href="#view"]').unbind('click').each(function(){
                $(this).attr('href', '<?php echo base_url('curators-pick'); ?>/'+ $(this).attr('aria-alias'));
            });
        });

        $('.owl-btn').click(function(e){
            e.preventDefault();
            $('#'+ $(this).parent().prop('id') + ' .owl-carousel').trigger($(this).attr('aria-action'));
        });
    });
</script>