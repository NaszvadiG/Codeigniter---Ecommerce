<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 8/25/16 3:57 PM
 * Description:
 */
class Layout
{
    /**
     * CI Instance.
     * @var CI_Controller
     */
    protected $ci;

    /**
     * @var DOMDocument
     */
    protected $document;

    /**
     * @var DOMXPath
     */
    protected $xpath;

    /**
     * @var string
     */
    protected $directory;

    /**
     * @var boolean
     */
    protected $debug;

    /**
     * Initializing Layout library
     */
    public function __construct()
    {
        $this->ci =& get_instance();

        $config = $this->ci->config->item('layout', 'cnf');
        $this->directory = $config["path"];
        $this->debug = $config["debug"];
        $this->document = new DOMDocument("1.0", "UTF-8");
    }

    public function render($layout, $view, $params)
    {
        $document = clone $this->document;
        @$this->document->loadHTML($this->ci->load->view($this->directory.'/'.$layout, null, true));
        $this->xpath = new DOMXPath($this->document);

        $query = $this->xpath->query('//layout');
        if($query->length < 1)
        {
            return trigger_error('<layout /> not found in views/'.$this->directory.'/'.$layout.'.php', E_USER_ERROR);
        }

        @$document->loadHTML(sprintf('<body>%s</body>', $this->ci->load->view($view, $params, true)));
        $this->_import($query->item(0), $document, new DOMXPath($document));
        $output = $this->debug ? str_replace('><', ">\n<", $this->document->saveHTML()) : preg_replace(array("/\s+/", "/\>\s\</"), array(" ","><"), $this->document->saveHTML());
        $this->ci->output->set_output($output);
        exit($this->ci->output->_display());
    }

    /**
     * @param DOMNode $layout
     * @param DOMDocument $document
     * @param DOMXPath $xpath
     */
    protected function _import(DOMNode $layout, DOMDocument $document, DOMXPath $xpath)
    {
        $nodeList = $xpath->query('//title');
        if($nodeList->length > 0)
        {
            for($i=0, $n=$nodeList->length-1; $i<$nodeList->length; $i++)
            {
                $node = $nodeList->item($i);
                if($i === $n)
                {
                    $element = $this->xpath->query('//title')->item(0);
                    $element->parentNode->replaceChild($this->document->importNode($node, true), $element);
                }
                $node->parentNode->removeChild($node);
            }
        }

        foreach(array('meta','link','style','script') as $tag)
        {
            $query = $this->xpath->query('//'.$tag.'[last()]');
            $element = $query->length > 0 ? $query->item(0) : $this->xpath->query('//'.($tag !== 'script' ? 'head' : 'body'))->item(0);

            $nodeList = $xpath->query('//'.$tag);
            if($nodeList->length > 0)
            {
                for($i=0; $i<$nodeList->length; $i++)
                {
                    $node = $nodeList->item($i);
                    $value = $this->document->importNode($node, true);
                    if($query->length > 0) $element->parentNode->insertBefore($value, $element->nextSibling);
                    else $element->appendChild($value);
                    $node->parentNode->removeChild($node);
                }
            }
        }

        $layout->parentNode->removeChild($layout);
        $query = $xpath->query('//body');
        if ($query->length > 0)
        {
            $element = $this->xpath->query('//body')->item(0);
            foreach($element->childNodes as $node)
            {
                @$query->item(0)->appendChild($document->importNode($node, true));
            }
            @$element->parentNode->replaceChild($this->document->importNode($query->item(0), true), $element);
        }
        unset($xpath, $document);
    }    
}