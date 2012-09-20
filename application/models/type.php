<?php

class Type extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getTypes()
    {
        $query = $this->db->get('types');
        return $query->result();
    }
    
    function getType($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('types');
        return $query->result();
    }
    
    function save($data)
    {
        $this->db->insert('types',$data);
    }
    
    function update($idType,$data)
    {
        $this->db->where('id',$idType);
        $this->db->update('types',$data);
    }
}

?>