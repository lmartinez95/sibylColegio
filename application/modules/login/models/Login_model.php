<?php
    class Login_model extends CI_Model
    {
        public function __construct(){
            parent::__construct();
        }
        
        public function verificar($carne, $pass){
            $this->db->select('u.rolId,u.usrNombre,u.empId,u.almId,r.rolRedirect');
            $this->db->from('Usuario u');
            $this->db->join('Rol r', 'u.rolId = r.rolId');
            $this->db->where('u.usrUsuario', $carne);
            $this->db->where('u.usrPassword', hash('sha256',$pass));
            $query = $this->db->get()->row_array();
            if(isset($query) && $query != null){
                if($query['rolId'] !== NULL){
                    return $query;
                }else{
                    return false;
                }
            }else{
                return false;
            }	
        }

        public function getPermisos($rolId){
            $this->db->distinct(true);
            $this->db->select('a.accCodigo');
            $this->db->from('RolAcceso ra');
            $this->db->join('Rol r', 'ra.rolId = r.rolId');
            $this->db->join('Acceso a', 'ra.accId = a.accId');
            $this->db->join('Usuario u', 'u.rolId = r.rolId');
            $this->db->where('ra.rolId', $rolId);
            $query = $this->db->get();
            if(isset($query) && $query != null){
                $this->db->close();
                return $query->result_array();
            }else{
                return false;
            }
        }
    }
?>