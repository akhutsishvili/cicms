<?php

class Cms extends CI_Controller {
    private $data;
    function __construct() {
        parent::__construct();
        //load models
        $this->unit->active(FALSE);
        $this->load->model('cms_m');
        $this->load->model('core_m');
        $this->load->model('utils_m');

        //load librarys
        $this->load->library('table');

        $this->load->library('mylib');

        //load helpers

        $this->load->helper('directory');
        $this->load->helper('text');
        $this->load->helper('form');
        //load config
        //$this->config->load('cms/tables');

        $this->config->load('cms/config');
        if ($this->session->userdata('cms_logged') != 'true') {
            redirect('user/cmslogin');
        }

        $this->data->config = $this->config->item('config');
        $this->data->tables = $this->core_m->table_list_navbar();

    }

    //end copnstruct

    function index() {
        redirect('cms/dashboard');
    }

    function dashboard() {
        redirect('cms/view/'.$this->data->config['cms_options']['default_table']);

        // currently dashboard just redirects.
    }

    //maybe add view by parent_id or something in argument
    function view($table_name, $page = 0) {
        // SETTING TABLE CONFIG
        $table_config = $this->data->config[$table_name];
        $table_columns = array_keys($table_config);
        $visible_columns = $this->core_m->get_key_label($table_name, NULL, true);
        // visible columns in view


        if ($_POST) {
            $query = $this->cms_m->filter_table($table_name, $visible_columns);
        } //model method for get table content.with joins and etc     
        else {
            $query = $this->cms_m->get_table_view($table_name, $visible_columns, $page);
        }
        // generates table with data
        // generate filters



        foreach ($table_columns as $key) {
            $this->data->filters .= $this->core_m->generate_filter($table_name, $key);
        }
        $labels = array();
        foreach ($visible_columns as $key => $value) {
            $labels['asd'][] = $value; //asd is just stupid hack to generate table
        }
        //get data to print

        $table_data = $query ? $labels + $query : $labels;  // if there are entries in table add to labels else only labels

        $tmpl = array('table_open' => '<table id="view-table" class="table table-striped">');
        $this->table->set_template($tmpl);
        $this->data->table_data = $this->table->generate($table_data);
        /*    if($_POST['word'])
              $this->data->table_data = $this->table->generate($labels+$this->cms_m->search_in_table($table_name)); */

        $this->data->table_name = $table_name;
        $this->data->table_label = $this->data->config['tables'][$table_name];
        //load views
        $this->load->view('cms/cms_header', $this->data);
        $this->load->view('cms/cms_navbar');
        $this->load->view('cms/cms_filters');
        $this->load->view('cms/cms_view');
        $this->load->view('cms/cms_footer');
    }

    //end view

    function delete($table_name, $id) {

        $id_col = car($this->core_m->describe($table_name));
        if ($this->db->delete($table_name, array($id_col => $id))) {
            redirect(base_url() . 'index.php/cms/view/' . $table_name);
        }
    }

    //end delete

    function form($table_name, $id = NULL) {// generates form for inserting or editing data
        // SETTING TABLE CONFIG
        $table_config = $this->data->config[$table_name];
        $table_columns = \array_keys($table_config);
        $labels = $this->core_m->get_key_label($table_name);
        $this->data->table_label = $this->data->config['tables'][$table_name];
        // get all labels in table
        $table_result = array(); // variable for storing data to show in form inputs

        if ($id) {// if posted id exsists get whole table data with id
            $table_result = $this->cms_m->get_table_entry($table_name, $id);
        } 
        else {
            // if input is emty it does not generates.
            // this generates emty input (no metter which)
            // sam as previous block
            for ($i = 0; $i < sizeof($table_columns); $i++) {// for every item in table columns
                $table_result[$table_columns[$i]] = '';
            }
            // set value empty
        }
        foreach ($table_result as $k => $val) {//$query as $key => $value
            $this->data->input_forms .= '<span class="col-md-3">' . lab($labels[$k]) . '</span>';
            $this->data->input_forms .= '<span class="col-md-7">' . $this->core_m->generate_input_forms($table_name, $k, $val) .$this->utils_m->column_tooltip($table_name , $k). '</span>';
            $this->data->input_forms .= $this->core_m->generate_note($table_name, $k, $val);
            $this->data->input_forms .= "<br clear='all'><hr/>";
        }
        $uploads_dir = $this->data->config['cms_options']['uploads_dir'];

        $dir = "{$uploads_dir}/{$table_name}/" . $id;
        // upload dorectory
        $dir_map = directory_map($dir);
        // get directory tree
        /* @var $q string */
        $this->data->image_list = $this->cms_m->image_list($dir, $dir_map);
        // generate html list of pinned images
        $this->data->table_name = $table_name;

        // load views nigger
        $this->load->view('cms/cms_header', $this->data);
        $this->load->view('cms/cms_navbar');
        $this->load->view('cms/cms_form');
        $this->load->view('cms/cms_footer');
    }

