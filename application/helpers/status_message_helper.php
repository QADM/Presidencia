<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * NOTE: This Helper need to run CodeIgniter Session Library
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter status message Helpers
 *
 * @package		Application
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Fernando Jimenez Lopez
 */
 
 
 // ------------------------------------------------------------------------
 /**
  * Constants of message types
  */
 
 define("FLASH_MSG_SUCCESS", 0);
 define("FLASH_MSG_ERROR"  , 1);

// ------------------------------------------------------------------------

/**
 * Set flash status message
 *
 * @access	public
 * @param	string, Message text
 * @param	int, Message type (see above 'Constants Message Types')
 */
if ( ! function_exists('set_flash_message'))
{
	function set_flash_message($text, $type=FLASH_MSG_SUCCESS)
	{
		$CI =& get_instance();
		$CI->session->set_flashdata('status_msg', $text);
		$CI->session->set_flashdata('status_msg_type', $type);
	}
}

// ------------------------------------------------------------------------

/**
 * Set flash status message array
 *
 * @access	public
 * @param	array, Message text array
 * @param	int, Message type (see above 'Constants Message Types')
 */
if ( ! function_exists('set_flash_message_array'))
{
	function set_flash_message_array($array, $type=FLASH_MSG_SUCCESS)
	{
            $text = "";
            foreach ($array as $value) {
                $text .=  '<p>' . $value . '</p>';
            }
		$CI =& get_instance();
		$CI->session->set_flashdata('status_msg', $text);
		$CI->session->set_flashdata('status_msg_type', $type);
	}
}

// ------------------------------------------------------------------------

/**
 * Get html string with flash status message
 *
 * @access	public
 * @return	string, message in basic a html template
 */
if ( ! function_exists('get_flash_message'))
{
	function get_flash_message()
	{
		$CI =& get_instance();
	
		$html = '';
		
		if ($CI->session->flashdata('status_msg')){
			$text = $CI->session->flashdata('status_msg');
			$type = $CI->session->flashdata('status_msg_type');
			$class='';
			switch ($type) {
			    case 0:
			        $class='success';
			        break;
			    case 1:
			        $class='error';
			        break;
				}
			
			$html = '<div class="'.$class.'" >' . $text . '</div>';
		}
		return $html;
	}
}

// ------------------------------------------------------------------------

/**
 * Get html string with flash status message using jquery notification
 *
 * @access	public
 * @return	string, message in basic a html template
 */
if ( ! function_exists('get_flash_message_jnotify'))
{
	function get_flash_message_jnotify()
	{
		$CI =& get_instance();
                $base_url = $CI->config->slash_item('base_url');
	
		$html = '<link type="text/css" rel="stylesheet" href="'. $base_url .'js/jquery-notify/ui.notify.css" />';
                $html .= '<script src="'. $base_url .'js/jquery-notify/jquery.notify.min.js" type="text/javascript"></script>';
                $html .= '<script type="text/javascript">';
                $html .= '$(document).ready(function() { ';
                $html .= '$container = $("#container-notify").notify();';

		if ($CI->session->flashdata('status_msg')){
			$text = $CI->session->flashdata('status_msg');
			$type = $CI->session->flashdata('status_msg_type');
			$class='';
			switch ($type) {
			    case 0:
			        $class='success';
			        break;
			    case 1:
			        $class='error';
			        break;
				}
			
			//$html = '<div class="'.$class.'" >' . $text . '</div>';
                        $html .= '$container.notify("create", "sticky", { title:\'Notificación\', text:\'' . $text . '\'});';
		
		}
                
                $html .= '})';
                $html .= '</script>';
                
                
                $html .= '<div id="container-notify" style="display:none">';		
		$html .= '<div id="sticky">';
		$html .= '<a class="ui-notify-close ui-notify-cross" href="#">x</a>';
		$html .= '<h1>#{title}</h1>';
		$html .= '<p>#{text}</p>';
		$html .= '</div>';
                $html .= '</div>';
                
                
		return $html;
	}
}



/* End of file status_message_helper.php */
/* Location: ./application/helpers/status_message_helper.php */