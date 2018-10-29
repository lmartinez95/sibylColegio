<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complements {
    
    public function cargaCombo($id, $value, $table, $where = NULL)
    {
        try{
            $CI =& get_instance();
            $CI->db->select("{$id},{$value}");
            $CI->db->from($table);
            if(isset($where) || !empty($where))
                $CI->db->where($where);
            $query = $CI->db->get();
            return $query->result_array();
        } catch(Exception $e){
            return false;
        } finally{
            $CI->db->close();
        }
    }

    function veriAcceso($vista){
        $CI =& get_instance();
        for ($i=0; $i < count($CI->session->userdata('permisos')); $i++) { 
            if ($CI->session->userdata('permisos') == $vista) {
                return true;
            } else {
                return false;
            }
            
        }
    }
}