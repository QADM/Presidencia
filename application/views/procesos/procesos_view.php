<script type="text/javascript">
    function clickOptions()
    {
        $('.ui-delete').click(function(){
            id = $(this).attr('cve_proceso');
            $.app.messages.info('<?php echo lang('msg_conf_delete'); ?>', function(){
                $.post('<?php echo base_url() ?>procesos/deleteProcesos', {'id':id}, function(response){
                    response = $.secureEvalJSON(response);
                    if(response.success)
                    {
                         $.app.messages.info('<?php echo lang('msg_delete'); ?>');
                         $("#table_proceso").trigger("reloadGrid");
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
        edit = '<a class="ui-edit" href="<?php echo base_url() ?>procesos/edit/'+ options.RowId + '" style="cursor:pointer" cve_proceso="'+ options.RowId + '" title="<?php echo lang('edit_grid'); ?> ' + rowObject.cve_proceso +'"/></a>';
        remove = '<a class="ui-delete" style="cursor:pointer" cve_proceso="'+ options.RowId + '" title="<?php echo lang('delete_grid'); ?> ' + rowObject.cve_proceso +'"/></a>';
        return remove+edit;
    }
    
    $(function(){
        $("#table_proceso").grid('destroy');
        $("#table_proceso").grid({
            url:'<?php echo base_url() ?>procesos/getProcesos',
            colNames:['','<?php echo lang('label_proceso'); ?>','<?php echo lang('label_objetivoproceso'); ?>','<?php echo lang('label_instrumentojuridico'); ?>','<?php echo lang('label_codigoproceso'); ?>','<?php echo lang('option_grid'); ?>'],
            colModel:[
                {name:'cve_proceso',index:'cve_proceso',width:30,align:"left",hidden:true},
                {name:'proceso',index:'proceso',width:40,align:"left"},
                {name:'objetivoproceso',index:'objetivoproceso',width:40,align:"left"},
				{name:'instrumentojuridico',index:'instrumentojuridico',width:40,align:"left"},
				{name:'codigoproceso',index:'codigoproceso',width:40,align:"left"},
                {name:'options',index:'options',width:40,align:"left",formatter:options}],
            pager: '#pager_proceso',
            sortname:'cve_proceso',
            rowNum:10,
            caption:'<?php echo lang('caption_grid_proceso'); ?>',
            gridComplete:clickOptions,
            jsonReader: {
                repeatitems : false,
                cve_proceso: 'cve_proceso'
            }
        });
    });
</script>
<div class="content-admin" >
    <div style="height: 43px;margin-top: 11px;">
        <a href="<?php echo base_url() ?>procesos/insert">
            <img width="18" style="margin-bottom: -3px;" src="<?php echo base_url()?>/images/icons/add.png"> Insertar Proceso
        </a>
    </div>
    <table id="table_proceso"></table>
    <div id="pager_proceso"></div>
</div>
