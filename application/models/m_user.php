<?php

class M_user extends CI_Model{

    function search($search){
        $stno = $this->session->userdata('student_no');

        $existing_connection = array();

        $this->db->select('studentno2');
        $this->db->from('connection');
        $this->db->where('studentno1', $stno);
        $query = $this->db->get();
        
        foreach($query->result() as $element){
            array_push($existing_connection, $element->studentno2);
        }

        $this->db->select('studentno1');
        $this->db->from('connection');
        $this->db->where('studentno2', $stno);
        $query = $this->db->get();
        
        foreach($query->result() as $element){
            array_push($existing_connection, $element->studentno1);
        }


        $this->db->select('*');
        $this->db->from('graduate');
        $this->db->like('firstname', $search);
        $this->db->where('student_no !=', $stno);
        $this->db->where_not_in('student_no', $existing_connection);
        $this->db->limit(18);

        $query = $this->db->get();
        $data['results'] = $query->result();
        return $data;
    }

    public function add_image($filename)
    {
        $stno = $this->session->userdata('student_no');
        $data = array(
            'imagepath'=> $filename,
        );
        $this->db->where('student_no', $stno);
        $this->db->update('graduate', $data);
    }

    function get_profile(){
        $stno = $this->session->userdata('student_no');

        //basic information
        $this->db->select('*');
        $this->db->from('graduate');
        $this->db->where('student_no', $stno);
        $query = $this->db->get();
        $data['details'] = $query->result();

        //work info
        $this->db->select('*');
        $this->db->from('work');
        $this->db->where('studentno', $stno);
        $query = $this->db->get();
        $data['work'] = $query->result();

        //education info
        $this->db->select('*');
        $this->db->from('educationalbg');
        $this->db->where('studentno', $stno);
        $query = $this->db->get();
        if($query->result()!=NULL)
        $data['educ'] = $query->result();

        //publications and projects
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('studentno', $stno);
        $query = $this->db->get();
        if($query->result()!=NULL)
        $data['proj']= $query->result();

        $this->db->select('*');
        $this->db->from('publication');
        $this->db->where('studentno', $stno);
        $query = $this->db->get();
        if($query->result()!=NULL)
        $data['pub'] = $query->result();

        return $data;

    }

    function add_new_account($info){

        $names = explode(" ", $info[0]);

        $lastname = str_replace(',', '', $names[0]);




        $this->db->set('student_no', $stno);
        $this->db->insert('graduate');
        return;
    }

    function user_exists($stno){
        /*return 
        0 - not
        1 - exists
        */

        $this->db->select('*');
        $this->db->from('graduate');
        $this->db->where('student_no', $stno);
        $query = $this->db->get();

        if($query->result()){
            return $query->result();
        }
        else
            return NULL;
    }
    
