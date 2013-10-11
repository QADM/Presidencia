<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Módulo de Programación.</title>

        <link href="" rel="shortcut icon" />
        <link href="<?php echo base_url() ?>css/jquery-ui.1.8.20/jquery-ui-1.8.20.custom.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url() ?>css/style_admin.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--        <link href="<?php echo base_url() ?>css/ui.multiselect.css" rel="stylesheet" type="text/css" media="all" />-->

        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery-1.8.1.min.js"  ></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery-ui-1.8.23.custom.min.js"  ></script>

        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/script.js"  ></script>

        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.validate.js"  ></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.form.js"  ></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/app.form.js"  ></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery-json.js"  ></script>

        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/notifications.js"  ></script>

        <!--    grid   -->
        <script type="text/javascript">
            var base_url = base_url();
            function base_url()
            {
                return "<?php echo base_url(); ?>";
            }
        </script>
        <link href="<?php echo base_url() ?>css/ui/ui.jqgrid.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/grid/jqgrid/grid.loader.js"  ></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/grid/app.grid.js"  ></script>
        <!--    grid   -->

        <!-- messages -->
        <link href="<?php echo base_url() ?>css/ui/ui.messages.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/app.messages.js"  ></script>
        <!-- messages -->

        <!-- date -->
        <link href="<?php echo base_url() ?>css/ui/ui.timepicker.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/app.date.js"  ></script>
        <!-- date -->

        <!-- fileinput -->
        <link href="<?php echo base_url() ?>css/fileinput.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/jquery.fileinput.min.js"  ></script>
        <!-- fileinput -->
    </head>

    <!-- To disable link on menu-separators  -->
    <!-- To fix IE menu bugs-->
    <script language="javascript">
        $(document).ready(function(){
            $('a.separator').click(function(event){
                event.preventDefault();
            });
        });

    </script>

    <body>

        <?php
//Defining template variables if they went not defined in the last request
        $_T = ( isset($_T) ? $_T : '' );
        $_B = ( isset($_B) ? $_B : '' );
        $_R = ( isset($_R) ? $_R : '' );
        $_F = ( isset($_F) ? $_F : '' );
        ?>
        <div id="sge-main">
            <div class="sge-sheet">
                <div class="sge-sheet-body">
                    <div id="_top" >
                        <?php require(template_top($_T)); ?>  
                    </div>
                    <div class="sge-content-layout">
                        <?php require(template_body($_B)); ?>
                    </div>
                    <div class="img_footer"></div>
                    <div class="sge-footer">
                        <?php require(template_footer($_F)); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>