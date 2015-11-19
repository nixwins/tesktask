<?php

class Users_model extends CI_Model {
	
	public function __construct()
    {
     	$this->load->database();
    }
	
	public function addNewUser($data)
	{
		return $this->db->insert('users', $data);
	}
	
	public function email_exist($email)
	{
    	$this->db->where(['email'=>$email]);
		
    	$query = $this->db->get('users');
    	if ($query->num_rows() > 0){
        	return true;
   		 }
    	else{
        	return false;
   		 }
	}
	
	public function username_exist($username)
	{
    	$this->db->where(['username'=>$username]);
		
    	$query = $this->db->get('users');
    	if ($query->num_rows() > 0){
        	return true;
   		 }
    	else{
        	return false;
   		 }
	}
	
}
	