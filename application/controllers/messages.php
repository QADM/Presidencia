<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Message manager class
 * @package Controllers
 * @category Messages
 * @author Fernando Jimenez Lopez <fer800412@gmail.com>
 */
class Messages extends CI_Controller {

    private $template_base = 'index';

    /**
     * Constructor
     *
     * @access public
     */
    function __construct() {
        parent::__construct();
    }

    public function denied() {
        $template['_B'] = 'messages/denied.php';

        $this->load->template_view($this->template_base, $template);
    }

    public function test() {
        $this->load->view('messages/test');
    }

}
?>