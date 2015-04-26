<?php

class M_index extends CI_Model{
	
	function login(){
		$stno = $this->input->post('stno');
		$pword = $this->input->post('pword');
		

		$found_user = $this->db->query("SELECT * FROM graduate WHERE student_no = '$stno' AND password = '$pword'");
        
        if($found_user->num_rows()){

            foreach($found_user->result() as $row)
			{
				if($stno==$row->student_no && $pword==$row->password){
                    $userdata = array(
                        'logged_in' => TRUE,
                        'student_no' => $row->student_no,
                        'password' => $pword
                        );
            
                    $this->session->set_userdata($userdata);
                    return $found_user;
                }
            }
        }
        return 0;
	} //end of function login
    
    
    function get_yearlist(){
        $found_yearlist = $this->db->query("select substr(graduate.`graduatedate`, 1, 4) as 'year' from graduate group by substr(graduate.graduatedate, 1, 4);");
        return $found_yearlist->result_array();
    }

}

?>