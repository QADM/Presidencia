<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 */

// ------------------------------------------------------------------------

/**
 * Extention to CodeIgniter Date Helper
 *
 * @package		Application
 * @subpackage          Helpers
 * @category            Helpers
 * @author		Fernando Jimenez Lopez
 */


// ------------------------------------------------------------------------

/**
 * Convert string date from DD/MM/YYYY format to YYYY/MM/DD format
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('date_dmy_ymd'))
{
    function date_dmy_ymd($datedmy)
    {
        $list = explode("/", $datedmy);
        if (count($list) == 3)
            return  $list[2].'/'.$list[1].'/'.$list[0];
        else
            return $datedmy;
    }
}

// ------------------------------------------------------------------------

/**
 * Format string date from yyyy-mm-dd hh:mm:ss (database datetime format ex. 2011-10-30 11:23:30)
 * to other format
 *
 * @param       string, string date, by default get "Now"
 * @param       string, format to get date, by default "d/m/Y h:i a"
 * @access	public
 * @return	string
 */
if ( ! function_exists('date_f'))
{
    function date_f($strdate = '', $stringformat = 'd/m/Y h:i a')
    {
        if (empty($strdate)) $strdate = date(DATE_ATOM);

        $date_time = explode(' ', $strdate);
        if (count($date_time) == 2){
            $date = explode('-', $date_time[0]);
            if (count($date) == 3){
                $time = explode(':', $date_time[1]);
                if (count($time) == 3){
                    return date($stringformat, mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]));
                }
            }
        }
        elseif (count($date_time) == 1){
            $date = explode('-', $date_time[0]);
            if (count($date) == 3){
                 return date($stringformat, mktime(0, 0, 0, $date[1], $date[2], $date[0]));
            }
        }

        return $strdate;
    }
}

// ------------------------------------------------------------------------

/**
 * Format string date from yyyy-mm-dd hh:mm:ss to Unix time stamp
 *
 * @param       string, string date, by default get "Now"
 * @access	public
 * @return	string
 */
if ( ! function_exists('date_to_time'))
{
    function date_to_time($strdate = '')
    {
        if (empty($strdate)) $strdate = date(DATE_ATOM);

        $date_time = explode(' ', $strdate);
        if (count($date_time) == 2){
            $date = explode('-', $date_time[0]);
            if (count($date) == 3){
                $time = explode(':', $date_time[1]);
                if (count($time) == 3){
                    return mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);
                }
            }
        }
        elseif (count($date_time) == 1){
            $date = explode('-', $date_time[0]);
            if (count($date) == 3){
                 return mktime(0, 0, 0, $date[1], $date[2], $date[0]);
            }
        }

        return $strdate;
    }
}// ------------------------------------------------------------------------

/**
 * Comparation between two unix time stamp
 * Return 0 if time stamps are iqual,
 *       -1 if first time stamp is bigger and
 *        1 if second time stamp are bigger
 *
 * @param   longint, first time stamp
 * @param   longint, second time stamp
 * @access  public
 * @return  int, 0 if time stamps are iqual,
 *          -1 if first time stamp is bigger and
 *           1 if second time stamp are bigger
 */
if ( ! function_exists('time_cmp'))
{
    function time_cmp($time0, $time1)
    {
        if($time0 === $time1)
            return 0;
        elseif ($time0 > $time1)
            return -1;
        else
            return 1;
    }
}

// ------------------------------------------------------------------------
/* End of file MY_date_helper.php */
/* Location: ./application/helpers/MY_date_helper.php */