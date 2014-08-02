<?php
class User extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('user_m');
    //$this->load->model('useractions_m');
    $this->load->library('General');
	  
    $data;
  }


  function index(){
    // do stuff if you need
  }




  // cms login
  function cmslogin(){

    $this->load->helper('form');
    if($this->session->userdata('cms_logged')=='true')
      redirect('cms/dashboard');
    if($this->session->userdata('cms_logged')!='true'){
      if($_POST['user'] and $_POST['pass']){
	//$this->load->library('encrypt');
	  $u = $_POST['user']; // user is admin
	$p = my_encryption($_POST['pass']); // pass is devadmin
	$res = $this->db->get_where('cms_users' , array('username' => $u , 'password' => $p))->result_array();
	if($res){
	  $this->session->set_userdata('cms_logged','true');
	  redirect('cms/dashboard');
	}
	else
	  $data['messege'] = "<script>alert('სახელი ან პაროლი არასწორია')</script>";
      }//if user and pass are set

    }// you are not logged
    $this->load->view('cms/login',$data);
    
  }


  function logout(){
    $this->session->sess_destroy();
    redirect('user/cmslogin');
  }





} // user class
