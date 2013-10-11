<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Access Control List controller class
* @package Controllers
* @category Authentication and ACL
* @author Fernando Jimenez Lopez <fer800412@gmail.com>
*/
class Acl_controller extends CI_Controller
{
	
	private $read_list = array();
	private $insert_list = array();
	private $update_list = array();
	private $delete_list = array();
	
	/** 
	 * Constructor
	 * 
	 * @access public 
	 */
	function __construct(){
            parent::__construct();
	}
	
	/** 
	 * Define if user logged have permission to current resources
	 * 	
	 * @access public 
	 * @param  
	 * @return
	 */
	function check_access(){	
		
            if (!$this->session->userdata('logged_in')){
                redirect('admin/');
            }else{

                //Scape if is super user
                $su = $this->config->item('su_name');
                $suid = $this->config->item('su_id');
                if ($this->session->userdata('user') != $su or $this->session->userdata('id') != $suid){
                    $acl = $this->auth_acl->get_acl($this->session->userdata('id'));
                    $route = $this->router->class . '/' . $this->router->method;

                    $valid = FALSE;

                    //In case of "controller_name/action_name" resource format
                    foreach ($acl as $item) {
                        if (strcasecmp(trim($item->RESOURCE), $route) == 0){
                            if (in_array($this->router->method, $this->read_list))   $valid = ($item->R != 0);
                            if (in_array($this->router->method, $this->insert_list)) $valid = ($item->I != 0);
                            if (in_array($this->router->method, $this->update_list)) $valid = ($item->U != 0);
                            if (in_array($this->router->method, $this->delete_list)) $valid = ($item->D != 0);
                            if ($valid) break;
                        }
                    }

                    if (!$valid){
                        $route = $this->router->class;

                        //In case of "controller_name" resource format
                        foreach ($acl as $item) {
                            if (strcasecmp(trim($item->RESOURCE), $route) == 0){
                                if (in_array($this->router->method, $this->read_list))   $valid = ($item->R != 0);
                                if (in_array($this->router->method, $this->insert_list)) $valid = ($item->I != 0);
                                if (in_array($this->router->method, $this->update_list)) $valid = ($item->U != 0);
                                if (in_array($this->router->method, $this->delete_list)) $valid = ($item->D != 0);
                                if ($valid) break;
                            }
                        }
                    }


                    if (!$valid){
                        redirect('messages/denied');
                    }

                }

            }
		
	}
	
	/** 
	 * Set function name list for read propouses
	 * 
	 * @access public 
	 */
	protected function set_read_list($list){
		$this->read_list = $list;
	}
	
	/** 
	 * Set function name list for insert propouses
	 * 
	 * @access public 
	 */
	protected function set_insert_list($list){
		$this->insert_list = $list;
	}
	
	/** 
	 * Set function name list for update propouses
	 * 
	 * @access public 
	 */
	protected function set_update_list($list){
		$this->update_list = $list;
	}
	
	/** 
	 * Set function name list for delete propouses
	 * 
	 * @access public 
	 */
	protected function set_delete_list($list){
		$this->delete_list = $list;
	}
}
 ?>