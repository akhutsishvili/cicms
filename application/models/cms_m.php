<?php

class Cms_m extends CI_Model {

    function get_table_view($table, $param = 'desc', $page = 0) { //fitler is array
	$this->db->from($table);
	// show content to table
	$query = $this->db->order_by('id','desc')->limit(30, $page)->get()->result_array();
        

	return $this->core_m->gen_cms_table($query, $table, $param);
    }

    //end get_table

    function get_table_entry($table, $id = NULL) { //fitler is array
	return car($this->db->get_where($table, array('id' => $id))->result_array());
    }

    //end get_table

    function image_list($dir, $lst, $i) {
	foreach ($lst as $l) {
	    $h.= '<div class="col-xs-6 col-md-3"><div class="thumbnail">'.
		substr($l,-25)."<span class='glyphicon glyphicon-remove pull-right cms-file-delete' path='".$dir.'/'.$l."'></span>".
		img($dir . '/' . $l).'</div></div>';
	}
	return $h;
    }

    function search_in_table($table) {
	$keys = $this->core_m->describe($table);
	$word = $_POST['word'];
	$this->db->query("SET CHARACTER SET utf8");
	$this->db->query("SET NAMES UTF8");
	$this->db->select()->from($table);
	foreach ($keys as $k) {
	    $this->db->or_like($k, $word);
	}
	/* @var $q array */
	$q = $this->db->get()->result_array();
	$t = $this->config->item($table, 'view');
	return $this->core_m->gen_cms_table($q, $table, $t);
    }

    //end search in table

    function filter_table($table_name, $visible_columns) {
	$this->db->from($table_name);
	foreach ($_POST as $key => $value) {
	    if ($value != NULL)
		$where[$key] = $value;
	}
	$this->db->like($where);
	$query = $this->db->get()->result_array();
	return $this->core_m->gen_cms_table($query, $table_name, $visible_columns);
    }

    public function image_manip($path, $file) {
	echo $path . $file . br();
	//if(file_exists($path.$file)){
	$config['image_library'] = 'gd2';
	$config['source_image'] = $path . $file;
	$config['maintain_ratio'] = TRUE;
	$config['dynamic_output'] = FALSE;
	$config['new_image'] = $path . '_' . $file;
	$config['width'] = 239;
	$config['height'] = 844;
	$this->image_lib->initialize($config);
	if (!$this->image_lib->resize()) {
	    echo $this->error = $this->image_lib->display_errors();
	    // do something with this error
	}
	$this->image_lib->clear();
	//end resize
	/* unlink($path.$file);
	   $config['source_image'] = $path."_".$file;
	   $config['new_image'] = $path.$file;
	   $config['wm_type'] = 'overlay';
	   $config['wm_overlay_path'] = 'water.png';
	   $config['wm_hor_offset'] = 30;
	   $config['wm_vrtf_offset'] = 30;
	   $this->image_lib->initialize($config);

	   $this->image_lib->watermark();

	   $this->image_lib->clear(); */
	unlink($path . $file);
	//}//end if
    }

  }

//end model
