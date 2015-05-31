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

    function add_connection_search()
    {
        $id = $this->session->userdata('student_no');


        $search = $this->input->post('add_connection_search');
        if(!$search=="")
          $data = $this->m_user->search($search);
        else
          $data['results'] = NULL;
        // var_dump($data);
        $this->add_connection_results($data);
    }

    function add_connection_results($data){
        $data += $this->data;

        $data['suggestions'] = $this->m_user->get_smart_suggestions();
        $data['smart_suggestions'] = $this->m_user->get_suggestions();

        //$data['smart_suggestions'] = $this->m_user->get_suggestions();
        // var_dump($data);
        $this->load->view('v_userheader', $data);
        $this->load->view('v_addconnection');
        $this->load->view('v_footer');
    }

    /*function upload_image(){

      $file_element_name = 'FileInput';
      
          $config['upload_path'] = './uploads/';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = 1024 * 8;
          $config['encrypt_name'] = TRUE;
      
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
              echo "here1";

      
          if (!$this->upload->do_upload($file_element_name))
          {
              $status = 'error';
              $msg = $this->upload->display_errors('', '');
              echo $msg;
          
          }
          else
          {
              $data = $this->upload->data();
              $this->m_user->upload_image($data['file_name']);
              echo "here";
              redirect('c_user', $data);
             
          }
          @unlink($_FILES[$file_element_name]);
          echo $_FILES[$file_element_name];
      
    }*/

    /*function upload_image(){


           $j = 0; //Variable for indexing uploaded image 
    $filenames=array();
  $target_path = "./images/"; //Declaring Path for uploaded images
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $filenames[$i]=md5(uniqid())."." . $ext[count($ext) - 1];
    $target_path = $target_path . $filenames[$i];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
    if (($_FILES["file"]["size"][$i] < 10000000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                //echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                echo $target_path;
            } else {//if file was not moved.
                 echo $target_path;
            }
        } else {//if file size and file type was incorrect.
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
    //print_r($filenames);
      if(isset($filenames)){
        $photo_file=implode(",",$filenames);
      } else{
        $photo_file="";
      }
      $this->m_user->upload_image($photo_file);
      redirect('c_user', 'refresh');
    }*/

    public function upload_image(){
      $config['upload_path'] = "./uploads/";
      $config['allowed_types'] = 'jpg|jpeg|png';
      $this->load->library('upload',$config);

      if(!$this->upload->do_upload()){
        $error = array('error'=>$this->upload->display_errors());
      }
      else{
        $file_data = $this->upload->data();
        $imagepath = base_url().'./uploads/'.$file_data['file_name'];
        $this->m_user->add_image($imagepath);
      }
      redirect('c_user/profile', 'refresh');

    }





    function profile(){
      $data = $this->data;
      $data['profile'] = $this->m_user->get_profile();

      $this->load->view('v_userheader', $data);
      $this->load->view('v_profile');            
      $this->load->view('v_footer');
    }
    
    function home(){
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

    public function index(){
      define('APP_SECRET','isTdRsjIj3GTEMI6kMD0');
      define('APP_URL','https://www.uplbosa.org/legacy/oneauth?code=onlineyearbook');
      $details="";
      if(!isset($_GET['auth']));
        $this->logout();

      $auth = $_GET['auth'];
      if ($auth) {
        $options = array(
          'http'=>array(
            'method'=>"POST",
            'header'=>
              "Accept-language: en\r\n".
              "Content-type: application/x-www-form-urlencoded\r\n",
            'content'=>http_build_query(
                array(
                    'code'=>$auth,
                    'hash'=>md5($auth. ' ' . APP_SECRET) # ensure that server is communicating with an authorized client
                ),'','&'
            )
        ));
        $context = stream_context_create($options);
        $output = @file_get_contents(APP_URL,false,$context);
        $output = json_decode($output,true);

        if (!$output['data']) {
          redirect('https://www.uplbosa.org/legacy/oneauth?code=onlineyearbook');
        }
        else{
          $array = (array) $output['data'];
          //echo 'Successfully received the following data:<br /><br />';
          foreach ($array as $k=>$v) {
            //echo $k.': '.$v.'<br />';
            $details=$details.$v."=";
          }
          //echo '<br /><br />This authentication code ('.$auth.') will only work once. When this page is reloaded, the server will no longer return the above data.';
          //echo $details;
          $info=explode("=", $details);
          $exists=$this->m_user->user_exists($info[1]);
          
          //var_dump($userdata);
          if($exists){
            $userdata = array(
              'logged_in' => true,
              'student_no' => $info[1]
              );
            $this->session->set_userdata($userdata);


        
            $data = $this->data;
            if(!$data['user'][0]['email']){
                redirect('c_user/initialize_info','refresh');
            }

            $data['posts'] = $this->m_user->get_posts();
            
            $this->load->view('v_userheader', $data);
            $this->load->view('v_user');            
            $this->load->view('v_footer');
          }
          else{
            $new_account = $this->m_user->add_new_account($info);

            $userdata = array(
              'logged_in' => true,
              'student_no' => $info[1]
              );
            $this->session->set_userdata($userdata);

            $data = $this->data;
            redirect('c_user/initialize_info','refresh');
          }


          //     $this->user_model->insert_account_student($info[1], $info[0]);
          //     $userData = $this->user_model->get_user_data_stud($info[1]);
          //     $sessionData = array(
          //     'loggedIn' => true,
          //     'id' => $userData[0]->google_id,
          //     'userType' => $userData[0]->user_type,
          //     'status' => $userData[0]->status,
          //     'username' => $userData[0]->google_name
          //     );
  
          //   $this->session->set_userdata($sessionData);
          // }
          //redirect('c_user/initialize_info', $);
          
        }

      } else {
        //echo 'Please login first via OSAM.';
      }
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
        $data['histExp']=$this->m_user->getWork();

        $this->load->view('v_userheader', $data);
        $this->load->view('v_userinfo');
        $this->load->view('v_footer');
    }
    
    function add_connection(){
         $data = $this->data;

        $data['suggestions'] = $this->m_user->get_smart_suggestions();
        $data['smart_suggestions'] = $this->m_user->get_suggestions();

        //$data['smart_suggestions'] = $this->m_user->get_suggestions();
        // var_dump($data);
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
        $currentjob = $this->input->post('exp-current');
        $datestart = $this->input->post('exp-job-start');
        $dateend = $this->input->post('exp-job-start');
        

         $user_data = array(
           'studentno' => $stno,
           'companyno' => $companynumber,
           'position' => $position,
           'salary' => $salary,
           'employmentstatus' => $empstat,
           'currentjob' => $currentjob,
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