<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/30/16 4:42 PM
 * Description:
 */

function sidebar_menu($list = array(), $level = 0)
{
    $buttons = '';
    $level = $level + 1;
    $template = '<input type="checkbox" id="menu-{level}-{id}" /><label for="menu-{level}-{id}">{anchor}<i class="fa fa-plus" aria-hidden="true"></i><i class="fa fa-minus" aria-hidden="true"></i></label>';
    foreach ($list as $item)
    {
        $button = sprintf('<a href="%s">%s</a>', base_url('catalog/'.$item->id), $item->name);
        if(! empty($item->children))
        {
            $button = preg_replace(array('/\{level\}/', '/\{id\}/', '/\{anchor\}/'), array($level, $item->id, $button), $template).'<nav aria-for="menu-'.$level.'-'.$item->id.'">'. sidebar_menu($item->children, $level) .'</nav>';
        }
        $buttons .= $button; unset($button);
    }

    return $level === 1 ? "<nav>$buttons</nav>" : $buttons;
}

?>
