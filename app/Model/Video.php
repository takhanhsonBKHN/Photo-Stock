<?php 
App::uses('AppModel', 'Model');
class Video extends AppModel{
	public $hasMany = array(
		'Like' => array(
			'className' => 'Like',
			'foreignKey' => 'video_id',
			'dependent' => true
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'video_id',
			'dependent' => true
		)
	);
}
