/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/9/16 10:13 AM
 * Description: script.js
 */

/**
 * Product Box Maker
 * @param data object
 * Usage:
    Product({
 'id': 1,
 'name': 'Lorem ipsum',
 'short_description': 'Lorem ipsum dolor sit amet',
 'price': 25,
 'price_special': 50,
 'discount': 50,
 'image': false,
 'is_new': true
 });


 */
function Product(url) {
    this.url = url;
    this.catalog = window.location.href.split('/').pop();
    if (this.catalog.length < 1) this.catalog = 1;
} Product.prototype = {
    request: function(action, params) {
        var $it = this;
        $('.content-products-overlay').addClass('active');

        $.post($it.url+'/'+action, params, function(data) {
            switch(action)
            {
                case 'list': $it.list(data); break;
                case 'view': $it.view(data); break;
                default: $it.message(data.msg); break;
            }
        }, 'json').fail(function(data) {
            console.log(data.responseText);
        }).always(function() {
            $('.content-products-overlay').removeClass('active');
        });
    },

    content: function(data)
    {
        var $it = this;
        var id = 'product-'+ data.id;
        $('#content-products').append('<div class="col-sm-4 col-lg-4 col-md-4 col-xs-6" id="'+id+'">'+ $('#tpl-product-box').html() +'</div>');
        var $product = $('#'+id+' > .product');
        $product.find('a').each(function(){
            $(this).attr('href', $it.url+'/show/'+$it.catalog+'/'+data.id);
        });
        $product.attr('data-id', data.id);
        $product.find('.product-info a').text(data.name);
        $product.find('.product-short-description').text(data.short_description);

        if (!data.is_new && !data.discount)
            $product.find('.product-promotion').remove();
        else
        {
            if (! data.is_new)
                $product.find('.product-promotion > span:first()').remove();

            if (! data.discount)
                $product.find('.product-discount').remove();

            $product.find('.product-discount').text(data.discount+'% OFF');
        }

        if (! data.price_special)
            $product.find('.product-price').html('$'+ data.price);
        else
            $product.find('.product-price').html('$'+data.price_special+' <span>$'+ data.price +'</span>');



        $product.find('button').click(function(){
            var $button = $(this);

            if ($button.text().toLowerCase() !== 'view detail')
            {
                return $it.request(($button.text()=='Quick View'?'view':'wish'), {id: data.id});
            }

            document.location.href = $it.url+'/show/'+$it.catalog+'/'+data.id;
        });
    },

    list: function(data)
    {
        var $it = this;
        $('#content-products').html('');

        if (data.data.length < 1)
        {
            $it.message('No product available from selected filters. Kindly please reset your filter options');
            $('#content-products').html('<p style="text-align: center; margin-top: 20px;">No product to display...</p>');
            $('.pagination').html('');
            return false;
        }

        for(var i=0; i < data.data.length; i++)
        {
            $it.content(data.data[i]);
        }

        $it.pager(parseInt(data.pages), parseInt(data.page));
    },
    pager: function(pages, page)
    {
        var $it = this;
        var build = function(val) {
            return '<li'+ (page == val ? ' class="active"' : '') +'><a href="#'+ val +'" aria-label="pager-'+ val +'"><span aria-hidden="true">'+ val +'</span></a></li>';
        }

        var pager = "";
        var max = 0;
        while(max <= pages)
        {
            max += 10;
            if(page <= max)
            {
                if (max > pages) max = pages-1;
                for(var i=max-10; i <= max+1; i++)
                {
                    if (i < 1) continue;
                    pager += build(i);
                }
                break;
            }
        }

        if (page > 1)
            pager = build('prev') + pager;

        if (pages > max)
            pager = pager + build('next');

        $('.pagination').html(pager);
        $('.pagination a').click(function(e){
            e.preventDefault();

            var target = $(this).attr('href').substring(1);
            var cur = page;
            if (target == "prev") target = cur-1;
            if (target == "next") target = cur+1;

            var params = {
                id: $it.catalog,
                price: '',
                brands: [],
                colors: [],
                page: target
            };

            if($('input[name=product-filter-price]:checked').val())
                params.price=$('input[name=product-filter-price]:checked').val();

            $('input[name=product-filter-brand]:checked').each(function(i){
                params.brands[i] = $(this).val();
            });
            $('input[name=product-filter-color]:checked').each(function(i){
                params.colors[i] = $(this).val();
            });

            $it.request('list', params);
        });
    },

    message: function(msg)
    {
        $('.product-modal-alert .product-message').text(msg);
        $('.product-modal-form').modal('hide');
        $('.product-modal-alert').modal();
    },

    view: function(data)
    {
        var $product = $('.product-modal-form .modal-content');
        $product.find('.product-name').text(data.name);
        $product.find('.product-name').attr('data-id', data.id);
        $product.find('.product-short-description').text(data.short_description);
        $product.find('.product-image-preview img').attr('src', data.image);
        if (! data.price_special)
            $product.find('.product-price').html('$'+ data.price);
        else
            $product.find('.product-price').html('$'+data.price_special+' <span>$'+ data.price +'</span>');

        $('.product-modal-form').modal();
    }
}


