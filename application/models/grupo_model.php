<?php
    class Grupo_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar(){
            $this->db->select("g.grpId,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) AS Empleado,m.matNombre,n.nvlNivel");
            $this->db->from('Grupo g');
            $this->db->join('Empleado e', 'g.empId = e.empId');
            $this->db->join('Materia m', 'g.matId = m.matId');
            $this->db->join('Nivel n', 'g.nvlId = n.nvlId');
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

        public function cargaCombo($id,$value,$tabla)
        {
            try{
                $this->db->select($id, $value);
                $this->db->from($tabla);
                $query = $this->db->get();
                $result = $query->result_array();
                $query->free_result();
                return $result;
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