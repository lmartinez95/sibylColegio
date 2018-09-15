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
                $this->db->insert('Grupo', $data);
                return true;
            } catch(Exception $e){
                return "ERROR. No se pudo ingresar el registro";
            } finally{
                $this->db->close();
            }
        }

        public function cargaCombo($id,$value,$tabla,$where = '')
        {
            try{
                $this->db->select("{$id}, {$value}");
                $this->db->from($tabla);
                if (isset($where) && $where <> '')
                    $this->db->where($where);
                $query = $this->db->get();
                $result = $query->result_array();
                $query->free_result();
                return $result;
            } catch(Exception $e){
                return false;
            }
        }

        public function cargaAlumno($grupo)
        {
            $this->db->select("a.almId,CONCAT(a.almNombre,' ',a.almApellidoP,' ',a.almApellidoM) AS nombre");
            $this->db->from('Alumno a');
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        public function inscribir($data)
        {
            try{
                $this->db->insert_batch('detGrupo', $data);
                return true;
            } catch(Exception $e){
                return "ERROR. No se pudo ingresar el registro";
            } finally{
                $this->db->close();
            }
        }

        public function listado($grupo){
            $this->db->select("a.almId,CONCAT(a.almNombre,' ',a.almApellidoP,' ',a.almApellidoM) as nombre");
            $this->db->from('detGrupo dg');
            $this->db->join('Alumno a', 'dg.almId = a.almId');
            $this->db->where('dg.grpId', $grupo);
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        public function eliminar($value)
        {
            try{
                $this->db->select('COUNT(grpId) AS cant');
                $this->db->from('Grupo');
                $this->db->where('grpId', $value);
                $query = $this->db->get();
                $result = $query->result_array();
                foreach ($result as $r) {
                    if ($r['cant'] == 1) {
                $this->db->where('grpId', $value);
                        $this->db->where('grpId', $value);
                        $this->db->delete('Grupo');
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