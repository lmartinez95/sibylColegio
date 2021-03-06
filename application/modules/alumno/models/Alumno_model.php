<?php
    class Alumno_model extends CI_Model
    {
        public function __construct(){
            $this->load->database();
        }

        public function mostrar($codigo){
            
            $this->db->select("gr.grdNombre,t.turNombre, a.almNie");
            $this->db->from('detGrupo dg');
            $this->db->join('Alumno a', 'dg.almId = a.almId');
            $this->db->join('Grupo g', 'dg.grpId = g.grpId');
            $this->db->join('Grado gr', 'g.grdId = gr.grdId');
            $this->db->join('Turno t', 'gr.turId = t.turId');
            $this->db->where('a.almId', $codigo);
            $this->db->limit(1);
            

            $query = $this->db->get()->row_Array();
            $this->db->close();
            return $query;
        }

        function nota($codigo){
            $this->db->select("g.grpId,m.matCodigo,m.matNombre");
            $this->db->from('detGrupo dg');
            $this->db->join('Grupo g', 'dg.grpId = g.grpId');
            $this->db->join('Materia m', 'g.matId = m.matId');
            $this->db->join('Alumno a', 'dg.almId = a.almId');
            $this->db->where('dg.almId', $codigo);  

            $query = $this->db->get()->result_array();
            $this->db->close();
            return $query;
        }

        function detNota($grupo, $alumno){
            try{
                $this->db->reset_query();
                $this->db->select('G.grpId, D.dgrpId, E.evaId, e.evaNombre, N.notPorcentaje, N.notTot,
                CASE WHEN n.notId IS NULL THEN 0 ELSE n.notId END AS notId,
                CASE WHEN n.notNota IS NULL THEN 0 ELSE n.notNota END AS nota', FALSE);
                $this->db->from('Grupo G');
                $this->db->join('detGrupo D', 'G.grdId = D.grpId');
                $this->db->join('Alumno A', 'D.almId = A.almId');
                $this->db->join('Evaluacion E', 'G.grpId=E.grpId');
                $this->db->join('Nota N', 'N.evaId=E.evaId and N.almId=A.almId and N.grpId=G.grpId', 'left');
                $this->db->where('N.almId', $alumno);
                $this->db->where('N.grpId', $grupo);
                $query = $this->db->get()->result_array();
                return $query;
            }catch(Exception $e){

            } finally{
                $this->db->close();
            }
        }
    }
?>