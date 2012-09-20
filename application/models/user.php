<?php

class User extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getUsers()
    {
        $query = $this->db->get('users');
        return $query->result();
    }
    
    function getUser($param,$value)
    {
        $this->db->where($param,$value);
        $query = $this->db->get('users');
        return $query->result();
    }
    
    function save($data)
    {
        $this->db->insert('users',$data);
    }
    
    function update($data,$idUser)
    {
        $this->db->where('id',$idUser);
        $this->db->update('users',$data);
    }
    
    function remove($idUser)
    {
        $this->db->where('id',$idUser);
        $this->db->delete('users');
    }

    function countUser($param,$value)
    {
        $this->db->where($param,$value);
        $this->db->from('users');
        return $this->db->count_all_results();
    }
    
    public function countAccess($login,$password)
    {
        $this->db->like('login',$login);
        $this->db->like('password',sha1($password));
        $this->db->from('users');
        return $this->db->count_all_results();
    }
}

?>