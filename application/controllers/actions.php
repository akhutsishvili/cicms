<?php
class Actions extends CI_Controller {


  
    function setlang($lang = 'geo'){
	$this->session->set_userdata('lang',$lang);
	redirect($_SERVER['HTTP_REFERER']);
      

    }
  
    function send_mails(){
	$list = $this->db->get('maillist')->result_array();
	foreach ($list as $address)
	    {
		//$this->email->clear();
		//$this->email->mailtype('html');
		$this->email->from('noreply@example.com','No Reply');
		$this->email->to($address['mail']); 
		$this->email->subject('Message from example');
		$this->email->message($_POST['mailbody']);
         
		if($this->email->send())
		    print('to . '.$address);
  		
	    }
	echo heading('მეილები გაგზავნილია',2).br();
    }//end mail list

    function file_upload($id,$table){
	$this->load->library('upload');

    
	if(!is_dir(base_url().'uploads'))
	    mkdir(base_url().'uploads');
	if(!is_dir(base_url().'uploads/'.$table))
	    mkdir(base_url().'uploads/'.$table);
	if(!$id)
	    $id=$this->core_m->get_last_id($table);
	$config['upload_path'] = './uploads/'.$table.'/'.$id.'/';
	mkdir($config['upload_path'],0777);
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']	= '91024';
	$config['max_width']  = '91024';
	$config['max_height']  = '9768';

	foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
	    {
		if (!empty($fileObject['name']))
		    {
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($fieldname))
			    {
				$data['errors'] = $this->upload->display_errors();
				die($config['upload_path'].print_r($data['errors'],true));
			    }
			else
			    {
				//$this->image_manip($config['upload_path'],$fileObject['name']);
			    }
		    }//if(!empty)
		else
		    return 1;
	    }//foreach
    }//file_upload($id)
  


  }
