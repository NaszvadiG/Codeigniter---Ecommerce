<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/31/16 2:35 PM
 * Description: Header
 */
?>
<div class="prompt prompt-overlay"></div>
<article class="notice">
    <p>We ship worldwide. First shipping 20% off</p>
</article>

<div class="content-head">
    <div class="toolbar">
        <nav>
            <a href="#" id="shop-us">Shop in <span>United States</span><span>U.S.</span></a>
            <a href="#" id="shop-thai">Shop in <span>Thailand</span><span>Thai</span></a>
        </nav>
        <nav class="pull-right">
            <a href="<?php echo base_url('seller'); ?>">Become a Seller</a>
            <a href="javascript:prompt_box('#sign-in',true);">Join/Sign in</a>
            <a href="<?php echo base_url('shopping-cart'); ?>" id="shopping-cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <?php if ($this->cart->count() > 0): ?>
                <span class="badge"><?php echo $this->cart->count(); ?></span>
                <?php endif; ?>
            </a>
            <a href="#menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
        </nav>
    </div>
    <nav class="menubar">
        <a href="<?php echo base_url('home'); ?>" class="logo"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="ONENOW"></a>
        <nav id="menu">
            <span>
                <a href="<?php echo base_url('about/sacict'); ?>">SACICT</a>
                <nav>
                    <a href="<?php echo base_url('about/sacict'); ?>">About SACICT</a>
                    <a href="<?php echo base_url('about/master-artisans'); ?>">Master Artisans</a>
                    <a href="<?php echo base_url('about/master-craftsmen'); ?>">Master Craftsmen</a>
                    <a href="<?php echo base_url('about/craftsmen-decendants'); ?>">Craftsman Descendants</a>
                    <a href="<?php echo base_url('coming-soon'); ?>">Lux by SACICT</a>
                    <a href="<?php echo base_url('coming-soon'); ?>">Sustainable Crafts</a>
                </nav>
            </span>
            <a href="<?php echo base_url('coming-soon'); ?>">Thai Brands</a>
            <span>
                <a href="<?php echo base_url('home-and-living'); ?>">Home and Living</a>
                <nav>
                    <a href="<?php echo base_url('furniture'); ?>">Furniture</a>
                    <a href="<?php echo base_url('dining'); ?>">Dining</a>
                    <a href="<?php echo base_url('decorative-arts'); ?>">Decorative Arts</a>
                    <a href="<?php echo base_url('lacquerware'); ?>">Lacquerware</a>
                    <a href="<?php echo base_url('lighting'); ?>">Lighting</a>
                    <a href="<?php echo base_url('cushions'); ?>">Cushions</a>
                    <a href="<?php echo base_url('glassware'); ?>">Glassware</a>
                </nav>
            </span>
            <span>
                <a href="<?php echo base_url('clothing-and-accessories'); ?>">Clothing and Accessories</a>
                <nav>
                    <a href="<?php echo base_url('apparel'); ?>">Apparel</a>
                    <a href="<?php echo base_url('shoes'); ?>">Shoes</a>
                    <a href="<?php echo base_url('jewelry'); ?>">Jewelry</a>
                    <a href="<?php echo base_url('bags'); ?>">Bags</a>
                    <a href="<?php echo base_url('hats-and-scarves'); ?>">Hats &amp; scarves</a>
                    <a href="<?php echo base_url('accessories'); ?>">Accessories</a>
                </nav>
            </span>
            <span>
                <a href="<?php echo base_url('health-and-beauty'); ?>">Health and Beauty</a>
                <nav>
                    <a href="<?php echo base_url('skin-care'); ?>">Skin Care</a>
                    <a href="<?php echo base_url('bath-and-body'); ?>">Bath &amp; Body</a>
                    <a href="<?php echo base_url('hair-care'); ?>">Hair Care</a>
                    <a href="<?php echo base_url('make-up'); ?>">Make up</a>
                    <a href="<?php echo base_url('spa-treatment'); ?>">Spa Treatment</a>
                    <a href="<?php echo base_url('balms'); ?>">Balms</a>
                </nav>
            </span>

            <span>
                <a href="<?php echo base_url('food'); ?>">Food</a>
                <nav>
                    <a href="<?php echo base_url('snack'); ?>">Snack</a>
                    <a href="<?php echo base_url('coffee'); ?>">Coffee</a>
                    <a href="<?php echo base_url('organic-food'); ?>">Organic Food</a>
                    <a href="<?php echo base_url('cookies'); ?>">Cookies</a>
                    <a href="<?php echo base_url('jam-jelly-peanut'); ?>">Jam, Jelly, Peanut</a>
                    <a href="<?php echo base_url('butter'); ?>">Butter</a>
                    <a href="<?php echo base_url('cocoa'); ?>">Cocoa</a>
                    <a href="<?php echo base_url('seasonings'); ?>">Seasonings</a>
                </nav>
            </span>

            <!--<a href="<?php /*echo base_url('coming-soon'); */?>">Kids</a>-->

            <a href="<?php echo base_url('coming-soon'); ?>">Curator's Pick</a>
        </nav>
        <div class="searchbar pull-right">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" id="searcher" name="searcher" placeholder="Search"/>
            <div></div>
        </div>
        <script type="text/javascript">
            $(function() {
                $('.searchbar input').focus(function(){
                    $(this).parent().addClass('focused');
                }).blur(function(){
                    $(this).parent().removeClass('focused');
                });

                var searchPool;
                var clearList = true;
                $('#searcher').keyup(function(e){
                    var a = $(this).next().find('a');
                    var cursor = a.index($(this).next().find('a.active'));
                    switch (e.key.toLowerCase())
                    {
                        case 'arrowup':
                            if (a.length > 0)
                            {
                                --cursor;
                                if (cursor < 0)
                                {
                                    cursor = a.length - 1;
                                }

                                $(a).removeClass('active');
                                $(a[cursor]).addClass('active');
                                $(this).val($(a[cursor]).attr('href').substring(1));
                            }
                            break;
                        case 'arrowdown':
                            if (a.length > 0)
                            {
                                ++cursor;
                                if (cursor < 0 || cursor >= a.length)
                                {
                                    cursor = 0;
                                }

                                $(a).removeClass('active');
                                $(a[cursor]).addClass('active');
                                $(this).val($(a[cursor]).attr('href').substring(1));
                            }
                            break;

                        case 'enter': window.location.href = '<?php echo base_url('search'); ?>?q='+encodeURI($(this).val());
                            break;

                        default: var text = $(this).val();
                        if (text.length > 1)
                        {
                            if (searchPool)
                                searchPool.abort();

                            searchPool = $.ajax({
                                url: '<?php echo base_url('catalog/search/keyword'); ?>',
                                method: 'GET',
                                async: true,
                                dataType: 'json',
                                data: {query: text},
                                success: function(data) {
                                    if(data.list.length)
                                    {
                                        var content = "";
                                        for(var i in data.list)
                                        {
                                            content += '<a href="#'+ data.list[i] +'">'+data.list[i]+'</a>';
                                        }
                                        $('.menubar .searchbar input + div').html(content).hover(function(){
                                            clearList = false;
                                        }, function(){
                                            clearList = true;
                                        });
                                        $('.menubar .searchbar input + div > a').click(function(e){
                                            $('#searcher').val($(this).attr('href').substring(1));
                                            $('#searcher').focus();
                                            $('.menubar .searchbar input + div').html('');
                                        });
                                    }
                                    else
                                        $('.menubar .searchbar input + div').html('');
                                }
                            });
                        }
                    }
                }).blur(function(e){
                    if (clearList) $(this).next().html('');
                });
            });
        </script>
    </nav>
