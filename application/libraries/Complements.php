<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complements {
    
    public function cargaCombo($id, $value, $table, $where = NULL, $whereData = NULL)
    {
        try{
            $CI =& get_instance();
            $CI->db->select("{$id},{$value}");
            $CI->db->from($table);
            if(isset($where) || !empty($where))
                $CI->db->where($where, $whereData);
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
        $permisos = $CI->session->userdata('permisos');
        for ($i=0; $i < count($permisos); $i++) { 
            if (strcasecmp($permisos[$i], $vista) == 0)
                return true;
        }
        return false;
    }
}