<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/10/16 1:42 PM
 * Description:
 */
class ProductModel extends MY_Model
{
    const MAP = 'product';

    public function getPhotos()
    {
        $images = array();

        if (sizeof($this->getImages()) > 0)
        {
            foreach($this->getImages() as $image)
            {
                $error = false;
                $large = preg_replace(array("/\.(jpg|png|gif)/", "/item\/\d+\//"), array('_lg.$1', 'item/imglrg/'), $image);
                if (@file_get_contents($large, 0, null, 0, 1) === false)
                {
                    $error = true;
                    $large = $image;
                }

                $images[] = (object)array(
                    'thumbnail' => $image,
                    'photo' => $large,
                    'zoomable' => $error ? 'false' : 'true'
                );
            }
        }

        return $images;
    }
}
