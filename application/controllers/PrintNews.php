<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once BASEPATH . '/helpers/url_helper.php';

	/*
	 *  @class PrintNews Содрежит методы которые отвечает за 
	 * 	вывод новости на главную страницу. 
	 *  А так же методы счетчика страниц
	 */

class PrintNews extends CI_Controller {

	public function index()
	{
		$this->load->model('news_model');
		$data['news'] = $this->news_model->get_news();
		$data['page'] = 'index';
		$this->load->view('index', $data);
	}
	
	/*
	 * @method readAll() Показывает новость полностью
	 * 
	 * @param Integer $news_id id новости
	 */
	 
	public function readAll($news_id)
	{
		$data['page'] = 'onenews';
		$this->load->model('news_model');
		
		$this->pageCounter($news_id);
		
		$data['news'] = $this->news_model->getNewsById($news_id);
		$this->load->view('index', $data);
	}
	
	/*
	 * @method pageCounter() для обновления счетчик просмотра 
	 * 
	 * @param Integer $news_id id новости
	 */
	 
	public function pageCounter($news_id)
	{
		$page_url = base_url("/admin/news/$news_id");
		
		//Подключаем модели
		
		$this->load->model('ipaddr_model');
		$this->load->model('news_model');
		
		//Получаем количество просмотров из таблицы news
		$count = $this->news_model->getCount($news_id);
		
		//В моделе Ipaddr_model есть два метода ipAddrExist and currentPageVisited которые 
		// проверяет есть ли ip или страница в БД. 
		if(!$this->ipaddr_model->ipAddrExist($_SERVER['REMOTE_ADDR']))
		{
			$this->ipaddr_model->addIp(['ip' => $_SERVER['REMOTE_ADDR'], 'page_url'=>$page_url]);
			$this->news_model->updateCount($news_id, ['count' => $count[0]['count']+1] );
			
		} else if(!$this->ipaddr_model->currentPageVisited($_SERVER['REMOTE_ADDR'], $page_url))
		{
			$this->ipaddr_model->addIp(['ip' => $_SERVER['REMOTE_ADDR'], 'page_url'=>$page_url]);
			$this->news_model->updateCount($news_id, ['count' => $count[0]['count']+1] );
		}
		
	}
	

}
