<?php

class Countries extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function record_count($search) {


        $this->db->where("DES LIKE \"%$search%\" ");
        return $this->db->count_all_results('kursy_');
        
        
    }

    public function fetch_countries($limit, $start,$search) {


        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('kursy_');
        $this->db->like('DES', $search, 'both');

        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } return false;
    }

}