</div>

<style type="text/css">
    #sign-in .content-auth {
        width: 360px;
    }

    #sign-up .content-auth {
        width: 620px;
    }
    .content-auth h3 {
        margin-bottom: 15px;
        margin-top: 10px;
    }
    .content-auth .content-buttons {
        background: #ebedef none repeat scroll 0 0;
        border-top: 1px solid #ddd;
        padding: 15px;
        text-align: right;
        margin-top: 5px;
    }
    .content-auth .btn-danger:hover,.content-auth .btn-danger {
        background: #f24b4b none repeat scroll 0 0;
        border-color: #f24b4b;
    }
    .content-auth input,
    .content-auth select,
    .content-auth .btn {
        border-radius: 0 !important;
    }
    .content-auth .form-group label {
        font-size: 15px;
        font-weight: normal;
    }
    .content-auth .form-group input,
    .content-auth .form-group select {
        font-size: 14px;
        outline: medium none;
        padding: 1px 5px;
        box-shadow: none;
    }
    .content-auth .form-group input:focus,
    .content-auth .form-group select:focus {
        border: 1px solid #f24b4b;
    }

    .content-auth .content-buttons p {
        float: left;
        text-align: left;
        font-size: 14px;
        margin: -4px 0 0;
    }

    #sign-up .content-auth .content-buttons p {
        margin-top: 2px;
    }

    .content-auth .content-buttons a {
        color: #F24B4B;
    }

    .content-auth .col-lg-4,
    .content-auth .col-md-4,
    .content-auth .col-sm-4 {
        padding-right: 0;
    }
</style>
<?php $this->view('auth/form-sign-in'); ?>
<?php $this->view('auth/form-sign-up'); ?>