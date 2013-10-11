<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include("acl_controller.php");

/**
 * Users controller class
 * @package Controllers
 * @category User and group administration
 * @author Fernando Jimenez Lopez <fer800412@gmail.com>
 */
class Users extends Acl_controller {

    private $template_base = 'index';

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();

        $this->set_read_list(array('index', 'nick_exist', 'player','loadSubSecretary','subsecretary_asociate'));
        $this->set_insert_list(array('insert_user', 'form_insert'));
        $this->set_update_list(array('edit_user', 'form_edit', 'change_password', 'form_password'));
        $this->set_delete_list(array('delete_user'));

        $this->check_access();

        $this->load->model('users_model');
        $this->load->model('subsecretary_model');
        $this->load->library('form_validation');
    }

    /**
     * Default Action. Listing user collection
     *
     * @access public
     */
    function index() {
        $data['rows'] = $this->users_model->get_all();

        $template['_B'] = 'users/users_view.php';

        $this->load->template_view($this->template_base, $data, $template);
    }

    /**
     * Insert a new user
     *
     * @access public
     * @param
     * @return
     */
    function insert_user() {

        $this->form_validation->set_rules('username', lang('label_name'), 'required|trim');
        $this->form_validation->set_rules('email', lang('label_email'), 'valid_email|trim');
        $this->form_validation->set_rules('nick', lang('label_nickname'), 'required|callback_val_nick_exist');
        $this->form_validation->set_rules('password', lang('label_password'), 'required');
        $this->form_validation->set_rules('repassword', lang('label_repassword'), 'required|matches[password]');
        $this->form_validation->set_rules('cellular', lang('label_phone'), 'numeric|trim');
        $this->form_validation->set_rules('subsecretary', lang('label_subsecretary'), 'callback_subsecretary_asociate');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->form_insert();
        } else {
            $name = $this->input->post('username');
            $surname = $this->input->post('surname');
            $email = $this->input->post('email');
            $nick = $this->input->post('nick');
            $paswd = md5($this->input->post('password'));
            $cellular = $this->input->post('cellular');
            $subsecretary = $this->input->post('subsecretary');
            // $department = $this->input->post('department');
            $enable = ($this->input->post('enableuser') == FALSE) ? FALSE : TRUE;

            $id = $this->users_model->insert($nick, $paswd, $name, $surname, $email, $cellular, $subsecretary/* , $department */, $enable);

            if (isset($_POST['checkgroup'])) {
                foreach ($_POST['checkgroup'] as $group) {
                    $this->users_model->insert_group_relation($id, $group);
                }
            }
            set_flash_message(lang('msg_insert_user_success'));
            redirect('users/');
        }
    }

    /**
     * Update user data
     *
     * @access public
     * @param
     * @return
     */
    function edit_user() {

        $this->form_validation->set_rules('username', lang('label_name'), 'required|trim');
        $this->form_validation->set_rules('email', lang('label_email'), 'valid_email|trim');
        $this->form_validation->set_rules('nick', lang('label_nickname'), 'required|callback_val_nick_exist');
        $this->form_validation->set_rules('cellular', lang('label_phone'), 'numeric|trim');
        if($this->input->post('subsecretary') != $this->input->post('id_subsecretary_first'))
            $this->form_validation->set_rules('subsecretary', lang('label_subsecretary'), 'callback_subsecretary_asociate');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $id = $this->input->post('userid');

        if ($this->form_validation->run() == FALSE) {
            $this->form_edit($id);
        } else {
            $name = $this->input->post('username');
            $surname = $this->input->post('surname');
            $email = $this->input->post('email');
            $nick = $this->input->post('nick');
            $cellular = $this->input->post('cellular');
            $subsecretary = $this->input->post('subsecretary');
            $enable = ($this->input->post('enableuser') == FALSE) ? FALSE : TRUE;
//
            $this->users_model->update_all($id, $nick, $name, $surname, $email, $cellular, $subsecretary, $enable);

            if (isset($_POST['checkgroup'])) {
                $groups = $_POST['checkgroup'];
                $this->users_model->update_group_relation($id, $groups);
            }
            else
            //whitout checkboxes group request, then remove all groups to current user
                $this->users_model->update_group_relation($id, array());

            set_flash_message(lang('msg_update_user_success'));
            redirect('users/');
        }
    }

    /**
     * Update user password
     *
     * @access public
     * @param
     * @return
     */
    function change_password() {

        $this->form_validation->set_rules('password', lang('label_password'), 'required');
        $this->form_validation->set_rules('repassword', lang('label_repassword'), 'required|matches[password]');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $id = $this->input->post('userid');

        if ($this->form_validation->run() == FALSE) {
            $this->form_password($id);
        } else {

            $password = md5($this->input->post('password'));

            $this->users_model->update_password($id, $password);

            set_flash_message(lang('msg_update_user_pwd_success'));
            redirect('users/form_edit/' . $id);
        }
    }

    /**
     * delete user
     *
     * @access public
     * @param  int
     * @return
     */
    function delete_user($id) {

        $this->users_model->delete($id);

        set_flash_message(lang('msg_delete_user_success'));
        redirect('users/');
    }

    /**
     * Check if user nick exist (ajax method)
     *
     * @access public
     * @return
     */
    function nick_exist() {
        $nick = $this->input->post('nick');
        $id = ($this->input->post('userid') == FALSE) ? -1 : $this->input->post('userid');
        echo $this->users_model->nick_exist($nick, $id);
    }

    /**
     * Check if user nick exist to server side validate
     *
     * @access public
     * @return
     */
    function val_nick_exist($nick) {
        $id = ($this->input->post('userid') == FALSE) ? -1 : $this->input->post('userid');
        if ($this->users_model->nick_exist($nick, $id)) {
            $this->form_validation->set_message('val_nick_exist', lang('val_exist'));
            return FALSE;
        }
        else
            return TRUE;
    }

    /**
     * Load insert user form
     *
     * @access public
     * @param
     * @return
     */
    function form_insert() {

        $data['groups'] = $this->load_groups_options();
        $data['subsecretary'] = $this->loadSubSecretary();
        // $data['departments'] = $this->load_departments_options();

        $tamplate['_B'] = 'users/insert_user_view.php';

        $this->load->template_view($this->template_base, $data, $tamplate);
    }

    /**
     * Load edit user form
     *
     * @access public
     * @param int, user id
     * @return
     */
    function form_edit($id=0) {

        $data['data'] = $this->users_model->get_user($id);
        $data['groups'] = $this->load_groups_options();
        $data['usergroups'] = $this->users_model->get_user_group($id);
        $data['subsecretary'] = $this->loadSubSecretary();
        // $data['departments'] = $this->load_departments_options();

        $tamplate['_B'] = 'users/edit_user_view.php';
        $this->load->template_view($this->template_base, $data, $tamplate);
    }

    /**
     * Load form to chage user password
     *
     * @access public
     * @param int, user id
     * @return
     */
    function form_password($id=0) {
        $data['id'] = $id;
        $data['submitdata'] = 'users/change_password';

        $tamplate['_B'] = 'users/change_password_view.php';
        $this->load->template_view($this->template_base, $data, $tamplate);
    }

    /**
     * Create group list to load multiselect component in views
     *
     * @access private
     * @param
     * @return array of groups data
     */
    private function load_groups_options() {

        $this->load->model('groups_model');

        $groups = $this->groups_model->get_all();
        $options = array();
        foreach ($groups as $group) {
            $option['ID'] = $group->ID;
            $option['NAME'] = $group->NAME;
            $options[] = $option;
        }

        return $options;
    }

    /**
     * Create department list to fill a combobox component in views
     *
     * @access private
     * @param
     * @return array of groups data
     */
    private function load_departments_options() {

        $this->load->model('departments_model');

        $departments = $this->departments_model->get_all();

        $options = array('' => '');
        foreach ($departments as $department) {
            $options[$department->ID] = $department->NAME;
        }

        return $options;
    }

    private function loadSubSecretary() {
        $nomenclador = $this->subsecretary_model->loadSubSecretary();
        $options[0] = '-Seleccione-';
        foreach ($nomenclador as $tipo) {
            $options[$tipo->id_subsecretary] = $tipo->description;
        }
        return $options;
    }

    public function subsecretary_asociate($id_subsecretary)
    {
        $result = $this->subsecretary_model->verifySubSecretaryAsociateUser($id_subsecretary);
        if($result)
        {
            $this->form_validation->set_message('subsecretary_asociate', lang('label_subsecretary_asociate'));
            return FALSE;
        }
        else
            return TRUE;
    }
}
?>