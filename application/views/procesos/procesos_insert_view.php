<script type="text/javascript">
    //validation
    $(function(){        
        $("#current_form").form({
            rules: {
                proceso:{
                    required:true,
                    maxlength:100
                },
                objetivoproceso:{
                    required:true,
                    maxlength:30
                },
				 instrumentojuridico:{
                    required:true,
                    maxlength:100
                },
                codigoproceso:{
                    required:true,
                    maxlength:30
                }
            },
            messages: {
                proceso: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength_1'); ?>"
                },
                objetivoproceso: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength'); ?>"
					
                },
				  instrumentojuridico: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength_1'); ?>"
                },
                codigoproceso: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength'); ?>"
					
                }
            },
            action: function(){window.location = '<?php echo base_url() ?>procesos';}
        });
    });
</script>
<div class="content-form_negocio">

    <h3 style="color: #993300;margin: 0;text-align: center;"><?php echo lang('label_new_proceso') ?></h3>
    <img src="../images/separator_form.png" style="margin-bottom: 25px;margin-top: -40px;">

    <?php echo form_open('procesos/insertProcesos', array('id' => 'current_form')) ?>
    <?php echo validation_errors(); ?>

    <div class="form_body">
            <div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_proceso'), 'proceso', array('for' => "proceso")) ?>
                </div>
                <?php echo form_input('proceso', null, 'id="proceso" class="input"'); ?>
            </div>
            <div  class="region_edit" style="height: 136px !important;">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_objetivoproceso'), 'objetivoproceso', array('for' => "objetivoproceso")) ?>
                </div>
                <?php echo form_input('objetivoproceso', null, 'id="objetivoproceso"'); ?>
            </div>
             <div  class="region_edit" style="height: 136px !important;">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_instrumentojuridico'), 'instrumentojuridico', array('for' => "instrumentojuridico")) ?>
                </div>
                <?php echo form_input('instrumentojuridico', null, 'id="instrumentojuridico"'); ?>
            </div>
			 <div  class="region_edit" style="height: 136px !important;">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_codigoproceso'), 'codigoproceso', array('for' => "codigoproceso")) ?>
                </div>
                <?php echo form_input('codigoproceso', null, 'id="codigoproceso"'); ?>
            </div>
			<div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_cve_tipoproceso'), 'tipoproceso', array('for' => "label_cve_tipoproceso")) ?>
                </div>
                <?php echo form_dropdown('label_cve_tipoproceso', $modalidad, '', 'id="label_cve_tipoproceso"'); ?>
                <input type="hidden" id="cve_proceso_hidden" name="cve_proceso_hidden">
            </div>
			<div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_cve_macroproceso'), 'macroproceso', array('for' => "label_cve_macroproceso")) ?>
                </div>
                <?php echo form_dropdown('label_cve_macrorproceso', $modalidad, '', 'id="label_cve_macroproceso"'); ?>
                <input type="hidden" id="cve_proceso_hidden" name="cve_proceso_hidden">
            </div>
			<div  class="region_edit">
                <div  class="region_edit_label">
                    <?php echo form_label(lang('label_cve_funcioninstitucional'), 'funcioninstitucional', array('for' => "label_cve_funcioninstitucional")) ?>
                </div>
                <?php echo form_dropdown('label_cve_funcioninstitucional', $modalidad, '', 'id="label_cve_funcioninstitucional"'); ?>
                <input type="hidden" id="cve_proceso_hidden" name="cve_proceso_hidden">
            </div>
        </div>

        <div class="form_submit">
            <?php echo form_submit('accept', lang('label_button_submit'), 'class="button_submit"') ?>
        </div>

    <?php echo form_close() ?>

</div>



