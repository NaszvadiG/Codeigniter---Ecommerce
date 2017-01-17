<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/30/16 10:26 AM
 * Description:
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>" />
<script type="text/javascript">
    $(function(){
        /*Forcing radio button to collapse itself when hitting multiple times.*/
        var menu_id = '';
        var menu_id_hit = 0;
        $('input[name="menu-1"]').click(function(){
            if (menu_id != this.id)
            {
                menu_id = this.id;
                menu_id_hit = 0;
            }

            if (menu_id_hit % 2 == 1)
            {
                $(this).prop('checked', false);
            }

            menu_id_hit++;
        });
    });
</script>
<div class="content-sidebar">
    <div class="row">
        <div class="sidebar col-md-4">
            <input type="checkbox" id="category" checked="checked">
            <label for="category">Categories
                <i class="fa fa-plus" aria-hidden="true"></i>
                <i class="fa fa-minus" aria-hidden="true"></i>
            </label>
            <div>
                <?php echo sidebar_menu($this->category->menu); ?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="sidebar col-md-6">
                    <input type="checkbox" id="seller" checked="checked">
                    <label for="seller">Seller
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </label>
                    <div class="filters">
                        <?php echo sidebar_filter('filter-sellers', $this->category->filter->sellers); ?>
                    </div>
                </div>

                <div class="sidebar col-md-6">
                    <input type="checkbox" id="price" checked="checked">
                    <label for="price">Price
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </label>
                    <div class="filters">
                        <input type="radio" name="filter-price" id="filter-price-all" value="all" checked="checked" />
                        <label for="filter-price-all"><span class="glyphicon glyphicon-ok"></span> See All</label>
                        <input type="radio" name="filter-price" id="filter-price-75" value="75" />
                        <label for="filter-price-75"><span class="glyphicon glyphicon-ok"></span> Up to US$ 75.00</label>
                        <input type="radio" name="filter-price" id="filter-price-150" value="150" />
                        <label for="filter-price-150"><span class="glyphicon glyphicon-ok"></span> Up to US$ 150.00</label>
                        <input type="radio" name="filter-price" id="filter-price-200" value="200" />
                        <label for="filter-price-200"><span class="glyphicon glyphicon-ok"></span> Up to US$ 200.00</label>
                        <input type="radio" name="filter-price" id="filter-price-300" value="300" />
                        <label for="filter-price-300"><span class="glyphicon glyphicon-ok"></span> Up to US$ 300.00</label>

                        <input type="radio" name="filter-price" id="filter-price-oth" value="oth" />
                        <label for="filter-price-oth" class="filter-price-range"><span class="glyphicon glyphicon-ok"></span>
                            <div>
                                <label>From US$</label>
                                <input type="text" placeholder="100" name="filter-price-min" aria-for="filter-price-oth" />
                            </div>
                            <div>
                                <label>To US$</label>
                                <input type="text" placeholder="500" name="filter-price-max" aria-for="filter-price-oth" />
                            </div>

                            <button class="btn btn-default">Apply</button>
                        </label>
                    </div>
                </div>
            </div>
            <?php if (! empty($this->category->filter->colors) > 0 || ! empty($this->category->filter->sizes)): ?>
            <div class="row">
                <?php if (! empty($this->category->filter->colors)): ?>
                <div class="sidebar col-md-6">
                    <input type="checkbox" id="color" checked="checked">
                    <label for="color">Color
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </label>
                    <div class="filters">
                        <?php echo sidebar_filter('filter-colors', $this->category->filter->colors); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (! empty($this->category->filter->sizes)): ?>
                <div class="sidebar col-md-6">
                    <input type="checkbox" id="size" checked="checked">
                    <label for="size">Size
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </label>
                    <div class="filters">
                        <?php echo sidebar_filter('filter-sizes', $this->category->filter->sizes); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
