<?php
    class Nivel_model extends CI_Model
    {
        public function __construct(){
        }

        public function mostrar(){
            $query = $this->db->get('Nivel');
            $this->db->close();
            return $query->result_array();
        }

        public function agregar($data)
        {
            try{
                $this->db->select('COUNT(nvlId) AS cant');
                $this->db->from('Nivel');
                $this->db->where('nvlAbrev', $data['nvlAbrev']);
                $this->db->or_where('nvlNivel', $data['nvlNivel']);
                $query = $this->db->get()->row_array();
                if ($query['cant'] == 0) {
                    $this->db->insert('Nivel', $data);
                    return true;
                } else {
                    return "La abreviatura o nivel ya existe";
                }
            } catch(Exception $e){
                return "No se pudo ingresar el registro";
            } finally{
                $this->db->close();
            }
        }

        public function eliminar(int $value)
        {
            try{
                $this->db->select('COUNT(nvlId) AS cant');
                $this->db->from('Nivel');
                $this->db->where('nvlId', $value);
                $query = $this->db->get();
                $result = $query->result_array();
                if ($result['cant'] == 1) {
                    $this->db->where('nvlId', $value);
                    $this->db->delete('Nivel');
                    return true;
                } else {
                    return "El código no existe";
                }
            } catch(Exception $e){
                return "ERROR. No se pudo eliminar";
            } finally{
                $this->db->close();
            }
        }
    }
?>