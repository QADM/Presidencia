<?php

/**
 * SubSecretary model class
 * @package Model
 * @author Aylienn Aquino Leiva
 */

class Subsecretary_model extends CI_Model{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function getCountSubSecretary() {
        return count($this->db->get('tb_n_subsecretary')->result());
    }

    public function getSubSecretary($begining=-1, $limit=-1, $sortElement='', $sortDir='asc') {
        if ($sortElement != null)
            $this->db->order_by('tb_n_subsecretary.'.$sortElement, $sortDir);
        if ($limit != null && $begining != null)
            $this->db->limit($limit, $begining);
        return $this->db->get('tb_n_subsecretary')->result();
    }

    function getSubSecretaryById($id) {
        $data = array();
        $query = $this->db->where('tb_n_subsecretary.id_subsecretary', $id)->get('tb_n_subsecretary');
        if ($query->num_rows > 0) {
            $data = $query->row();
        }
        return $data;
    }

    public function loadSubSecretary() {
        return $this->db->get('tb_n_subsecretary')->result();
    }

    public function loadSubSecretaryAsociateUser() {
        $array_associate = array();
        $this->db->select('public.users.fk_subsecretary');
        $result = $this->db->get('public.users')->result();
        foreach ($result as $obj) {
            if(!empty ($obj->fk_subsecretary))
                $array_associate[] = $obj->fk_subsecretary;
        }
        return $array_associate;
    }


    public function verifySubSecretaryAsociateUser($id_subsecretary)
    {
        $query = $this->db->where('public.users.fk_subsecretary', $id_subsecretary)->get('public.users');
        if ($query->num_rows > 0) {
            return true;
        }
        return false;
    }

    function insertSubSecretary($code, $description, $secretary) {
        $data = array(
            'code' => $code,
            'description' => $description,
            'fk_secretary' => $secretary,
        );
        $this->db->insert('tb_n_subsecretary', $data);
        return $this->db->insert_id();
    }

    function updateSubSecretary($code, $description, $secretary, $id) {
        $data = array(
            'code' => $code,
            'description' => $description,
            'fk_secretary' => $secretary,
        );
        return $this->db->update('tb_n_subsecretary', $data, array('id_subsecretary' => $id));
    }

    function deleteSubSecretary($id) {
        $this->db->delete('tb_n_subsecretary', array('id_subsecretary' => $id));
        return true;
    }

    function SubSecretaryAsociate($id) {
        $query = $this->db->select('tb_plan_state.*')->where('tb_plan_state.fk_rector_axis', $id)->get('tb_plan_state');
        if ($query->num_rows > 0) {
            return true;
        }
        return false;
    }
}
?>
