<?php

/**
 * Procesos model class
 * @package Model
 * @author Arturo Cuenca Coss
 */

class Procesos_model extends CI_Model{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountProcesos() {
        return count($this->db->get('procesos')->result());
    }

    public function getProcesos($begining=-1, $limit=-1, $sortElement='', $sortDir='asc') {
        if ($sortElement != null)
            $this->db->order_by('procesos.'.$sortElement, $sortDir);
        if ($limit != null && $begining != null)
            $this->db->limit($limit, $begining);
        return $this->db->get('procesos')->result();
    }

    public function loadProcesos() {
        return $this->db->get('procesos')->result();
    }

    function getProcesosById($id) {
        $data = array();
        $query = $this->db->where('procesos.cve_proceso', $id)->get('procesos');
        if ($query->num_rows > 0) {
            $data = $query->row();
        }
        return $data;
    }

    function insertProcesos($proceso, $objetivoproceso,$instrumentojuridico,$codigoproceso) {
        $data = array(
            'proceso' => $proceso,
            'objetivoproceso' => $objetivoproceso,
			'instrumentojuridico'=> $instrumentojuridico,
			'codigoproceso' => $codigoproceso,
        );
        $this->db->insert('procesos', $data);
        return $this->db->insert_id();
    }

    function updateProcesos($proceso, $objetivoproceso, $id) {
        $data = array(
            'mproceso' => $proceso,
            'objetivoproceso' => $objetivoproceso,
			'instrumentojuridico' => $instrumentojuridico,
			'codigoproceso' => $codigoproceso,
        );
        return $this->db->update('procesos', $data, array('cve_proceso' => $id));
    }

    function deleteProcesos($id) {
        $this->db->delete('procesos', array('cve_proceso' => $id));
        return true;
    }

//    function ProcesosAsociate($id) {
//        $query = $this->db->select('procesos.*')->where('procesos.fk_rector_axis', $id)->get('tb_plan_state');
//        if ($query->num_rows > 0) {
//            return true;
//        }
//        return false;
//    }

}
?>
