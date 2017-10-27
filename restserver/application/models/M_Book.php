<?php
	class M_Book extends CI_Model {

		function get_list_book() {
			//return $this->db->query('SELECT * from museum INNER JOIN gambar_museum ON museum.id_museum = gambar_museum.id_museum')->result();
			return $this->db->get('book')->result();
		}
		
		function get_book($id_book) {
			$this->db->where('id', $id_book);
			return $this->db->get('book')->result();
		}
		

		function insert_book($dataBook) {
			return $this->db->insert('book', $dataBook);
		}
		
		function update_book($id_book, $dataBook) {
			$this->db->set('title', $dataBook['title']);
			$this->db->set('author', $dataGuide['author']);
			$this->db->set('isbn', $dataGuide['isbn']);
			$this->db->where('id', $id_book);
			return $this->db->update('book');
		}
				
		function delete_book($id_book) {
			$this->db->where('id', $id_book);
			return $this->db->delete('book', $id_book);
		}
	}
?>