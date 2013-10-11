<script type="text/javascript">
    //validation
    $(function(){        
        $("#current_form").form({
            rules: {
                nombre:{
                    required:true,
                    maxlength:100
                },
                numeral:{
                    required:true,
                    maxlength:30
                }
            },
            messages: {
                nombre: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength_1'); ?>"
                },
                numeral: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength'); ?>"
                }
            },
            action: function(){window.location = '<?php echo base_url() ?>fundamentosnormativos';}
        });
    });
</script>
<div class="content-form_negocio">

    <h3 style="color: #993300;margin: 0;text-align: center;"><?php echo lang('label_new_fundamentonormativo') ?></h3>
    <img src="../images/separator_form.png" style="margin-bottom: 25px;margin-top: -40px;">

    <?php echo form_open('fundamentosnormativos/insertFundamentosNormativos', array('id' => 'current_form')) ?>
    <?php echo validation_errors(); ?>

    <div class="form_body">
            <div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_nombre'), 'nombre', array('for' => "nombre")) ?>
                </div>
                <?php echo form_input('nombre', null, 'id="nombre" class="input"'); ?>
            </div>
            <div  class="region_edit" style="height: 136px !important;">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_numeral'), 'numeral', array('for' => "numeral")) ?>
                </div>
                <?php echo form_input('numeral', null, 'id="numeral"'); ?>
            </div>
			<div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_cve_tipofundamento'), 'cve_tipofundamento', array('for' => "cve_tipofundamento")) ?>
                </div>
                <?php echo form_dropdown('cve_tipofundamento', $cve_tipofundamento, '', 'id="cve_tipofundamento"'); ?>
                <input type="hidden" id="cve_tipofundamento_hidden" name="cve_tipofundamento_hidden">
            </div>

            
        </div>

        <div class="form_submit">
            <?php echo form_submit('accept', lang('label_button_submit'), 'class="button_submit"') ?>
        </div>

    <?php echo form_close() ?>

</div>



