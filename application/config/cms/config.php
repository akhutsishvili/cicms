<?php

$config['config']['cms_options'] = array ( 
    'uploads_dir' => 'uploads', // relative to index.php ,
    'default_table' => 'test_table'
);

$config['config']['tables'] = array (
    'test_table' => array (
        'label' => 'testing table' ,
        'icon' => 'glyphicon glyphicon-tower' ,
    )


);



// documentation in config.org

$config['config']['test_table'] = array (
    'id' => array (
        'type' => 'hidden', 
        'label' => 'id', 
        'visible' => true
    ),
    'title' => array(
        'type' => 'text',
        'label' => 'test input',
	'visible' => true
    )
);