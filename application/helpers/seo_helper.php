<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter seo helper to manage title, description and keywords
 *
 * @package	Application
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Fernando Jimenez Lopez
 */
 

/**
 * Set Title
 *
 * @access	public
 * @param	string, file path
 */
if ( ! function_exists('seo_title'))
{
    function seo_title($text='')
    {
        if (!empty($text))
            return $text;
        else
            return get_instance()->config->item('seo_title');


    }
}

 // ------------------------------------------------------------------------

/**
 * Set Description
 *
 * @access	public
 * @param	string, file path
 */
if ( ! function_exists('seo_description'))
{
    function seo_description($text='')
    {
        if (!empty($text))
            return $text;
        else
            return get_instance()->config->item('seo_description');


    }
}

 // ------------------------------------------------------------------------

/**
 * Set Keywords
 *
 * @access	public
 * @param	string, file path
 */
if ( ! function_exists('seo_keywords'))
{
    function seo_keywords($text='')
    {
        if (!empty($text))
            return $text;
        else
            return get_instance()->config->item('seo_keywords');


    }
}

/* End of file seo_helper.php */
/* Location: ./application/helpers/seo_helper.php */