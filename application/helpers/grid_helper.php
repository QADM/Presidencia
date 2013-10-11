<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

// @RQUITECTOS
// Helper to show a data in the grid
// Example: grid_json($this->library_lib,'metodoDeConteo','metodoDePaginado', $param);
//          $this->library_lib  =>  library where is the count and pager methods.
//          metodoDeConteo      =>  count method
//          metodoDePaginado    =>  pager method
//          $param              =>  additional parameters. Is optional
//
//

function grid_json($libreria, $metodoDeConteo, $metodoDePaginado, $args = array()) {

    //  Obtain the content of $_POST
    $page = $_POST['page'];
    $limit = $_POST['rows'];
    $sidx = $_POST['sidx'];
    $sord = $_POST['sord'];

    //  All parameters should be define.
    if (isset($libreria) && isset($metodoDeConteo) && isset($metodoDePaginado)) {

        // Check that the two methods exists in the library and can be call
        if (is_callable(array($libreria, $metodoDeConteo)) && is_callable(array($libreria, $metodoDePaginado))) {

            // Call the count method.
            $count = call_user_func_array(array($libreria, $metodoDeConteo), $args);

            // Save the count elements.
            $json['records'] = $count;

            // Calculate the numbers of pages.
            if ($count > 0)
                $total_pages = ceil($count / $limit);
            else
                $total_pages = 0;

            // Adjust the page
            if ($page > $total_pages)
                $page = $total_pages;

            // Calculate the start for the OFFSET in the query
            $start = $limit * $page - $limit;

            // Adjust the start
            if ($start < 0)
                $start = 0;

            // Save all these results
            $responce->page = $page;
            $responce->start = $start;
            $responce->limit = $limit;
            $responce->total = $total_pages;
            $responce->records = $count;

            // Define the params for pager method
            $params = array($start, $limit, $sidx, $sord);

            // Join these params with are passed to this method
            $params = array_merge($params, $args);

            // Call the pager method.
            $result = call_user_func_array(array($libreria, $metodoDePaginado), $params);


            $responce->rows = $result;
        }
    }
    return json_encode($responce);
}