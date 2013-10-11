
<script language="javascript" src="<?php echo base_url() ?>js/jquery.validate.js"  ></script>

<script type="text/javascript">   
  //validacion de la pagina
     $(document).ready(function() {   
     $("#current_form").validate({   
         rules: {   
           password: "required",
           repassword:{
           		required: true,
           		equalTo:'#password'
           	}
		 },
         messages: {   
           	password: "<?php echo lang('val_required'); ?>",
           	repassword:{
           		required: "<?php echo lang('val_required'); ?>",
           		equalTo: "<?php echo lang('val_pwd_matches'); ?>"
           	} 
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
	<h2 class="sge-postheader" ><?php echo lang('label_change_password') ?></h2>
	<?php echo form_open($submitdata, array('id' => 'current_form')) ?>
    <?php echo validation_errors(); ?>
	<?php echo form_hidden('userid',$id) ?>
    <div class="form-row">
        <div class="form-property required">
	<?php echo form_label("* " . lang('label_password').":", 'password'); ?>
        </div>
        <div class="form-value">
	<?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'text')); ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row">
        <div class="form-property required">
	<?php echo form_label("* " . lang('label_repassword').":", 'repassword'); ?>
        </div>
        <div class="form-value">
	<?php echo form_password(array('name' => 'repassword', 'id' => 'repassword', 'class' => 'text')); ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row-submit">
	<?php echo form_submit(array('id' => 'submituser', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
	</div>
	<?php echo form_close() ?>
</div>