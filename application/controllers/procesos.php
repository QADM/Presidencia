<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include("acl_controller.php");


/**
 * Procesos controller class
 * @package Controllers
 * @category Business
 * @author Arturo Cuenca Coss
 */

class Procesos extends Acl_controller {

    private $template_base = 'index';

    function __construct() {
        parent::__construct();

        $this->set_read_list(array('index','getProcesos'));
        $this->set_insert_list(array('insert', 'insertProcesos'));
        $this->set_update_list(array('edit', 'editProcesos'));
        $this->set_delete_list(array('deleteProcesos'));

        $this->check_access();
        $this->load->model('procesos_model');
        $this->load->library('form_validation');
    }

    function index() {
        $template['_B'] = 'procesos/procesos_view.php';
        $this->load->template_view($this->template_base, '', $template);
    }

    function getProcesos() {
        $this->load->helper('grid');
        echo grid_json($this->procesos_model, 'getCountProcesos', 'getProcesos');
    }

    function insert() {
        $template['_B'] = 'procesos/procesos_insert_view.php';
        return $this->load->template_view($this->template_base, '', $template);
    }

    function insertProcesos() {
        $this->form_validation->set_rules('proceso', lang('label_proceso'), 'required|trim');
        $this->form_validation->set_rules('objetivoproceso', lang('label_objetivoproceso'), 'required|trim');
		$this->form_validation->set_rules('instrumentojuridico',lang('label_instrumentojuridico'),'required|trim');
		$this->form_validation->set_rules('codigoproceso',lang('label_codigoproceso'),'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $proceso = $this->input->post('proceso');
            $objetivoproceso = $this->input->post('objetivoproceso');
			$instrumentojuridico = $this->input->post('instrumentojuridico');
            $codigoproceso = $this->input->post('codigoproceso');
            if ($this->procesos_model->insertProcesos($proceso, $objetivoproceso,$instrumentojuridico,$codigoproceso) != FALSE) {
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
        $data['procesos'] = $this->procesos_model->getProcesosById($Cve_MacroProceso);

        $template['_B'] = 'procesos/procesos_edit_view.php';
        return $this->load->template_view($this->template_base, $data, $template);
    }

    function editProcesos() {
        $this->form_validation->set_rules('proceso', lang('label_proceso'), 'required|trim');
        $this->form_validation->set_rules('objetivoproceso', lang('label_objetivoproceso'), 'required|trim');
		$this->form_validation->set_rules('instrumentojuridico', lang('label_instrumentojuridico'), 'required|trim');
        $this->form_validation->set_rules('codigoproceso', lang('label_codigoproceso'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $code = $this->input->post('proceso');
            $description = $this->input->post('objetivoproceso');
			$instrumentojuridico = $this->input->post('instrumentojuridico');
            $codigoproceso = $this->input->post('codigoproceso');
            $cve_procesos = $this->input->post('cve_proceso');
            if ($this->procesos_model->updateProcesos($proceso, $objetivoproceso,$instrumentojuridico, $codigoproceso, $cve_proceso) != FALSE) {
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

    function deleteProcesos() {
        $id = $this->input->post('cve_proceso');
        $this->procesos_model->deleteProcesos($id);
        $response['success'] = TRUE;
        die(json_encode($response));
    }

}
?>
