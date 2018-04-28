<?php
    class Nivel_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar(){
            $this->load->database();
            $query = $this->db->get('Nivel');
            $this->db->close();
            return $query->result_array();
        }

        public function agregar($data)
        {
            $this->db->insert('Nivel', $data);
        }
    }
?>