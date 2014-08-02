<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General {

  public function __construct()
  {
    // Do something with $params
  }

  public function day_range ($date1 = NULL,$date2 = NULL){
    date_default_timezone_set('America/Los_Angeles');
    $date1 = new DateTime($date1);
    if(!$date2)
      $date2 = new DateTime("NOW");
    $interval = $date1->diff($date2);
    return $interval->format('%R%a');
  }


  public function if_leap_year($year){
    date_default_timezone_set('America/Los_Angeles');
    if(date('L', strtotime($year."-01-01")))
      return true;
    else
      return false;
  }


  

  function utf8text($text,$dir="to"){
    $arg=$text;
    $lenght=  strlen($arg);
    $move=TRUE;
    $tmp="";
    $alpha_geo=explode(" ","ა ბ გ დ ე ვ ზ თ ი კ ლ მ ნ ო პ ჟ რ ს ტ უ ფ ქ ღ ყ შ ჩ ც ძ წ ჭ ხ ჯ ჰ A B D E F G H I K L M N O P Q U V X Y");
    $alpha_eng=explode(" ","a b g d e v z T i k l m n o p J r s t u f q R y S C c Z w W x j h A B D E F G H I K L M N O P Q U V X Y");
    if("to"==$dir){
      for ($i=0;$i<=$lenght;$i++){
	if($arg[$i]==="<")
	  $move=FALSE;
	if($arg[$i]===">")
	  $move=TRUE;
	if($move===TRUE)
	  $val .= str_replace($alpha_eng,$alpha_geo,$arg[$i]);
	else
	  $val .= $arg[$i];
      }
		
    }//to
    elseif("from"==$dir)
      $val=str_replace($alpha_geo,$alpha_eng,$arg);
    return $val;
  }
  
} // end general

?>