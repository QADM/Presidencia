<script type="text/javascript">
    function clickOptions()
    {
        $('.ui-delete').click(function(){
            id = $(this).attr('cve_funcioninstitucional');
            $.app.messages.info('<?php echo lang('msg_conf_delete'); ?>', function(){
                $.post('<?php echo base_url() ?>funcionesinstitucionales/deleteFuncionesInstitucionales', {'id':id}, function(response){
                    response = $.secureEvalJSON(response);
                    if(response.success)
                    {
                         $.app.messages.info('<?php echo lang('msg_delete'); ?>');
                         $("#table_funcioninstitucional").trigger("reloadGrid");
                    }
                    else
                    {
                        $.app.messages.info('<?php echo lang('msg_asociate_plan_state'); ?>');
                    }
                })
            });
        })
    }
    
    function options(cellvalue, options, rowObject)
    {
        edit = '<a class="ui-edit" href="<?php echo base_url() ?>funcionesinstitucionales/edit/'+ options.RowId + '" style="cursor:pointer" cve_funcioninstitucional="'+ options.RowId + '" title="<?php echo lang('edit_grid'); ?> ' + rowObject.cve_funcioninstitucional +'"/></a>';
        remove = '<a class="ui-delete" style="cursor:pointer" cve_funcioninstitucional="'+ options.RowId + '" title="<?php echo lang('delete_grid'); ?> ' + rowObject.cve_funcioninstitucional +'"/></a>';
        return remove+edit;
    }
    
    $(function(){
        $("#table_funcioninstitucional").grid('destroy');
        $("#table_funcioninstitucional").grid({
            url:'<?php echo base_url() ?>funcionesinstitucionales/getFuncionesInstitucionales',
            colNames:['','<?php echo lang('label_funcioninstitucional'); ?>','<?php echo lang('option_grid'); ?>'],
            colModel:[
                {name:'cve_funcioninstitucional',index:'cve_funcioninstitucional',width:30,align:"left",hidden:true},
                {name:'funcioninstitucional',index:'funcioninstitucional',width:40,align:"left"},
                {name:'options',index:'options',width:40,align:"left",formatter:options}],
            pager: '#pager_funcioninstitucional',
            sortname:'cve_funcioninstitucional',
            rowNum:10,
            caption:'<?php echo lang('caption_grid_funcioninstitucional'); ?>',
            gridComplete:clickOptions,
            jsonReader: {
                repeatitems : false,
                cve_funcioninstitucional: 'cve_funcioninstitucional'
            }
        });
    });
</script>
<div class="content-admin" >
    <div style="height: 43px;margin-top: 11px;">
        <a href="<?php echo base_url() ?>funcionesinstitucionales/insert">
            <img width="18" style="margin-bottom: -3px;" src="<?php echo base_url()?>/images/icons/add.png"> Insertar Funcion Institucional
        </a>
    </div>
    <table id="table_funcioninstitucional"></table>
    <div id="pager_funcioninstitucional"></div>
</div>
