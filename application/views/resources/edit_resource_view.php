
<script language="javascript" src="<?php echo base_url() ?>js/jquery.validate.js"  ></script>


<script type="text/javascript">   
  //validacion de la pagina
/*     $(document).ready(function() {   
       $("#current_form").validate({   
         rules: {   
           resourcename: "required"
		 },
         messages: {   
           resourcename: "<?php echo lang('val_required'); ?>"
         }   
       });   	   
	   
     }); */  
  </script> 
  
 <style>
 	#content{
		width:100%;
		}
 </style>

<div class="content-admin" >
	<h2 class="sge-postheader" ><?php echo lang('label_edit_resource') ?></h2>
  <?php if (empty($data)){ ?>
        <div class="message">
            <?php echo lang('msg_empty_data') ?>
        </div>
    <?php }
    else{ ?>
	<?php echo form_open('resources/edit_resource', array('id' => 'current_form')) ?>
    <?php echo form_hidden('resourceid',$data->ID) ?>
	<?php echo validation_errors(); ?>
    <div class="form-row">
        <div class="form-property required">
	<?php echo form_label("* " . lang('label_name').':', 'resourcename') ?>
        </div>
        <div class="form-value">
	<?php echo form_input(array('name' => 'resourcename', 'id' => 'resourcename', 'class' => 'text', 'value' => $data->RESOURCE)) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row-submit">
	<?php echo form_submit(array('id' => 'submitresource', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
	</div>
    
	<?php echo form_close() ?>
        <?php } ?>
</div>