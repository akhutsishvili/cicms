<?php

$config['config']['cms_options'] = array ( 
				      'uploads_dir' => '../uploads', // relative to index.php ,
				      'default_table' => 'items'
				       );

$config['config']['tables'] = array (
				     'about' => array (
						       'label' => 'ჩვენ შესახებ', 
						       'icon' => 'glyphicon glyphicon-tower'
						       ),
				     'categories' => array (
							    'label' => 'კატეგორიები', 
							    'icon' => 'glyphicon glyphicon-tower'
							    ),
				     'brands' => array (
							'label' => 'ბრენდები', 
							'icon' => 'glyphicon glyphicon-tower'
							),
				     'cities' => array (
							'label' => 'ქალაქები', 
							'icon' => 'glyphicon glyphicon-tower'
							),
				     'comments' => array (
							  'label' => 'კომენტარები', 
							  'icon' => 'glyphicon glyphicon-tower'
							  ),
				     'contact' => array (
							 'label' => 'კონტაქტი', 
							 'icon' => 'glyphicon glyphicon-tower'
							 ),
				     'items' => array (
						       'label' => 'კატალოგი', 
						       'icon' => 'glyphicon glyphicon-tower'
						       ),
				     'promocodes' => array (
							    'label' => 'პრომო კოდები', 
							    'icon' => 'glyphicon glyphicon-tower'
							    ),
				     'orders' => array (
							'label' => 'შეკვეთები', 
							'icon' => 'glyphicon glyphicon-tower'
							),
				     'users' => array (
						       'label' => 'მომხმარებლები', 
						       'icon' => 'glyphicon glyphicon-tower'
						       ),
				     'options' => array (
						       'label' => 'სხვა', 
						       'icon' => 'glyphicon glyphicon-tower' ,
						       'row_lock' => true ,
						       'help' => array (
									'value' => 'the html helping text'
									)
						       ),
				     'maillist' => array (
							  'label' => 'mail' ,
							  'icon' => 'glyphicon glyphicon-tower' ,
							  )


				     );



// documentation in config.org

$config['config']['about'] = array (
				    'id' => array (
						   'type' => 'hidden', 
						   'label' => 'id', 
						   'visible' => true
						   ),
				    'body_geo' => array (
							 'type' => 'textarea', 
							 'label' => 'ქართ', 
							 'visible' => true
							 ),
				    'body_eng' => array (
							 'type' => 'textarea', 
							 'label' => 'ინგ', 
							 'visible' => false
							 ),
				    'body_rus' => array (
							 'type' => 'textarea', 
							 'label' => 'რუს', 
							 'visible' => false
							 )
				    );

$config['config']['contact'] = array (
				      'id' => array (
						     'type' => 'hidden', 
						     'label' => 'id', 
						     'visible' => true
						     ),
				      'body_geo' => array (
							   'type' => 'textarea', 
							   'label' => 'ქართ', 
							   'visible' => true
							   ),
				      'body_eng' => array (
							   'type' => 'textarea', 
							   'label' => 'ინგ', 
							   'visible' => false
							   ),
				      'body_rus' => array (
							   'type' => 'textarea', 
							   'label' => 'რუს', 
							   'visible' => false
							   ),
				      'lat' => array (
						      'type' => 'text',
						      'label' => 'lat',
						      'visible' => true
						      ),
				      'lng' => array (
						      'type' => 'text',
						      'label' => 'lng',
						      'visible' => true
						      ),
				      'email' => array (
							'type' => 'text',
							'label' => 'ელ-ფოსტა',
							'visible' => true
							)
				      );


$config['config']['categories'] = array (
					 'id' => array (
							'type' => 'hidden', 
							'label' => 'id', 
							'visible' => true
							),
					 'title_geo' => array (
							       'type' => 'text',
							       'label' => 'სახელი ქართ',
							       'visible' => true
							       ),
					 'title_eng' => array (
							       'type' => 'text',
							       'label' => 'სახელი ინგ',
							       'visible' => true
							       ),
					 'title_rus' => array (
							       'type' => 'text',
							       'label' => 'სახელი რუს',
							       'visible' => true
							       ),
					 'filters' => array (
							     'type' => 'text', 
							     'label' => 'ფილტრები', 
							     'visible' => false
							     ),
					 );

$config['config']['brands'] = array (
				     'id' => array (
						    'type' => 'hidden', 
						    'label' => 'id', 
						    'visible' => true
						    ),
				     'title_geo' => array (
							   'type' => 'text',
							   'label' => 'სახელი ქართ',
							   'visible' => true
							   ),
				     'title_eng' => array (
							   'type' => 'text',
							   'label' => 'სახელი ინგ',
							   'visible' => true
							   ),
				     'title_rus' => array (
							   'type' => 'text',
							   'label' => 'სახელი რუს',
							   'visible' => true
							   ),
				     'categoryID' => array (
							    'type' => 'dropdown', 
							    'relation' => 'categories',
							    'relation_column' => 'title_geo',
							    'label' => 'კატეგორია', 
							    'visible' => true
							    ),
				     );


