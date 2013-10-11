<?php

/**
 * Cicle model class
 * @package Model
 * @author Aylienn Aquino Leiva
 */

class Cicle_model extends CI_Model{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountCicle() {
        return count($this->db->get('tb_n_cicle')->result());
    }

    public function getCicle($begining=-1, $limit=-1, $sortElement='', $sortDir='asc') {
        if ($sortElement != null)
            $this->db->order_by('tb_n_cicle.'.$sortElement, $sortDir);
        if ($limit != null && $begining != null)
            $this->db->limit($limit, $begining);
        return $this->db->get('tb_n_cicle')->result();
    }

    function getCicleById($id) {
        $data = array();
        $query = $this->db->where('tb_n_cicle.id_cicle', $id)->get('tb_n_cicle');
        if ($query->num_rows > 0) {
            $data = $query->row();
        }
        return $data;
    }

    public function loadCicle() {
        return $this->db->get('tb_n_cicle')->result();
    }

    function insertCicle($code, $description) {
        $data = array(
            'code' => $code,
            'description' => $description,
        );
        $this->db->insert('tb_n_cicle', $data);
        return $this->db->insert_id();
    }

    function updateCicle($code, $description, $id) {
        $data = array(
            'code' => $code,
            'description' => $description,
        );
        return $this->db->update('tb_n_cicle', $data, array('id_cicle' => $id));
    }

    function deleteCicle($id) {
        $this->db->delete('tb_n_cicle', array('id_cicle' => $id));
        return true;
    }

    function CicleAsociate($id) {
        $query = $this->db->select('tb_plan_state.*')->where('tb_plan_state.fk_rector_axis', $id)->get('tb_plan_state');
        if ($query->num_rows > 0) {
            return true;
        }
        return false;
    }

}
?>
