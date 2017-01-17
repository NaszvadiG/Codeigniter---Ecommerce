/**
 * Created with IntelliJ IDEA.
 * User: CGW-IT
 * Date: 10/17/16
 * Time: 3:17 PM
 * To change this template use File | Settings | File Templates.
 */

function checkout(data) {
    var $form = $('.cart-summary form');
    var content = "";
    for(var i in data.params)
    {
        content += ('<input type="hidden" name="'+ data.params[i].name +'" value="'+ data.params[i].value +'" />');
    }
    $form.html(content);
    $form.attr('action', data.url);
    $form.submit();
    return false;
}

$(function() {
    $('.cart a').click(function(e) {
        e.preventDefault();
        var action = $(this).attr('href').substring(1);

        if (action !== 'shop')
        {
            var params = {};
            switch (action) {
                /*case 'voucher': params.value = $('.cart-voucher input').val();
                    break;*/
                case 'remove':
                    if (! confirm('Are you sure?'))
                    {
                        return false;
                    }
                    params.value = $(this).attr('aria-target');
                    break;
                case 'update':
                case 'checkout':
                    $('.cart input').each(function(){
                        params.value += ';'+ $(this).attr('aria-target') + ':' + $(this).val();
                    });
                    params.value = params.value.substring(1);
                    break;
                case 'increment':
                case 'decrement':
                    var $qty = $('input[name="product-quantity"][aria-target='+$(this).attr('aria-target')+']');
                    var qty = parseInt($qty.val());
                    if (action == 'increment') ++qty;
                    else --qty;
                    if (qty < 1 || qty > 999)
                        return false;
                    return $qty.val(qty);
                    break;
                default: return alert('Undefined action '+ action +'!');
            }

            return $.post('shopping-cart/'+action, params, function(data) {
                if (action === 'checkout')
                {
                    return checkout(data);
                }

                window.location.href = 'shopping-cart';
            }, 'json');
        }

        window.location.href = 'catalog';
    });

    $('input[name="product-quantity"]').on('keyup mouseleave', function(){
        var qty = $(this).val().replace(/[^0-9]/g, '');
        qty = parseInt(qty.length < 1 ? 1 : qty);
        $(this).val((qty < 1 ? 1 : qty));
    });
});
