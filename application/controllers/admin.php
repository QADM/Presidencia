<?php 

/**
* Authentication controller class
* @package Controllers
* @category Authentication and ACL
* @author Fernando Jimenez Lopez <fer800412@gmail.com>
*/
class Admin extends CI_Controller
{
	
    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model('cicle_model');
        $this->load->model('finance_key_model');
    }

    /**
     * Default Action. Show view of authentication form
     *
     * @access public
     */
    function index()
    {
        if (!$this->session->userdata('logged_in'))
        {
            $data['cicle'] = $this->loadCicle();
            $this->load->view('login_view',$data);
        }
        else
        {
            redirect(base_url());
        }
    }

    /**
     * User login
     *
     * @access public
     */
    function login()
    {
        $nick  = $this->input->post('nick');
        $password = $this->input->post('password');
        $id_cicle = $this->input->post('cicle');
        $cicle = $this->cicle_model->getCicleById($id_cicle);

        if (!$this->auth_acl->login($nick, $password, $cicle->id_cicle, $cicle->description)){
            redirect('admin/');
        }
        else{
            redirect(base_url());
        }
    }

    /**
     * User logout
     *
     * @access public
     */
    function logout()
    {
        $this->auth_acl->logout();

        redirect(base_url());
    }

    function loadCicle() {
        $tipo_nomenclador = $this->finance_key_model->loadCicle();
        $options[0] = '-Seleccione-';
        foreach ($tipo_nomenclador as $tipo) {
            $options[$tipo->id_cicle] = $tipo->description;
        }
        return $options;
    }

}
 ?>