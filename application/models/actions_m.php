<?php

class Actions_m extends CI_Model {

    function send_mails() {

        $list = $this->db->get('maillist')->result_array();
        foreach ($list as $address) {
            //$this->email->clear();
            //$this->email->mailtype('html');
            $this->email->from('noreply@snowplaza.ge', 'No Reply');
            $this->email->to($address['mail']);
            $this->email->subject('Message from snowpalaza');
            $this->email->message($_POST['mailbody']);

            if ($this->email->send())
                print('to . ' . $address);
        }
        echo heading('მეილები გაგზავნილია', 2) . br();
    }

//end mail list

    function file_upload($dir, $table) {

        $this->load->library('upload');
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777);
        }
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }

        $config['upload_path'] = "./" . $dir;
        mkdir($config['upload_path'], 0777);
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '91024';
        $config['max_width'] = '91024';
        $config['max_height'] = '9768';
        foreach ($_FILES as $fieldname => $fileObject) {  //fieldname is the form field name
            if ($fileObject['name']) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname)) {
                    $data['errors'] = $this->upload->display_errors();
                    die($config['upload_path'] . pre($data['errors']));
                } else {
                    //$this->image_manip($config['upload_path'],$fileObject['name']);
                }
            }//if(!empty)
            else {
                return 0;
            }
        }//foreach
    }

//file_upload($id)
}
