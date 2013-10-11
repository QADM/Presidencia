<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * Extention to CodeIgniter Form Helper
 *
 * @package     Application
 * @subpackage	Helpers
 * @category	Helpers
 * @author      Fernando Jimenez Lopez
 */


// ------------------------------------------------------------------------

/**
 * set_val
 *
 * re-populate an input field or textarea
 *
 * @access	public
 * @param	string	field name
 * @param	string	default value
 * @return	string
 */
if ( ! function_exists('set_val'))
{
	function set_val($field, $default = '')
	{
            if ( ! isset($_POST[$field]))
                return $default;
            else
                return $_POST[$field];
	}
}


// ------------------------------------------------------------------------
/* End of file MY_form_helper.php */
/* Location: ./application/helpers/MY_form_helper.php */