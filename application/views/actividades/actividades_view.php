<script type="text/javascript">
    function clickOptions()
    {
        $('.ui-delete').click(function(){
            id = $(this).attr('cve_actividad');
            $.app.messages.info('<?php echo lang('msg_conf_delete'); ?>', function(){
                $.post('<?php echo base_url() ?>actividades/deleteActividades', {'id':id}, function(response){
                    response = $.secureEvalJSON(response);
                    if(response.success)
                    {
                         $.app.messages.info('<?php echo lang('msg_delete'); ?>');
                         $("#table_actividades").trigger("reloadGrid");
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
        edit = '<a class="ui-edit" href="<?php echo base_url() ?>actividades/edit/'+ options.RowId + '" style="cursor:pointer" cve_actividad="'+ options.RowId + '" title="<?php echo lang('edit_grid'); ?> ' + rowObject.cve_actividad +'"/></a>';
        remove = '<a class="ui-delete" style="cursor:pointer" cve_actividad="'+ options.RowId + '" title="<?php echo lang('delete_grid'); ?> ' + rowObject.cve_actividad +'"/></a>';
        return remove+edit;
    }
    
    $(function(){
        $("#table_actividades").grid('destroy');
        $("#table_actividades").grid({
            url:'<?php echo base_url() ?>actividades/getActividades',
            colNames:['','<?php echo lang('label_actividad'); ?>','<?php echo lang('label_codigoactividad'); ?>','<?php echo lang('option_grid'); ?>'],
            colModel:[
                {name:'cve_actividad',index:'cve_actividad',width:30,align:"left",hidden:true},
                {name:'actividad',index:'actividad',width:40,align:"left"},
                {name:'codigoactividad',index:'codigoactividad',width:40,align:"left"},
                {name:'options',index:'options',width:40,align:"left",formatter:options}],
            pager: '#pager_actividad',
            sortname:'cve_actividad',
            rowNum:10,
            caption:'<?php echo lang('caption_grid_actividad'); ?>',
            gridComplete:clickOptions,
            jsonReader: {
                repeatitems : false,
                cve_actividad: 'cve_actividad'
            }
        });
    });
</script>
<div class="content-admin" >
    <div style="height: 43px;margin-top: 11px;">
        <a href="<?php echo base_url() ?>actividades/insert">
            <img width="18" style="margin-bottom: -3px;" src="<?php echo base_url()?>/images/icons/add.png"> Insertar Actividad
        </a>
    </div>
    <table id="table_actividades"></table>
    <div id="pager_actividad"></div>
</div>
