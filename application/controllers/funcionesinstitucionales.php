<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include("acl_controller.php");


/**
 * FuncionesInstitucionales controller class
 * @package Controllers
 * @category Business
 * @author Arturo Cuenca Coss
 */

class FuncionesInstitucionales extends Acl_controller {

    private $template_base = 'index';

    function __construct() {
        parent::__construct();

        $this->set_read_list(array('index','getFuncionesInstitucionales'));
        $this->set_insert_list(array('insert', 'insertFuncionesInstitucionales'));
        $this->set_update_list(array('edit', 'editFuncionesInstitucionales'));
        $this->set_delete_list(array('deleteFuncionesInstitucionales'));

        $this->check_access();
        $this->load->model('funcionesinstitucionales_model');
        $this->load->library('form_validation');
    }

    function index() {
        $template['_B'] = 'funcionesinstitucionales/funcionesinstitucionales_view.php';
        $this->load->template_view($this->template_base, '', $template);
    }

    function getFuncionesInstitucionales() {
        $this->load->helper('grid');
        echo grid_json($this->funcionesinstitucionales_model, 'getCountFuncionesInstitucionales', 'getFuncionesInstitucionales');
    }

    function insert() {
        $template['_B'] = 'funcionesinstitucionales/funcionesinstitucionales_insert_view.php';
        return $this->load->template_view($this->template_base, '', $template);
    }

    function insertFuncionesInstitucionales() {
        $this->form_validation->set_rules('funcioninstitucional', lang('label_funcioninstitucional'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $funcioninstitucional = $this->input->post('funcioninstitucional');
            if ($this->funcionesinstitucionales_model->insertFuncionesInstitucionales($funcioninstitucional) != FALSE) {
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

    function edit($Cve_FuncionesInstitucionales) {
        $data['funcionesinstitucionales'] = $this->funcionesinstitucionales_model->getFuncionesInstitucionalesById($Cve_FuncionesInstitucionales);

        $template['_B'] = 'funcionesinstitucionales/funcionesinstitucionales_edit_view.php';
        return $this->load->template_view($this->template_base, $data, $template);
    }

    function editFuncionesInstitucionales() {
        $this->form_validation->set_rules('funcionesinstitucionales', lang('label_funcionesinstitucionales'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $code = $this->input->post('funcionesinstitucionales');
            $cve_funcioninstitucional = $this->input->post('cve_funcioninstitucional');
            if ($this->funcionesinstitucionales_model->updateFuncionesInstitucionales($funcionesinstitucionales, $cve_funcioninstitucional) != FALSE) {
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

    function deleteFuncionesInstitucionales() {
        $id = $this->input->post('cve_funcioninstitucional');
        $this->funcionesinstitucionales_model->deleteFuncionesInstitucionales($id);
        $response['success'] = TRUE;
        die(json_encode($response));
    }

}
?>
