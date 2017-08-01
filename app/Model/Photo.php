<?php 
App::uses('AppModel', 'Model');
class Photo extends AppModel{
	public $hasMany = array(
		'Like' => array(
			'className' => 'Like',
			'foreignKey' => 'photo_id',
			'dependent' => true
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'photo_id',
			'dependent' => true
		)
	);
}
