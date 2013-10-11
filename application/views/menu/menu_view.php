
<?php

if ( ! function_exists('generateRowsByLevel'))
{
    /**
    * @param array $level The current navigation level array
    * @param string $output The output to be added to
    * @param lang language abreviature to genrate correct links
    * @param int $depth The current depth of the tree to determine classname
    */
    function generateRowsByLevel($level, &$output, $depth = 0) {

        $depthClassMapping = array(0 => 'parent', 1 => 'child', 2 => 'grandchild');

        foreach ($level as $row) {
            $output .= '<tr class="even" valign="top">';
            $output .= "<td>". $row['id']."</td>\n";
            $output .= "<td class=\"" . $depthClassMapping[$depth] . "\">" . $row['name']."</td>\n";

            $output .= '<td style="text-align:center" >';
            $active = (strcmp($row['status'],'active') == 0)?TRUE:FALSE;
            $output .= form_checkbox(array('checked' => $active, 'disabled' => ''));
            $output .= "</td>\n";

            $output .= '<td style="text-align:center" >'. $row['parentid']."</td>\n";
            $output .= "<td class=\"" . $depthClassMapping[$depth] . "\" >". $row['orderr']."</td>\n";
            $output .= "<td >". $row['page_uri']."</td>\n";
            $output .= '<td style="text-align:center" >';
            $active = (strcmp($row['status'],'active') == 0)?lang('label_menu_disable'):lang('label_menu_enable');
            $output .= anchor('menu/change_menu_status/'.$row['id'],$active);
            $output .= action_separator();
            $output .= anchor( '/menu/edit_menu/'. $row['id'],lang('label_edit'));
            $output .= action_separator();
            $output .= anchor('/menu/delete_menu/'. $row['id'],lang('label_delete'), array('class' => 'prevent_delete_jq'));
            $output .= "</td>\n";
            $output .= "</tr>\n";

            // if the row has any children, parse those to ensure we have a properly
            // displayed nested table
            if (!empty($row['children'])) {
                generateRowsByLevel($row['children'], $output, $depth + 1);
            }
        }
    }
}

?>

<div class="content-admin" >
<h2 class="sge-postheader" ><?php echo lang('label_menus'); ?></h2>


<?php echo get_flash_message(); ?>
<?php echo anchor('menu/insert_menu',lang('label_new_menu')) ?> 
<br />

<?php if (empty($navlist)){ ?>
<div class="message">
<?php echo lang('msg_empty_data') ?>
</div>
<?php }
else{ 
    ?>

    <table id='tablesorter' class='data-table' >
    <thead>
    <tr valign='top'>
        <th><?php echo lang('label_id') ?></th>
        <th><?php echo lang('label_name') ?></th>
        <th style="text-align:center" ><?php echo lang('label_enabled') ?></th>
        <th style="text-align:center" ><?php echo lang('label_menu_parent_id') ?></th>
        <th><?php echo lang('label_menu_order') ?></th>
        <th><?php echo lang('label_menu_uri') ?></th>
        <th style="text-align:center" ><?php echo lang('label_actions') ?></th>
    </tr>
    </thead>
    <tbody>
 
    <!--generate all table rows-->
    <?php
    $output = "";
    generateRowsByLevel($navlist, $output);
    echo $output;
    ?>
 

    </tbody>
    </table>
<?php } ?>
<?php echo anchor('menu/insert_menu',lang('label_new_menu')) ?> 

<br />
<br/>
</div>