    function get_details(){
        $stno = $this->session->userdata('student_no');
        //$pword = $this->session->userdata('password');
    
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

    function get_smart_suggestions(){
        $stno = $this->session->userdata('student_no');

        //$batch = substr($stno, 0, 4);
        //$found_suggestions = $this->db->query("SELECT * FROM graduate WHERE student_no LIKE '$batch%' AND student_no NOT IN (SELECT studentno2 FROM connection WHERE studentno1 = '$stno')");

        //Get all existing Connection of the user
        $existing_connection = array();

        $this->db->select('studentno2');
        $this->db->from('connection');
        $this->db->where('studentno1', $stno);
        $query = $this->db->get();
        
        foreach($query->result() as $element){
            array_push($existing_connection, $element->studentno2);
        }

        $this->db->select('studentno1');
        $this->db->from('connection');
        $this->db->where('studentno2', $stno);
        $query = $this->db->get();
        
        foreach($query->result() as $element){
            array_push($existing_connection, $element->studentno1);
        }

        


        $level2_connections = array();
        //get all 2nd level connection using existing connections
        foreach ($existing_connection as $key) {
            
            $this->db->select('studentno2');
            $this->db->from('connection');
            $this->db->where('studentno1', $key);
            $query = $this->db->get();
            
            foreach($query->result() as $element){
                $level2_connections["$element->studentno2"] = 10;
            }

            $this->db->select('studentno1');
            $this->db->from('connection');
            $this->db->where('studentno2', $key);
            $query = $this->db->get();
            

            foreach($query->result() as $element){
                $level2_connections["$element->studentno1"] = 10;
            }
        }

        
        $level3_connections = array();
        //get all 2nd level connection using level 2 connections
        foreach ($level2_connections as $key => $value) {
            $this->db->select('studentno2');
            $this->db->from('connection');
            $this->db->where('studentno1', $key);
            $query = $this->db->get();
            
            foreach($query->result() as $element){
                $level3_connections["$element->studentno2"] = 3;
            }

            $this->db->select('studentno1');
            $this->db->from('connection');
            $this->db->where('studentno2', $key);
            $query = $this->db->get();
            

            foreach($query->result() as $element){
                $level3_connections["$element->studentno1"] = 3;
            }
        }

        $suggestions = $level2_connections + $level3_connections;
       

       $suggestions = $this->apply_multipliers($suggestions);
       arsort($suggestions);

       //clean suggestions - remove existing connections and self
        unset($suggestions[$stno]);
       foreach ($existing_connection as $key) {
        unset($suggestions[$key]);
       }

       $suggestion_stno = array_keys($suggestions);
       $suggestion_details = array();

       foreach ($suggestion_stno as $key){
            $this->db->select('*');
            $this->db->from('graduate');
            $this->db->where('student_no', $key);
            $query = $this->db->get();
            array_push($suggestion_details, $query->result());
       }

       return $suggestion_details;
        /* multiply
        foreach($query->result() as $element){
            $existing_connection["$element->studentno2"] = 0;
        }


        $this->db->select('studentno1');
        $this->db->from('connection');
        $this->db->where('studentno2', $stno);
        $query = $this->db->get();
        
        foreach($query->result() as $element){
            $existing_connection["$element->studentno1"] = 0;
        }

        foreach($scores as $x => $x_value) {
            $x_value += 5;
            $scores["$x"] = $x_value;
        }
        */









        //return $existing_connection;
    }

    function apply_multipliers($suggestions){
        $stno = $this->session->userdata('student_no');

        //for current company 
        $this->db->select('companyno');
        $this->db->from('work');
        $this->db->where('studentno', $stno);
        $this->db->where('currentjob', 1);
        $query = $this->db->get();

        if($query->result()!=NULL){
            $current_companyno = $query->result()[0]->companyno;


            //get current co-emplyees
            $this->db->select('studentno');
            $this->db->from('work');
            $this->db->where('companyno', $current_companyno);
            $this->db->where('currentjob', 1);
            $query = $this->db->get();

            $current_coemployees = $query->result();

            foreach ($current_coemployees as $element) {
                if(array_key_exists($element->studentno, $suggestions)){
                    $suggestions[$element->studentno] += 7;
                }
                else
                    $suggestions[$element->studentno] = 7;
            }

            //ex employees of users current company
            $this->db->select('studentno');
            $this->db->from('work');
            $this->db->where('companyno', $current_companyno);
            $this->db->where('currentjob', 0);
            $query = $this->db->get();

            $past_coemployees = $query->result();

            foreach ($past_coemployees as $element) {
                if(array_key_exists($element->studentno, $suggestions)){
                    $suggestions[$element->studentno] += 5;
                }
                else
                    $suggestions[$element->studentno] = 5;
            }
        }


        //get companyno of past companies of user
        $this->db->select('companyno');
        $this->db->from('work');
        $this->db->where('studentno', $stno);
        $this->db->where('currentjob', 0);
        $query = $this->db->get();

        $ex_companies = array();
        foreach ($query->result() as $element) {
            array_push($ex_companies, $element->companyno);
        }

        //get current employees of users ex companies
        foreach ($ex_companies as $key => $value) {

            $this->db->select('studentno');
            $this->db->from('work');
            $this->db->where('companyno', $value);
            $this->db->where('currentjob', 1);
            $query = $this->db->get();

            $ex_coemployees = $query->result();

            foreach ($ex_coemployees as $element) {
                if(array_key_exists($element->studentno, $suggestions)){
                    $suggestions[$element->studentno] += 5;
                }
                else
                    $suggestions[$element->studentno] = 5;
            }


            $this->db->select('studentno');
            $this->db->from('work');
            $this->db->where('companyno', $value);
            $this->db->where('currentjob', 0);
            $query = $this->db->get();

            $ex_exemployees = $query->result();

            foreach ($ex_exemployees as $element) {
                if(array_key_exists($element->studentno, $suggestions)){
                    $suggestions[$element->studentno] += 2;
                }
                else
                    $suggestions[$element->studentno] = 2;
            }


        }        
        return $suggestions;
    }



    function get_suggestions(){
        $stno = $this->session->userdata('student_no');

        // $user_details =  $this->db->query("SELECT * FROM graduate WHERE student_no = '$stno'");
        // $batch = substr($stno, 0, 4);
        // $found_suggestions = $this->db->query("SELECT * FROM graduate WHERE student_no LIKE '$batch%'");
        
        $batch = substr($stno, 0, 4);
        $existing_connection = array();

        $this->db->select('studentno2');
        $this->db->from('connection');
        $this->db->where('studentno1', $stno);
        $query = $this->db->get();
        
        foreach($query->result() as $element){
            array_push($existing_connection, $element->studentno2);
        }

        $this->db->select('studentno1');
        $this->db->from('connection');
        $this->db->where('studentno2', $stno);
        $query = $this->db->get();
        
        foreach($query->result() as $element){
            array_push($existing_connection, $element->studentno1);
        }


        $this->db->select('*');
        $this->db->from('graduate');
        $this->db->where('student_no !=',$stno);
        $this->db->where_not_in('student_no',$existing_connection);
        $this->db->like('student_no', $batch, 'after');
        $this->db->limit(50);
        $query=$this->db->get();

        return $query->result();
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