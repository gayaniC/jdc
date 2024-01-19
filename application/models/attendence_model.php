<?php 

class attendence_model extends CI_Model{
	
	function get_all_att($data)
	{
	   $test1 = $data['att_date'];
	   $att_date = date('Y-m-d',strtotime($test1));
        $this->db->select('emp.title,emp.First_name,emp.Middle_name,att.att_date,att.In_Time,att.Out_time,att.duration');
        $this->db->from(ATTENDENCE.' att');
        $this->db->join(EMP_TBL.' emp','emp.Emp_id = att.Emp_id');
        if(!empty($data['Emp_id'])){
            $this->db->like('emp.Emp_id',$data['Emp_id']);
        }
        if(!empty($data['att_date'])){
            $this->db->like('att.att_date',$att_date);
        }
        //$this->db->get()->result();
        return $this->db->get()->result();
        //echo $this->db->last_query();
	   
		
		
	}
    
    function insert($files)
    {
        $att = $files['Attendance']['tmp_name'];
        $handle = fopen($att,"r");
        
        $databasetable = ATTENDENCE;
        
        do{
        if(!empty($data[0])){
            //echo $data[1];
            $test1 = $data[0];
            $From = date('Y-m-d',strtotime($test1));
            $sql = "INSERT INTO $databasetable (att_date,In_Time,Out_time,duration,Emp_id) VALUES 
                    ( 
                        '".addslashes($From)."', 
                        '".addslashes($data[1])."',
                        '".addslashes($data[2])."',
                        '".addslashes($data[3])."',
                        '".addslashes($data[4])."'
                        
                    ) 
                ";
            $this->db->query($sql) ;
            //return true; 
            
        }
    
   }while($data = fgetcsv($handle,1000,",","'"));
        
        
    }
    
    
    
   
   
}