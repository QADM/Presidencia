<div class="content-admin" >
<h2 class="sge-postheader" ><?php echo lang('label_users'); ?></h2>

<?php echo get_flash_message(); ?>
<?php echo anchor('users/form_insert',lang('label_new_user')) ?>
<br />
<?php if (empty($rows)){ ?>
<div class="message">
<?php echo lang('msg_empty_data') ?>
</div>
<?php }
else{ ?>
<table class="data-table" >
    <thead>
        <tr>
            <th><?php echo lang('label_id'); ?></th>
            <th><?php echo lang('label_nickname'); ?></th>
            <th><?php echo lang('label_name'); ?></th>
            <th><?php echo lang('label_surname_2'); ?></th>
            <th><?php echo lang('label_email'); ?></th>
            <th><?php echo lang('label_cellular'); ?></th>
            <th style="text-align:center" ><?php echo lang('label_enabled'); ?></th>
            <th><?php echo lang('label_creation_date'); ?></th>
            <th style="text-align:center"><?php echo lang('label_actions'); ?></th>
        </tr>
    </thead>
    <tbody>
<?php 
$i = 0;
foreach ($rows as $row){
	$class = ($i % 2 == 0)?'class="even"':'class="odd"';
	$i++;
	echo '<tr '. $class .' >';
	echo '<td>' . $row->ID . '</td>';
	echo '<td>' . $row->NICKNAME . '</td>';
	echo '<td>' . $row->NAME . '</td>';
	echo '<td>' . $row->SURNAME . '</td>';
	echo '<td>' . $row->EMAIL . '</td>';
        echo '<td>' . $row->CELLULAR . '</td>';
//        echo '<td>' . $row->DEPARTMENT . '</td>';
	echo '<td style="text-align:center" >' . form_checkbox(array('checked' => (bool)$row->ENABLE, 'disabled' => '')) . '</td>';
	echo '<td>' . $row->CREATEDATE . '</td>';
	echo '<td style="text-align:center">' . anchor('users/form_edit/'.$row->ID,lang('label_edit')) . action_separator();
	echo anchor('users/delete_user/'.$row->ID,lang('label_delete'), array('class' => 'prevent_delete_jq')) . action_separator();
	echo anchor('acl/form_acl/'.$row->ID . '/2',lang('label_permission')) . '</td>';
	echo '</tr>';
}
?>
	</tbody>
</table>
<?php } ?>
<?php echo anchor('users/form_insert',lang('label_new_user')) ?>
<br />
<br/>
</div>
