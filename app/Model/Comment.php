<?php

App::uses('Model', 'Model');

class Comment extends AppModel {
	public $validate = array(
        'message' => array(
            'rule' => 'notBlank'
        )
    );

    public $belongsTo = array(
		'Photo' => array(
			'className' => 'Photo',
			'foreignKey' => 'photo_id',
			'counterCache' => true
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id',
			'counterCache' => true
		),
	);
}
