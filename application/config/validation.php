<?php
$config['validation']['order_package'] = array(
					       array(
						     'field'   => 'name',
						     'label'   => 'name',
						     'rules'   => 'required'
						     ),
					       array(
						     'field'   => 'surname',
						     'label'   => 'surname',
						     'rules'   => 'required'
						     ),
					       array(
						     'field'   => 'phone',
						     'label'   => 'phone',
						     'rules'   => 'required'
						     ),
					       array(
						     'field'   => 'email',
						     'label'   => 'email',
						     'rules'   => 'required|valid_emails|is_unique[package_users.email]'
						     ),   
					       array(
						     'field'   => 'personal_id',
						     'label'   => 'personal_id',
						     'rules'   => 'required|exact_length[11]'
						     ),
					       array(
						     'field'   => 'shipping_adress',
						     'label'   => 'shipping_adress',
						     'rules'   => 'required'
						     ),   
					       );


$config['validation']['order_items'] = array(
					       array(
						     'field'   => 'name',
						     'label'   => 'name',
						     'rules'   => 'required'
						     ),
					       array(
						     'field'   => 'surname',
						     'label'   => 'surname',
						     'rules'   => 'required'
						     ),
					       array(
						     'field'   => 'phone',
						     'label'   => 'phone',
						     'rules'   => 'required'
						     ),
					       array(
						     'field'   => 'email',
						     'label'   => 'email',
						     'rules'   => 'required|valid_emails|is_unique[shop_users.email]'
						     ),   
					       array(
						     'field'   => 'personal_id',
						     'label'   => 'personal_id',
						     'rules'   => 'required|exact_length[11]'
						     ),
					       array(
						     'field'   => 'shipping_adress',
						     'label'   => 'shipping_adress',
						     'rules'   => 'required'
						     ),   
					       );

