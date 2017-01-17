/**
 * Created with IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/11/16
 * Time: 6:56 PM
 * Description: Product Class
 */
function Product() {
    this.url = "";
    this.category = "";
    this.model = "";
    this.params = {
        search: "",
        categories: "",
        sellers: "",
        colors: "",
        sizes: "",
        price: 'all',
        price_min: 0,
        price_max: 0,
        limit: 12,
        page: 1
    };
    this.do_please_wait = false;
}

Product.prototype = {
    construct : function(model, url, categories)
    {
        this.model = model;
        this.url = url;
        this.params.categories = categories;
        this.category = categories.split(',').shift();
    },

    request : function(action, params, method)
    {
        return $.post(this.url+action, params, method, 'json');
    },

    list : function()
    {
        if (this.do_please_wait)
        {
            prompt_box('#loading', true);
        }

        var $this = this;
        $this.request('product/list', $this.params, function(data){
            $("html,body").scrollTop(0);
            $($($this.model).attr('aria-target')).html('');
            if (data.list.length > 0)
            {
                for(var i in data.list)
                {
                    $this.make($($this.model).attr('aria-target'), data.list[i]);
                }
            }

            $this.pager(data.pages);

            if (data.rows > 0)
            {
                var max = $this.params.limit * $this.params.page;
                var min = (max - $this.params.limit) + 1;
                if (max > data.rows) max = data.rows;

                $('#total').text(min+ ' - '+ max +' of '+ data.rows +' Products');
            }
            else
            {
                $('#total').text('No item');
            }

            prompt_box('#loading', false);
        });
    },

    make : function(target, data)
    {
        var $this = this;
        var context = $(target);
        context.append($($this.model).html());
        var $product = context.find('.product-box:last()');

        $product.find('.product-image img').attr('src', data.image ? data.image : 'no-image');
        $product.find('.product-info > a').text(data.name);
        $product.find('.product-info > label').text('by '+ data.seller);

        if (data.discount)
        {
            $product.find('.product-price').html('USD '+ data.price_usd_discount +' <sup><del>'+ data.price_usd +'</del></sup>');
        }
        else {
            if (parseFloat(data.price) < 1)
                data.price_usd = 'Made to Order';
            else
                data.price_usd = 'USD '+ data.price_usd;

            $product.find('.product-price').text(data.price_usd);
        }

        $product.find('a').attr('aria-product', data.id);
        $product.find('a').attr('aria-alias', data.alias);
        $product.find('a').click(function(e){
            e.preventDefault();
            var instance = $(this);
            var product = instance.attr('aria-product');
            var action = instance.attr('href').substring(1);
            if(action === 'wish')
            {
                return $this.wish(product);
            }
            $this.view(product, (action === 'quick-view'));
        });
    },

    pager : function(pages)
    {
        var $this = this;
        var builder = function(page, is_active) {
            return '<a href="#'+ page +'"'+ (is_active ? ' class="active"' : '') +'>'+ (page.toString().toUpperCase()) +'</a>';
        };
        var contents = "";
        var max = 0;
        while(max <= pages)
        {
            max += 10;
            if($this.params.page <= max)
            {
                var min = max - 10;
                max = max >= pages ? pages : ++max;
                for(var i=min; i <= max; i++)
                {
                    if (i < 1) continue;
                    if (i == max && max != pages)
                        contents += builder('...', false);
                    else
                        contents += builder(i, ($this.params.page == i ? true : false));
                }

                break;
            }
        }

        if (pages > max)
            contents += builder(pages, false);

        if ($this.params.page < --i)
            contents += builder('next', false);

        /*if (min > 1)
            contents = builder(1, false) + contents;*/

        if ($this.params.page > 1)
            contents = builder('prev', false) + contents;

        $('.paginator').html(contents);
        $('.paginator a:not(.active)').click(function(e){
            e.preventDefault();
            var target = $(this).attr('href').substring(1);
            var current = parseInt($('.paginator a.active').attr('href').substring(1));

            switch (target)
            {
                case 'next': target = ++current; break;
                case 'prev': target = --current; break;
                case '...': target = parseInt($(this).prev().attr('href').substring(1))+1;
                    break;
            }

            $this.set('page', target);
            $.cookie('_catalog_mapping', JSON.stringify({origin: window.location.href, params: $this.params}));
            $this.list();
        });
    },

    view : function(product, is_quick_view) {
        var $this = this;

        if (is_quick_view)
        {
            return $this.request('product/view', {id: product}, function(data) {
                var shareUrl = $this.url+'product/view/'+data.id;
                var standard_sla = parseInt(data.seller_sla)+9;
                var express_sla = parseInt(data.seller_sla)+7;
                $('.product-social a[role=facebook]').attr('href','https://www.facebook.com/sharer/sharer.php?u='+shareUrl);
                $('.product-social a[role=twitter]').attr('href','http://twitter.com/share?url='+shareUrl);
                $('.product-social a[role=googleplus]').attr('href','https://plus.google.com/share?url='+shareUrl);
                $('.product-social a[role=pinterest]').attr('href','https://pinterest.com/pin/create/button/?url='+shareUrl+'&media='+(data.images[0].photo||'none'));

                $('.content-product #product-quantity').val(1);
                $('.content-product .product-image img').attr('src', '');
                $('.content-product .product-name').attr('aria-product', data.id);
                $('.content-product .product-name').text(data.name);
                $('.content-product .price-list').text('USD '+ data.price_usd);
                $('.content-product #tab-details p').html(data.description);
                $('.content-product #tab-shipping p').html('Express Delivery: '+express_sla+' business days ' + '<br/>'+ 'Standard Delivery: '+ standard_sla +' business days');
                $('.product-action-buttons button:first()').attr('aria-action', 'add').text('ADD TO CART');

                var $productOfferedPrice = $('.content-product .product-offered-price');

                if (parseFloat(data.bulk_discount) > 0)
                {
                    if ($productOfferedPrice.find('.price-bulk').length < 1)
                        $productOfferedPrice.append('<span class="price-bulk"></span>');

                    $productOfferedPrice.find('.price-bulk').html('Bulk Purchase ('+ data.bulk_min_order +') USD '+ parseFloat(data.bulk_discount_price).toFixed(2));
                }
                else if ($productOfferedPrice.find('.price-bulk').length > 0)
                {
                    $productOfferedPrice.find('.price-bulk').remove();
                }

                if (parseFloat(data.discount) > 0)
                {
                    if($productOfferedPrice.find('.price-sale').length < 1)
                        $productOfferedPrice.append('<span class="price-sale"></span>');

                    if($productOfferedPrice.find('.price-discount').length < 1)
                        $productOfferedPrice.append('<span class="price-discount"></span>');

                    $productOfferedPrice.find('.price-sale').html('<sup>Sale</sup> $'+ data.price_usd_discount);
                    $productOfferedPrice.find('.price-discount').text(data.discount +'% OFF');

                    if (data.deal_expiry)
                    {
                        if ($productOfferedPrice.find('.deal-count-down').length < 1)
                            $productOfferedPrice.append('<div class="deal-count-down"></div>');

                        $productOfferedPrice.find('.deal-count-down').html('Time left to buy <span></span>');
                        $productOfferedPrice.find('.deal-count-down span').countdown(data.deal_expiry).on('update.countdown', function(event) {
                            var format = '%H:%M:%S';
                            if(event.offset.totalDays > 0) {
                                format = '%-d day%!d ' + format;
                            }
                            if(event.offset.weeks > 0) {
                                format = '%-w week%!w ' + format;
                            }
                            $(this).html(event.strftime(format));
                        }).on('finish.countdown', function(event) {
                                if($productOfferedPrice.find('.price-sale').length > 0)
                                    $productOfferedPrice.find('.price-sale').remove();
                                if($productOfferedPrice.find('.price-discount').length > 0)
                                    $productOfferedPrice.find('.price-discount').remove();
                                if ($productOfferedPrice.find('.deal-count-down').length > 0)
                                    $productOfferedPrice.find('.deal-count-down').remove();
                        });
                    }
                }
                else
                {
                    if($productOfferedPrice.find('.price-sale').length > 0)
                        $productOfferedPrice.find('.price-sale').remove();
                    if($productOfferedPrice.find('.price-discount').length > 0)
                        $productOfferedPrice.find('.price-discount').remove();
                    if ($productOfferedPrice.find('.deal-count-down').length > 0)
                        $productOfferedPrice.find('.deal-count-down').remove();
                }

                if (parseFloat(data.price.replace(/\,/g,'')) < 1)
                {
                    $('.product-offered-price .price-list').text('Made to Order');
                    $('.product-action-buttons button:first()').attr('aria-action', 'mail').text('GET QUOTE');
                }

                var builder = function(name, value) {
                    var id = name +'-'+ value;
                    return '<input id="'+ id +'" class="product-option" name="product-'+ name +'" value="'+ value +'" type="radio"><label for="'+ id +'">'+ value +'</label>';
                };

                $.each(['colors', 'sizes'], function(i,a) {
                    var $context = $('.content-product .product-options .product-'+a);
                    $context.html('');
                    if (data[a])
                    {
                        $context.parent().show();
                        var strlen = a.length - 1;
                        for(var i in data[a])
                        {
                            $context.append(builder(a.substring(0, strlen), data[a][i]));
                        }
                    }
                    else
                        $context.parent().hide();
                });

                $('.product-colors .product-option').each(function(){
                    var $label = $(this).next();
                    $label.css('background-color', this.value);
                    $label.html('<span class="glyphicon glyphicon-ok"></span>');
                });

                if(data.images)
                {
                    $('.content-product .product-image-thumbnails').html('');
                    for(var i in data.images)
                    {
                        var image = data.images[i];
                        $('.content-product .product-image-thumbnails').append('<a href="'+ image.photo +'" aria-zoomable="'+ image.zoomable +'"><img src="'+ image.thumbnail +'" alt="'+ data.name +'" /></a>');
                    }

                    $('.content-product .product-image-thumbnails a:first()').addClass('active');
                    $('.content-product .product-image img').attr('src', data.images[0].photo);
                    $('.content-product .product-image').attr('aria-zoomable', data.images[0].zoomable);
                    $this.swapper();
                }

                prompt_box('#product-preview', true);
            });
        }

        window.location.href = this.url +'product/view/'+product;
    },

    swapper : function() {
        $('.content-product .product-image-thumbnails a').click(function(e) {
            e.preventDefault();
            $('.content-product .product-image').attr('aria-zoomable', $(this).attr('aria-zoomable'));
            $('.content-product .product-image img').attr('src', $(this).attr('href'));
            $('.content-product .product-image-thumbnails a').removeClass('active');
            $(this).addClass('active');
        });

        $('.content-product .product-image').unbind('hover').hover(function(){
            var $this = $(this);
            if($this.attr('aria-zoomable') == "true")
            {
                $this.addClass('active');
                var offset = $this.offset();
                $(document).mousemove(function(e){
                    var top = (e.pageY - offset.top) / $this.height();
                    var left =(e.pageX - offset.left) / $this.width();
                    $this.find("img").css({
                        'margin-top': (-($this.find("img").height() * top) + ($this.find("img").height() / 4))+'px',
                        'margin-left': (-($this.find("img").width() * left) + ($this.find("img").width() / 4))+'px'
                    });
                });
            }
        }, function(){
            var $this = $(this);
            $(document).unbind('mousemove');
            $this.removeClass('active');
            $this.find("img").css('margin', '0 auto');
        });
    },

    wish: function(product) {
        alert('Coming Soon...');
        this.request('catalog/wish', {category: this.category, id: product}, function(data) {
            console.log(data);
        });
    },

    set: function(name, value) {
        this.params[name] = value;
    },

    controller : function(method) {
        var $this = this;
        $('.content-product .product-action-buttons button').click(function(e){
            e.preventDefault();

            switch($(this).attr('aria-action'))
            {
                case 'add': var error = "";
                    var validate = new Array('color', 'size');
                    for (var i in validate)
                    {
                        var context = '.content-product input[name="product-'+ validate[i] +'"]';
                        if ($(context).length > 0 && $(context+":checked").length < 1)
                        {
                            error += "\nPlease choose your preferred "+ validate[i] +".";
                        }
                    }

                    if (error != "")
                    {
                        return alert("Error"+ error);
                    }

                    $this.request('catalog/cart/add', {
                        product: $('.content-product .product-name').attr('aria-product'),
                        color: $('.content-product input[name="product-color"]:checked').val(),
                        size: $('.content-product input[name="product-size"]:checked').val(),
                        quantity: $('.content-product input[name="product-quantity"]').val()
                    }, method);
                    break;

                case 'wish':
                    break;

                case 'favorite':
                    break;

                case 'mail': prompt_box('#product-get-qoute', true);
                    break;
            }
        });

        return $this;
    },

    features : function(target, data)
    {
        var $this = this;
        if (data.rows < 1)
        {
            $(target).hide();
            return;
        }

        $(target+' > .row').html('');
        for(var i in data.list)
        {
            $this.make(target+' > .row', data.list[i]);
        }

        $(target+' > .row > div').prop('class', 'col-lg-3 col-md-6 col-sm-6');
        $(target+' a[href="#quick-view"]').unbind('click').remove();
    }
};