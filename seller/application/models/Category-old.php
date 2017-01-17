<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/31/16 11:21 AM
 * Description: category class mapper.
 */

/**
 * @schema db_catalog
 * @map tbl_djc2_categories
 */
class Category extends MY_Model
{
    /**
     * @var array
     */
    protected $categories;

    public function __construct()
    {
        parent::__construct();

        $query = $this->db->query('select id, name, parent_id as parent, ordering, brand_filters from tbl_djc2_categories where published=1 order by parent_id, ordering, name asc');
        // TODO (remove below lines due to for presentation remedy for viewing 4 leveled category)
        $categories = array_merge($query->result(), array(
            (object)array('id' => 1001, 'name' => 'Denim', 'parent' => 3),
            (object)array('id' => 1002, 'name' => 'Jagger', 'parent' => 3)
        ));
        // TODO (uncomment below line when above lines is removed)
        //$categories = $query->result();

        foreach($categories as $category)
        {
            if ($category->parent > 0)
            {
                $category->parent = @array_pop(array_filter($categories, function($item) use ($category) {
                    return $item->id == $category->parent;
                }));
            }

            $category->children = array_values(array_filter($categories, function($item) use ($category) {
                return (is_object($item->parent) ? $item->parent->id : $item->parent) == $category->id;
            })) ?: false;

            $this->categories[$category->id] = $category;
        }
    }

    public function get($id)
    {
        return @$this->categories[$id] ?: false;
    }

    public function getList()
    {
        return $this->categories;
    }

    public function getGroupedList()
    {
        return array_filter($this->categories, function($item) {
            if (is_object($item->parent))
            {
                return false;
            }
            return  $item->parent == 0;
        });
    }
}