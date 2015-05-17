<?php

class M_user extends CI_Model{
    
    function get_details(){
        $stno = $this->session->userdata('student_no');
        $pword = $this->session->userdata('password');
    
        $this->db->select('*');
        $this->db->from('graduate');
        $this->db->where('student_no', $stno);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_posts(){
        $stno = $this->session->userdata('student_no');
        $pword = $this->session->userdata('password');

        // $found_posts = 	$this->db->query("SELECT * FROM post WHERE studentno = '$stno' ORDER BY time DESC");

        $found_posts = $this->db->query("SELECT * FROM post left join graduate on post.studentno=graduate.student_no WHERE post.studentno = '$stno' or post.studentno IN (select studentno2 from connection where studentno1 = '$stno') order by post.time desc");
        return $found_posts->result_array();

  //       SELECT t1.name, t2.salary FROM employee t1, info t2
  // WHERE t1.name = t2.name;

    }

    function initialize_info($id, $data){
        $this->db->where('student_no', $id);
        $this->db->update('graduate', $data); 
        return;
    }
	
	function create_post(){	
		$body = $this->input->post('post_body');
        $stno = $this->session->userdata('student_no');
        
		$post = $this->db->query("INSERT INTO `post`(`studentno`, `body`) VALUES ('$stno','$body');");
        return;
       
	} //end of function login

    function get_suggestions(){
        $stno = $this->session->userdata('student_no');

        $batch = substr($stno, 0, 4);
        $found_suggestions = $this->db->query("SELECT * FROM graduate WHERE student_no LIKE '$batch%' AND student_no NOT IN (SELECT studentno2 FROM connection WHERE studentno1 = '$stno')");

        return $found_suggestions->result_array();
    }

    function get_suggestions2(){
        $stno = $this->session->userdata('student_no');

        $user_details =  $this->db->query("SELECT * FROM graduate WHERE student_no = '$stno'");
        $batch = substr($stno, 0, 4);
        $found_suggestions = $this->db->query("SELECT * FROM graduate WHERE student_no LIKE '$batch%'");
        return $found_suggestions->result_array();
    }

    function add_connection($stno, $stno2){
        $query = $this->db->query("INSERT INTO connection VALUES ('','$stno', '$stno2')");
        return $query;
    }

    function add_project($user_data){
        $this->db->insert('project', $user_data); 
        return;
    }

    function add_publication($user_data){
        $this->db->insert('publication', $user_data); 
        return;
    }

    function request_company($name, $country, $caddcountrycode, $state, $caddprovincecode, $type){
        $stno = $this->session->userdata('student_no');

        $this->db->set('companyname', $name);
        $this->db->set('caddcountry', $country);
        $this->db->set('caddprovince', $state);
        $this->db->set('caddcountrycode', $caddcountrycode);
        $this->db->set('caddprovincecode', $caddprovincecode);
        $this->db->set('companytype', $type);
        $this->db->insert('company');
        return;
    }


    function request_school($name, $country, $saddcountrycode, $state, $saddprovincecode){
        $stno = $this->session->userdata('student_no');

        $this->db->set('schoolname', $name);
        $this->db->set('saddcountry', $country);
        $this->db->set('saddprovince', $state);
        $this->db->set('saddcountrycode', $saddcountrycode);
        $this->db->set('saddprovincecode', $saddprovincecode);
        $this->db->insert('school');
        return;
    }

    function get_companyno($name, $country, $caddcountrycode, $state, $caddprovincecode, $type){
        
        $this->db->select('company_no');
        $this->db->from('company');
        $this->db->where('companyname', $name);
        $this->db->where('caddcountry', $country);
        $this->db->where('caddprovince', $state);

        $query = $this->db->get();

        if($query->result()){
            return $query->row()->company_no; 
        }
        else{
            $this->request_company($name, $country, $caddcountrycode, $state, $caddprovincecode, $type);
            $companyno = $this->get_companyno($name, $country, $caddcountrycode, $state, $caddprovincecode, $type);
            $this->db->set('companyno', $companyno);
            $this->db->insert('request');
            return $companyno;
        }
    }


    function get_schoolno($name, $country, $saddcountrycode, $state, $saddprovincecode){
        
        $this->db->select('school_no');
        $this->db->from('school');
        $this->db->where('schoolname', $name);
        $this->db->where('saddcountry', $country);
        $this->db->where('saddprovince', $state);

        $query = $this->db->get();

        if($query->result()){
            return $query->row()->school_no; 
        }
        else{
            $this->request_school($name, $country, $saddcountrycode, $state, $saddprovincecode);
            $schoolno = $this->get_schoolno($name, $country, $saddcountrycode, $state, $saddprovincecode); 
            $this->db->set('schoolno', $schoolno);
            $this->db->insert('request');
            return $schoolno;
        }
    }

    function getWork(){
        $stno = $this->session->userdata('student_no');

        $this->db->select('*');
        $this->db->from('work');
        $this->db->where('studentno', $stno);
        $this->db->order_by('workdatestart', 'asc');
        $query=$this->db->get();
        return $query;
    }


    function add_experience($user_data){
        $this->db->insert('work', $user_data); 
        return;
    }

    function add_education($user_data){
        $this->db->insert('educationalbg', $user_data); 
        return;
    }

    function get_companies_name($q){
        $this->db->select('*');
        $this->db->like('companyname', $q);
        $query = $this->db->get('company');
        if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['companyname']));
            $new_row['value']=htmlentities(stripslashes($row['companyname']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    function get_companies_loc($q){
        $this->db->select('*');
        $this->db->like('address', $q);
        $query = $this->db->get('company');
        if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['address']));
            $new_row['value']=htmlentities(stripslashes($row['address']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    function get_school_name($q){
        $this->db->select('*');
        $this->db->like('schoolname', $q);
        $query = $this->db->get('school');
        if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['schoolname']));
            $new_row['value']=htmlentities(stripslashes($row['schoolname']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    function get_school_add($q){
        $this->db->select('*');
        $this->db->like('name', $q);
        $query = $this->db->get('school');
        if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['address']));
            $new_row['value']=htmlentities(stripslashes($row['address']));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    function getCountry()
    {
       $this->db->select('alpha_2,name');
       $this->db->from('meta_country');
       $this->db->order_by('name', 'asc');
       $query=$this->db->get();
       return $query;
    }

    function getData($loadType,$loadId)
    {

        $fieldList='iso_code,name';
        $table='meta_province';
        $fieldName='country_code';
        $orderByField='name';
       
       $this->db->select($fieldList);
       $this->db->from($table);
       $this->db->where($fieldName, $loadId);

       if($loadId == "PH"){
        $this->db->where('type', 'Province');
       }

       $this->db->order_by($orderByField, 'asc');
       $query=$this->db->get();
       return $query;
     }


     

     function get_country_name($alpha_2){
        $this->db->select('name');
        $this->db->from('meta_country');
        $this->db->where('alpha_2', $alpha_2);
        $query = $this->db->get();
        return $query->result()[0]->name;
     }

     function get_state_name($iso_code){
        $this->db->select('name');
        $this->db->from('meta_province');
        $this->db->where('iso_code', $iso_code);
        $query =  $this->db->get();
        return $query->result()[0]->name;
     }
}

?>