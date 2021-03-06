<?php
    class Materia_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar(){
            $query = $this->db->get('Materia');
            $this->db->close();
            return $query->result_array();
        }

        public function agregar($data)
        {
            try{
                $this->db->select('COUNT(matId) AS cant');
                $this->db->from('Materia');
                $this->db->where('matCodigo', $data['matCodigo']);
                $this->db->or_where('matNombre', $data['matNombre']);
                $query = $this->db->get()->row_array();
                if ($query['cant'] == 0) {
                    $this->db->insert('Materia', $data);
                    return true;
                } else {
                    return "El código o materia ya existe";
                }
            } catch(Exception $e){
                return "ERROR. No se pudo ingresar el registro";
            } finally{
                $this->db->close();
            }
        }

        public function eliminar(int $value)
        {
            try{
                $this->db->select('COUNT(matId) AS cant');
                $this->db->from('Materia');
                $this->db->where('matId', $value);
                $query = $this->db->get();
                $result = $query->result_array();
                if ($result['cant'] == 1) {
                    $this->db->where('matId', $value);
                    $this->db->delete('Materia');
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