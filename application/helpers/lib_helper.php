<?php
function lab($arg){					
  return "<label>".$arg."</label>";
}
	
function pre($arr){
  print("<pre>".print_r($arr,TRUE)."</pre>");
		
}

function grid_span($str , $num = 3) {
    return "<span class='col-md-{$num}'>{$str}</span>";
}

function grid_div($str , $num = 3) {
    return "<div class='col-md-{$num}'>{$str}</div>";
}


function car($arr,$key = NULL){
    if ($key) {
        return $arr[0][$key];
    } else {
        return $arr[0];
    }
}

function my_encryption($str){
  return sha1(sha1($str).'239EA2196769368F628C9AE8266B8D97597A1C53');
}


function my_isset($arg){
    if (isset($arg)) {
        return $arg;
    } else {
        return '';
    }
}

function _ret($bool){
  return $bool ? 1 : 0;
}

function first_file($dir){
  $CI = get_instance();
  $CI->load->helper('directory');
  if (is_dir($dir)) {
        return $dir . '/' . car(directory_map($dir));
    } else {
        return 0;
    }
}


function redirect_messege($url,$messege = NULL){
  // in future will add some style
  if (!$messege) {
        $messege = 'You are redirecting.Please Wait 5 Seoncds or lick link bellow';
    }

    header('Content-Type: text/html; charset=utf-8');
  print($messege);
  header( "refresh:5;url=".$url);
} // redirect_message

function gen_dropdown($name , $arr , $label , $value , $attr = ''){
  $CI = get_instance();
  $CI->load->helper('form');
  $list = array('' => ' ');
  foreach ($arr as $item) {
        $list[$item['id']] = $item[$label];
    }
    return form_dropdown($name,$list,$value,$attr);
}