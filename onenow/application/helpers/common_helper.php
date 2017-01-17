<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/1/16 5:23 PM
 * Description:
 */
function draw_menubar_button($data, $level = 0)
{
    $button = '';
    $level = ++$level;
    foreach($data as $item)
    {
        $button .= sprintf('<li class="level-%d"><a href="%s">%s</a></li>', $level, base_url('catalogs/show/'.$item->id), $item->name);
        if ($item->children)
        {
            $button .= draw_menubar_button($item->children, $level);
        }
    }
    return $button;
}

function draw_sidebar($data)
{
    $button = sprintf('<a class="sidebar-btn" href="%s">%s</a>', $url = base_url('catalogs/show/'. $data->id), $data->name);
    if ($data->children)
    {
        $buttons = '';
        foreach($data->children as $child)
        {
            $buttons .= draw_sidebar($child);
        }
        $button = sprintf('<input type="checkbox" id="sidebar-%d" name="sidebar-%d" /><label class="sidebar-btn" for="sidebar-%d"><a href="%s">%s</a><span class="closed glyphicon glyphicon-menu-left"></span><span class="opened glyphicon glyphicon-menu-down"></span></label><ul>%s</ul>', $data->id, (is_object($data->parent) ? $data->parent->id:$data->parent), $data->id, $url, $data->name, $buttons);
    }
    return '<li>'. $button .'</li>';
}

function draw_breadcrumb($data)
{
    return (is_object($data->parent) ? draw_breadcrumb($data->parent) : '') . sprintf('<li><a href="%s">%s</a></li>', base_url('catalogs/show/'. $data->id), $data->name);
}

function get_sub_categories($data, $items = array())
{
    if ($data)
    {
        foreach($data as $item)
        {
            $items[] = $item->id;
            if ($item->children)
            {
                $items = get_sub_categories($item->children, $items);
            }
        }
    }

    return $items;
}

function get_filtered_brand($data, $items = array())
{
    if ($data)
    {
        foreach($data as $item)
        {
            $items = array_merge($items, @explode(',', preg_replace('/\,\s|\s,/',',', ucwords($item->brand_filters))));
            if ($item->children)
            {
                $items = get_filtered_brand($item->children, $items);
            }
        }
    }

    return array_unique(array_filter($items));
}