<?php
    class Login_model extends CI_Model
    {
        public function __construct(){
            parent::__construct();
        }
        
        public function verificar($carne, $pass){
            $this->db->select('COUNT(e.empId) AS cant');
            $this->db->from('Empleado e');
            $this->db->join('TipoEmpleado TP', 'e.tempId = TP.tempId');
            $this->db->where('e.empCodigo', $carne);
            $this->db->where('e.empPassword', hash('sha256',$pass));
            $query = $this->db->get()->row_array();
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