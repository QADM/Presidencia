<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Módulo de Programación.</title>

        <link href="<?php echo base_url() ?>css/style_login.css" rel="stylesheet" type="text/css" media="all" />

        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery-1.8.1.min.js"  ></script>

        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.validate.js"  ></script>

        <script type="text/javascript">
            $(function(){

                $('#cicle').change(function(){
                    if($(this).val() == 0)
                    {
                        $('#cicle_hidden').val('');
                    }
                    else
                    {
                        $('label[for="cicle_hidden"]').html('');
                        $('#cicle_hidden').val('aa');
                    }
                })
                
                $("#form_authentication").validate({
                    rules: {
                        nick:'required',
                        password:'required',
                        cicle_hidden:'required'
                    },
                    messages: {
                        nick:"<?php echo lang('val_required'); ?>",
                        password:"<?php echo lang('val_required'); ?>",
                        cicle_hidden:"<?php echo lang('val_required'); ?>"
                    }
                });
            })
        </script>

    </head>

    <body>

        <div id="login">
            <div class="content-login" >
                <div class="form-admin" >
                    <?php echo form_open('admin/login', array('id' => 'form_authentication')); ?>
                    <div class="div_field_login">
                        <?php echo form_label(lang('label_user_login') . ":", 'nick'); ?>
                        <?php echo form_input(array('name' => 'nick', 'id' => 'nick')); ?>
                    </div>
                    <div class="div_field_login">
                        <?php echo form_label(lang('label_password_login') . ":", 'password'); ?>
                        <?php echo form_password(array('name' => 'password', 'id' => 'password')); ?>
                    </div>
                    <div class="div_field_login">
                        <?php echo form_label(lang('label_cicle_login') . ":", 'cicle'); ?>
                        <?php echo form_dropdown('cicle', $cicle, '', 'id="cicle" name="cicle"'); ?>
                        <input type="hidden" name="cicle_hidden" id="cicle_hidden">
                    </div>
                    <div style="float: right; width: 100%; margin-top: 10px;">
                        <?php echo form_submit(array('id' => 'submituser', 'value' => lang('label_button_login'), 'class' => 'button_login')); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </body>
</html>



