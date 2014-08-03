<?php

class Core_m extends CI_Model {

    function get_table_config($table_name) {
        return $this->config->item($table_name, 'config');
    }
    

    function table_list_navbar() {
        $config = $this->get_table_config('tables');
        $dont_show = $this->get_table_config('ignore_tables');
        $q = $this->db->query('SHOW TABLES')->result_array();
        $db_name = $this->db->database;
        foreach ($q as $r) {
            if (!in_array($r['Tables_in_' . $db_name], $dont_show)) {
                $table_name = $r['Tables_in_' . $db_name];
                $table_config = $config[$table_name];
                $icon = "<span class='".$table_config['icon']."'></span> ";
                $t[] = anchor('cms/view/' . $table_name, $icon.$table_config['label']);
            }
        }
        return $t;
    }

    function describe($table, $ret = 'Field') {
        $retArr = array();
        $query = $this->db->query("DESCRIBE `$table`")->result_array();
        foreach ($query as $row) {
            $retArr[] = $row[$ret];
        }
        return $retArr;
    }

    function get_last_id($table) {
        $q = car($this->db->query("SHOW TABLE STATUS WHERE `Name` = '$table'")->result_array());
        return $q['Auto_increment'];
    }

    function id_title($table) {
        return car($this->describe($table));
    }

    function gen_cms_table($query, $table, $showCols) {
        // query is result from database
        // table is used table name
        // show cols are columns that used to be shown
        for ($i = 0; $i < sizeof($query); $i++) {
            foreach ($showCols as $k => $v) {// k stands for key
                $rid = $query[$i][$this->core_m->id_title($table)];
                // $rid is table id name

                if($this->is_relational($k , $table)){
                    $query[$i][$k] = $this->get_relation_value($k, $query[$i][$k] , $table);
                }
	
                // strips tags from value and limits 30 chars
                $t[$i][$k] = character_limiter(strip_tags($query[$i][$k]), 30);

            }//end foreach
            $t[$i]['edit'] = anchor('cms/form/' . $table . '/' . $rid, '<span class="glyphicon glyphicon-pencil"></span>');
            // put script in link
            if($this->utils_m->column_attr('tables',$table , 'row_lock') != true)
                $t[$i]['delete'] = anchor('cms/delete/' . $table . '/' . $rid, '<span class="glyphicon glyphicon-remove-sign"></span>');
        }//end for
        return $t;
    }

    //end gen cms

    function is_relational($col , $table){
        /* if column you are calling is relational */
        $t = $this->config->item($table, 'config');
        if($t[$col]['relation'])
            return 1;

        return 0;
    }

    function get_relation_value($col , $val ,$table){
        $t = $this->config->item($table, 'config');
        $rel = $t[$col]['relation'];
        $rel_col = $t[$col]['relation_column'];
        return car($this->db->select($rel_col)->from($rel)->where('id' , $val)->get()->result_array() , $rel_col);
    }

    function generate_note($table, $column, $val) {
        $config = $this->get_table_config($table);
        $config = $config[$column];
        $note = $config['note'];
        if ($note) {
            return  "<span class='well well-sm'>" . $note . "</span>";
        }
    }

    function generate_input_forms($table, $column, $value = NULL) {
        $this->load->model('cms_input_m');
        
        $input_config = $this->get_table_config($table);
        $input_type = $input_config[$column]['type'];

        if ($input_type == 'text') {
            return $this->cms_input_m->type_text($column , $value);
        }
        elseif ($input_type == 'hidden') {
            return form_hidden($column, $value);
        }
        elseif ($input_type == 'dropdown') {
            $list = $input_config[$column]['list'] ? $input_config[$column]['list'] : NULL;
            if ($list) {
                return form_dropdown($column, $list, $value , "class='form-control'");
            } 
            else {
                $relation = $input_config[$column]['relation'];
                if ($relation) {
                    $relation_column = $input_config[$column]['relation_column'];
                    $query = $this->db->from($relation)->order_by($relation_column, 'asc')->get()->result_array();
                }
                if ($query) {
                    foreach ($query as $r) {
                        $list[$r['id']] = $r[$relation_column];
                    }
                    return form_dropdown($column, $list, $value,"class='form-control'");
                }
            } // if list is not set in configuration
        }// dropdown
        elseif ($input_type == 'date') {
            $t = ' <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"> <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script> <script> $(function() {$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });;}); </script>';
            return $t.form_input($column, $value, 'id="datepicker" class="form-control"');
        }
        elseif ($input_type == 'textarea') {
            return form_textarea($column, $value, 'class="ckeditor"');
        } 
        elseif ($input_type == 'bool') {
            if ($value == 1) {
                $boolval_yes = true;
                $boolval_no = false;
            }
            if ($value == 0 || !$value) {
                $boolval_yes = false;
                $boolval_no = true;
            }
            return form_radio($column, 1, $boolval_yes) . " YES | " . form_radio($column, 0, $boolval_no) . " NO";
        } // end bool block
        elseif ($input_type == 'file') {
            return form_upload($column, NULL);
        } 
    }

    // generate_input_forms

    function get_key_label($table, $key = NULL, $is_visible = NULL) {
        // if key is sets.gives you config of that key
        // else will give whole table key array
        $t = $this->config->item($table, 'config');
        
        if ($key) {
            return $t[$key]['label'];
        }
        else {
            $columns = $this->describe($table);
            foreach ($columns as $c) {
                if ($is_visible) {
                    $is_col_visible = $t[$c]['visible'];
                    if ($is_col_visible) {
                        $labels[$c] = $t[$c]['label'];
                    }
                } 
                else {
                    $labels[$c] = $t[$c]['label'];
                }
            }// foreach
            return $labels; // return labels 
        } // else
    }

    // get_label

    function generate_filter($table_name, $key) {
        $table_conf = $this->config->item($table_name, 'config');
        $input_type = $table_conf[$key]['type'];
        $is_visible = $table_conf[$key]['visible'];
        $label = $table_conf[$key]['label'];
        if ($is_visible) {
            if ($input_type == 'text' || $key == "id") {
                $label_input = lab($label) . form_input($key, '', 'class="form-control"');
            }
            if ($input_type === 'dropdown') {
                if ($table_conf[$key]['list']) {
                    $label_input = lab($label) . br() . form_dropdown($key, $table_conf[$key]['list'], " ","class=form-control input-group");
                }
                if ($table_conf[$key]['relation']) {
                    $relation_column = $table_conf[$key]['relation_column'];
                    $vals = $this->db->from($table_conf[$key]['relation'])->order_by($relation_column, 'asc')->get()->result_array();
                    $label_input = lab($label) . br() . gen_dropdown($key, $vals, $relation_column, NULL, "class=form-control input-group");
                }
            }
        }// is visible
        if ($label_input) {
            return '<div class="col-md-3">' . $label_input . '</div>';
        }
    }

} // END CLASS


