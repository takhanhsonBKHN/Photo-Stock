<?php 
App::uses('AppModel', 'Model');
class Like extends AppModel{
	public $belongsTo = array(
		'Photo' => array(
			'className' => 'Photo',
			'foreignKey' => 'photo_id',
			'counterCache' => true
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id',
			'counterCache' => true
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'counterCache' => true
		)
	);
}
