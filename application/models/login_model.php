<?php
    class Login_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }
        public function verificar($carne, $pass, $tipo){
            $this->db->select('E.empPassword');
            $this->db->from('empleado AS E');
            $this->db->join('tipoempleado AS TP', 'E.tempId = TP.tempId');
            $this->db->where('E.empCodigo', $carne);
            $this->db->where('TP.tempNombre', $tipo);
            $query = $this->db->get()->row_array();
            if(isset($query) && $query != null){
                if($query['empPassword'] == $pass){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }	
        }
    }
?>