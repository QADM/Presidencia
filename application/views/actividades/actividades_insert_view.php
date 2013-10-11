<script type="text/javascript">
    //validation
    $(function(){        
        $("#current_form").form({
            rules: {
                actividad:{
                    required:true,
                    maxlength:100
                },
                codigoactividad:{
                    required:true,
                    maxlength:30
                }
            },
            messages: {
                actividad: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength_1'); ?>"
                },
                codigoactividad: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength'); ?>"
                }
            },
            action: function(){window.location = '<?php echo base_url() ?>actividades';}
        });
    });
</script>
<div class="content-form_negocio">

    <h3 style="color: #993300;margin: 0;text-align: center;"><?php echo lang('label_new_actividad') ?></h3>
    <img src="../images/separator_form.png" style="margin-bottom: 25px;margin-top: -40px;">

    <?php echo form_open('actividades/insertActividades', array('id' => 'current_form')) ?>
    <?php echo validation_errors(); ?>

    <div class="form_body">
            <div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_actividad'), 'actividad', array('for' => "actividad")) ?>
                </div>
                <?php echo form_input('actividad', null, 'id="actividad" class="input"'); ?>
            </div>
            <div  class="region_edit" style="height: 136px !important;">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_codigoactividad'), 'codigoactividad', array('for' => "codigoactividad")) ?>
                </div>
                <?php echo form_input('codigoactividad', null, 'id="codigoactividad"'); ?>
            </div>
			<div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_cve_proceso'), 'Cve_proceso', array('for' => "label_cve_proceso")) ?>
                </div>
                <?php echo form_dropdown('label_cve_proceso', $Cve_proceso, '', 'id="label_cve_proceso"'); ?>
                <input type="hidden" id="cve_proceso_hidden" name="cve_proceso_hidden">
            </div>

            
        </div>
		


        <div class="form_submit">
            <?php echo form_submit('accept', lang('label_button_submit'), 'class="button_submit"') ?>
        </div>

    <?php echo form_close() ?>

</div>



