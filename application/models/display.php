<?php

class Display extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function save($data)
    {
        $this->db->insert('displays',$data);
    }
    
    function delete($idPageSection,$idContent)
    {
        //echo $idPageSection.' - '.$idContent;
        $this->db->where('id_pages_sections',$idPageSection);
        $this->db->where('id_contents',$idContent);
        $this->db->delete('displays');
    }
    
    function removeContent($idContent)
    {
        $this->db->where('id_contents',$idContent);
        $this->db->delete('displays');
    }
    
    function updateOrder($idDisplay,$data)
    {
        $this->db->where('id',$idDisplay);
        $this->db->update('displays',$data);
    }
    
    function getDisplays($idPageSection)
    {
        $this->db->order_by('positions','asc');
        $this->db->where('id_pages_sections',$idPageSection);
        $query = $this->db->get('displays');
        return $query->result();
    }
    
    function getDisplay($idPageSection,$idContent,$idType)
    {
        $this->db->where('id_pages_sections',$idPageSection);
        $this->db->where('id_foreigns',$idContent);
        $this->db->where('id_types',$idType);
        $query = $this->db->get('displays');
        return $query->result();
    }

    function remove($idDisplay)
    {
      $this->db->where('id',$idDisplay);
      $this->db->delete('displays');
    }

    function removePageSection($idPageSection)
    {
      $this->db->where('id_pages_sections',$idPageSection);
      $this->db->delete('displays');
    }
    
    function countDisplay($idPageSection,$idContent,$idType)
    {
        $this->db->where('id_pages_sections',$idPageSection);
        $this->db->where('id_foreigns',$idContent);
        $this->db->where('id_types',$idType);
        $this->db->from('displays');
        return $this->db->count_all_results();
    }
}

?>