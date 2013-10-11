<?php

/**
 * FundamentosNormativos model class
 * @package Model
 * @author Arturo Cuenca Coss
 */

class FundamentosNormativos_model extends CI_Model{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountFundamentosNormativos() {
        return count($this->db->get('fundamentonormativo')->result());
    }

    public function getFundamentosNormativos($begining=-1, $limit=-1, $sortElement='', $sortDir='asc') {
        if ($sortElement != null)
            $this->db->order_by('fundamentonormativo.'.$sortElement, $sortDir);
        if ($limit != null && $begining != null)
            $this->db->limit($limit, $begining);
        return $this->db->get('fundamentonormativo')->result();
    }

    public function loadFundamentosNormativos() {
        return $this->db->get('fundamentonormativo')->result();
    }

    function getFundamentosNormativosById($id) {
        $data = array();
        $query = $this->db->where('fundamentonormativo.cve_fundamentonormativa', $id)->get('fundamentosnormativos');
        if ($query->num_rows > 0) {
            $data = $query->row();
        }
        return $data;
    }

    function insertFundamentosNormativos($nombre, $numeral) {
        $data = array(
            'nombre' => $nombre,
            'numeral' => $numeral,
        );
        $this->db->insert('fundamentonormativo', $data);
        return $this->db->insert_id();
    }

    function updateFundamentosNormativos($nombre, $numeral, $id) {
        $data = array(
            'nombre' => $nombre,
            'numeral' => $numeral,
        );
        return $this->db->update('fundamentonormativo', $data, array('cve_fundamentonormativa' => $id));
    }

    function deleteFundamentosNormativos($id) {
        $this->db->delete('fundamentonormativo', array('cve_fundamentonormativa' => $id));
        return true;
    }

//    function FundamentosNormativosAsociate($id) {
//        $query = $this->db->select('macroprocesos.*')->where('macroprocesos.fk_rector_axis', $id)->get('tb_plan_state');
//        if ($query->num_rows > 0) {
//            return true;
//        }
//        return false;
//    }

}
?>
