<?php

class Section extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getSections()
    {
        $query = $this->db->get('sections');
        return $query->result();
    }
    
    function save($data)
    {
        $this->db->insert('sections',$data);
    }
    
    function remove($idSection)
    {
        $this->db->where('id',$idSection);
        $this->db->delete('sections');
    }
    
    function count($param,$value)
    {
        $this->db->where($param,$value);
        $this->db->from('pages');
        return $this->db->count_all_results();
    }
    
    function getSection($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('sections');
        return $query->result();
    }
    
    function getSectionsPages($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('sections_contents');
        return $query->result();
    }
}

?>