$(function (){
    var $product = new Product('http://192.168.200.147/onenow/products');
    $product.request('list', {id: document.location.href.split("/").pop()});

    $('.product-modal button').click(function(){
        var text = $(this).text().toLowerCase().split(' ').pop();
        var id = $('.product-modal .product-name').attr('data-id');
        if(text !== 'cart')
        {
            return $product.request('wish', {id: id});
        }

        var color = $('.product-modal .product-colors input:checked').val();
        var quantity = $('.product-modal #product-quantity').val();
        var size = $('.product-modal #product-size').val();

        // validation
        var errors = new Array();
        if(! color) errors.push('Please choose your preferred color.\n');
        if(size == 'none') errors.push('Please choose your preferred size.\n');
        if(quantity == 'none') errors.push('Please choose how many quantity you want to order.\n');
        if(errors.length > 0)
        {
            var content = "";
            for(var i in errors)
                content += errors[i];

            return alert(content);
        }

        $product.request('cart', {
            id: id,
            category: $product.catalog,
            color: color,
            quantity: quantity,
            size: size
        });
    });

    $('.product-modal .product-colors label').each(function() {
        $(this).css('background', '#'+$(this).attr('for'));
    });
    $('.product-modal .product-image-preview').click(function(){
        $(this).toggleClass('active');
    });

    $('.product-filters > a').click(function(e){
        e.preventDefault();
        $(this).parent().find('ul input:checkbox, ul input:radio').removeAttr('checked');
        $(this).parent().find('ul input:text').val('');
        var url = document.location.href.split("/");
        $product.request('list', {id: url[url.length-1]});
    });

    $('.product-filters ul').find('input:checkbox, input:radio').click(function(){
        var params = {
            id: document.location.href.split("/").pop(),
            price: '',
            brands: [],
            colors: []
        };

        if($('input[name=product-filter-price]:checked').val())
        {
            params.price=$('input[name=product-filter-price]:checked').val();
        }

        $('input[name=product-filter-brand]:checked').each(function(i){
            params.brands[i] = $(this).val();
        });

        $('input[name=product-filter-color]:checked').each(function(i){
            params.colors[i] = $(this).val();
        });

        $product.request('list', params);
    });

    $('#price-check-btn').click(function(){
        var params = {
            id: document.location.href.split("/").pop(),
            price: '',
            brands: [],
            colors: []
        };
        $('.price-filter-price-ranges').each(function(){
            if ($(this).val()) params.price += '-'+ $(this).val();
            else params.price += '-0';
        });

        params.price = params.price.substring(1);

        $('input[name=product-filter-brand]:checked').each(function(i){
            params.brands[i] = $(this).val();
        });

        $('input[name=product-filter-color]:checked').each(function(i){
            params.colors[i] = $(this).val();
        });
        $product.request('list', params);
    });
});
