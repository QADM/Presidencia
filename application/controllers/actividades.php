<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include("acl_controller.php");


/**
 * Actividades controller class
 * @package Controllers
 * @category Business
 * @author Arturo Cuenca Coss
 */

class Actividades extends Acl_controller {

    private $template_base = 'index';

    function __construct() {
        parent::__construct();

        $this->set_read_list(array('index','getActividades'));
        $this->set_insert_list(array('insert', 'insertActividades'));
        $this->set_update_list(array('edit', 'editActividades'));
        $this->set_delete_list(array('deleteActividades'));

        $this->check_access();
        $this->load->model('actividades_model');
        $this->load->library('form_validation');
    }

    function index() {
        $template['_B'] = 'actividades/actividades_view.php';
        $this->load->template_view($this->template_base, '', $template);
    }

    function getActividades() {
        $this->load->helper('grid');
        echo grid_json($this->actividades_model, 'getCountActividades', 'getActividades');
    }

    function insert() {
        $template['_B'] = 'actividades/actividades_insert_view.php';
        return $this->load->template_view($this->template_base, '', $template);
    }

    function insertActividades() {
        $this->form_validation->set_rules('actividad', lang('label_actividad'), 'required|trim');
        $this->form_validation->set_rules('codigoactividad', lang('label_codigoactividad'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $actividad = $this->input->post('actividad');
            $codigoactividad = $this->input->post('codigoactividad');
            if ($this->actividades_model->insertActividades($actividad, $codigoactividad) != FALSE) {
                $response['success'] = TRUE;
                $response['message'] = lang('msg_insert_success');
                die(json_encode($response));
            } else {
                $response['success'] = FALSE;
                $response['message'] = lang('msg_error');
                die(json_encode($response));
            }
        }
    }

    function edit($Cve_Actividad) {
        $data['actividades'] = $this->actividades_model->getActividadesById($Cve_Actividad);

        $template['_B'] = 'actividades/actividades_edit_view.php';
        return $this->load->template_view($this->template_base, $data, $template);
    }

    function editActividades() {
        $this->form_validation->set_rules('actividad', lang('label_actividad'), 'required|trim');
        $this->form_validation->set_rules('codigoactividad', lang('label_codigoactividad'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $code = $this->input->post('actividad');
            $description = $this->input->post('codigoactividad');
            $cve_macroprocesos = $this->input->post('cve_actividad');
            if ($this->actividades_model->updateActividades($actividad, $codigoactividad, $cve_actividad) != FALSE) {
                $response['success'] = TRUE;
                $response['message'] = lang('msg_edit_success');
                die(json_encode($response));
            } else {
                $response['success'] = FALSE;
                $response['message'] = lang('msg_error');
                die(json_encode($response));
            }
        }
    }

    function deleteActividades() {
        $id = $this->input->post('cve_actividad');
        $this->actividades_model->deleteActividades($id);
        $response['success'] = TRUE;
        die(json_encode($response));
    }

}
?>
