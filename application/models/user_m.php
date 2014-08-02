<?php
class User_m extends CI_Model {


  function validate_user($table = 'users') {
    //just general purpose validation
    //table name argument says in what table look for user

    //$_POST['email'] = 'alex@mail.com';
    //$_POST['password'] = '123';
    
    if ($_POST) {
      $_POST['password'] = my_encryption($_POST['password']);
      $q = car($this->db->get_where($table, $_POST)->result_array());


      // START TEST
      $this->unit->run($q, isset($q) , 'CAN NOT VALIDATE USER');
      echo $this->unit->report();
      // END TEST


      if($q){
	$q = json_encode($q);
	return $q;
      }
    } // if($_POST)
  }

  function register()
  {
    /*
      data is send by $_POST
      and validates

      
     */
    

    $this->load->library('form_validation');
    $this->form_validation->set_rules('first_name', 'firstname', 'required');
    $this->form_validation->set_rules('last_name', 'lastname', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation','required|matches[password]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('confemail', 'Email Conf', 'required|valid_email|matches[email]');
    $this->form_validation->set_rules('personalID', 'personal id', 'required|exact_length[11]');


    if ($this->form_validation->run() == FALSE){
      echo json_encode(array("result" => validation_errors())); 
    }
    else{
      $ins['email'] = "lorem@example.com";
      $ins['password'] = my_encryption('123');
      if($this->db->insert('users',$ins))
	echo json_encode(array("result" => 'user was inserted')); 
    }
    
  } // END register




  function set_user_password($userid , $table = 'users'){
    // sets user username and password
    $this->db->where('id',$userid);
    $query_status = $this->db->update($table,array(
						   'password' => my_encryption($_POST['password']) ,
						   'username' => $_POST['username']
						   ));
    return _ret($query_status);
  }



  function get_user_id($key = 'userid'){
    if($key == 'shop')
      return $this->session->userdata('shop_user_id');
    if($key == 'provider')
      return $this->session->userdata('package_user_id');
  }
  
  function get_user($userid,$table = 'users'){
    return car($this->db->get_where($table,array('id' => $userid))->result());
  }

  function check_user_ballance($userid) {
    //checks user ballance.
    //if user has on ballance returns ballance number
    //if ballance has gone bellow 0 it sets ballance on 0 and sets user status 'out of ballance'
    $user = car($this->db->get_where('package_users', array('id' => $userid))->result());
    if($user)
      $package = car($this->db-> get_where('packages', array('id' => $user->id))->result());
    else
      return 'no such user';
    if($this ->general->day_range($user ->activation_date) < 0)
      return 'service in not active yet';
    else {
      $days_from_activation = $this ->general->day_range($user->activation_date);
      if ($days_from_activation > 0) {
	$cost_per_day = round($package ->costPerMonth/30.5 , 2);
	$curr_ballance = $user->ballance - ($days_from_activation * $cost_per_day);
	if ($curr_ballance < 0) {
	  $this->db->where('id', $userid);
	  $this->db->update('package_users', array(
						   'ballance' => 0,
						   'package_status' => 'out of ballance'
						   ));
	  return 'out of ballance';
	  // user gets out of ballance
	}
	return $curr_ballance;
      }
    } // if servise is active
  }// check_user_ballance

  function pause_package($userid) {
    $user = car($this->db->get_where('package_users', array('id' => $userid))->result());
    $activation_date = $user->activation_date;
    date_default_timezone_set('America/Los_Angeles');
    if(!isset($user->last_paused))
      $user->last_paused = date("Y-m-d");
    $activation_year = car(explode('-', $activation_date));
    if ($this->general->if_leap_year($activation_year))
      $days_in_year = 366;
    else
      $days_in_year = 365;
    if ($this->general->day_range($activation_date) >= $days_in_year) {
      $this ->db->where('id', $userid);
      $this->db->update('package_users', array('pausedDays' => 30));
    }
    if ($user->ballance < 0) 
      return 'you are out of ballance';
    if ($user->package_status != 'active')
      return 'your package is not active';
    if ($user->pausedDays <= 0)
      return 'you cant pause package anymore';
    $this->db->where('id', $userid);
    $this->db->update('package_users', array('package_status' => 'paused','last_paused' => $user->last_paused));
    return 'package paused sucsessfully';
  
  }// pause package

  /*
    function check_package_status($userid){
    $user = car($this->db->get_where('package_users', array('id' => $userid))->result());
    if($user){
    if($user->pausedDays < 1)
    return 0;
    if($user->package_status != 'active')
    return 0;
    else
    return 1;
    }
    else
    return 0;
    }

    function unpause_package($userid) {
    $user = car($this->db->get_where('package_users', array('id' => $userid))->result());
    if ($user->package_status == 'paused') {
    $days_from_pause = $this->general->day_range($user->last_paused);
    $days_remaning = $user->pausedDays - $days_from_pause;
    $this->db->where('id', $userid);
    $this->db->update('package_users', array('pausedDays' => $days_remaning, 'package_status' => 'active'));
    return 1;
    // means that internet was paused sucsessfully
    }
    else
    return 0;
    }
  */

  /*
    function item_price_by_status($itemid,$userid){
    // returns item new price 
    // according to sale user status
    $user = car($this->db->get_where('shop_users',array('id' => $userid))->result_array());
    if($user['fk_status']){
    $this->load->model('products_m');
    $status = car($this->db->get_where('sale_status',array('id' => $user['fk_status']))->result_array());
    $brands = json_decode($status['brands']);
    $categories = json_decode($status['categories']);
    $item = car($this->db->get_where('shop_items',array('id' => $itemid))->result_array());
    // check if sale status covers brand
    foreach($brands as $r){
    if($r->key == $item['brand'])
    return $this->products_m->calc_item_sale($item['price'],$r->value);
    }
    // check if sale status covers category
    foreach($categories as $r){
    if($r->key == $item['category'])
    return $this->products_m->calc_item_sale($item['price'],$r->value);
    } 
    } // if user has status
    else
    return 0;
    } // item_price_by_status
  */
}


