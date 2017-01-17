<?php
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/31/16 11:22 AM
 * Description:
 */
class MY_Model
{
    /**
     * API Map.
     */
    const MAP = '';

    /**
     * Data handler
     * @var array
     */
    protected $_attributes = array();

    /**
     * Initiate Model class
     */
    public function __construct()
    {
        log_message('info', 'Model Class Initialized');
    }

    public function getAttributes()
    {
        return $this->_attributes;
    }

    /**
     * Magic method __get()
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return isset($this->_attributes[$name]) ? $this->_attributes[$name] : NULL;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        // do nothing...
    }

    public function __call($method, $value)
    {
        $name = strtolower(rtrim(get_called_class(),'Model'));

        if (! isset($this->_attributes[$name]))
        {
            return false;
        }

        if ($method !== 'get')
        {
            $attr = lcfirst(substr($method, 3));

            if (! isset($this->_attributes[$name]->{$attr}))
            {
                return null;
            }

            return $this->_attributes[$name]->{$attr};
        }

        return $this->_attributes[$name];
    }

    public function request($action, $params = array())
    {
        $config = (object)get_instance()->config->item('cms','cnf');
        $request = curl_init(sprintf('%s/%s/%s', $config->url, static::MAP, $action));
        @curl_setopt($request, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        @curl_setopt($request, CURLOPT_AUTOREFERER, true);
        @curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        @curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
        @curl_setopt($request, CURLOPT_TIMEOUT, 10);

        // (04/11/2016) Added: Disable SSL verify peer.
        //@curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        @curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
        @curl_setopt($request, CURLOPT_POST, true);
        @curl_setopt($request, CURLOPT_POSTFIELDS, array_merge($config->params, $params));
        $response = curl_exec($request); curl_close($request);
        if ($config->debug !== false)
        {
            $content = sprintf("%s [%s]: %s\n %s\n", date('Y-m-d H:i:sa'), get_called_class(), $response, json_encode($params));
            $file = fopen(APPPATH.'logs/'.date('Ymd').'.log', 'a');
            @fwrite($file, $content);
            fclose($file);
        }
        $this->_attributes = (array)json_decode($response);
    }

    /**
     * API Check error
     * @return bool
     */
    public function isError()
    {
        if(is_null($this->status))
        {
            trigger_error('Undefined error', E_USER_ERROR);
        }

        return ($this->status !== 'SUCCESS');
    }

    /**
     * @return bool
     */
    public function error()
    {
        return $this->message ?: false;
    }
}