$config['config']['cities'] = array (
				     'id' => array (
						    'type' => 'hidden', 
						    'label' => 'id', 
						    'visible' => true
						    ),
				     'title_geo' => array (
							   'type' => 'text',
							   'label' => 'სახელი ქართ',
							   'visible' => true
							   ),
				     'title_eng' => array (
							   'type' => 'text',
							   'label' => 'სახელი ინგ',
							   'visible' => true
							   ),
				     'title_rus' => array (
							   'type' => 'text',
							   'label' => 'სახელი რუს',
							   'visible' => true
							   )
				     );

$config['config']['comments'] = array (
				       'id' => array (
						      'type' => 'hidden', 
						      'label' => 'id', 
						      'visible' => true
						      ),
				       'name' => array (
							'type' => 'text',
							'label' => 'სახელი ქართ',
							'visible' => true
							),
				       'surname' => array (
							   'type' => 'text',
							   'label' => 'გვარი',
							   'visible' => true
							   ),
				       'body' => array (
							'type' => 'textarea',
							'label' => 'ტექსტი',
							'visible' => true , 
							),
				       'postID' => array (
							  'type' => 'dropdown', 
							  'relation' => 'items',
							  'relation_column' => 'title_geo',
							  'label' => 'ნივთი', 
							  'visible' => true
							  )

				       );

$config['config']['orders'] = array (
				     'id' => array (
						    'type' => 'hidden', 
						    'label' => 'id', 
						    'visible' => true
						    ),
				     'trackingID' => array (
							    'type' => 'text',
							    'label' => 'საიდენთიფიკაციო კოდი',
							    'visible' => true
							    ),
				     'dateTime' => array (
							  'type' => 'date',
							  'label' => 'თარიღი',
							  'visible' => true
							  ),
				     'status' => array (
							'type' => 'dropdown',
							'label' => 'სტატუსი',
							'list' => array (
									 'accepted' => 'Accepted',
									 'In Transit' => 'In Transit',
									 'Delivered' => 'Delivered'
									 ),
							'visible' => true , 
							),
				     'userID' => array (
							'type' => 'dropdown',
							'relation' => 'users',
							'relation_column' => 'id' ,
							'label' => 'მომხმარებელი',
							'visible' => true , 
							),
				     'fee' => array (
							    'type' => 'text',
							    'label' => 'გადასახადი',
							    'visible' => true
							    ),
				     'itemfee' => array (
							    'type' => 'text',
							    'label' => 'ნივთების ღირებულება',
							    'visible' => false
							    ),
				     'transportfee' => array (
							    'type' => 'text',
							    'label' => 'ტრანსპორტირების ღირებულება',
							    'visible' => false
							    ),
				     'itemList' => array (
							      'type' => 'cvs',
							      'relation' => 'items',
							      'label' => 'ნივთები',
							      'visible' => false,
							      ),

				     );



