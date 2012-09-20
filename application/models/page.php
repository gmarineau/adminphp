<?php

class Page extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getPages()
    {
        $query = $this->db->get('pages');
        return $query->result();
    }
    
    function save($data)
    {
        $this->db->insert('pages',$data);
    }
    
    function remove($idPage)
    {
        $this->db->where('id',$idPage);
        $this->db->delete('pages');
    }
    
    function count($param,$value)
    {
        $this->db->where($param,$value);
        $this->db->from('pages');
        return $this->db->count_all_results();
    }
    
    function getPage($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('pages');
        return $query->result();
    }
    
    function getAllPagesSections()
    {
        $query = $this->db->get('pages_sections');
        return $query->result();  
    }
    
    function getPagesSections($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('pages_sections');
        return $query->result();
    }
    
    function savePageSection($data)
    {
        $this->db->insert('pages_sections',$data);
    }
    
    function getPageSectionId($idPage,$idSection)
    {
        $this->db->select('id');
        $this->db->where('id_pages',$idPage);
        $this->db->where('id_sections',$idSection);
        $query = $this->db->get('pages_sections');
        return $query->result();
    }
    
    function countPageSection($idPage,$idSection)
    {
        $this->db->where('id_pages',$idPage);
        $this->db->where('id_sections',$idSection);
        $this->db->from('pages_sections');
        return $this->db->count_all_results();
    }
    
    function removePageSection($idPageSection)
    {
        $this->db->where('id',$idPageSection);
        $this->db->delete('pages_sections');
    }
    
}

?>