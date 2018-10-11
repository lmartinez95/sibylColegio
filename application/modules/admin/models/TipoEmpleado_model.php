<?php
    class TipoEmpleado_model extends CI_Model
    {
        public function __construct(){
        }

        public function mostrar(){
            $query = $this->db->get('TipoEmpleado');
            $this->db->close();
            return $query->result_array();
        }

        public function agregar($data)
        {
            try{
                $this->db->select('COUNT(tempId) AS cant');
                $this->db->from('TipoEmpleado');
                $this->db->where('tempCodigo', $data['tempCodigo']);
                $this->db->or_where('tempNombre', $data['tempNombre']);
                $result = $this->db->get()->row_array();
                if ($result['cant'] == 0) {
                    $this->db->insert('TipoEmpleado', $data);
                    return true;
                } else {
                    return "El código o tipo ya existe";
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
                $this->db->select('COUNT(tempId) AS cant');
                $this->db->from('TipoEmpleado');
                $this->db->where('tempId', $value);
                $query = $this->db->get();
                $result = $query->result_array();
                foreach ($result as $r) {
                    if ($r['cant'] == 1) {
                        $this->db->where('tempId', $value);
                        $this->db->delete('TipoEmpleado');
                        return true;
                    } else {
                        return "El código no existe";
                    }
                }
            } catch(Exception $e){
                return "ERROR. No se pudo eliminar";
            } finally{
                $this->db->close();
            }
        }

        
    }
?>