    //end form


    function update($table) {
        //this function stands for updating and inserting rows.
        //if id is not send by POST it will insert sent data.
        $uploads_dir = $this->data->config['cms_options']['uploads_dir'];
        if( ! $uploads_dir)
            die("direcotry {$uploads_dir} does not exist!");
        $id = $_POST['id'];

        $table_cols = $this->core_m->describe($table);


        // gets column names
        if ($_FILES) {
            $this->load->library('image_lib');
            $this->load->model('actions_m');
            $dir_id = $id ? $id : $this->core_m->get_last_id($table);
            if ( ! is_dir("./{$uploads_dir}/" . $table)) {
                mkdir("{$uploads_dir}/" . $table, 0777);
            }
            $dir = "{$uploads_dir}/" . $table . '/' . $dir_id;

            $this->actions_m->file_upload($dir, $table);
            // uploads posted images if one exists
        }
        foreach ($_POST as $k => $v) {
            if (in_array($k, $table_cols)) { // if posted keyword is in database column
                $data[$k] = $v;
            }
        }

        foreach ($table_cols as $col) {
            if ($_FILES[$col]['name']){
                $data[$col] = $_FILES[$col]['name'];
            }

      
        }
        if ($id) {
            $this->db->where('id' , $id);
            // select where id = posted id
            if ($this->db->update($table, $data)) {// if data is inserted
                redirect('cms/view/' . $table);
                // redirect to table page
            }
        }//if id is set
        else {
            $_POST['sort'] = $this->core_m->get_last_id($table);
            // prevents unwanted $_POST variables to be added in db
            if ($this->db->insert($table, $data)) { // insert data
                redirect('cms/view/' . $table); // redirect to the page
            } //end of insert
        } //else
    }
    // end update

    // delete file with ajax request
    function file_remove() {
        $path = $_POST['p'];
        if (file_exists($path) && unlink($path)) {
            print('s');
        } else {
            print('error');
        }
    }

    function ajax_get_table($table_name, $offset) {
        $table_config = $this->data->config[$table_name];
        $table_columns = array_keys($table_config);
        $visible_columns = $this->core_m->get_key_label($table_name, NULL, true);
        // visible columns in view



        $query = $this->cms_m->get_table_view($table_name, $visible_columns, $offset);

        foreach ($table_columns as $key) {
            $this->data->filters .= $this->core_m->generate_filter($table_name, $key);
        }
        $labels = array();
        foreach ($visible_columns as $key => $value) {
            $labels['asd'][] = $value; //asd is just stupid hack to generate table
        }
        //get data to print

        $table_data = $query ? $labels + $query : $labels;  // if there are entries in table add to labels else only labels

        $tmpl = array('table_open' => '<table class="table table-striped">');
        $this->table->set_template($tmpl);
        $this->data->table_data = $this->table->generate($table_data);
        echo $this->data->table_data;
    }

    // ajax_get_table
    function ajax_filter_table($table_name, $offset) {
        $visible_columns = $this->core_m->get_key_label($table_name, NULL, true);
        $filters = json_decode($_POST['filters']);
        $where = array();
        foreach ($filters as $row) {
            $where[$row->key] = $row->value;
        }

        $this->db->from($table_name)->like((Array) $where);
        $q = $this->db->order_by('id', 'desc')->get()->result_array();
        /* @var $table type */
        $query = $this->core_m->gen_cms_table($q, $table_name, $visible_columns);
        foreach ($visible_columns as $key => $value) {
            $labels['asd'][] = $value; //asd is just stupid hack to generate table
        }
        $table_data = $query ? $labels + $query : $labels;  // if there are entries in table add to labels else only labels

        $tmpl = array('table_open' => '<table class="table table-striped">');
        $this->table->set_template($tmpl);
        $this->data->table_data = $this->table->generate($table_data);
        echo $this->data->table_data;
    }

}// end controller


