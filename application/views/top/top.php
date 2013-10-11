<div class="sge-header">
    <div class="sge-header-top">
        <a class="header_exit" href="<?php echo base_url() ?>admin/logout">Salir</a>
        <a class="header_start" href="<?php echo base_url() ?>welcome">Inicio</a>
    </div>
    <div class="separator_header_center_top"></div>
    <div class="sge-header-center">
        <img style="margin-left: 109px; margin-top: 5px;" src="<?php echo base_url() ?>images/durango_index.png">
    </div>
    <div class="separator_header_center_footer"></div>
    <div class="sge-header-footer">
        <div class="sge-img-blue-header"></div>
    </div>
</div>
<div class="navigation-down" style="display: <?php echo isset ($display) ? $display : 'none' ?>">
    <ul class="inside top">
        <li><a class="navigation" href="<?php echo site_url() ?>">Inicio</a></li>
        <li><img style="margin-top: 22px;" src="<?php echo base_url()?>images/bullet-menu-s.png"></li>
        <?php
        $cont = 0;
        if (!empty($links))
            $count = count($links);
            foreach ($links as $key => $value) {
                ?>
                    <?php $cont++; ?>
                    <?php if($cont != $count) { ?>
                        <li> <a href="<?php echo site_url() . $value ?>"><?php echo $key ?></a></li>
                        <li><img style="margin-top: 22px;" src="<?php echo base_url()?>images/bullet-menu-s.png"></li>
                    <?php }else{ ?>
                        <li> <a href="<?php echo site_url() . $value ?>"><?php echo $key ?></a></li>
                    <?php } ?>
                <?php
            }
        ?>
    </ul>
</div>
<div class="div_blue"></div>
<div class="sge-nav">
    <div class="r"></div>

    <?php
        echo $this->menu_manager->generate_menu();
    ?>

</div>