<?php

/**
 * MacroProcesos model class
 * @package Model
 * @author Arturo Cuenca Coss
 */

class MacroProcesos_model extends CI_Model{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountMacroProcesos() {
        return count($this->db->get('macroprocesos')->result());
    }

    public function getMacroProcesos($begining=-1, $limit=-1, $sortElement='', $sortDir='asc') {
        if ($sortElement != null)
            $this->db->order_by('macroprocesos.'.$sortElement, $sortDir);
        if ($limit != null && $begining != null)
            $this->db->limit($limit, $begining);
        return $this->db->get('macroprocesos')->result();
    }

    public function loadMacroProcesos() {
        return $this->db->get('macroprocesos')->result();
    }

    function getMacroProcesosById($id) {
        $data = array();
        $query = $this->db->where('macroprocesos.cve_macroproceso', $id)->get('macroprocesos');
        if ($query->num_rows > 0) {
            $data = $query->row();
        }
        return $data;
    }

    function insertMacroProcesos($macroproceso, $codigomacroproceso) {
        $data = array(
            'macroproceso' => $macroproceso,
            'codigomacroproceso' => $codigomacroproceso,
        );
        $this->db->insert('macroprocesos', $data);
        return $this->db->insert_id();
    }

    function updateMacroProcesos($macroproceso, $codigomacroproceso, $id) {
        $data = array(
            'macroproceso' => $macroproceso,
            'codigomacroproceso' => $codigomacroproceso,
        );
        return $this->db->update('macroprocesos', $data, array('cve_macroproceso' => $id));
    }

    function deleteMacroProcesos($id) {
        $this->db->delete('macroprocesos', array('cve_macroproceso' => $id));
        return true;
    }

//    function MacroProcesosAsociate($id) {
//        $query = $this->db->select('macroprocesos.*')->where('macroprocesos.fk_rector_axis', $id)->get('tb_plan_state');
//        if ($query->num_rows > 0) {
//            return true;
//        }
//        return false;
//    }

}
?>
