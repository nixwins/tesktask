<?php

class Ipaddr_model extends CI_Model
 {
 	public function __construct()
	{
		$this->load->database();
	}	
	
	public function ipAddrExist($ip_adddr)
	{
		$this->db->where(['ip'=>$ip_addr]);
		
    	$query = $this->db->get('ip_addr');
    	if ($query->num_rows() > 0){
        	return true;
   		 }
    	else{
        	return false;
   		 }
	}
	public function addIp($data)
	{
		//$data = ['ip' => $ip_addr];
		$this->db->insert('ip_addr',$data);
	}
 }
		
	