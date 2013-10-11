
<div class="content-admin" >

<h2 class="sge-postheader" ><?php echo lang('label_resources'); ?></h2>
<?php echo get_flash_message(); ?>

<?php echo anchor('resources/form_insert',lang('label_new_resource')) ?>

<?php if (empty($rows)){ ?>
<div class="message">
<?php echo lang('msg_empty_data') ?>
</div>
<?php }
else{ ?>
<table class="data-table" >
	<thead>
		<tr>
			<th><?php echo lang('label_id') ?></th>
			<th><?php echo lang('label_name') ?></th>
			<th style="text-align:center" ><?php echo lang('label_actions') ?></th>
		</tr>
	</thead>
	<tbody>
<?php 
$i = 0;
foreach ($rows as $row){
	$class = ($i % 2 == 0)?'class="even"':'class="odd"';
	$i++;
	echo '<tr '. $class . '>';
	echo '<td>' . $row->ID . '</td>';
	echo '<td>' . $row->RESOURCE . '</td>';
	echo '<td style="text-align:center" >' . anchor('resources/form_edit/'.$row->ID,lang('label_edit')) . action_separator();
	echo anchor('resources/delete_resource/'.$row->ID,lang('label_delete'), array('class' => 'prevent_delete_jq')) . '</td>';
	echo '</tr>';
}
?>
	</tbody>
</table>
<?php } ?>

<?php echo anchor('resources/form_insert',lang('label_new_resource')) ?>

<br />
<br/>
</div>
