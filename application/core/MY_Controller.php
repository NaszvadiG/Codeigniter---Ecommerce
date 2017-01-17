<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/31/16 11:22 AM
 * Description:
 */
class MY_Controller extends CI_Controller
{
    const LAYOUT = 'default';

    /**
     * @param string $view
     * @param null|array $params
     */
    public function render($view, $params = NULL)
    {
        $this->layout->render(static::LAYOUT, $view, $params);
    }

    /**
     * @param array $params
     */
    public function renderJSON($params = array())
    {
        $this->output->set_content_type('application/json', 'utf-8');
        $this->output->set_output(json_encode($params));
        exit($this->output->_display());
    }

    /**
     * Rendering error contents.
     * @param string $message
     * @param int $status_code
     */
    protected function renderError($message, $status_code = 500)
    {
        $this->output->set_status_header($status_code);
        $this->output->set_content_type('text/html', 'utf-8');
        $this->output->set_output($message);
        exit($this->output->_display());
    }
}

class Buyer_Controller extends MY_Controller
{
    const LAYOUT = 'buyer';

    public function __construct()
    {
        parent::__construct();
    }
}