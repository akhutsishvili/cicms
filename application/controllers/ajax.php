<?php
class Ajax extends CI_Controller {

    function test(){
	echo "123";
    }

    function get_category_filters(){
	$this->load->helper('form');
      
	$categories = $this->db->from('categories')->order_by('title_geo' , 'desc')->get()->result_array();
	$res = array();
	foreach($categories as $cat){
	    $t['title'] = $cat['title_geo'];
	    $filters = json_decode($cat['filters']);
	    foreach($filters as $z){
		foreach($z as $k => $v){
		    for($i = 0 ; $i < sizeof($v) ; $i++){
			$v[$v[$i]] = $v[$i];
			unset($v[$i]);
		    }
		    $res[$cat['title_geo']][$k] = form_dropdown($k , $v , '' , "category='{$cat['title_geo']}'");
		}
	    }
	}
	echo json_encode($res);
    }


    function apply_category_filters(){
	$this->db->where('id' , $_POST['id']);
	unset($_POST['id']);
	if($this->db->update('items' , $_POST)){
	    echo json_encode(array("result" => "Success"));
	}
    }


} // END CLASS
