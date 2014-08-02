<?php
class Utils_m extends CI_Model {
  
  function get_config($table = NULL){
    $this->config->load('cms/config');
    return $this->config->item($table,'config');
  }

  function column_config($table , $col){
    $table_conf = $this->get_config($table);
    return $table_conf[$col];
  } // END input_is_json

  
  function column_attr($table , $col , $attr){
    $column_conf = $this->column_config($table,$col);
    return $column_conf[$attr];
  } // END input_is_json
  

  

  function column_tooltip($table , $col){
      $tooltip = $this->column_attr($table , $col , 'tooltip');
      echo $tooltip;
      if($tooltip)
	  $tooltip = "<a class=\"pull-right\" href=\"#\" data-toggle=\"tooltip\" data-original-title=\"{$tooltip}\"><span class=\"glyphicon glyphicon-question-sign\"</span></a>";
      return $tooltip;
  }

  
}
