<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include("acl_controller.php");


/**
 * FundamentosNormativos controller class
 * @package Controllers
 * @category Business
 * @author Arturo Cuenca Coss
 */

class FundamentosNormativos extends Acl_controller {

    private $template_base = 'index';

    function __construct() {
        parent::__construct();

        $this->set_read_list(array('index','getFundamentosNormativos'));
        $this->set_insert_list(array('insert', 'insertFundamentosNormativos'));
        $this->set_update_list(array('edit', 'editFundamentosNormativos'));
        $this->set_delete_list(array('deleteFundamentosNormativos'));

        $this->check_access();
        $this->load->model('fundamentosnormativos_model');
        $this->load->library('form_validation');
    }

    function index() {
        $template['_B'] = 'fundamentosnormativos/fundamentosnormativos_view.php';
        $this->load->template_view($this->template_base, '', $template);
    }

    function getFundamentosNormativos() {
        $this->load->helper('grid');
        echo grid_json($this->fundamentosnormativos_model, 'getCountFundamentosNormativos', 'getFundamentosNormativos');
    }

    function insert() {
        $template['_B'] = 'fundamentosnormativos/fundamentosnormativos_insert_view.php';
        return $this->load->template_view($this->template_base, '', $template);
    }

    function insertFundamentosNormativos() {
        $this->form_validation->set_rules('nombre', lang('label_nombre'), 'required|trim');
        $this->form_validation->set_rules('numeral', lang('label_numeral'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $nombre = $this->input->post('nombre');
            $numeral = $this->input->post('numeral');
            if ($this->fundamentosnormativos_model->insertFundamentosNormativos($nombre, $numeral) != FALSE) {
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

    function edit($Cve_FundamentoNormativa) {
        $data['fundamentosnormativos'] = $this->fundamentosnormativos_model->getFundamentosNormativosById($Cve_FundamentoNormativa);

        $template['_B'] = 'fundamentosnormativos/fundamentosnormativos_edit_view.php';
        return $this->load->template_view($this->template_base, $data, $template);
    }

    function editFundamentosNormativos() {
        $this->form_validation->set_rules('nombre', lang('label_nombre'), 'required|trim');
        $this->form_validation->set_rules('numeral', lang('label_numeral'), 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            $this->insert();
        } else {
            $code = $this->input->post('nombre');
            $description = $this->input->post('numeral');
            $cve_fundamentonormativa = $this->input->post('cve_fundamentonormativa');
            if ($this->macroprocesos_model->updateFundamentosNormativos($nombre, $numeral, $cve_fundamentonormativa) != FALSE) {
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

    function deleteFundamentosNormativos() {
        $id = $this->input->post('cve_fundamentonormativa');
        $this->fundamentosnormativos_model->deleteFundamentosNormativos($id);
        $response['success'] = TRUE;
        die(json_encode($response));
    }

}
?>
