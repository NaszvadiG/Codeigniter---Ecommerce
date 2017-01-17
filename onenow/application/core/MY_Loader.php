<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 3:52 PM
 * Description:
 */
class MY_Loader extends CI_Loader
{
    public function __construct()
    {
        parent::__construct();
    }

    /*public function model($model, $name = '', $db_conn = false)
    {
        if (empty($model))
        {
            return $this;
        }
        elseif (is_array($model))
        {
            foreach ($model as $key => $value)
            {
                is_int($key) ? $this->model($value, '') : $this->model($key, $value);
            }

            return $this;
        }

        $path = '';

        // Is the model in a sub-folder? If so, parse out the filename and path.
        if (($last_slash = strrpos($model, '/')) !== FALSE)
        {
            // The path is in front of the last slash
            $path = substr($model, 0, ++$last_slash);

            // And the model name behind it
            $model = substr($model, $last_slash);
        }

        if (empty($name))
        {
            $name = $model;
        }

        if (in_array($name, $this->_ci_models, TRUE))
        {
            return $this;
        }

        $CI =& get_instance();
        if (isset($CI->$name))
        {
            throw new RuntimeException('The model name you are loading is the name of a resource that is already being used: '.$name);
        }

        // Loading MY_Model Core
        $app_path = APPPATH.'core'.DIRECTORY_SEPARATOR;
        $class = config_item('subclass_prefix').'Model';
        if (file_exists($app_path.$class.'.php'))
        {
            require_once($app_path.$class.'.php');
            if ( ! class_exists($class, FALSE))
            {
                throw new RuntimeException($app_path.$class.".php exists, but doesn't declare class ".$class);
            }
        }

        $model = ucfirst($model);
        if ( ! class_exists($model, FALSE))
        {
            foreach ($this->_ci_model_paths as $mod_path)
            {
                if ( ! file_exists($mod_path.'models/'.$path.$model.'.php'))
                {
                    continue;
                }

                require_once($mod_path.'models/'.$path.$model.'.php');
                if ( ! class_exists($model, FALSE))
                {
                    throw new RuntimeException($mod_path."models/".$path.$model.".php exists, but doesn't declare class ".$model);
                }

                break;
            }

            if ( ! class_exists($model, FALSE))
            {
                throw new RuntimeException('Unable to locate the model you have specified: '.$model);
            }
        }
        elseif ( ! is_subclass_of($model, $class))
        {
            throw new RuntimeException("Class ".$model." already exists and doesn't extend $class");
        }

        $this->_ci_models[] = $name;
        $CI->$name = new $model();
        return $this;
    }*/
}