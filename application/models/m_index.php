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
    

    function getStudents($classOf)
    {
        $this->db->select('studentno');
        $this->db->from('educationalbg');
        $this->db->where('class', $classOf);
        $this->db->where('level', 'tertiary');
        $this->db->where('schoolno', 1);
        $studentno=$this->db->get();
        
        $list = array();

        foreach($studentno->result() as $element){
           array_push($list, $element->studentno);
         }

        $this->db->select('*');
        $this->db->from('graduate');
        $this->db->where_in('student_no', $list);
        $query=$this->db->get();
        
        return $query;
     }
    
    function get_yearlist(){
        // $found_yearlist = $this->db->query("select substr(graduate.`graduatedate`, 1, 4) as 'year' from graduate group by substr(graduate.graduatedate, 1, 4);");
        // return $found_yearlist->result_array();
        $this->db->select('class');
        $this->db->distinct('class');
        $this->db->where('level', 'tertiary');
       $this->db->order_by('class', 'asc');
        $query=$this->db->get('educationalbg');
        return $query;
    }

}

?>