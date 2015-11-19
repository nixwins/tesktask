<?php

class Ipaddr_model extends CI_Model
 {
 	public function __construct()
	{
		$this->load->database();
	}	
	
	/*
	 * @method ipAddrExist() проверяет есть ли  IP в таблице
	 * 
	 * @param string $ip_addr Айпи адресс
	 * 
	 * @return Bool 
	 */
	 
	public function ipAddrExist($ip_addr)
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
	
	/*
	 * @method currentPageVisited() проверяет просмотрел ли пользователь с таким IP на данную страницу
	 *  
	 * @param string $ip_addr Айпи адресс
	 * 
	 * @param string $page_url url адресс страницы
	 * 
	 * @return Bool 
	 */
	 
	public function currentPageVisited($ip_addr, $page_url)
	{
		$this->db->where(['ip' => $ip_addr, 'page_url' => $page_url]);
		$query = $this->db->get('ip_addr');
		
		if ($query->num_rows() > 0){
        	return true;
   		 }
    	else{
        	return false;
   		 }
		
	}
	
	/*
	 * @method currentPageVisited() проверяет просмотрел ли пользователь с таким IP на данную страницу
	 *  
	 * @param Array $data массив должен содержить ['имя_поли' => value]
	 * 
	 */
	public function addIp($data)
	{
		//$data = ['ip' => $ip_addr];
		$this->db->insert('ip_addr',$data);
	}
 }
		
	