<?php
    class Docente_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar($codigo){
            
            $this->db->select("g.grpId,m.matNombre,gr.grdNombre,t.turNombre");
            $this->db->from('Grupo g');
            $this->db->join('Empleado e', 'g.empId = e.empId');
            $this->db->join('Materia m', 'g.matId = m.matId');
            $this->db->join('Grado gr', 'g.grdId = gr.grdId');
            $this->db->join('Turno t', 'gr.turId = t.turId');
            $this->db->where('g.empId', $codigo);
            

            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        function listado($grupo){
            $this->db->select("a.almId,a.almCodigo,CONCAT(a.almApellidoP,' ',a.almApellidoM,' ', a.almNombre) as Nombre");
            $this->db->from('Alumno a');
            $this->db->join('detGrupo dg', 'dg.almId = a.almId');
            $this->db->where('dg.grpId', $grupo);  
            $this->db->order_by('Nombre');         

            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        function evaluacion($grupo){
            $this->db->select("evaId,evaNombre,evaPorcentaje");
            $this->db->from('Evaluacion');
            $this->db->where('grpId', $grupo);
            
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }

        public function agregarEva($data)
        {
            try{
                $this->db->select("ROUND(SUM(evaPorcentaje),2) AS suma");
                $this->db->from('Evaluacion');
                $this->db->where('grpId', $data['grpId']);
                $query = $this->db->get()->row_array();
                $suma = $data['evaPorcentaje'] + $query['suma'];
                if ($suma > 1.00) {
                    return 'La sumatoria de porcentaje es igual o superior al 100%';
                } else {
                    $this->db->insert('Evaluacion', $data);
                    return true;                    
                }
            } catch(Exception $e){
                return "ERROR. No se pudo ingresar el registro";
            } finally{
                $this->db->close();
            }
        }

        function addNota($grupo,$evaluacion){
            try{
                $this->db->select("G.grpId, D.dgrpId, A.almCodigo, A.almId, CONCAT(a.almNombre,' ', a.almApellidoP,' ',a.almApellidoM) AS Nombre, E.evaId, e.evaNombre,
                    CASE WHEN n.notId IS NULL THEN 0 ELSE n.notId END AS notId,
                    CASE WHEN n.notNota IS NULL THEN 0 ELSE n.notNota END AS nota", FALSE);
                $this->db->from('Grupo G');
                $this->db->join('detGrupo D', 'G.grdId = D.grpId');
                $this->db->join('Alumno A', 'D.almId = A.almId');
                $this->db->join('Evaluacion E', 'G.grpId = E.grpId');
                $this->db->join('Nota N', 'N.evaId = E.evaId AND N.almId = A.almId AND N.grpId = G.grpId', 'left');
                $this->db->where('G.grpId', $grupo);
                $this->db->where('E.evaId', $evaluacion);
                $query = $this->db->get()->result_array();
                return $query;
            } catch(Exception $e){
                return "ERROR. No se pudo ingresar el registro";
            } finally{
                $this->db->close();
            }
        }
        
    }
?>