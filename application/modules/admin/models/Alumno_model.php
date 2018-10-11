<?php
    class Alumno_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar(){
            $this->db->select("almId,almCodigo,CONCAT(almNombre,' ',almApellidoP,' ',almApellidoM) as Nombre,
            CASE almSexo WHEN 'M' THEN 'Masculino' ELSE 'Femenino' END AS Sexo,almCorreo,almTelCasa,almResponsable");
            $this->db->from('Alumno');
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        function buscaAlumno($busqueda){
            $this->db->select("almId,almCodigo,CONCAT(almNombre,' ',almApellidoP,' ',almApellidoM) as Nombre");
            $this->db->from('Alumno');
            $this->db->like('almCodigo',$busqueda);
            $this->db->or_like('almNombre',$busqueda);
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        public function agregar($data)
        {
            try{
                $query = $this->db->query('CALL spAddAlumno(?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $data)->row_array();
                return array('status' => TRUE, 'value' => $query['codigo']);
            } catch(Exception $e){
                array('status' => FALSE, 'value' => $query['No se pudo ingresar el alumno']);
            } finally{
                $this->db->close();
            }
        }

        public function eliminar(int $value)
        {
            try{
                $this->db->select('COUNT(almId) AS cant');
                $this->db->from('Alumno');
                $this->db->where('almId', $value);
                $query = $this->db->get();
                $result = $query->result_array();
                foreach ($result as $r) {
                    if ($r['cant'] == 1) {
                        $this->db->where('almId', $value);
                        $this->db->delete('Alumno');
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