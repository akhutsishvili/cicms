<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mylib {

  public function car($arr,$key=NULL){
    if($key)
      return $arr[0][$key];
    else
      return $arr[0];
  }



  public function checkImg($path){
    print($path);
    //return (file_exists($path) ? $path : 'uploads/noimage.jpg');
  }
  

  function getRandomNews($table,$limit=NULL){
    return $this->db->query("SELECT * FROM $table ORDER BY RAND();")->result_array();
  }

  function img_from_dir($dir)
  {
	  $m = directory_map($dir);
	  echo $m[0];
  }


  
  function addView($id){
    $newsViewed['idArr']=$this->session->userdata('idArr');
    if(!in_array($id,$newsViewed['idArr'])){
      $newsViewed['idArr'][]=$id;
      $tmp=$this->db->get_where('news', array('newsID' => $id),1)->result_array();
      $views=$tmp[0]['iViews']+1;
      $this->db->where('newsID', $id);
      $this->db->update('news', array('iViews'=> $views)); 
    }
    $this->session->set_userdata($newsViewed);
  }

  function fb_meta($name=NULL,$img=NULL){
       $html .= '<meta property="fb:app_id" content="635648919814858" />';
       $html.='<meta property="og:title" content="'.$name.'" />';
       $html.='<meta property="og:image" content="'.$img.'"/>';
	    $html.='<meta property="og:type" content="article"/>';
   	 return $html;
	}//gen fbdesc and meta tags

    
    function generateTree(){
      $html="";
      $parents = $this->db->get_where('cms_menu', array('parentID' => 0))->result_array();
      foreach($parents as $pid){

        $parent=$pid['id'];
        $html.="<div id='mid-$parent'><ul>";

        $childrens= $this->db->get_where('cms_menu', array('parentID' => $pid['id']))->result_array();
        if(count($childrens)==0)$purl=base_url()."index.php/main/filter/".$pid['id'];
        else
         $purl="#";
       $html.="<li class='first-$parent'><a href='$purl'>".$pid['name']."</a></li>";
       foreach($childrens as $cid){
         $url=base_url()."index.php/main/filter/".$cid['id'];
         $html.="<li class='other-$parent'><a href='$url'>".$cid['name']."</a></li>";
       }
       $html.="</ul></div>";
     }
    //$html.="</nav>";
     return $html;
  }//gentree

  public function pre($arr){
    echo "<pre>".print_r($arr,TRUE)."</pre>";
  }

  public function pre_die($arr){
   echo "<pre>".print_r($arr,TRUE)."</pre>";
   die();
 }


  //this is just inserted here.has never been actually used
 public function download(){
        // place this code inside a php file and call it f.e. "download.php"
    $path = base_url()."uploads/entry/$id/"; // change the path to fit your websites document structure
    $fullPath = $path.$fname;
    if ($fd = fopen ($fullPath, "r")) {
      $fsize = filesize($fullPath);
      $path_parts = pathinfo($fullPath);
      $ext = strtolower($path_parts["extension"]);
      switch ($ext) {
        case "pdf":
        header("Content-type: application/pdf"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
      }
      header("Content-length: $fsize");
      header("Cache-control: private"); //use this to open files directly
      while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
      }
    }
    fclose ($fd);
    exit;
    // example: place this kind of link into the document where the file download is offered:
    // <a href="download.php?download_file=some_file.pdf">Download here</a>
  }

  //---------------------------------
  public function string_of_photos($dir){
    //because i`m lazy to use loops everywhere
    $d = directory_map($dir);
    $html='';

    foreach($d as $f){
      $html.=img($dir.'/'.$f);
    }
    return $html;
  }//end string_of_photos

  
  public function ls($geo,$eng){
    $CI =& get_instance();
    $cur_lang = $CI->session->userdata('lang');
    if($cur_lang == 'geo')
      return $geo;
    if($cur_lang == 'eng')
      return $eng;

  }

  // have some problems with $CI object
  public function resize($path, $file){
    if(file_exists($path.$file)){
      $config['image_library']   = 'gd2';
      $config['source_image']    = $path.$file;
      $config['maintain_ratio']  = TRUE;
      $config['dynamic_output']  = FALSE;
      $config['new_image']= $path.'_'.$file;
      $config['width'] = 800;
      $config['height'] = 600;
      $this->image_lib->initialize($config);
      if(!$this->image_lib->resize()){
        $this->error = $this->image_lib->display_errors();
  // do something with this error
      }
      $this->image_lib->clear();
      //end resize
      unlink($path.$file);
      $config['source_image'] = $path."_".$file;
      $config['new_image'] = $path.$file;
      $config['wm_type'] = 'overlay';
      $config['wm_overlay_path'] = 'water.png';
      $config['wm_hor_offset'] = 30;
      $config['wm_vrtf_offset'] = 30;
      $this->image_lib->initialize($config);
      
      $this->image_lib->watermark();
      
      $this->image_lib->clear();
      unlink($path."_".$file);
    }//end if
  }  //end resize photos

  function month_to_word($m)
  {
    $m_geo = array(0,'იან','თევ','მარტი','აპრ','მაი','ივნ','ივლ','აგვ','სექ','ოქტ','ნოე','დეკ');
    $m_eng = array(0,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    return $this->ls($m_geo[$m],$m_eng[$m]);
  }

  function format_date($date)
  {
    $date = date_parse($date);
    return "<div class='formatDate'><p>".$this->month_to_word($date['month'])."</p><p>".
    $date['day']."</p><p>".$date['year'].
    "</p></div>";
  }

  public function line_div($color,$width)
  {
    if($width)
      $w = 'width:'.$width;
    return "<div style='border-bottom: 1px solid #EEEEEE;
    height: 1px;
    margin-left: -40px;
    width: 775px;
    margin-top:20px;'></div>";
  }

} 