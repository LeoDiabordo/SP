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

    function request($name, $loc, $type){
        $stno = $this->session->userdata('student_no');

        echo($name.", ".$loc.", ".$type);


        $this->db->set('name', $name);
        $this->db->set('address', $loc);
        $this->db->set('companytype', $type);

        $this->db->insert('company');

        $this->db->set('studentnos', $stno);

        if($type!=NULL)
            $this->db->set('request_type', 0);
        else
            $this->db->set('request_type', 1);


        $this->db->insert('request');
    }

    function get_companyno($name, $loc, $type){



        $this->db->select('company_no');
        $this->db->from('company');
        $this->db->where('name', $name);
        $this->db->where('address', $loc);
        $this->db->where('companytype', $type);

        $query = $this->db->get();

        // var_dump($query);
        // var_dump($query->result());
        // var_dump($loc);
        // var_dump($name);
        // var_dump($type);



        if($query->result()){
            return $query->row()->company_no; 

        }
        else{
            $this->request($name, $loc, $type);
            return $this->get_companyno($name, $loc, $type);    
        }
    }

    function add_experience($user_data){
        $this->db->insert('work', $user_data); 
        return;
    }

    function get_companies_name($q){
        $this->db->select('*');
        $this->db->like('name', $q);
        $query = $this->db->get('company');
        if($query->num_rows > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['name']));
            $new_row['value']=htmlentities(stripslashes($row['name']));
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

    function getCountry()
    {
       $this->db->select('id,printable_name');
       $this->db->from('iso_3166_1');
       $this->db->order_by('printable_name', 'asc');
       $query=$this->db->get();
       return $query;
    }

    function getData($loadType,$loadId)
    {

        $fieldList='id,name';
        $table='iso_3166_2';
        $fieldName='3166_1_id';
        $orderByField='name';
       
       $this->db->select($fieldList);
       $this->db->from($table);
       $this->db->where($fieldName, $loadId);
       $this->db->order_by($orderByField, 'asc');
       $query=$this->db->get();
       return $query;
     }

     function get_country_name($id){
        $this->db->select('printable_name');
        $this->db->from('iso_3166_1');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result()[0]->printable_name;
     }

     function get_state_name($id){
        $this->db->select('name');
        $this->db->from('iso_3166_2');
        $this->db->where('id', $id);
        $query =  $this->db->get();
        return $query->result()[0]->name;
     }
}

?>