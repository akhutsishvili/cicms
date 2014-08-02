<?php
class Unit extends CI_Controller {

  function __construct(){
    parent::__construct();
    print('<b>Unit Test</b><hr>');
    $this->load->library('cart');
    $this->load->model('cart_m');
    $this->load->library('general');
  }


  function __destruct(){
    echo "<hr>";
  }

  function test(){
    $this->load->model('user_m');
    echo $this->user_m->item_price_by_status(1,1);

  }
  
  
  function cart(){

    //$this->cart_m->get_content('shop_items');
    
  }

  function rmc(){
    $t = $this->db->query("DESCRIBE packages")->result_array();
    foreach($t as $r)
      echo $r['Field'].'<br>';
    $this->load->model('core_m');
    $this->core_m->generate_input_forms('packages','id');
  }

}



















