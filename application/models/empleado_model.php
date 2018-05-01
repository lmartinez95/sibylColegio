<?php
    class Empleado_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar(){
            $this->db->select("e.empId,e.empCodigo,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) as Nombre,
            CASE e.empSexo WHEN 'M' THEN 'Masculino' ELSE 'Femenino' END AS Sexo,e.empDUI,te.tempNombre");
            $this->db->from('Empleado e');
            $this->db->join('TipoEmpleado te', 'e.tempId = te.tempId');
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        public function agregar($data)
        {
            try{
                $query = $this->db->query('CALL spAddEmpleado(?,?,?,?,?,?,?,?,?,?,?)', $data);
                return 'true'.$query;
            } catch(Exception $e){
                return "ERROR. No se pudo ingresar el registro";
            } finally{
                $this->db->close();
            }
        }

        public function cargaCombo()
        {
            try{
                $this->db->select('tempId,tempNombre');
                $this->db->from('TipoEmpleado');
                $query = $this->db->get();
                return $query->result_array();
            } catch(Exception $e){
                return false;
            }
        }

        public function eliminar(int $value)
        {
            try{
                $this->db->select('COUNT(empId) AS cant');
                $this->db->from('Empleado');
                $this->db->where('empId', $value);
                $query = $this->db->get();
                $result = $query->result_array();
                foreach ($result as $r) {
                    if ($r['cant'] == 1) {
                        $this->db->where('empId', $value);
                        $this->db->delete('Empleado');
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