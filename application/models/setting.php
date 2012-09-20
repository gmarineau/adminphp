<?php

class Setting extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getSettings()
    {
        $query = $this->db->get('settings');
        return $query->result();
    }
    
    function getSetting($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('settings');
        return $query->result();
    }
    
    function save($data)
    {
        $this->db->insert('settings',$data);
    }
    
    function update($idSetting,$data)
    {
        $this->db->where('id',$idSetting);
        $this->db->update('settings',$data);
    }
}

?>