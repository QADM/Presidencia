/* 
 * Notification to prevent or notify any actions 
 */

$(document).ready(function(){
    $('body').append('<div style="display:none;font-size: 12px;" id="dialog-confirm" title="Confirmar eliminación" ><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Realmente desea eliminar este elemento?</div>');
    
    $('.prevent_delete').click(function(event){

        if (!confirm('¿Realmente desea eliminar este elemento?'))
            event.preventDefault();
        else
            return;
        
    });

    //location.href
    $('.prevent_delete_jq').live('click',function(event){
        event.preventDefault();
        var href = $(this).attr('href');
        $( "#dialog-confirm" ).dialog({
                resizable: false,
                width:400,
                modal: true,
                buttons: {
                        "OK": function() {
                                window.location = href;
                                $( this ).dialog( "close" );
                        },
                        "Cancelar": function() {
                                $( this ).dialog( "close" );
                        }
                }
        });
    });
    
})


