<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter site template manager Helpers.
 * This helper assign the file names to define the 4 dynamic sections (pages) of the template base
 * (TEMPLATE_TOP, TEMPLATE_BODY, TEMPLATE_RIGHT and TEMPLATE_FOOTER)
 *
 * @package		Application
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Fernando Jimenez Lopez
 */
 

/**
 * Set Top template section
 *
 * @access	public
 * @param	string, file path
 */
if ( ! function_exists('template_top'))
{
	function template_top($path='')
	{
		if (!empty($path))
			return $path;
		else{
			$default = get_instance()->config->item('TEMPLATE');
			return $default['_T'];
			}
			
	}
}

 // ------------------------------------------------------------------------

/**
 * Set Body template section
 *
 * @access	public
 * @param	string, file path
 */
if ( ! function_exists('template_body'))
{
	function template_body($path=TEMPLATE_BODY)
	{
		if (!empty($path))
			return $path;
		else{
			$default = get_instance()->config->item('TEMPLATE');
			return $default['_B'];
			}
	}
}

 // ------------------------------------------------------------------------

/**
 * Set Right template section
 *
 * @access	public
 * @param	string, file path
 */
if ( ! function_exists('template_right'))
{
	function template_right($path=TEMPLATE_RIGHT)
	{
		if (!empty($path))
			return $path;
		else{
			$default = get_instance()->config->item('TEMPLATE');
			return $default['_R'];
			}
	}
}

 // ------------------------------------------------------------------------

/**
 * Set Footer template section
 *
 * @access	public
 * @param	string, file path
 */
if ( ! function_exists('template_footer'))
{
	function template_footer($path=TEMPLATE_FOOTER)
	{
		if (!empty($path))
			return $path;
		else{
			$default = get_instance()->config->item('TEMPLATE');
			return $default['_F'];
			}
	}
}
 
 

/* End of file site_template_helper.php */
/* Location: ./application/helpers/site_template_helper.php */