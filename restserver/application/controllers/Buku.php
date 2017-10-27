<?php

require APPPATH . '/libraries/REST_Controller.php';
Class Buku Extends REST_Controller{
    
    function __construct($config = 'rest') {
        parent::__construct($config);

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS');



    }
    
    // untuk menampilkan data
    function show_get(){
        $data = $this->db->get('book')->result();


        $this->response($data);
    }
    
    // untuk mengirim data
    function add_post(){
        $id           = $this->post('id');
        $title          = $this->post('title');
        $author         = $this->post('author');
        $isbn         = $this->post('isbn');
        
        
        $book = array (
                    'id'            =>  $id,
                    'title'         =>  $title,
                    'author'        =>  $author,
                    'isbn'   =>  $isbn);

        $insert = $this->db->insert('book',$book);
        
        if($insert){
            $this->response($book,200);
        }else{
            $data = array ('status'=>'gagal insert');
            $this->response($data,502);
        }
    }
    
    function update_put(){
        // parameter yang dikirimkan oleh client
        $id             = $this->put('id');
        $title          = $this->put('title');
        $author         = $this->put('author');
        $isbn           = $this->put('isbn');
        // menyimpan data dalam bentuk array
        $book           = array(
                            'title'         =>  $title,
                            'author'        =>  $author,
                            'isbn'          =>  $isbn);
        // update berdasarkan sibn sebagai parameter
        $this->db->where('id',$id);
        $update = $this->db->update('book',$book); 
        // chek apakah update nya berhasil atau gagal
        if($update){
            $this->response($book,200);
        }else{
            $data = array ('status'=>'gagal insert');
            $this->response($data,502);
        }
    }
    
    function delete_delete(){
        
        $id= $this->delete('id');
        $book = $this->db->get_where('book',array('id'=>$id));
        if($book->num_rows()>0){
            // delete data
            $this->db->where('id',$id);
            $this->db->delete('book');
            $data = array('status'=>'Berhasil Delete Buku Dengan ISBN : '.$id);
            $this->response($data,200);
        }else{
            $data = $data = array('status'=>'Buku dengan ISBN: '.$id.' Tidak Ditemukan');
            $this->response($data,200);
        }
    }
}
?>
