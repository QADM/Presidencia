
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
                      data: {nick:value,userid:$("#userid").val()},
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
           cellular:"number",
           subsecretary_hidden:"required"
		 },
         messages: {
         	username: "<?php echo lang('val_required'); ?>",
         	email: "<?php echo lang('val_email'); ?>",
           	nick: {
           		required: "<?php echo lang('val_required'); ?>"
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
	<h2 class="sge-postheader" ><?php echo lang('label_edit_user') ?></h2>
        <?php if (empty($data)){ ?>
        <div class="message">
            <?php echo lang('msg_empty_data') ?>
        </div>
        <?php }
        else{ ?>
        <?php echo get_flash_message(); ?>
	<?php echo form_open('users/edit_user', array('id' => 'current_form')) ?>
        <?php echo validation_errors(); ?>
        <input type="hidden" name="userid" id="userid" value="<?php echo $data->ID  ?>" />
        <input type="hidden" name="id_subsecretary_first" id="id_subsecretary_first" value="<?php echo $data->fk_subsecretary  ?>" />
        
        <div class="form-row">
            <div class="form-property required">
            <?php echo form_label("* " . lang('label_name').':', 'username') ?>
            </div>
            <div class="form-value">
            <?php echo form_input(array('name' => 'username', 'id' => 'username', 'size' => '50', 'value' => $data->NAME, 'class' => 'text')) ?>
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
            <div class="form-property">
            <?php echo form_label(lang('label_surname_2').':', 'surname') ?>
            </div>
            <div class="form-value">
            <?php echo form_input(array('name' => 'surname', 'id' => 'surname', 'size' => '50', 'value' => $data->SURNAME, 'class' => 'text')) ?>
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
            <div class="form-property">
            <?php echo form_label(lang('label_email').':', 'email'); ?>
            </div>
            <div class="form-value">
            <?php echo form_input(array('name' => 'email', 'id' => 'email', 'size' => '50', 'value' => $data->EMAIL, 'class' => 'text')); ?>
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
            <div class="form-property required">
            <?php echo form_label("* " . lang('label_nickname').':', 'nick') ?>
            </div>
            <div class="form-value">
            <?php echo form_input(array('name' => 'nick', 'id' => 'nick', 'size' => '50', 'value' => $data->NICKNAME, 'class' => 'text')) ?>
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
            <div class="form-property">&nbsp;</div>
            <div class="form-value" >
            <?php echo anchor('users/form_password/'.$data->ID,lang('label_change_password')) ?>
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
            <div class="form-property">
                    <?php echo form_label(lang('label_cellular').":", 'cellular') ?>
            </div>
            <div class="form-value">
                    <?php echo form_input(array('name' => 'cellular', 'id' => 'cellular', 'class' => 'text', 'value' => $data->CELLULAR)) ?>
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
            <div class="form-property">&nbsp;</div>
            <div class="form-value" >

            <?php echo form_checkbox(array('name' => 'enableuser', 'id' => 'enableuser', 'value' => 'ON', 'checked' => (bool)$data->ENABLE, 'style' => 'margin:10px 10px 10px 0px;')); ?>
            <?php echo form_label(lang('label_user_enabled').':', 'enableuser', array('style' => 'display:inline;')); ?>
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
            <div class="form-property">
                    <?php echo form_label(lang('label_subsecretary'), 'subsecretary', array('for' => "subsecretary")) ?>
            </div>
            <div class="form-value">
                    <?php echo form_dropdown('subsecretary', $subsecretary, $data->fk_subsecretary, 'id="subsecretary"'); ?>
                    <input type="hidden" id="subsecretary_hidden" name="subsecretary_hidden" value="aa">
            </div>
            <div class="clearer">&nbsp;</div>
	</div>
        <div class="form-row">
        <div>    
	
	<?php echo form_fieldset(lang('label_select_user_group'), array('class' => 'fsborder')); ?>
	<?php
            if (!empty($groups)){
		foreach ($groups as $group) {
			
			$check = FALSE;
			$i = 0;
			while (!$check && count($usergroups) > $i ) {
				if ($group['ID'] == $usergroups[$i]->GROUPID){
					$check = TRUE;
				}
				$i++;
			}
			
			echo form_checkbox(array('name' => 'checkgroup[]', 'ID' => 'group'.$group['ID'], 'value' => $group['ID'], 'checked' => $check, 'style' => 'margin:10px;display:inline;'));
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
        <?php } ?>
</div>
	