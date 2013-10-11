
<script type="text/javascript">   
  //validacion de la pagina
     $(document).ready(function() {

         $('#subsecretary').change(function(){
            if($(this).val() == 0)
            {
                $('#subsecretary_hidden').val('');
            }
            else
            {
                $('label[for="subsecretary_hidden"]').html('');
                $('#subsecretary_hidden').val('aa');
            }
        })

        $.validator.addMethod("nickExist", function(value, element) {
                $('img.loading').remove();
                $(element).after('<img class="loading" src="<?php echo base_url() ?>images/ajax-loader.gif" >');
                var valid = $.ajax({
                  type: "POST",
                      url: "<?php echo site_url() ?>/users/nick_exist",
                      data: "nick="+value,
                      async: false
                     }).responseText;
                $('img.loading').remove();
                return (valid != 1)
        }, "<?php echo lang('val_user_exist'); ?>");
     	
     
      $("#current_form").validate({
         invalidHandler: function() {
             $("#nick").rules("remove", "nickExist");
         },
         rules: {   
           username: "required",
           email:"email",
           nick: {
           	required: true
           	},
          password: "required",
          repassword:{
           		required: true,
           		equalTo:'#password'
           	},
           cellular:"number",
           subsecretary_hidden:"required"
		 },
         messages: {   
         	username: "<?php echo lang('val_required'); ?>",
         	email: "<?php echo lang('val_email'); ?>",
           	nick: {
           		required: "<?php echo lang('val_required'); ?>"
       		},
           	password: "<?php echo lang('val_required'); ?>",
           	repassword:{
           		required: "<?php echo lang('val_required'); ?>",
           		equalTo: "<?php echo lang('val_pwd_matches'); ?>"
           	},
                cellular: "<?php echo lang('val_phone'); ?>",
                subsecretary_hidden: "<?php echo lang('val_required'); ?>"
         }   
       });

        $("#submituser").click(function(ev){
            $("#nick").rules("add", "nickExist");
        });
	   
     });   
 </script> 
 
 <style>
 	#content{
		width:100%;
		}
	fieldset{
		width: 310px;
		}
 </style>

<div class="content-admin" >
	<h2 class="sge-postheader" ><?php echo lang('label_new_user') ?></h2>
	<?php echo form_open('users/insert_user', array('id' => 'current_form')) ?>
        <?php echo validation_errors(); ?>
        
    <div class="form-row">
        <div class="form-property required">
        <?php echo form_label("* " . lang('label_name').":", 'username') ?>
        </div>
        <div class="form-value">
        <?php echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'text', 'value' => set_value('username'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row">
        <div class="form-property">
		<?php echo form_label(lang('label_surname_2').":", 'surname') ?>
        </div>
        <div class="form-value">
		<?php echo form_input(array('name' => 'surname', 'id' => 'surname', 'class' => 'text', 'value' => set_value('surname'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row">
        <div class="form-property">
		<?php echo form_label(lang('label_email').":", 'email'); ?>
        </div>
        <div class="form-value">
		<?php echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'text', 'value' => set_value('email'))); ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row">
        <div class="form-property required">
		<?php echo form_label("* " . lang('label_nickname').":", 'nick') ?>
        </div>
        <div class="form-value">
		<?php echo form_input(array('name' => 'nick', 'id' => 'nick', 'class' => 'text', 'value' => set_value('nick'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
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
    <div class="form-row">
        <div class="form-property">
		<?php echo form_label(lang('label_cellular').":", 'cellular') ?>
        </div>
        <div class="form-value">
		<?php echo form_input(array('name' => 'cellular', 'id' => 'cellular', 'class' => 'text', 'value' => set_value('cellular'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>

    	<div class="form-property">&nbsp;</div>
        <div class="form-value" >
        <?php echo form_checkbox(array('name' => 'enableuser', 'id' => 'enableuser', 'value' => 'ON', 'style' => 'margin:10px 10px 10px 0px;')); ?>
		<?php echo form_label(lang('label_user_enabled'), 'enableuser'); ?>
        </div>
        <div class="clearer">&nbsp;</div>
        <div class="form-row">
            <div class="form-property">
                    <?php echo form_label(lang('label_subsecretary'), 'subsecretary', array('for' => "subsecretary")) ?>
            </div>
            <div class="form-value">
                    <?php echo form_dropdown('subsecretary', $subsecretary, '', 'id="subsecretary"'); ?>
                    <input type="hidden" id="subsecretary_hidden" name="subsecretary_hidden">
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row">
        <div >
		<?php echo form_fieldset(lang('label_select_user_group'), array('class' => 'fsborder')); ?>
        <?php
        if (!empty($groups)){
            foreach ($groups as $group) {
                echo form_checkbox(array('name' => 'checkgroup[]', 'ID' => 'group'.$group['ID'], 'value' => $group['ID'], 'style' => 'margin:10px;display:inline;'));
                echo form_label($group['NAME'], 'group'.$group['ID'], array('style' => 'display:inline;'));
                echo '<br>';
    
            }
        }
        else{
            ?>
            <div class="message"><?php echo lang('msg_groups_empty') ?></div>
        <?php
        }
         ?>	
        <?php echo form_fieldset_close();  ?>
        </div>
		<div class="clearer">&nbsp;</div>
	</div>
    <div class="form-row-submit">
        <?php echo form_submit(array('id' => 'submituser', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
	</div>
	
	<?php echo form_close() ?>
</div>
	