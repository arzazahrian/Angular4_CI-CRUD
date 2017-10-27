<?php

require APPPATH . '/libraries/REST_Controller.php';

class Book extends REST_Controller {
	
	public function __construct() {

		parent::__construct();


		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Origin: *');

		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
    	    die();
    	}
	
		$this->load->model('m_book');
	}
	
	//get book from database
	function list_book_get()
	{
		//call method get_list_book() in model m_book
		$dataBook = $this->m_book->get_list_Book();
				
		//if dataBook exist
		if($dataBook != null) {	
			$output['status'] = true;
			$output['data'] = $dataBook;
		} else {	// if dataBook not exist
			$output['status'] = false;
			$output['message'] = 'empty';
		}
				
		
		//send response
        $this ->response($output);

	}
	
	function get_book_get()
	{
		//store parameter id_book
		$id_book = $this->get('id');
		
		//call method get_book() in model m_book
		$dataBook = $this->m_book->get_book($id_book);		
		
		//if dataBook exist
		if($dataBook != null) {	
			$output['status'] = true;
			$output['message'] = 'data exist';
			$output['data'] = $dataBook;

		} else {	// if dataBook not exist
			$output['status'] = false;
			$output['message'] = 'data is not available';
		}
		


		//send response
        $this->response($output);
	}
	
	//create book into database
	function add_book_post()
	{

		//store all parameter in array dataBook
		$dataBook = array(
			'id' => $this->post('id'),
			'title' => $this->post('title'),
			'author' => $this->post('author'),
			'isbn' =>$this->post('isbn')			
		);
		
		//call method  in model m_guide with array dataBook
		$insert = $this->m_book->insert_book($dataBook);
		
		//if tambah_guide() success
		if($insert) {
			$output['status'] = true;
			$output['message'] = 'success';
			$output['data'] = $dataBook;
		} else {
			$output['status'] = false;
			$output['message'] = 'failed';
		}
		
		//send response
        $this->response($output);
	}
	
	//update book into database
	function update_book_post()
	{
		//to store parameter id_book if exist
		$id_book = $this->post('id');
		
		//store all parameter in array dataBook
		$dataBook = array(
			'title' => $this->post('title'),
			'author' => $this->post('author'),
			'isbn' =>$this->post('isbn')
		);
		
		//call method update_book() in model m_book with parameter id_museum and array dataBook
		$update = $this->m_book->update_book($id_book, $dataBook);
		
		//if update_museum() success
		if($update) {
			$output['status'] = true;
			$output['message'] = 'success';
			$output['data'] = $dataBook;
		} else {
			$output['status'] = false;
			$output['message'] = 'failed';
		}
		
		//send response
        $this->response($output);
	}
	
	//destroy book from database
	function destroy_delete()
	{
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('book');
        if ($delete) {
            $this->response(array('status' => true,
            					  'message' => 'delete success',
        											), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

	}
	
}