$config['config']['items'] = array (
				    'id' => array (
						   'type' => 'hidden', 
						   'label' => 'id', 
						   'visible' => true
						   ),
				    'title_geo' => array (
							  'type' => 'text',
							  'label' => 'სახელი ქართ',
							  'visible' => true
							  ),
				    'title_eng' => array (
							  'type' => 'text',
							  'label' => 'სახელი ინგ',
							  'visible' => true
							  ),
				    'title_rus' => array (
							  'type' => 'text',
							  'label' => 'სახელი რუს',
							  'visible' => true
							  ),
				    'body_geo' => array (
							 'type' => 'textarea', 
							 'label' => 'ქართ', 
							 'visible' => true
							 ),
				    'body_eng' => array (
							 'type' => 'textarea', 
							 'label' => 'ინგ', 
							 'visible' => false
							 ),
				    'body_rus' => array (
							 'type' => 'textarea', 
							 'label' => 'რუს', 
							 'visible' => false
							 ),
				    'img_cover' => array (
						      'type' => 'file' ,
						      'label' => 'ქოვერი' ,
						      'visible' => false
						      ),
				    'img_1' => array (
						      'type' => 'file' ,
						      'label' => 'სურათი' ,
						      'visible' => false
						      ),
				    'img_2' => array (
						      'type' => 'file' ,
						      'label' => 'სურათი' ,
						      'visible' => false
						      ),
				    'img_3' => array (
						      'type' => 'file' ,
						      'label' => 'სურათი' ,
						      'visible' => false
						      ),
				    'categoryID' => array (
							   'type' => 'dropdown', 
							   'relation' => 'categories',
							   'relation_column' => 'title_geo',
							   'label' => 'კატეგორია', 
							   'visible' => true
							   ),
				    'brandID' => array (
							'type' => 'dropdown', 
							'relation' => 'brands',
							'relation_column' => 'title_geo',
							'label' => 'ბრენდი', 
							'visible' => true
							),
				    'body_geo' => array (
							 'type' => 'textarea', 
							 'label' => 'ქართ', 
							 'visible' => true
							 ),
				    'body_eng' => array (
							 'type' => 'textarea', 
							 'label' => 'ინგ', 
							 'visible' => false
							 ),
				    'body_rus' => array (
							 'type' => 'textarea', 
							 'label' => 'რუს', 
							 'visible' => false
							 ),
				    'SaleNewPrice' => array (
							     'type' => 'text', 
							     'label' => 'ფასდაკლება', 
							     'visible' => false
							     ),
				    'fastShippingInRegion' => array (
								     'type' => 'text', 
								     'label' => 'სწრაფი რეგიონში', 
								     'visible' => false
								     ),
				    'fastShippingInTbilisi' => array (
								      'type' => 'text', 
								      'label' => 'სწრაფი თბილისში', 
								      'visible' => false
								      ),
				    'shippingInRegion' => array (
								 'type' => 'text', 
								 'label' => 'რეგიონში', 
								 'visible' => false
								 ),
				    'shippingInTbilisi' => array (
								  'type' => 'text', 
								  'label' => 'თბილისსში', 
								  'visible' => false
								  ),
				    'price' => array (
						      'type' => 'text', 
						      'label' => 'price', 
						      'visible' => true
						      ),
				    'properties' => array (
							   'type' => 'json' ,
							   'label' => 'მახასიათებლები' ,
							   'relation' => 'categories' ,
							   'relation_column' => 'filters'
							   ),
				    'visibleRating' => array (
							     'type' => 'bool' ,
							     'label' => 'რეიტინგის ხილვადობა' ,
							      ),
				    'inStock' => array (
							      'type' => 'bool' ,
							      'label' => 'საწყობშია' ,
							),
				    'arriveDate' => array (
							'type' => 'date' ,
							'label' => 'ჩამოსვლის დრო' ,
							),
				    

				    );


$config['config']['users'] = array ( 
				    'id' => array (
						   'type' => 'hidden', 
						   'label' => 'id', 
						   'visible' => true
						   ),
				    'facebookID' => array (
							   'type' => 'text', 
							   'label' => 'facebook ID', 
							   'visible' => true
							   ),
				    'nameSurname' => array (
							    'type' => 'text', 
							    'label' => 'სახელი გვარი', 
							    'visible' => true
							    ),
				    'email' => array (
						      'type' => 'text', 
						      'label' => 'E-mail', 
						      'visible' => true
						      ),
				    'personal_id' => array (
							    'type' => 'text', 
							    'label' => 'პირადი ნომერი', 
							    'visible' => true
							    ),
				    'phone' => array (
						      'type' => 'text', 
						      'label' => 'ტელეფონი', 
						      'visible' => true
						      ),
				    'shippingAdressCity' => array (
								   'type' => 'dropdown',
								   'relation' => 'cities',
								   'relation_column' => 'title_geo',
								   'label' => 'შიპინგის ქალაქი', 
								   'visible' => true
								   ),
				    'shippingDirectAdress' => array (
								     'type' => 'text', 
								     'label' => 'შიპინგის მისამართი', 
								     'visible' => true
								     ),
				    'homePhone' => array (
							  'type' => 'text', 
							  'label' => 'სახლის ტელეფონი', 
							  'visible' => true
							  ),
				    'status' => array (
						       'type' => 'dropdown', 
						       'label' => 'სტატუსი', 
						       'visible' => true,
						       'list' => array (
									'' => '',
									'user' => 'მომხმარებელი',
									'partner' => 'პარტნიორი',
									'vip' => 'VIP'
									),
						       )
				     );
$config['config']['options'] = array(
				     'id' => array (
						    'type' => 'hidden', 
						    'label' => 'id', 
						    'visible' => true
						    ),
				     'title_geo' => array (
							    'type' => 'text', 
							    'label' => 'აღწერა', 
							    'visible' => true ,
							    'tooltip' => 'lorem ipsum'
							    ),
				     'value' => array (
							     'type' => 'text', 
							     'label' => 'მნიშვნელობა', 
							     'visible' => true
							     ),
				     );

/*
  properties
*/