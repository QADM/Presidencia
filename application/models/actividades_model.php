<?php

/**
 * Actividades model class
 * @package Model
 * @author Arturo Cuenca Coss
 */

class Actividades_model extends CI_Model{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountActividades() {
        return count($this->db->get('actividades')->result());
    }

    public function getActividades($begining=-1, $limit=-1, $sortElement='', $sortDir='asc') {
        if ($sortElement != null)
            $this->db->order_by('actividades.'.$sortElement, $sortDir);
        if ($limit != null && $begining != null)
            $this->db->limit($limit, $begining);
        return $this->db->get('actividades')->result();
    }

    public function loadActividades() {
        return $this->db->get('actividades')->result();
    }

    function getActividadesById($id) {
        $data = array();
        $query = $this->db->where('actividades.cve_actividad', $id)->get('actividades');
        if ($query->num_rows > 0) {
            $data = $query->row();
        }
        return $data;
    }

    function insertActividades($actividad, $codigoactividad) {
        $data = array(
            'actividad' => $actividad,
            'codigoactividad' => $codigoactividad,
        );
        $this->db->insert('actividades', $data);
        return $this->db->insert_id();
    }

    function updateActividades($actividad, $codigoactividad, $id) {
        $data = array(
            'actividad' => $actividad,
            'codigoactividad' => $codigoactividad,
        );
        return $this->db->update('actividades', $data, array('cve_actividad' => $id));
    }

    function deleteActividades($id) {
        $this->db->delete('actividades', array('cve_actividad' => $id));
        return true;
    }

//    function ActividadesAsociate($id) {
//        $query = $this->db->select('actividades.*')->where('actividades.fk_rector_axis', $id)->get('tb_plan_state');
//        if ($query->num_rows > 0) {
//            return true;
//        }
//        return false;
//    }

}
?>
