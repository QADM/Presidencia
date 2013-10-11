<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.validate.js"  ></script>

<script type="text/javascript">
  //validacion de la pagina
     $(document).ready(function() {
       $("#current_form").validate({
         rules: {
           name: "required"
		 },
         messages: {
           name: "<?php echo lang('val_required'); ?>"
         }
       });

       $("#radio_res").change(function(){
            $("#resource").removeAttr("disabled");
            $("#page_res").removeAttr("disabled");
            $("#page_uri").attr("disabled",true);
       });

      $("#radio_url").change(function(){
            $("#resource").attr("disabled", true);
            $("#page_res").attr("disabled", true);
            $("#page_uri").removeAttr("disabled");
       });

       //Initialize radio buttons
       $("#radio_res").attr('checked', true);
       $("#resource").removeAttr("disabled");
       $("#page_res").removeAttr("disabled");
       $("#page_uri").attr("disabled",true);

     });

  </script>

 <style>
    #content{
        width:100%;
    }
   
    .radio_label{
        margin: 3px 5px 5px 0px;
    }
}

 </style>

<div class="content-admin" >
    <h2 class="sge-postheader" ><?php echo lang('label_new_menu') ?></h2>
    <?php echo form_open('menu/insert_menu', array('id' => 'current_form')) ?>
    <div class="form-row">
        <div class="form-property required">
	<?php echo form_label("* " . lang('label_name').':', 'name') ?>
        </div>
        <div class="form-value">
	<?php echo form_input(array('name' => 'name', 'id' => 'name', 'class' => 'text', 'value' => set_value('name'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property">
	<?php echo form_label(lang('label_short_desc').':', 'shortdesc') ?>
        </div>
        <div class="form-value">
	<?php echo form_input(array('name' => 'shortdesc', 'id' => 'shortdesc', 'class' => 'text_long', 'value' => set_value('shortdesc'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
        <div class="form-property">
	<?php echo form_label(lang('label_menu_parent').':', 'parentid') ?>
        </div>
        <div class="form-value">
	<?php echo form_dropdown('parentid',$menus) ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div id="mark">
    <div class="form-row">
        <div class="form-property-radio">
         <?php echo form_radio(array('name' => 'radiourl', 'ID' => 'radio_res', 'value' => '0', 'class' => 'radio_label')); ?>
	<?php echo form_label(lang('label_menu_url_res').':', 'radio_res') ?>
        </div>
        <div class="form-value">
        <?php echo form_dropdown('resource',$resources,'','id="resource"') ?>&nbsp;/&nbsp;
        <?php echo form_input(array('name' => 'page_res', 'id' => 'page_res', 'class' => 'text', 'value' => set_value('page_res'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
        <div class="span"> <?php echo lang('msg_menu_url_resource') ?> </div>
        <div class="clearer">&nbsp;</div>
    </div>

    <div class="form-row">
        <div class="form-property-radio">
        <?php echo form_radio(array('name' => 'radiourl', 'ID' => 'radio_url', 'value' => '1', 'class' => 'radio_label')); ?>
	<?php echo form_label(lang('label_menu_url_std').':', 'radio_url') ?>
        </div>
        <div class="form-value">
	<?php echo form_input(array('name' => 'page_uri', 'id' => 'page_uri', 'class' => 'text_long', 'value' => set_value('page_uri'))) ?>
        </div>
        <div class="clearer">&nbsp;</div>
        <div class="span"><?php echo lang('msg_nemu_url_standard') ?> </div>
        <div class="clearer">&nbsp;</div>
    </div>
    </div>
    <div class="form-row">
        <div class="form-property">
	<?php echo form_label(lang('label_menu_order').':', 'order') ?>
        </div>
        <div class="form-value">
	<?php 
            $ord = array(
                '0' => '0',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10'
            );
            echo form_dropdown('order',$ord, '', 'class="auto"') ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row">
    	<div class="form-property required">&nbsp;</div>
        <div class="form-value" >
	<?php echo form_checkbox(array('name' => 'status', 'id' => 'status', 'value' => 'ON', 'class' => 'margin:10px 10px 10px 0px;')); ?>
	<?php echo form_label(lang('label_menu_enabled'), 'status'); ?>
        </div>
        <div class="clearer">&nbsp;</div>
    </div>
    <div class="form-row-submit">
	<?php echo form_submit(array('id' => 'submit', 'value' => lang('label_button_submit'), 'class' => 'button')) ?>
	</div>
<?php echo form_close(); ?>


</div>
