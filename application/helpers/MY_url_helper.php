<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * Extention to CodeIgniter Url Helper
 *
 * @package		Application
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Fernando Jimenez Lopez
 */
 

// ------------------------------------------------------------------------

/**
 * Base URL Lang
 *
 * Returns the "base_url" item from your config file adding language segment behind this 
 * (Ex. http://www.example.com/en/)
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('base_url_lang'))
{
	function base_url_lang()
	{
		$CI =& get_instance();
		return base_url() . $CI->config->item('lang') . '/';
	}
}

// ------------------------------------------------------------------------

/**
 * Anchor Link Lang
 *
 * Creates an anchor based on the local URL with language segment.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the link title
 * @param	mixed	any attributes
 * @return	string
 */
if ( ! function_exists('anchor_lang'))
{
	function anchor_lang($uri = '', $title = '', $attributes = '')
	{
		$title = (string) $title;
		
		$CI =& get_instance();
		$lang = $CI->config->item('lang') . '/';

		if ( ! is_array($uri))
		{
			
			if ( ! preg_match('!^\w+://! i', $uri)){
				$uri = $lang . $uri;
				$site_url = site_url($uri);
			}
			else{
				$site_url = $uri;
				} 
		}
		else
		{
			$lang_array = array($lang);
			$uri_merge = array_merge($lang_array, $uri);
			$site_url = site_url($uri_merge);
		}

		if ($title == '')
		{
			$title = $site_url;
		}

		if ($attributes != '')
		{
			$attributes = _parse_attributes($attributes);
		}

		return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
	}
}

// ------------------------------------------------------------------------

/**
 * Header Redirect adding language url segment
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('redirect_lang'))
{
	function redirect_lang($uri = '', $method = 'location', $http_response_code = 302)
	{
		$CI =& get_instance();
		$uri = $CI->config->item('lang') . '/' . $uri;
		if ( ! preg_match('#^https?://#i', $uri))
		{
			$uri = site_url($uri);
		}

		switch($method)
		{
			case 'refresh'	: header("Refresh:0;url=".$uri);
				break;
			default			: header("Location: ".$uri, TRUE, $http_response_code);
				break;
		}
		exit;
	}
}

// ------------------------------------------------------------------------

/**
 * Language url segment
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('lang_segment'))
{
	function lang_segment()
	{
		$CI =& get_instance();
		return $CI->config->item('lang') . '/';
	}
}

// ------------------------------------------------------------------------
/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */