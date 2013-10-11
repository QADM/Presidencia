<script type="text/javascript">
    function clickOptions()
    {
        $('.ui-delete').click(function(){
            id = $(this).attr('cve_macroproceso');
            $.app.messages.info('<?php echo lang('msg_conf_delete'); ?>', function(){
                $.post('<?php echo base_url() ?>macroprocesos/deleteMacroProcesos', {'id':id}, function(response){
                    response = $.secureEvalJSON(response);
                    if(response.success)
                    {
                         $.app.messages.info('<?php echo lang('msg_delete'); ?>');
                         $("#table_macroproceso").trigger("reloadGrid");
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
        edit = '<a class="ui-edit" href="<?php echo base_url() ?>macroprocesos/edit/'+ options.RowId + '" style="cursor:pointer" cve_macroproceso="'+ options.RowId + '" title="<?php echo lang('edit_grid'); ?> ' + rowObject.cve_macroproceso +'"/></a>';
        remove = '<a class="ui-delete" style="cursor:pointer" cve_macroproceso="'+ options.RowId + '" title="<?php echo lang('delete_grid'); ?> ' + rowObject.cve_macroproceso +'"/></a>';
        return remove+edit;
    }
    
    $(function(){
        $("#table_macroproceso").grid('destroy');
        $("#table_macroproceso").grid({
            url:'<?php echo base_url() ?>macroprocesos/getMacroProcesos',
            colNames:['','<?php echo lang('label_macroproceso'); ?>','<?php echo lang('label_codigomacroproceso'); ?>','<?php echo lang('option_grid'); ?>'],
            colModel:[
                {name:'cve_macroproceso',index:'cve_macroproceso',width:30,align:"left",hidden:true},
                {name:'macroproceso',index:'macroproceso',width:40,align:"left"},
                {name:'codigomacroproceso',index:'codigomacroproceso',width:40,align:"left"},
                {name:'options',index:'options',width:40,align:"left",formatter:options}],
            pager: '#pager_macroproceso',
            sortname:'cve_macroproceso',
            rowNum:10,
            caption:'<?php echo lang('caption_grid_macroproceso'); ?>',
            gridComplete:clickOptions,
            jsonReader: {
                repeatitems : false,
                cve_macroproceso: 'cve_macroproceso'
            }
        });
    });
</script>
<div class="content-admin" >
    <div style="height: 43px;margin-top: 11px;">
        <a href="<?php echo base_url() ?>macroprocesos/insert">
            <img width="18" style="margin-bottom: -3px;" src="<?php echo base_url()?>/images/icons/add.png"> Insertar MacroProceso
        </a>
    </div>
    <table id="table_macroproceso"></table>
    <div id="pager_macroproceso"></div>
</div>
