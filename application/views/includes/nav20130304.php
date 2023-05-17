<div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <img src="<?php echo site_url(); ?>/template/img/logo.png" alt="Logo" /></div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="<?php echo site_url(); ?>/images/saree.jpg" alt="Profile Pic" width="30" height="40" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                            <li><a href="#">Config</a></li>
                            <li><a href="<?php echo site_url()?>login/logout">Logout</a></li>
                        </ul>
                        <br />
                    </div>
                </div><!-- floatright -->
                <div class="clear">
                </div>
            </div><!-- branding -->
        </div><!-- grid_12 header-repeat-->
        <?php 
		$modules = $this->nav_model->get_main_menu();
		 ?>
        <div class="clear">
        </div>
        <div class="clear">
        </div>
        <?php 
			foreach($modules as $nav){
		?>
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                   <?php $result = $this->nav_model->sub_nav_menu($nav->option_code);
						if($result == ''){	 ?>
                        <li><a href="<?php echo $nav->page_id; ?>" class="menuitem"><?php echo $nav->option_name; ?></a>
                        <?php } else{ ?>
                            <ul class="submenu">
                            
                                <li><a href="<?php echo $result['page_id'] ?>"><?php echo $result['option_name']; ?></a> </li>
                            <?php } ?>    
                            </ul>
                    </ul>
                </div><!-- block -->
            </div><!-- box sidemenu -->
        </div><!-- grid_2 -->
        <?php } ?>
		
    </div><!-- container_12 -->