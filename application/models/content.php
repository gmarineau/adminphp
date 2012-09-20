<?php

class Content extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getContents()
    {
        $query = $this->db->get('contents');
        return $query->result();
    }
    
    function save($data)
    {
        $this->db->insert('contents',$data);
    }
    
    function count($param,$value)
    {
        $this->db->where($param,$value);
        $this->db->from('pages');
        return $this->db->count_all_results();
    }
    
    function getContent($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('contents');
        return $query->result();
    }
    
    function update($data,$idContent)
    {
        $this->db->where('id',$idContent);
        $this->db->update('contents',$data);
    }
    
    function remove($idContent)
    {
        $this->db->where('id',$idContent);
        $this->db->delete('contents');
    }
    
    function display($idContent)
	{
		$content = current($this->getContent('id',$idContent));
        return $content->content;
	}
}

?>