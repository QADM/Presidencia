<div class="content-admin" >

<h2 class="sge-postheader" ><?php echo lang('label_acl_title') . "&nbsp;" . $title ?></h2>

<?php echo form_open('acl/edit_acl') ?>

<?php echo form_hidden('targetid',$targetid) ?>
<?php echo form_hidden('targettype',$targettype) ?>

<?php echo get_flash_message(); ?>

<?php if (empty($rows)){ ?>
<div class="message">
<?php echo lang('msg_empty_data') ?>
</div>
<?php }
else{ ?>
<table class="data-table" >
	<thead>
		<tr>
			<th><?php echo lang('label_resource'); ?></th>
			<th style="text-align:center" ><?php echo lang('label_acl_read'); ?></th>
			<th style="text-align:center" ><?php echo lang('label_acl_insert'); ?></th>
			<th style="text-align:center" ><?php echo lang('label_acl_update'); ?></th>
			<th style="text-align:center" ><?php echo lang('label_acl_delete'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php 
$i = 0;
foreach ($rows as $row){

	//if is an user
	$r_name = 'R[]';	$i_name = 'I[]';	$u_name = 'U[]';	$d_name = 'D[]';
	$r_disable = '';	$i_disable = '';	$u_disable = '';	$d_disable = ''; 
	if ($targettype == 2){
		if ($row->R_G == 1 ) { $r_name = 'R';	$r_disable = 'disabled';}
		if ($row->I_G == 1 ) { $i_name = 'I';	$i_disable = 'disabled';}
		if ($row->U_G == 1 ) { $u_name = 'U';	$u_disable = 'disabled';}
		if ($row->D_G == 1 ) { $d_name = 'D';	$d_disable = 'disabled';}
	}
	
	$class = ($i % 2 == 0)?'class="even"':'class="odd"';
	$i++;
	
	echo '<tr '. $class .' >';
	echo '<td>' . form_hidden('id[]',$row->RESOURCEID) . $row->RESOURCE . '</td>';
	echo '<td style="text-align:center" >' . form_checkbox(array('name' => $r_name, 'id' => 'R'.$row->ID, 'value' => $row->ID,'checked' => (bool)$row->R, $r_disable =>'')) . '</td>';
	echo '<td style="text-align:center" >' . form_checkbox(array('name' => $i_name, 'id' => 'I'.$row->ID, 'value' => $row->ID,'checked' => (bool)$row->I, $i_disable =>'')) . '</td>';
	echo '<td style="text-align:center" >' . form_checkbox(array('name' => $u_name, 'id' => 'U'.$row->ID, 'value' => $row->ID,'checked' => (bool)$row->U, $u_disable =>'')) . '</td>';
	echo '<td style="text-align:center" >' . form_checkbox(array('name' => $d_name, 'id' => 'D'.$row->ID, 'value' => $row->ID,'checked' => (bool)$row->D, $d_disable =>'')) . '</td>';
	echo '</tr>';
}
?>
	</tbody>
</table>
<?php } ?>

<div class="form-row-submit">
<?php echo form_submit(array('id' => 'submitgroup', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
</div>

<?php echo form_close() ?>

</div>

