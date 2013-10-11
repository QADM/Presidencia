<script type="text/javascript">
    //validation
    $(function(){        
        $("#current_form").form({
            rules: {
                macroproceso:{
                    required:true,
                    maxlength:100
                },
                codigomacroproceso:{
                    required:true,
                    maxlength:30
                }
            },
            messages: {
                macroproceso: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength_1'); ?>"
                },
                codigomacroproceso: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength'); ?>"
                }
            },
            action: function(){window.location = '<?php echo base_url() ?>macroprocesos';}
        });
    });
</script>
<div class="content-form_negocio">

    <h3 style="color: #993300;margin: 0;text-align: center;"><?php echo lang('label_new_macroproceso') ?></h3>
    <img src="../images/separator_form.png" style="margin-bottom: 25px;margin-top: -40px;">

    <?php echo form_open('macroprocesos/insertMacroProcesos', array('id' => 'current_form')) ?>
    <?php echo validation_errors(); ?>

    <div class="form_body">
            <div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_macroproceso'), 'macroproceso', array('for' => "macroproceso")) ?>
                </div>
                <?php echo form_input('macroproceso', null, 'id="macroproceso" class="input"'); ?>
            </div>
            <div  class="region_edit" style="height: 136px !important;">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_codigomacroproceso'), 'codigomacroproceso', array('for' => "codigomacroproceso")) ?>
                </div>
                <?php echo form_input('codigomacroproceso', null, 'id="codigomacroproceso"'); ?>
            </div>
            
        </div>

        <div class="form_submit">
            <?php echo form_submit('accept', lang('label_button_submit'), 'class="button_submit"') ?>
        </div>

    <?php echo form_close() ?>

</div>



