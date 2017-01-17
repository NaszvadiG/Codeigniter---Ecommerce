<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/9/16 11:12 AM
 * Description: product class mapper
 */

/**
 * @schema db_catalog
 * @map tbl_djc2_items
 */
class Product extends MY_Model
{
    /*LEFT JOIN tbl_djc2_items_extra_fields_values_text colors ON colors.item_id = products.id AND colors.field_id = 2
    LEFT JOIN tbl_djc2_items_extra_fields_values_text sizes ON sizes.item_id = products.id AND sizes.field_id = 7
    LEFT JOIN tbl_djc2_items_extra_fields_values_text weights ON weights.item_id = products.id AND weights.field_id = 12
    LEFT JOIN tbl_djc2_items_extra_fields_values_text itemurls ON itemurls.item_id = products.id AND itemurls.field_id = 10
    LEFT JOIN tbl_djc2_items_extra_fields_values_text brands ON brands.item_id = products.id AND brands.field_id = 17
    LEFT JOIN tbl_djc2_items_extra_fields_values_text altimages ON altimages.item_id = products.id AND altimages.field_id = 18
    */

    function get($id)
    {
        //$query = $this->db->query("select id, name, description, intro_desc as short_description, price from tbl_djc2_items where available = 1 and published = 1 and id = {$id}");
        $imagepath = 'http://www.onenow.com/media/djcatalog2/images/';
        $query = $this->db->query("select products.id, products.name, products.price, (case when images.fullpath = '' then '' else concat('{$imagepath}', images.fullpath) end) as image
                                   from tbl_djc2_items products
                                   left join tbl_djc2_images images on images.item_id = products.id
                                   where products.available = 1 and products.published = 1 and products.id = {$id}");
        return $query->first_row();
    }

    public function getList($category, $categories, $page, $filters="")
    {
        $query = "select distinct %s from tbl_djc2_items products
                  left join tbl_djc2_items_categories categories on categories.item_id = products.id
                  left join tbl_djc2_images images on images.item_id = products.id
                  left join tbl_djc2_items_extra_fields_values_text brands on brands.item_id = products.id and brands.field_id = 17
                  where products.available = 1 and products.published = 1 and categories.category_id in (%s)";

        $categories = implode(',', $categories);
        $_query = $this->db->query(sprintf($query, 'count(products.id) as rows', $categories));

        $limit = 12;
        $offset = ($limit * $page) - $limit;

        $result['catalog'] = $category->id;
        $result['rows'] = $_query->first_row()->rows;
        $result['page'] = $page;
        $result['pages'] = ceil($result['rows'] / $limit);

        $imagepath = 'http://www.onenow.com/media/djcatalog2/images/';
        if(strlen($filters) > 0) $query .= $filters;
        $query .= " order by categories.category_id asc limit %d, %d";
        $query = sprintf($query, "products.id, products.name, products.intro_desc as short_description, products.price, (case when images.fullpath = '' then '' else concat('{$imagepath}', images.fullpath) end) as image", $categories, $offset, $limit);
        $query = $this->db->query($query);
        $result['data'] = $query->result();

        return $result;
    }


    /**
     SELECT products.id, products.name, products.cat_id, products.price, products.special_price, sellers.name AS seller, images.fullpath
    FROM tbl_djc2_items products
    LEFT JOIN tbl_djc2_producers sellers ON sellers.id = products.producer_id
    LEFT JOIN tbl_djc2_images images ON images.item_id = products.id AND images.name REGEXP '-1$'
    WHERE products.published = 1 AND products.cat_id = category_id
    ORDER BY products.ordering ASC
     */
    public function retrieve($filters = array(), $id)
    {
        $query = $this->db->query("SELECT products.id, products.name, products.cat_id, products.price, products.special_price, sellers.name AS seller, images.fullpath as image
                                   FROM tbl_djc2_items products
                                   LEFT JOIN tbl_djc2_producers sellers ON sellers.id = products.producer_id
                                   LEFT JOIN tbl_djc2_images images ON images.item_id = products.id
                                   WHERE products.published = 1
                                   ORDER BY products.ordering ASC LIMIT 12");

        return json_encode(array(
            'pages' => 1,
            'rows' => 12,
            'list' => $query->result()
        ));
    }
}