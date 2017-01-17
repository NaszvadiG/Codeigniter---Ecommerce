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
    $template = '<input type="'.($level > 1 ? 'checkbox' : 'radio').'" name="menu-{level}" id="menu-{level}-{id}" /><label for="menu-{level}-{id}"><i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>{anchor}</label>';
    foreach ($list as $item)
    {
        $button = sprintf('<a href="%s">%s</a>', base_url($item->alias), $item->name);
        if(! empty($item->children))
        {
            $button = preg_replace(array('/\{level\}/', '/\{id\}/', '/\{anchor\}/'), array($level, $item->id, $button), $template).'<nav>'. sidebar_menu($item->children, $level) .'</nav>';
        }
        $buttons .= $button; unset($button);
    }

    return $level === 1 ? "<nav>$buttons</nav>" : $buttons;
}

function sidebar_filter($name = '', $filters = array())
{
    $content = '';
    foreach($filters as $filter)
    {
        if (! is_object($filter))
        {
            $filter = (object)array('id' => preg_replace('/[^0-9a-zA-Z]+/', '', $filter), 'name' => $filter);
        }

        $element_id = $name.'-'.$filter->id;
        $content .= sprintf('<input type="checkbox" name="%s" id="%s" value="%s" /><label for="%s"><span class="glyphicon glyphicon-ok"></span>%s</label>', $name, $element_id, $filter->id, $element_id, $filter->name);
    }

    return $content;
}

?>
