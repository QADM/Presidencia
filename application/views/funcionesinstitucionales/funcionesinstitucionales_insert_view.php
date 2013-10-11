<script type="text/javascript">
    //validation
    $(function(){        
        $("#current_form").form({
            rules: {
                funcioninstitucional:{
                    required:true,
                    maxlength:100
                }
            },
            messages: {
                funcioninstitucional: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength_1'); ?>"
                }
            },
            action: function(){window.location = '<?php echo base_url() ?>funcionesinstitucionales';}
        });
    });
</script>
<div class="content-form_negocio">

    <h3 style="color: #993300;margin: 0;text-align: center;"><?php echo lang('label_new_funcioninstitucional') ?></h3>
    <img src="../images/separator_form.png" style="margin-bottom: 25px;margin-top: -40px;">

    <?php echo form_open('funcionesinstitucionales/insertFuncionesInstitucionales', array('id' => 'current_form')) ?>
    <?php echo validation_errors(); ?>

    <div class="form_body">
            <div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_funcioninstitucional'), 'funcioninstitucional', array('for' => "funcioninstitucional")) ?>
                </div>
                <?php echo form_input('funcioninstitucional', null, 'id="funcioninstitucional" class="input"'); ?>
            </div>
			<div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_cve_tipofuncion'), 'cve_tipofuncion', array('for' => "cve_tipofuncion")) ?>
                </div>
                <?php echo form_dropdown('cve_tipofuncion', $cve_tipofuncion, '', 'id="cve_tipofuncion"'); ?>
                <input type="hidden" id="cve_tipofuncion_hidden" name="cve_tipofuncion_hidden">
            </div>
			<div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_cve_fundamentonormativa'), 'cve_fundamentonormativa', array('for' => "cve_fundamentonormativa")) ?>
                </div>
                <?php echo form_dropdown('cve_fundamentonormativa', $cve_fundamentonormativa, '', 'id="cve_fundamentonormativa"'); ?>
                <input type="hidden" id="cve_fundamentonormativa_hidden" name="cve_fundamentonormativa_hidden">
            </div>
            
        </div>

        <div class="form_submit">
            <?php echo form_submit('accept', lang('label_button_submit'), 'class="button_submit"') ?>
        </div>

    <?php echo form_close() ?>

</div>



