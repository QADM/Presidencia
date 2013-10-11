<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This library is used for generate dynamic menu trees 
 */

/**
* Menu manager library
* @package Libraries
* @category Mail Manager
* @author Fernando Jiménez López <fer800412@gmail.com>
*/
class Menu_manager
{

    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        $this->CI = & get_instance();
 
    }
 
    /**
     * Generate menu site
     */    
    function generate_menu(){
        $tree = array();

        $CI = get_instance();
        $CI->load->model('menu_model');
        $su = $CI->config->item('su_name');
        $suid = $CI->config->item('su_id');

        if ($CI->session->userdata('user') != $su or $CI->session->userdata('id') != $suid) {
           $tree = $CI->menu_model->generateallActiveTreeArrayByUser($CI->session->userdata('id'));
        }
        else {
            $tree = $CI->menu_model->generateallActiveTreeArray();
        }

        $output = "";

        if (!empty($tree)){
            $output = '<ul class="sge-menu">';
            $this->generateMenuByLevel($tree, $output);
            $output .= '</ul>';
        }
        return $output;
    }
    
    /**
     * Generate menu by levels
     *
     * @access public
     * @param array, List of menu entries
     * @param string, return html script of menu
     * @param int, depth level in menu tree
     * @param int, return 1 or 0 if exist childs to level returned
     */
   function generateMenuByLevel($tree, &$output, $parent = 0, &$flag = 0) {
        if (isset($tree[$parent])){
            foreach ($tree[$parent] as $row) {
                $output .= "<li>";

                if (isset($tree[$row->id])){
                    $aux = "";
                    $flag1 = 0;
                    $this->generateMenuByLevel($tree, $aux, $row->id, $flag1);

                    if ($flag1 == 1) {
                        $flag = 1;
                        $content = '<a class="bullet-child"><span class="r"></span><span class="t">' . $row->name . '</span></a>';
                        if (!empty($row->page_uri))
                          $content = anchor($row->page_uri, $row->name );

                        $output .= $content;
                        $output .= "<ul>";
                        $output .= $aux;
                        $output .= "</ul>";
                    }
                    elseif (!empty($row->page_uri)){
                         $output .= '<a href="' . base_url() . $row->page_uri . '" >' . $row->name . '</a>';     
                         $flag = 1;
                    }

                }
                else
                    if (!empty($row->page_uri)){
                        $output .= '<a href="' . base_url() . $row->page_uri . '"><span class="r"></span><span class="t">' . $row->name  . '</span></a>';
                        $flag = 1;
                    }
                $output .= "</li>";

            }
        }
    }
   
}

?>