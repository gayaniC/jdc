<div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                   <h1><font color="#00CCCC">JDC Management System</font> </h1>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                    <?php //$this->load->model('emp_model');
                    $photo = $this->nav_model->get_photo($this->session->userdata('Emp_id'));
                    
                     ?>
                        <img src="<?php  echo site_url(); ?>/uploads/Employee/<?php echo $photo; ?>" alt="Profile Pic" width="30" height="40" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo $this->session->userdata('username'); ?></li>
                            <li><a href="#"><?php $datestring = "%Y %m %d"; echo mdate($datestring); ?></a></li>
                            <li><a href="<?php echo site_url()?>logout">Logout</a></li>
                        </ul>
                        <br />
                    </div>
                </div><!-- floatright -->
                <div class="clear">
                </div>
            </div><!-- branding -->
        </div><!-- grid_12 header-repeat-->
         
         <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                     <ul class="section menu">
                     <?php
						$this->load->model('nav_model');					
						$user_group =  $this->session->userdata('user_role_id');//'ADMIN';
						$navigation = $this->nav_model->get_user_menu_navigation($user_group);
						//echo '<pre>'; print_r($navigation); echo '</pre>';
						foreach($navigation as $nav){
							//echo $nav->page_id;
							//echo $nav->subnav;
							if(empty($nav->subnav)){
								echo '<li><a href="'.site_url($nav->page_id).'" class="menuitem">'.$nav->option_name.'</a></li>';
							}else{
								echo '<li><a href="'.site_url($nav->page_id).'" class="menuitem">'.$nav->option_name.'</a>';
								echo '<ul class="submenu">';
								foreach($nav->subnav as $sub){
									
									echo '<span><li><a href="'.site_url($sub->page_id).'" id="sub">'.$sub->option_name.'</a></li></span>';
									
								}
								echo '</ul></li>';
							}
						}
						/* 
						foreach($navigation as $nav){
							
							$class = $this->router->class;
							$method = $this->router->method;
							$navclass = ($class==$nav->page_id)?'class="current"':'';	
							if(empty($nav->subnav)){		
								
							  echo '<li '.$navclass.'><a href="'.site_url($nav->page_id).'" class="menuitem">'.$nav->option_name.'</a></li>';
							}else{
								echo '<li '.$navclass.'>';
								echo '<a href="#'.$nav->page_id.'" class="menuitem">'.$nav->option_name.'</a>';
								
								
								echo '<ul class="submenu" id="'.$nav->page_id.'">';
								foreach($nav->subnav as $sub){						
									if($method == 'index'){
										$subnavclass = ($class==$sub->page_id)?'class="current"':'';
									}else{
										$subnavclass = ($class.'/'.$method ==$sub->page_id)?'class="current"':'';
									}					
									echo '<li '.$subnavclass.'><a href="'.site_url($sub->page_id).'" class="submenu">'.$sub->option_name.'</a></li>';
								}
								echo '</ul>';
								echo '</li>';
							}
						} */
			?>
            
                        </ul>
                </div><!-- block -->
            </div><!-- box sidemenu -->
        </div><!-- grid_2 -->
       
		
    </div><!-- container_12 -->
