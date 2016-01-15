<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_model extends CI_Model {

    // Nazwa tabeli, z której będziemy korzystać w modelu
    public $table = 'kursy_';

    /**
     * Zwraca wpisy z podanego przedziału
     *
     * @access	public
     * @param	int Limit
     * @param	int Offset
     * @return	mixed
     */
    public function get_all_admin() {
        $this->db->select('*');
        $this->db->from('admins_');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    
    
    public function get_all_art() {
        $this->db->select('*');
        $this->db->from('artykoly');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    
    

    public function get_all_cours() {

        $this->db->select('*');
        $this->db->from('kursy_');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

//wyswietla wszytkie kategorie        
    public function edit_cat() {

        $this->db->select('*');
        $this->db->from('kategorie_nazwy_');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

//dodaje kategorie
    public function add_cat($data) {
        return $this->db->insert('kategorie_nazwy_', $data);
    }

    public function get_all_jw() {
        $this->db->select('*');
        $this->db->from('jednostki_wo');
        $this->db->order_by("id", 'desc');

        $query = $this->db->get();
        return $result = $query->result_array();
    }

    
    public function get_all_serv() {
        $this->db->select('*');
        $this->db->from('servery_');
        $query = $this->db->get();
        return $result = $query->result_array();
    }
    

    
    /**
	 * Zwraca wpisy o podanym numerze Id
	 *
	 * @access	public
	 * @param	int Numer Id wpisu
	 * @return	mixed
	 */
	public function get($id)
	{
		return $this->db->where('ID', $id)->get($this->table)->row_array();
	}
    
    
}

;
 