<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {

	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => true
		)
	);

	//xac nhan khi sign up
	public $validate = array(
		//name condition
		'name' => array(
	        'required' => array(
	            'rule' => array('notBlank'),
	            'message' => 'You must enter a name.'
	        )
    	),
    	//email condition
        'email' => array(
            'email' => array(
            	'rule'  => array('email'),
            	'message' => 'Please enter a valid email address.'
	        ),
	        'required' => array(
	            'rule' => array('notBlank'),
	            'message' => 'You must enter a name.'
	        ),
	        'unique' => array(
	            'rule'    => 'isUnique',
	            'message' => 'This username has already been taken.'
	        )
	    ),
	    //password condition
	    'password' => array(
	        'required' => array(
	            'rule' => array('notBlank'),
	            'message' => 'You must enter a password.'
	        )
	    )
	);

	//ma hoa password truoc khi luu vao csdl va giai ma truoc khi so sanh
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}
}
?>