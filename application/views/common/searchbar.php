<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 11/2/16 2:34 PM
 * Description:
 */
?>
<div class="searchbar pull-right">
    <i class="fa fa-search" aria-hidden="true"></i>
    <input type="text" id="searcher" name="searcher" placeholder="Search"/>
    <div></div>
</div>
<script type="text/javascript">
    $(function() {
        var search_pool;
        var is_clear_keywords = true;
        var retained_keyword = "";

        $('.searchbar input').focus(function(){
            $(this).parent().addClass('focused');
        }).blur(function(){
            $(this).parent().removeClass('focused');
            if (is_clear_keywords)
                $(this).next().html('');
        }).keyup(function(e){
            var a = $(this).next().find('a');
            var cursor = a.index($(this).next().find('a.active'));
            switch (e.which || e.keyCode || 0)
            {
                case 13: window.location.href = '<?php echo base_url('catalog/search'); ?>?q='+encodeURI($(this).val());
                    break;

                case 38:
                    if (a.length > 0)
                    {
                        --cursor;
                        if (cursor < 0)
                        {
                            cursor = a.length - 1;
                        }

                        $(a).removeClass('active');
                        $(a[cursor]).addClass('active');
                        $(this).val(retained_keyword+$(a[cursor]).attr('href').substring(1));
                    }
                    break;

                case 40:
                    if (a.length > 0)
                    {
                        ++cursor;
                        if (cursor < 0 || cursor >= a.length)
                        {
                            cursor = 0;
                        }

                        $(a).removeClass('active');
                        $(a[cursor]).addClass('active');
                        $(this).val(retained_keyword+$(a[cursor]).attr('href').substring(1));
                    }
                    break;

                default: var text = $(this).val();
                    var query = '';
                    if (text.length < 2) break;

                    var texts = text.split(/\s+/);
                    if (texts.length > 1)
                    {
                        text = texts.pop();
                        retained_keyword = texts.join(' ')+' ';
                    }

                    if (text.length < 2) break;

                    if (search_pool)
                        search_pool.abort();

                    search_pool = $.ajax({
                        url: '<?php echo base_url('catalog/search/keywords'); ?>',
                        method: 'POST',
                        async: true,
                        dataType: 'json',
                        data: {q: text.split(' ').pop()},
                        success: function(data) {
                            if(data.list.length)
                            {
                                var content = "";
                                for(var i in data.list)
                                {
                                    content += '<a href="#'+ data.list[i] +'">'+data.list[i]+'</a>';
                                }
                                $('.menubar .searchbar input + div').html(content).hover(function(){
                                    is_clear_keywords = false;
                                }, function(){
                                    is_clear_keywords = true;
                                });
                                $('.menubar .searchbar input + div > a').click(function(e){
                                    $('#searcher').focus().val(retained_keyword+$(this).attr('href').substring(1));
                                    $('.menubar .searchbar input + div').html('');
                                });
                            }
                            else
                                $('.menubar .searchbar input + div').html('');
                        }
                    });

            }
        });
    });
</script>