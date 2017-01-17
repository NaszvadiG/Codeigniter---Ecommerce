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
function Product() {} Product.prototype = {
    baseUrl: '',
    content: function(cid, data)
    {
        var $this = this;
        var id = 'product-'+ data.id;
        $('#content-products').append('<div class="col-sm-4 col-lg-4 col-md-4 col-xs-6" id="'+id+'">'+ $('#tpl-product-box').html() +'</div>');
        var $product = $('#'+id+' > .product');
        $product.find('a').each(function(){
            $(this).attr('href', $this.baseUrl+'/show/'+cid+'/'+data.id);
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

        if (data.image)
            $product.find('.product-image img').attr('src', 'http://www.onenow.com/media/djcatalog2/images/'+data.image);

        $product.find('button').click(function(){
            var $button = $(this);

            if ($button.text().toLowerCase() !== 'view detail')
            {
                return $this.request(($button.text()=='Quick View'?'view':'wish'), {id: data.id});
            }

            document.location.href = $this.baseUrl+'/show/'+cid+'/'+data.id;
        });

        $product.removeAttr('data-path');
    },

    request: function(action, data)
    {
        var $this = this;
        $('.content-products-overlay').addClass('active');
        $.post($this.baseUrl+'/'+action, data, function(data)
        {
            switch(action)
            {
                case 'list': $this.list(data); break;
                case 'view': $this.view(data); break;
                default: $this.message(data); break;
            }

        }, 'json').fail(function(data) {
            console.log(data.responseText);
        }).always(function() {
            $('.content-products-overlay').removeClass('active');
        });
    },

    list: function(it)
    {
        var $this = this;
        $('#content-products').html('');
        var paginator = '<li><a href="#prev" aria-label="Previous"><span aria-hidden="true">PREV</span></a></li>';
        for(var i=1; i<=10; i++)
        {
            paginator += '<li><a href="#'+i+'" aria-label="Next"><span aria-hidden="true">'+i+'</span></a></li>';
        }
        paginator += '<li><a href="#next" aria-label="Next"><span aria-hidden="true">NEXT</span></a></li>';
        $('.pagination').html(paginator);

        $('.pagination a').click(function(e){
            e.preventDefault();

            var data = {
                id: document.location.href.split("/").pop(),
                price: '',
                brands: [],
                colors: [],
                page: $(this).attr('href').substring(1)
            };

            if($('input[name=product-filter-price]:checked').val())
            {
                data.price=$('input[name=product-filter-price]:checked').val();
            }

            $('input[name=product-filter-brand]:checked').each(function(i){
                data.brands[i] = $(this).val();
            });

            $('input[name=product-filter-color]:checked').each(function(i){
                data.colors[i] = $(this).val();
            });

            $this.request('list', data);

        });



        if (it.data.length < 1)
        {
            var data = { msg: 'No product available from selected filters. Kindly please reset your filter options.'};
            $this.message(data);
            $('#content-products').html('<p style="text-align: center; margin-top: 20px;">No product to display...</p>');
            return false;
        }

        for(var i=0; i < it.data.length; i++)
        {
            $this.content(it.cid, it.data[i]);
        }
    },

    message: function(data)
    {
        $('.product-modal-alert .product-message').text(data.msg);
        $('.product-modal-form').modal('hide');
        $('.product-modal-alert').modal();
    },

    view: function(data)
    {
        var $product = $('.product-modal-form .modal-content');
        $product.find('.product-name').text(data.name);
        $product.find('.product-name').attr('data-id', data.id);
        $product.find('.product-short-description').text(data.short_description);
        $product.find('.product-image-preview img').attr('src', 'http://www.onenow.com/media/djcatalog2/images/'+data.image);
        if (! data.price_special)
            $product.find('.product-price').html('$'+ data.price);
        else
            $product.find('.product-price').html('$'+data.price_special+' <span>$'+ data.price +'</span>');

        $('.product-modal-form').modal();
    }
}


$(function (){
    var $product = new Product();
    $product.baseUrl = 'http://localhost/onenow/products';
    var url = document.location.href.split("/");

    $product.request('list', {id: url[url.length-1]});

    $('.product-modal button').click(function(){
        var text = $(this).text().toLowerCase().split(' ');
        var id = $('.product-modal .product-name').attr('data-id');
        if(text[text.length-1] !== 'cart')
        {
            return $product.request('wish', {id: id});
        }

        var color = $('.product-modal .product-colors input:checked').val();
        var quantity = $('.product-modal #product-quantity').val();
        var size = $('.product-modal #product-size').val();

        // validation
        var errors = new Array();
        if(! color) errors.push('Please choose your prefer color.\n');
        if(size == 'none') errors.push('Please choose your prefer size.\n');
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
        var url = document.location.href.split("/");
        var data = {
            id: url[url.length-1],
            price: '',
            brands: [],
            colors: []
        };

        if($('input[name=product-filter-price]:checked').val())
        {
            data.price=$('input[name=product-filter-price]:checked').val();
        }

        $('input[name=product-filter-brand]:checked').each(function(i){
            data.brands[i] = $(this).val();
        });

        $('input[name=product-filter-color]:checked').each(function(i){
            data.colors[i] = $(this).val();
        });

        $product.request('list', data);
    });

    $('#price-check-btn').click(function(){
        var url = document.location.href.split("/");
        var data = {
            id: url[url.length-1],
            price: '',
            brands: [],
            colors: []
        };
        $('.price-filter-price-ranges').each(function(){
            if ($(this).val()) data.price += '-'+ $(this).val();
            else data.price += '-0';
        });

        data.price = data.price.substring(1);

        $('input[name=product-filter-brand]:checked').each(function(i){
            data.brands[i] = $(this).val();
        });

        $('input[name=product-filter-color]:checked').each(function(i){
            data.colors[i] = $(this).val();
        });
        $product.request('list', data);
    });
});
