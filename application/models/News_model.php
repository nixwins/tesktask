<?php

class News_model extends CI_Model {

	public function __construct()
    {
     	$this->load->database();
    }
	
	/*
	 * @method get_news()
	 * 
	 * @return Array Возвращает все записи из БД
	 */
	 
	public function get_news($slug = FALSE)
	{
    	if ($slug === FALSE)
        {
                $query = $this->db->get('news');
                return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
       return $query->row_array();
	}
	
	/*
	 *  @method getNewsById()
	 * 
	 *  @param INTEGER $news_id Id новости.
	 * 
	 * @return Array Возвращает одну запись из БД по ИД
	 */
	 
	public function getNewsById($news_id, $slug=FALSE)
	{
		if ($slug === FALSE)
        {
                $query = $this->db->get_where('news', array('id'=> $news_id));
                return $query->result_array();
        }

        $query = $this->db->get_where('news', array('id' => $news_id));
        return $query->row_array();
		
	}
	
	/*
	 *  @method deleteNewsById() Удаляет одну новость(запись) из БД по ID
	 * 
	 *  @param INTEGER $news_id Id новости.
	 * 	
	 *  @return Bool 
	 */
	 
	public function deleteNewsById($news_id)
	{
		//$this->db->where('id', $news_id);
		return $this->db->delete('news', ['id'=> $news_id]); 	
		
	}
	
	/*
	 *  @method updateNewsById() Обнавляет одну новость(запись) из БД по ID
	 * 
	 *  @param INTEGER $news_id Id новости.
	 * 
	 * 	@param Array $data Массив данных которых нужно обнавить
	 * 
	 * 	@return Bool
	 */
	 
	public function updateNewsById($news_id, $data)
	{
		$this->db->where('id', $news_id);
		$res = $this->db->update('news', $data);
		
		return $res;
		
	}
	
	/*
	 * 	@method getCount()
	 * 
	 *  @param INTEGER $news_id Id новости.
	 * 
	 * 	@param Array $data Массив данных которых нужно обнавить
	 * 
	 *  @return Array Возвращает количество просмотров страницы
	 */
	 
	public function getCount($news_id)
	{
		$this->db->select('count');
		$this->db->from('news');
		$this->db->where('id', $news_id);
		return $this->db->get()->result_array();
	}
	
	/*
	 *  @method updateCount() Обнавляет количество просмотров по ID
	 * 
	 *  @param INTEGER $news_id Id новости.
	 * 
	 * 	@param Array $data Массив данных которых нужно обнавить
	 * 
	 *  @return Bool
	 */
	 
	public function updateCount($news_id, $data)
	{
		$this->db->where('id', $news_id);
		return $this->db->update('news', $data);
	}
	
	/*
	 *  @method addNews() Добавляет новости в БД
	 * 
	 * 	@param Array $data Массив данных которых нужно обнавить
	 * 
	 */
	 
	public function addNews($data)
	{
		$this->db->insert('news', $data);
	}
	
}