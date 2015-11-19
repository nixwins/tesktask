<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once BASEPATH . '/helpers/url_helper.php';
date_default_timezone_set('Asia/Almaty');

class AdminProfile extends CI_Controller {
	
	private function loadCkeditor($lang='ru', $width='749px', $height='300px')
	{
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		
		$this->ckeditor->config['language'] = 'ru';
		$this->ckeditor->config['width'] = '749px';
		$this->ckeditor->config['height'] = '300px'; 	
	}
	
	public function index()
	{
		$this->load->model('news_model');
		$data['page'] = 'index';
		$data['news'] = $this->news_model->get_news();	
		
		$this->load->view('admin/index', $data);
		
	}
	
	public function deleteNewsById($news_id)
	{
		$this->load->model('news_model');
		
		$data['deleted'] = $this->news_model->deleteNewsById($news_id);
		//var_dump($data);
		return json_encode($data);
	}
	
	public function showUpdateNewsById($news_id)
	{
		$data['page'] = 'updatenews';
		$this->load->helper('form');
		$this->loadCkeditor(); 
		$data['id'] = $news_id;
		$this->load->model('news_model');
		$data['news'] = $this->news_model->getNewsById($news_id);
		$this->load->view('admin/index', $data);	
	}
		
	public function updateNewsById()
	{
		$data = [
				'id'		=>	$this->input->post('news_id'),
				'title'		=>	$this->input->post('title'),
				'preview'	=> 	$this->input->post('preview'),
				'body'		=>	$this->input->post('textBody')];
		//var_dump($data);
		$this->load->model('news_model');
		$result = array();
		$report = $this->news_model->updateNewsById($this->input->post('news_id'), $data);
		if ($report) {
  		// update successful
  			$result['updated'] = TRUE;
  		
		} else {
		  // update failed
		  $result['updated'] = FALSE;
		}
		echo json_encode($result);
	}
	
	public function showAddUserForm()
	{
		$this->load->helper('form');
		$data['page'] = 'adduser';
		$this->load->view('admin/index', $data);
	}

	public function addUser()
	{
		$userName = $this->input->post('username');
		$email	  = $this->input->post('email');
		$password = $this->input->post('password');
		$page	  = $this->input->post('page');		
			//$this->load->library('PassowrdHash', [8, FALSE]);
						
			$this->load->model('users_model');
			$email_exist=$this->users_model->email_exist($email);
			$username_exist=$this->users_model->username_exist($userName);
			if($username_exist)
			{
				echo json_encode(['username'=>TRUE]);
				
			} else if ($email_exist){
				
				echo json_encode(['email'=>TRUE]);
				
			} else if (!$email_exist and !$username_exist) {
				
				$this->load->library('form_validation');
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				
				if ($this->form_validation->run() == FALSE)
                {
                 	echo json_encode(['mustFill' => TRUE]);
               }
                else
                {
                    $res = $this->users_model->addNewUser([
										'username' => $userName,
										'email'=>$email,
										'password'=>password_hash($password, PASSWORD_DEFAULT)]);
					if($res){
						
						$this->load->library('email');

							$this->email->from('dos_off@mail.ru', 'Admin site.loc');
							$this->email->to($email);
							$this->email->cc('test@test-test.com');
							$this->email->bcc('test@test2-test2.com');
							
							$this->email->subject('Акаунт создан');
							$this->email->message('Ваш акаунт создан');
							
							$this->email->send();
							
							echo json_encode(['added' =>TRUE]);
					}
					
                
				}

			}
		
	
		
	}
	public function showAddNewsForm()
	{
		$this->load->helper('form');
		$this->loadCkeditor();
		$data['page'] = 'addnews';
		$this->load->view('admin/index', $data);
	}
	public function addNews()
	{
		$data = [
				'title'		=>	$this->input->post('title'),
				'preview'	=> 	$this->input->post('preview'),
				'body'		=>	$this->input->post('textBody'),
				'date' 		=> 	time()];
		$this->load->model('news_model');
		$this->news_model->addNews($data);
				
	}

}