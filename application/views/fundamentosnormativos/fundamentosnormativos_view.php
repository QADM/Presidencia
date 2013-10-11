<script type="text/javascript">
    function clickOptions()
    {
        $('.ui-delete').click(function(){
            id = $(this).attr('cve_fundamentonormativa');
            $.app.messages.info('<?php echo lang('msg_conf_delete'); ?>', function(){
                $.post('<?php echo base_url() ?>fundamentosnormativos/deleteFundamentosNormativos', {'id':id}, function(response){
                    response = $.secureEvalJSON(response);
                    if(response.success)
                    {
                         $.app.messages.info('<?php echo lang('msg_delete'); ?>');
                         $("#table_fundamentonormativo").trigger("reloadGrid");
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
        edit = '<a class="ui-edit" href="<?php echo base_url() ?>fundamentosnormativos/edit/'+ options.RowId + '" style="cursor:pointer" cve_fundamentonormativa="'+ options.RowId + '" title="<?php echo lang('edit_grid'); ?> ' + rowObject.cve_fundamentonormativa +'"/></a>';
        remove = '<a class="ui-delete" style="cursor:pointer" cve_fundamentonormativa="'+ options.RowId + '" title="<?php echo lang('delete_grid'); ?> ' + rowObject.cve_fundamentonormativa +'"/></a>';
        return remove+edit;
    }
    
    $(function(){
        $("#table_fundamentonormativo").grid('destroy');
        $("#table_fundamentonormativo").grid({
            url:'<?php echo base_url() ?>fundamentosnormativos/getFundamentosNormativos',
            colNames:['','<?php echo lang('label_nombre'); ?>','<?php echo lang('label_numeral'); ?>','<?php echo lang('option_grid'); ?>'],
            colModel:[
                {name:'cve_fundamentonormativa',index:'cve_fundamentonormativa',width:30,align:"left",hidden:true},
                {name:'nombre',index:'nombre',width:40,align:"left"},
                {name:'numeral',index:'numeral',width:40,align:"left"},
                {name:'options',index:'options',width:40,align:"left",formatter:options}],
            pager: '#pager_fundamentonormativo',
            sortname:'cve_fundamentonormativa',
            rowNum:10,
            caption:'<?php echo lang('caption_grid_fundamentonormativo'); ?>',
            gridComplete:clickOptions,
            jsonReader: {
                repeatitems : false,
                cve_fundamentonormativa: 'cve_fundamentonormativa'
            }
        });
    });
</script>
<div class="content-admin" >
    <div style="height: 43px;margin-top: 11px;">
        <a href="<?php echo base_url() ?>fundamentosnormativos/insert">
            <img width="18" style="margin-bottom: -3px;" src="<?php echo base_url()?>/images/icons/add.png"> Insertar Fundamento Normativo
        </a>
    </div>
    <table id="table_fundamentonormativo"></table>
    <div id="pager_fundamentonormativo"></div>
</div>
