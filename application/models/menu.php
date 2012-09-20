<?php

class Menu extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('item');
    }
    
    function getMenus()
    {
        $query = $this->db->get('menus');
        return $query->result();
    }
    
    function getMenu($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('menus');
        return $query->result();
    }
    
    function save($data)
    {
        $this->db->insert('menus',$data);
    }
    
    function update($idSetting,$data)
    {
        $this->db->where('id',$idSetting);
        $this->db->update('settings',$data);
    }
    
    function display($idMenu)
	{
        $uri = $this->uri->segment(1);
        $html = '';
        $items = $this->item->getItem('id_menus',$idMenu);
        $html .= '<ul>';
        foreach($items as $item)
        {
            if($uri == $item->url) $class = ' class="on"'; else $class = '';
            $html .= '<li'.$class.'><a href="'.$item->url.'">'.$item->item.'</a></li>';
        }
        $html .= '</ul>';
		return $html;
	}
}

?>