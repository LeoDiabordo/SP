<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_index extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_index');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('../controllers/c_user');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in'))
        {
            redirect('/c_user/home','refresh');

//            $res = $this->m_index->login();
//            $data['user'] = $res;
//            $data['posts'] = $this->m_index->get_posts();
//            
//            $this->load->view('v_header');
//            $this->load->view('v_user', $data);
//            $this->load->view('v_footer');
        }
        else{
            $this->load->view('v_header');
            $this->load->view('v_body');
            $this->load->view('v_footer');
        }
    }

    function login(){
        $res = $this->m_index->login();
        if($res)
        {
            redirect('/c_user/home','refresh');
        }
            redirect('/c_index/','refresh');

    }
    
    function logout(){
		$this->session->sess_destroy();	
		redirect('/c_index/','refresh');	
	}
    
}