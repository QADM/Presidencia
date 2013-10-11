<script type="text/javascript">
    //validation
    $(function(){
        $("#current_form").form({
            rules: {
                code:{
                    required:true,
                    minlength:1,
                    maxlength:1,
                    number:true
                },
                description:{
                    required:true,
                    maxlength:100
                }
            },
            messages: {
                code: {
                    required:"<?php echo lang('val_required'); ?>",
                    minlength:"<?php echo lang('minLength_1'); ?>",
                    maxlength:"<?php echo lang('maxLength_1'); ?>",
                    number:"<?php echo lang('val_number'); ?>"
                },
                description: {
                    required:"<?php echo lang('val_required'); ?>",
                    maxlength:"<?php echo lang('maxLength'); ?>"
                }
            },
            action: function(){window.location = '<?php echo base_url() ?>rector_axis';}
        });
    });
</script>
<div class="content-form_negocio">

    <h3 style="color: #993300;margin: 0;text-align: center;"><?php echo lang('label_edit_rector_axis') ?></h3>
    <img src="../../images/separator_form.png" style="margin-bottom: 25px;margin-top: -40px;">

    <?php echo form_open('rector_axis/editRectorAxis', array('id' => 'current_form')) ?>
    <?php echo validation_errors(); ?>
    <input type="hidden" name="id_rector_axis" id="id_rector_axis" value="<?php echo $rector_axis->id_rector_axis  ?>" />

    <div class="form_body">
        <div  class="region_edit">
            <div  class="region_edit_label">
                 <?php echo form_label(lang('label_code'), 'code', array('for' => "code")) ?>
            </div>
            <?php echo form_input('code', $rector_axis->code, 'id="code" class="input"'); ?>
        </div>
        <div  class="region_edit" style="height: 136px !important;">
            <div  class="region_edit_label">
                <?php echo form_label(lang('label_description'), 'description', array('for' => "description")) ?>
            </div>
            <?php echo form_textarea('description', $rector_axis->description, 'id="description"'); ?>
        </div>

    </div>

    <div class="form_submit">
        <?php echo form_submit('accept', lang('label_button_submit'), 'class="button_submit"') ?>
    </div>

    <?php echo form_close() ?>

</div>



