<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    private $CI;
    private $var;
    
    public function __construct()
    {
        $this->CI =& get_instance();
        
        $this->var['output'] = '';
        $this->var['css'] = array();
        $this->var['js'] = array();
    }
    
    public function view($name,$data = array())
    {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        $this->CI->load->view('../webroot/pages', $this->var);
    }
    
    public function views($name,$data = array())
    {
        $this->var['output'] .= $this->CI->load->view($name,$data,true);
        return $this;
    }
    
    public function setTitle($title)
    {
        if(is_string($title) AND !empty($title))
        {
            $this->var['title'] = $title;
            return true;
        }
        return false;
    }
}

?>