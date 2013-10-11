
<script language="javascript" src="<?php echo base_url() ?>js/jquery.validate.js"  ></script>


<script type="text/javascript">   
  //validacion de la pagina
     $(document).ready(function() {   
       $("#current_form").validate({   
         rules: {   
           resourcename: "required"
		 },
         messages: {   
           resourcename: "<?php echo lang('val_required'); ?>"
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
	<h2 class="sge-postheader" ><?php echo lang('label_new_resource') ?></h2>
	<?php echo form_open('resources/insert_resource', array('id' => 'current_form')) ?>
	<?php echo validation_errors(); ?>
    <div class="form-row">
        <div class="form-property required">
	<?php echo form_label("* " . lang('label_name').':', 'resourcename') ?>
        </div>
        <div class="form-value">
	<?php echo form_input(array('name' => 'resourcename', 'id' => 'resourcename', 'class' => 'text', 'value' => set_value('resourcename'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row-submit">
	<?php echo form_submit(array('id' => 'submitresource', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
	</div>
    
	<?php echo form_close() ?>
</div>
	
	