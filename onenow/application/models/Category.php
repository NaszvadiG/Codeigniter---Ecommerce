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
     * Category list handler.
     * @var array
     */
    protected $categories = array();
    /**
     * Category menu handler.
     * @var array
     */
    protected $menu = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        // $this->getList();
    }

    /**
     * Retrieves the category list.
     * @return array
     */
    public function getList()
    {
        if (sizeof($this->categories) < 1)
        {
            $query = $this->db->query('select id, name, parent_id as parent, ordering from tbl_djc2_categories where published=1 order by parent_id, ordering, name asc');
            $categories = $query->result();
            foreach($categories as $category)
            {
                    
                if ($category->parent > 0)
                {
                    $category->parent = @array_pop(array_filter($categories, function($item) use ($category) {
                        return $item->id == $category->parent;
                    }));
                }
                else $this->menu[] = $category;
                $category->children = array_values(array_filter($categories, function($item) use ($category) {
                    return (is_object($item->parent) ? $item->parent->id : $item->parent) == $category->id;
                })) ?: false;

                $this->categories[$category->id] = $category;
            }
        }
        return $this->categories;
    }

    /**
     * Retrieves the category menu list.
     * @return array
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Alias for getMenu()
     * @return array
     */
    public function getGroupedList()
    {
        // var_dump($this->menu); die();
        return $this->menu;
    }

    /**
     * Retrieves the category instance.
     * @param int $id
     * @return stdClass|bool
     */
    public function get($id)
    {
        return isset($this->categories[$id]) ? $this->categories[$id] : false;
    }
}