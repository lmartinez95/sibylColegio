<?php
    class Login_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }
        public function verificar($carne, $pass, $tipo){
            $this->db->select('COUNT(e.empId) AS cant');
            $this->db->from('empleado e');
            $this->db->join('tipoempleado TP', 'e.tempId = TP.tempId');
            $this->db->where('e.empCodigo', $carne);
            $this->db->where('e.empPassword', hash('sha256',$pass));
            $this->db->where('TP.tempNombre', $tipo);
            $query = $this->db->get()->row_array();
            echo $query['cant'];
            if(isset($query) && $query != null){
                if($query['cant'] == 1){
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