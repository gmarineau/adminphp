<?php

class Item extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getItems()
    {
        $query = $this->db->get('items');
        return $query->result();
    }
    
    function getItem($param,$value)
    {
        $this->db->order_by('positions','asc');
        $this->db->where($param,$value);
        $query = $this->db->get('items');
        return $query->result();
    }
    
    function remove($idItem)
    {
        $this->db->where('id',$idItem);
        $this->db->delete('items');
    }
    
    function save($data)
    {
        $this->db->insert('items',$data);
    }
    
    function update($idItem,$data)
    {
        $this->db->where('id',$idItem);
        $this->db->update('items',$data);
    }
}

?>