
<script type="text/javascript">   
  //validacion de la pagina
     $(document).ready(function() {   
       $("#current_form").validate({   
         rules: {   
           groupname: "required"
		 },
         messages: {   
           groupname: "<?php echo lang('val_required'); ?>"
         }   
       });   	   
	   
     });   
  </script> 

 <style>
 	#content{
		width:100%;
		}
 </style>

<div class="content-admin" >
	<h2 class="sge-postheader" ><?php echo lang('label_new_group') ?></h2>
	<?php echo form_open('groups/insert_group', array('id' => 'current_form')) ?>
	<?php echo validation_errors(); ?>
    <div class="form-row">
        <div class="form-property required">
	<?php echo form_label("* " . lang('label_name').':', 'groupname') ?>
        </div>
        <div class="form-value">
	<?php echo form_input(array('name' => 'groupname', 'id' => 'groupname', 'class' => 'text', 'value' => set_value('groupname'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
    	<div class="form-property required">&nbsp;</div>
        <div class="form-value" >
	<?php echo form_checkbox(array('name' => 'enablegroup', 'id' => 'enablegroup', 'value' => 'ON', 'style' => 'margin:10px 10px 10px 0px;')); ?>
	<?php echo form_label(lang('label_group_enabled'), 'enablegroup'); ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row-submit">
	<?php echo form_submit(array('id' => 'submitgroup', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
	</div>
    
	<?php echo form_close() ?>
</div>
	