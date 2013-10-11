<?php

/**
 * FuncionesInstitucionales model class
 * @package Model
 * @author Arturo Cuenca Coss
 */

class FuncionesInstitucionales_model extends CI_Model{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountFuncionesInstitucionales() {
        return count($this->db->get('funcionesinstitucionales')->result());
    }

    public function getFuncionesInstitucionales($begining=-1, $limit=-1, $sortElement='', $sortDir='asc') {
        if ($sortElement != null)
            $this->db->order_by('funcionesinstitucionales.'.$sortElement, $sortDir);
        if ($limit != null && $begining != null)
            $this->db->limit($limit, $begining);
        return $this->db->get('funcionesinstitucionales')->result();
    }

    public function loadFuncionesInstitucionales() {
        return $this->db->get('funcionesinstitucionales')->result();
    }

    function getFuncionesInstitucionalesById($id) {
        $data = array();
        $query = $this->db->where('funcionesinstitucionales.cve_funcioninstitucional', $id)->get('funcionesinstitucionales');
        if ($query->num_rows > 0) {
            $data = $query->row();
        }
        return $data;
    }

    function insertFuncionesInstitucionales($funcioninstitucional) {
        $data = array(
            'funcioninstitucional' => $funcioninstitucional
        );
        $this->db->insert('funcionesinstitucionales', $data);
        return $this->db->insert_id();
    }

    function updateFuncionesInstitucionales($funcioninstitucional, $id) {
        $data = array(
            'funcioninstitucional' => $funcioninstitucional
        );
        return $this->db->update('funcionesinstitucionales', $data, array('cve_funcioninstitucional' => $id));
    }

    function deleteFuncionesInstitucionales($id) {
        $this->db->delete('funcionesinstitucionales', array('cve_funcioninstitucional' => $id));
        return true;
    }

//    function FuncionesInstitucionalesAsociate($id) {
//        $query = $this->db->select('macroprocesos.*')->where('macroprocesos.fk_rector_axis', $id)->get('tb_plan_state');
//        if ($query->num_rows > 0) {
//            return true;
//        }
//        return false;
//    }

}
?>
