<?php
	class UsersController extends AppController{
		public $helpers = array('Html','Form');

		// use layout
		public $layout = 'authencations';
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('signup');
		}

		public function login(){
			if ($this->request->is('post')) {

		        if ($this->Auth->login()) {

		        	$this->Session->write('userid', $this->Auth->user('id'));
		        	$this->Session->write('user_name', $this->Auth->user('name'));

		            // return $this->redirect($this->Auth->redirectUrl());
		            return $this->redirect('/');
		        }
		        $this->Session->setFlash('Invalid email or password, try again');
		    }
		}

		public function signup(){
			if ($this->request->is('post')) {
	            $this->User->create();

	            if ($this->User->save($this->request->data)) {

	                $this->Session->setFlash('Your account has been saved.');
	                return $this->redirect('/users/login');
	            }	            
	            $this->Session->setFlash('Unable to sign up.','default', array(), 'bad');

	        }
		}

		public function logout() {
			$this->Session->destroy();
		    return $this->redirect($this->Auth->logout());
		}
	}
?>

