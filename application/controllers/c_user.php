<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_user extends CI_Controller 
{
    var $data;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->data['user'] = $this->m_user->get_details();
    }
    
    function index(){
        if($this->session->userdata('logged_in')){


            $data = $this->data;
            $data['posts'] = $this->m_user->get_posts();
            
            $this->load->view('v_userheader', $data);
            $this->load->view('v_user');            
            $this->load->view('v_footer');
            
            if(!$data['user'][0]['email']){
                redirect('c_user/initialize_info','refresh');
            }

        }
        else  
            redirect('c_index','refresh');
    }

    function initialize_info(){
        $data = $this->data;
        $data['list']=$this->m_user->getCountry();
        
        $this->load->view('v_userheader', $data);
        $this->load->view('v_init_info');
        $this->load->view('v_footer');
    }

    function add_info(){
        $id = $this->session->userdata('student_no');


        $fname = $this->input->post('grad-first-name');
        $lname = $this->input->post('grad-last-name');
        $mname = $this->input->post('grad-mid-name');
        $sex = $this->input->post('grad-sex');
        $bdate = $this->input->post('grad-bdate');
        $email = $this->input->post('grad-email');
        $mobileno = $this->input->post('grad-mobile');
        $telno = $this->input->post('grad-tel');
        $curaddcountrycode = $this->input->post('country');
        $curaddprovincecode = $this->input->post('state');

        $country = $this->m_user->get_country_name($curaddcountrycode);
        $state = $this->m_user->get_state_name($curaddprovincecode);

        $user_data = array(
           'firstname' => $fname,
           'lastname' => $lname,
           'midname' => $mname,
           'sex' => $sex,
           'bdate' => $bdate,
           'email' => $email,
           'mobileno' => $mobileno,
           'telno' => $telno,
           'curaddcountry' => $country,
           'curaddprovince' => $state,
           'curaddprovincecode' => $curaddprovincecode,
           'curaddcountrycode' => $curaddcountrycode
        );
        
        $this->m_user->initialize_info($id ,$user_data);
        redirect('/c_user/update_information/','refresh'); 
    }

    function create_post(){
        $this->m_user->create_post();
        redirect('/c_user/','refresh');	

    }
    
    function logout(){
		$this->session->sess_destroy();	
		redirect('/c_index/','refresh');	
	}
    
    function update_information(){
        $data = $this->data;
        $data['list']=$this->m_user->getCountry();

        
        $this->load->view('v_userheader', $data);
        $this->load->view('v_userinfo');
        $this->load->view('v_footer');
    }
    
    function add_connection(){
        $data = $this->data;

        $data['suggestions'] = $this->m_user->get_suggestions2();
        $data['smart_suggestions'] = $this->m_user->get_suggestions();
        
        $this->load->view('v_userheader', $data);
        $this->load->view('v_addconnection');
        $this->load->view('v_footer');
    }

    function add(){
        $data = $this->data;
        $stno = $this->session->userdata('student_no');
        $stno2 = $_GET['stno2'];

        $this->m_user->add_connection($stno, $stno2);

        redirect('/c_user/add_connection','refresh');
    }

    function add_experience(){
        $data = $this->data;
        $stno = $this->session->userdata('student_no');


        $name = $this->input->post('exp-company-name');
        $caddcountrycode = $this->input->post('country');
        $caddprovincecode = $this->input->post('state');
        $type = $this->input->post('exp-company-type');

        $country = $this->m_user->get_country_name($caddcountrycode);
        $state = $this->m_user->get_state_name($caddprovincecode);

        $companynumber = $this->m_user->get_companyno($name, $country, $caddcountrycode, $state, $caddprovincecode, $type);

        $position = $this->input->post('exp-job-position');
        $title = $this->input->post('exp-job-title');
        $salary = $this->input->post('exp-job-salary');
        $empstat = $this->input->post('exp-job-type');
        $datestart = $this->input->post('exp-job-start');
        $dateend = $this->input->post('exp-job-start');

         $user_data = array(
           'studentno' => $stno,
           'companyno' => $companynumber,
           'position' => $position,
           'salary' => $salary,
           'employmentstatus' => $empstat,
           'workdatestart' => $datestart,
           'workdateend' => $dateend
        );

         // var_dump($user_data);
        $this->m_user->add_experience($user_data);
        redirect('/c_user/update_information','refresh'); 
    }

    function add_education(){
        $data = $this->data;
        $stno = $this->session->userdata('student_no');

        $name = $this->input->post('educ-school-name');
        $saddcountrycode = $this->input->post('educ_country');
        $saddprovincecode = $this->input->post('educ_state');

        $country = $this->m_user->get_country_name($saddcountrycode);
        $state = $this->m_user->get_state_name($saddprovincecode);

        $schoolnumber = $this->m_user->get_schoolno($name, $country, $saddcountrycode, $state, $saddprovincecode);

        $level = $this->input->post('educ-school-level');
        $course = $this->input->post('educ-course');
        $graduate = $this->input->post('educ-grad');
        $batch = $this->input->post('educ-batch');
        $class = $this->input->post('educ-class');
        // $class=intval($class);
        // var_dump($class);

         $user_data = array(
           'studentno' => $stno,
           'schoolno' => $schoolnumber,
           'batch' => $batch,
           'class' => $class,
           'level' => $level,
           'graduate' => $graduate,
           'course' => $course
        );

         // var_dump($user_data);
        $this->m_user->add_education($user_data);
        redirect('/c_user/update_information','refresh'); 
    }

    function add_project(){
        $data = $this->data;
        $stno = $this->session->userdata('student_no');

        $title = $this->input->post('proj-title');
        $desc = $this->input->post('proj-desc');
        $start = $this->input->post('proj-start');
        $end = $this->input->post('proj-end');

        $user_data = array(
           'studentno' => $stno,
           'project_title' => $title,
           'projectdesc' => $desc,
           'projectdatestart' => $start,
           'projectdateend' => $end
        );

        $this->m_user->add_project($user_data);
        redirect('/c_user/update_information','refresh'); 
    }


    function add_publication(){
        $data = $this->data;
        $stno = $this->session->userdata('student_no');

        $title = $this->input->post('pub-title');
        $desc = $this->input->post('pub-desc');
        $body = $this->input->post('pub-body');
        $date = $this->input->post('pub-date');

        $user_data = array(
           'studentno' => $stno,
           'publicationtitle' => $title,
           'publicationdesc' => $desc,
           'publicationbody' => $body,
           'publicationdate' => $date
        );

        $this->m_user->add_publication($user_data);
        redirect('/c_user/update_information','refresh');
    }





    public function loadData()
     {
       $loadType=$_POST['loadType'];
       $loadId=$_POST['loadId'];
       $result=$this->m_user->getData($loadType,$loadId);
       $HTML="";

       if($result->num_rows() > 0){
         foreach($result->result() as $list){
           $HTML.="<option value='".$list->iso_code."'>".$list->name."</option>";
         }
       }
       echo $HTML;
     }


    function get_school_name(){
        if (isset($_GET['term'])){
        $q = strtolower($_GET['term']);
        $this->m_user->get_school_name($q);
        }
    }

    function get_school_add(){
        if (isset($_GET['term'])){
        $q = strtolower($_GET['term']);
        $this->m_user->get_school_add($q);
        }
    }

    function get_companies_name(){
        if (isset($_GET['term'])){
        $q = strtolower($_GET['term']);
        $this->m_user->get_companies_name($q);
        }
    }

    function get_companies_loc(){
        if (isset($_GET['term'])){
        $q = strtolower($_GET['term']);
        $this->m_user->get_companies_loc($q);
    }

    

    }
    
    
}