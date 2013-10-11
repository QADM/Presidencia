<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * Extention to CodeIgniter Language Helper
 *
 * @package		Application
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Fernando Jimenez Lopez
 */
 

// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches and UTF8 encode a language variable and optionally outputs a form label.
 *
 * @access	public
 * @param	string	the language line
 * @param	string	the id of the form element
 * @return	string
 */
if ( ! function_exists('lang_utf8'))
{
	function lang_utf8($line, $id = '')
	{
		$CI =& get_instance();
		$line = utf8_encode($CI->lang->line($line));

		if ($id != '')
		{
			$line = '<label for="'.$id.'">'.$line."</label>";
		}

		return $line;
	}
}

// ------------------------------------------------------------------------
/* End of file MY_language_helper.php */
/* Location: ./application/helpers/MY_language_helper.php */