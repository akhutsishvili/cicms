<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cms_input_generator_m
 *
 * @author alex
 */
class Cms_input_m extends CI_Model {
    
    function type_text($column , $value) {
        $input = form_input($column , $value , "class=form-control");
        return grid_span($input , 11);
    }
    
    
    
    
}
