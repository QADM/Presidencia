<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


include("acl_controller.php");

class Welcome extends Acl_controller {


    /**
     * Constructor
     *
     * @access public
     */
    function __construct(){
        parent::__construct();

        $this->set_read_list(array('index'));

        $this->check_access();

    }

    public function index()
    {
        $this->load->view('index');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */