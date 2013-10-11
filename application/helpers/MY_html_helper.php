<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * Extention to CodeIgniter Html Helper
 *
 * @package		Application
 * @subpackage          Helpers
 * @category            Helpers
 * @author		Fernando Jimenez Lopez
 */


// ------------------------------------------------------------------------

/**
 * Html action separator
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('action_separatior'))
{
    function action_separator()
    {
        return  nbs(1) . '|' . nbs(1);
    }
}


// ------------------------------------------------------------------------

/**
 * Html alarm text element
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('alarm_text'))
{
    function alarm_text($text, $subtitle='')
    {
        $html = '<span class="alarm_text" >'. $text . '</span>';
        if (!empty($subtitle)){
            $html .= '<br>' . '<span class="alarm_subtitle" >'. $subtitle . '</span>';
        }

        return $html;
    }
}



// ------------------------------------------------------------------------
/* End of file MY_html_helper.php */
/* Location: ./application/helpers/MY_html_helper.php */