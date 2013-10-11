<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include("acl_controller.php");


/**
 * MacroProcesos controller class
 * @package Controllers
 * @category Business
 * @author Arturo Cuenca Coss
 */

class MacroProcesos extends Acl_controller {

    private $template_base = 'index';

    function __construct() {
        parent::__construct();

        $this->set_read_list(array('index','getMacroProcesos'));
        $this->set_insert_list(array('insert', 'insertMacroProcesos'));
        $this->set_update_list(array('edit', 'editMacroProcesos'));
        $this->set_delete_list(array('deleteMacroProcesos'));

        $this->check_access();
        $this->load->model('macroprocesos_model');
        $this->load->library('form_validation');
    }

    function index() {
        $template['_B'] = 'macroprocesos/macroprocesos_view.php';
        $this->load->template_view($this->template_base, '', $template);
    }

    function getMacroProcesos() {
        $this->load->helper('grid');
        echo grid_json($this->macroprocesos_model, 'getCountMacroProcesos', 'getMacroProcesos');
    }

    function insert() {
        $template['_B'] = 'macroprocesos/macroprocesos_insert_view.php';
        return $this->load->template_view($this->template_base, '', $template);
    }

    function insertMacroProcesos() {
        $this->form_validation->set_rules('macroproceso', lang('label_macroproceso'), 'required|trim');
        $this->form_validation->set_rules('codigomacroproceso', lang('label_codigomacroproceso'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $macroproceso = $this->input->post('macroproceso');
            $codigomacroproceso = $this->input->post('codigomacroproceso');
            if ($this->macroprocesos_model->insertMacroProcesos($macroproceso, $codigomacroproceso) != FALSE) {
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

    function edit($Cve_MacroProceso) {
        $data['macroprocesos'] = $this->macroprocesos_model->getMacroProcesosById($Cve_MacroProceso);

        $template['_B'] = 'macroprocesos/macroprocesos_edit_view.php';
        return $this->load->template_view($this->template_base, $data, $template);
    }

    function editMacroProcesos() {
        $this->form_validation->set_rules('macroproceso', lang('label_macroproceso'), 'required|trim');
        $this->form_validation->set_rules('codigomacroproceso', lang('label_codigomacroproceso'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $code = $this->input->post('macroproceso');
            $description = $this->input->post('codigomacroproceso');
            $cve_macroprocesos = $this->input->post('cve_macroproceso');
            if ($this->macroprocesos_model->updateMacroProcesos($macroproceso, $codigomacroproceso, $cve_macroproceso) != FALSE) {
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

    function deleteMacroProcesos() {
        $id = $this->input->post('cve_macroproceso');
        $this->macroprocesos_model->deleteMacroProcesos($id);
        $response['success'] = TRUE;
        die(json_encode($response));
    }

}
?>
