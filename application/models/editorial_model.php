<?php
    class Editorial_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar(){
            $this->load->database();
            $this->db->select('e.edtId,e.edtNombre,e.edtTelefono,e.edtDireccion,p.paiNombre');
            $this->db->from('Editorial e');
            $this->db->join('Pais p', 'e.paiId = p.paiId', 'inner');
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }
    }
?>