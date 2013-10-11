<?php echo meta('Content-type', 'text/html; charset=UTF-8', 'equiv'); ?>
    <link href="<?php echo base_url()?>css/style.css" rel="stylesheet" type="text/css" media="all" />

    <link href="<?php echo base_url()?>css/menu/nav-h.css" rel="stylesheet" type="text/css" media="all" />

    <link href="<?php echo base_url()?>css/jquery-ui-1.8.16/cupertino/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" media="all" />

    <link href="<?php echo base_url()?>css/table/table.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery-1.4.4.min.js"  ></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.validate.js"  ></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.dataTables.min.js"  ></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery-ui-1.8.16/jquery-ui-1.8.16.custom.min.js"  ></script>

<script language="javascript" >

$(document).ready(function(){

        function position( using ) {
            $( ".positionable" ).position({
                    of: $( "#dialog" ),
                    my: "center center",
                    at: "center center",
                    using: using
            });
        }


 //Dialog to add new product demand
        $( "#dialog" ).dialog({
        autoOpen: false,
        height: 600,
        width: 700,
        modal: true,
        buttons: {
                "<?php echo lang('label_demand_product_add'); ?>": function() {
                    
                },
                "<?php echo lang('label_cancel') ?>": function() {
                        $( this ).dialog( "close" );
                }
            }
        });



    $( "#add" ).click(function(ev) {
        ev.preventDefault();
        $( "#dialog" ).dialog( "open" );
        $( ".positionable" ).show();
            });

    position();
})

</script>

<style>
    div.positionable {
        width: 300px;
        height: 200px;
        position: absolute;
        display: none;
        margin:0;
        background-color: #bcd5e6;
        text-align: center;
        opacity:0.5;
        top:200px;
    }
</style>

<div>
<?php echo anchor('',lang('label_demand_product_add'), array('id'=>'add')) ?>
</div>
<!-- Jquery UI dialog -->
<div id="dialog" style="display: none" title="<?php echo lang('label_demand_product_add_title') ?>">
    <?php require('./application/views/products/products_selector_view.php'); ?>

</div>
    <div class="positionable">
	<p>
	to position
	</p>
    </div>


