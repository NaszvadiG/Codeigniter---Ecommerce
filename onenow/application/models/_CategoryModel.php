<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/10/16 1:42 PM
 * Description:
 */
class CategoryModel extends MY_Model
{
    const MAP = 'category';

    public function getTags()
    {
        $ids = $this->category->id;
        if (! empty($this->category->children))
        {
            $ids .= ','.implode(',', array_map(function($it) {
                return $it->id;
            }, $this->category->children));
        }

        return $ids;
    }
}
