<?php

	class nav_model extends CI_Model{
		
		/* function get_main_menu(){
			
			$userid = $this->session->userdata('user_role_id');
			$this->db->select('*');
			$this->db->from(MODULE_OPTION.' mp');//u03_module_options
			$this->db->join(ROLE_MODULE.' rm', 'rm.option_code = mp.option_code');//u04_user_roles_module_options
			$this->db->where('mp.parent',1);
			$this->db->where('mp.hidden',0);
			$this->db->where('rm.user_role_id',$userid);
            $navigation =  $this->db->get()->result();
			//echo '<pre>'; print_r($navigation); echo '</pre>'; 
			$i = -1;
			foreach($navigation as $name){
			$i++;
			
				$data[] = $name->option_code;
				$navigation[] = $this->sub_nav_menu($data);				
			}
			//echo '<pre>'; print_r($navigation); echo '</pre>'; die();
			return $navigation;
		}
		
		   function sub_nav_menu($data){
			
			$userid = $this->session->userdata('user_role_id');
			$this->db->select('*');
			$this->db->from(MODULE_OPTION.' mp');
			$this->db->join(ROLE_MODULE.' rm', 'rm.option_code = mp.option_code');
			$this->db->where('mp.sub_option',$data[0]);
			$this->db->where('mp.parent',0);
			$this->db->where('mp.hidden',0);
			$this->db->where('rm.user_role_id',$userid);
			
			return $this->db->get()->result();
			//echo $this->db->last_query(); die();
		}   */
		
		function get_user_menu_navigation($user_group){
			$navigation = array();
			//Get the main navigations		
			$this->db->select('*');
			$this->db->from(MODULE_OPTION.' um');//u03_module_options
			$this->db->join(ROLE_MODULE.' uro','um.option_code = uro.option_code');//u04_user_roles_module_options
			$this->db->where('uro.user_role_id',$user_group);
			$this->db->where('um.hidden',0);
			$this->db->where('um.parent',1);
			$this->db->order_by('uro.disp_ord');
			$nav = $this->db->get()->result();
			
			foreach($nav as $n){
				$subnav = $this->get_sub_navigation($user_group,$n->option_code);
				$n->subnav = $subnav;
				$navigation[] = $n;	
			}
			return $navigation;
		}
	
		function get_sub_navigation($user_group,$parent){
			$this->db->select('*');
			$this->db->from(MODULE_OPTION.' um');
			$this->db->join(ROLE_MODULE.' uro','um.option_code = uro.option_code');
			$this->db->where('uro.user_role_id',$user_group);
			$this->db->where('um.hidden',0);
			$this->db->where('um.sub_option',$parent);
			$this->db->order_by('uro.disp_ord');
			$nav = $this->db->get()->result();
			return $nav;
		}
        
         function get_photo($emp)
    {
        $this->db->select('photo');
        $this->db->from(EMP_TBL);
        $this->db->where('Emp_id',$emp);
        $result = $this->db->get()->result();
        foreach($result as $row){
            return $row->photo;
        }
    }//get photo to the home screen
    
        
			
	}