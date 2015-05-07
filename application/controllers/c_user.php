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

        $country = $this->m_user->get_country_name($this->input->post('country'));
        $country = $country.", ".$this->m_user->get_state_name($this->input->post('state'));

        $user_data = array(
           'firstname' => $fname,
           'lastname' => $lname,
           'midname' => $mname,
           'sex' => $sex,
           'bdate' => $bdate,
           'email' => $email,
           'mobileno' => $mobileno,
           'telno' => $telno,
           'currentaddress' => $country
        );

        $this->m_user->initialize_info($id ,$user_data);
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


        $companynumber = $this->m_user->get_companyno($this->input->post('exp-company-name'));
        $title = $this->input->post('exp-job-title');
        $salary = $this->input->post('exp-job-salary');
        $companytype = $this->input->post('exp-company-type');
        $empstat = $this->input->post('exp-job-type');
        $datestart = $this->input->post('exp-job-start');
        $dateend = $this->input->post('exp-job-start');

        $this->m_user->add_experience($stno);
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
           $HTML.="<option value='".$list->id."'>".$list->name."</option>";
         }
       }
       echo $HTML;
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