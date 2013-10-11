<link href="<?php echo base_url()?>css/fileinput.css" rel="stylesheet" type="text/css" media="all" />

<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.fileinput.min.js"  ></script>
<script type="text/javascript" >
    $(document).ready(function(){
        $("#userfile").fileinput({
            buttonText: "<?php echo lang('label_button_filter') ?>"
        });
    })
	

    </script>


<style>
    #content{
            width:100%;
            }
 </style>

<div class="content-admin" >
    <h2 class="sge-postheader" ><?php echo lang('label_user_profile') ?></h2>
    <?php if (empty($user)){ ?>
        <div class="message">
            <?php echo lang('msg_user_profile_empty') ?>
        </div>
    <?php }
    else{ ?>
    <?php echo get_flash_message(); ?>
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_id').':') ?>
        </div>
        <div class="form-value">
            <span><?php echo $user->ID ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_nickname').':') ?>
        </div>
        <div class="form-value">
	<span><?php echo $user->NICKNAME ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_name').':') ?>
        </div>
        <div class="form-value">
	<span><?php echo $user->NAME ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_surname_2').':') ?>
        </div>
        <div class="form-value">
	<span><?php echo $user->SURNAME ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div> 
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_email').':') ?>
        </div>
        <div class="form-value">
	<span><?php echo $user->EMAIL ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_cellular').':') ?>
        </div>
        <div class="form-value">
	<span><?php echo $user->CELLULAR ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_department').':') ?>
        </div>
        <div class="form-value">
	<span><?php echo $user->DEPARTMENT ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property-left">
	<?php echo form_label(lang('label_creation_date').':') ?>
        </div>
        <div class="form-value">
	<span><?php echo date_f($user->CREATEDATE) ?></span>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div id="mark_upload" >
        <?php echo form_open_multipart('user_profile/sign_upload');?>
        <div class="form-row">
            <div class="form-property-upload">
            <?php echo form_label(lang('label_user_sign').':') ?>
            </div>
            <div class="form-value">
                <input type="file" name="userfile" id="userfile" />
            </div>
            <div class="clearer">&nbsp;</div>
        </div>
        <div class="clearer">&nbsp;</div>
        <div class="span">
            <p>* Las dimensiones ideales para la imagen de la firma son 170x40 pixels.</p>
            <p>* No se permitirá subir una imagen de más de 512x512 o de 50 Kb.</p>
            <p>* Las extensiones permitidas son: jpeg, png, gif.</p>
        </div>
        <div class="clearer">&nbsp;</div>
        <div class="form-row-submit-upload">
            <div style="float:left">
                <?php echo form_submit(array('id' => 'submituser', 'value' => lang('label_button_upload'), 'class' => 'button')) ?>
            </div>
            <div style="float:right;;margin-right: 16px">
                <?php echo anchor('user_profile/delete_sign','Eliminar imagen')?>
            </div>

        </div>
        <?php echo form_close() ?>
    </div>
    <div id="mark_upload_image">
        <?php echo img(array('src' => $usersign, 'width' => '170px', 'height' => '40px', 'style' => 'margin: 80px 0 0;')) ?>
    </div>
    <div class="clearer">&nbsp;</div>
    <div class="form-row">
        <div class="form-value" >
	<?php echo anchor('user_profile/form_password/',lang('label_change_password')) ?>
        </div>
        <div class="clearer">&nbsp;</div>
	</div>
<?php } ?>
</div>


