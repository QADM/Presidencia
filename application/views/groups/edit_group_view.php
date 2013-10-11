
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
	<h2 class="sge-postheader" ><?php echo lang('label_edit_group') ?></h2>
   <?php if (empty($data)){ ?>
        <div class="message">
            <?php echo lang('msg_empty_data') ?>
        </div>
    <?php }
    else{ ?>
	<?php echo form_open('groups/edit_group', array('id' => 'current_form')) ?>
	<?php echo form_hidden('groupid',$data->ID) ?>
    <?php echo validation_errors(); ?>
    <div class="form-row">
        <div class="form-property required">
	<?php echo form_label("* " . lang('label_name').':', 'groupname') ?>
        </div>
        <div class="form-value">
	<?php echo form_input(array('name' => 'groupname', 'id' => 'groupname', 'class' => 'text', 'value' => $data->NAME)) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row">
    	<div class="form-property required">&nbsp;</div>
        <div class="form-value" >
	
	<?php echo form_checkbox(array('name' => 'enablegroup', 'id' => 'enablegroup', 'value' => 'ON', 'checked' => (bool)$data->ENABLE, 'style' => 'margin:10px;')); ?>
    <?php echo form_label(lang('label_group_enabled'), 'enablegroup'); ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row-submit">
	<?php echo form_submit(array('id' => 'submitgroup', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
	</div>
    
	<?php echo form_close() ?>
        <?php } ?>
</div>	
	