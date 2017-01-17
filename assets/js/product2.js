/**
 * Created with IntelliJ IDEA.
 * User: CGW-IT
 * Date: 10/11/16
 * Time: 6:56 PM
 * To change this template use File | Settings | File Templates.
 */

function prompt_bar(type, toggle)
{
    if (toggle)
    {
        $('.prompt.prompt-overlay').addClass('prompt-'+ type +'-active');
        $('.prompt.prompt-'+type).addClass('active');
    }
    else
    {
        $('.prompt.prompt-overlay').removeClass('prompt-'+ type +'-active');
        $('.prompt.prompt-'+type).removeClass('active');
    }

    return void(0);
}

function Product() {}

Product.request = function(action, params, method) {
    $.post(this.url+action, params, method, 'json').error(function(data) {
        console.log(data.statusText);
    });
    /*.always(function() {
     $('.content-products-overlay').removeClass('active');
     });*/
};

Product.prototype = {
    init: function(model, url, categories)
    {
        this.url = url;
        this.category = window.location.href.split('/').pop();
        this.model = model;
        this.params = {
            categories: categories,
            sellers: false,
            colors: false,
            sizes: false,
            price: 'all',
            price_min: false,
            price_max: false,
            limit: 12,
            page: 1
        };
    },

    list: function() {
        var $this = this;
        Product.request.apply(this, ['product/list', $this.params, function(data){
            if (data.list.length > 0)
            {
                $($($this.model).attr('aria-target')).html('');
                for(var i in data.list)
                {
                    $this.make(data.list[i]);
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
            else {
                $('#total').text('No item');
            }
        }]);
    },
    make: function(data) {
        var $this = this;
        var context = $($(this.model).attr('aria-target'));
        context.append($(this.model).html());
        var $product = context.find('.product-box:last()');

        if (data.image) {
            $product.find('.product-image img').attr('src', data.image);
        }

        $product.find('.product-info > a').text(data.name);
        $product.find('.product-info > label').text('by '+ data.seller);
        $product.find('.product-price').text('US$'+ data.price_usd);

        $product.find('a').attr('aria-product', data.id);
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

    view: function(product, is_quick_view) {
        if (is_quick_view)
        {
            var $this = this;
            return this.request('product/view', {category: this.category, id: product}, function(data) {
                $('#product-preview .product-name').attr('aria-product', data.id);
                $('#product-preview .product-name').attr('aria-category', data.category);
                $('#product-preview .product-name').text(data.name);
                $('#product-preview .price-list').attr('aria-value', data.price_usd);
                $('#product-preview .price-list').text('US$ '+data.price_usd);

                var color = $('#product-preview .product-options label:contains("Color")');
                color.next().html('');
                if (! data.colors)
                {
                    color.parent().hide();
                }
                else
                {
                    color.parent().show();
                    color = color.next();
                    for(var n in data.colors)
                    {
                        color.append('<input id="color-{id}" class="product-option" name="product-color" value="{value}" type="radio"><label for="color-{id}"><span class="glyphicon glyphicon-ok"></span></label>'.replace(/\{value\}/g, data.colors[n]).replace(/\{id\}/g, data.colors[n].replace(/\s+/g,'-')));
                    }

                    $('.product-colors .product-option').each(function(){
                        $(this).next().css('background-color', this.value);
                    });
                }

                var size = $('#product-preview .product-options label:contains("Size")');
                size.next().html('');
                if (! data.sizes) {
                    size.parent().hide();
                }
                else
                {
                    size.parent().show();
                    size = size.next();
                    for(var n in data.colors)
                    {
                        size.append('<input id="size-{id}" class="product-option" name="product-size" value="{value}" type="radio"><label for="size-{id}">{value}</label>'.replace(/\{value\}/g, data.sizes[n]).replace(/\{id\}/g, data.sizes[n].replace(/\s+/g,'-')));
                    }
                }

                if(data.images)
                {
                    $('#product-preview .product-image-thumbnails').html('');
                    for(var i in data.images)
                    {
                        $('#product-preview .product-image-thumbnails').append('<a href="{image}"><img src="{image}" alt="{name}" /></a>'.replace(/\{image\}/g, data.images[i]).replace(/\{name\}/, data.name));
                    }

                    $('#product-preview .product-image-thumbnails a:first()').addClass('active');
                    $('#product-preview .product-image img').attr('src', data.images[0]);
                    $this.imageSwap();
                }

                prompt_bar('form', true);
            });
        }

        window.location.href = this.url +'product/view/'+this.category+'/'+product;
    },
    imageSwap: function() {
        $('.content-product .product-image-thumbnails a').click(function(e) {
            e.preventDefault();
            $('.content-product .product-image img').attr('src', $(this).attr('href'));
            $('.content-product .product-image-thumbnails a').removeClass('active');
            $(this).addClass('active');
        });

        $('.content-product .product-image').unbind('hover').hover(function(){
            // $(this).addClass('active');
        }, function(){
            // $(this).removeClass('active');
        });
    },
    wish: function(product) {
        this.request('catalog/wish', {category: this.category, id: product}, function(data) {

        });
    },
    set: function(name) {
        var $scope = $('input[name="'+name+'"]:checked');
        console.log($scope);
    },
    pager: function(pages)
    {
        var builder = function(page, is_active) {
            return '<a href="#'+ page +'"'+ (is_active ? ' class="active"' : '') +'>'+ (page.toString().toUpperCase()) +'</a>';
        }

        var contents = "";
        var max = 0;
        while(max <= pages)
        {
            max += 10;
            if(this.params.page <= max)
            {
                if (max > pages) max = pages-1;
                for(var i=max-10; i <= max+1; i++)
                {
                    if (i < 1) continue;
                    contents += builder(i, (this.params.page == i ? true : false));
                }
                break;
            }
        } i = i - 1;

        if (this.params.page > 1)
            contents = builder('prev', false) + contents;

        if (this.params.page < i)
            contents += builder('next', false);

        var $this = this;
        $('.paginator').html(contents);
        $('.paginator a:not(.active)').click(function(e){
            e.preventDefault();
            var target = $(this).attr('href').substring(1);
            var current = parseInt($('.paginator a.active').attr('href').substring(1));

            if (target == 'next')
            {
                target = ++current;
            }
            else if (target == 'prev')
            {
                target = --current;
            }

            $this.params.page = target;
            $this.list();
        });
    }
};
