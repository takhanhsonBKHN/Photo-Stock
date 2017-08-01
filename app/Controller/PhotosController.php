<?php

App::uses('AppController', 'Controller'); 

class PhotosController extends AppController {
	public $layout = "pshome";
    public $components = array('Flash');

	public function upload(){

        if ($this->request->is('post')) {
            $this->Photo->create();

            //Check if image has been uploaded
            if (!empty($this->request->data['Photo']['file_name']['name'])) {
                $file = $this->request->data['Photo']['file_name'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);

                $arr_ext = array('jpg', 'jpeg', 'gif','png');
                if (in_array($ext, $arr_ext)) {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . DS . 'img' . DS . 'Uploads' . DS . $file['name']);
                    $this->request->data['Photo']['file_name'] = $file['name'];
                    $this->request->data['Photo']['user_id'] = $this->Session->read('userid');
                }
                else{
                    $this->Flash->error(__('Unable to add your photo. Please choose format correct!'));
                    return $this->redirect($this->referer());
                }

                if ($this->Photo->save($this->request->data)) {
                    return $this->redirect(array('controller' => 'dashboards', 'action' => 'index'));
                } else {
                    $this->Flash->error(__('Upload failed'));
                    return $this->redirect($this->referer());
                }
            }          
        }
	}

	public function view($id){
		$photo = $this->Photo->find('first', array(
			'conditions' => array('Photo.id' => $id),
			)
        );

        $this->loadModel('User');
        $user_ = $this->User->find('first',array('conditions' => array('User.id' => $photo['Photo']['user_id'])));

        $comment = $this->User->Comment->find('all', array( 'conditions' => array('Comment.photo_id' => $id),
                                                            'order' => array ('Comment.id' => 'DESC')));
        $checkview = $this->Photo->Like->find('first', array(
                    'conditions' => array('Like.user_id' => $this->Auth->user('id'), 'Photo.id' => $id)
            )
        );
        if($checkview == null){
            $this->set('check', false);
        }else{
            $this->set('check', true);
        }
        $this->set('comment',$comment);

        $this->set('username',$user_);
		$this->set('photo', $photo);
        return true;
	}

	public function delete($id = null, $file_name = null){
        if($id == null) {
            return false;
        }	
        $photo = $this->Photo->find('first', array(
            'conditions' => array('Photo.id' => $id)
            )
        );
        if($this->Photo->find('count', array('conditions' => array('Photo.file_name' => $file_name)))>1){
            // delete from database
            $this->Photo->delete($id);
        }
        else{
            $this->Photo->delete($id);
            $path = sprintf('img' . DS . 'Uploads' . DS . $photo['Photo']['file_name']);
            unlink($path);
        }
		// return $this->redirect('/');
        return $this->redirect($this->referer());
	}
    public function delete2($id = null, $file_name = null){
        if($id == null) {
            return false;
        }   
        $photo = $this->Photo->find('first', array(
            'conditions' => array('Photo.id' => $id)
            )
        );
        if($this->Photo->find('count', array('conditions' => array('Photo.file_name' => $file_name)))>1){
            $this->Photo->delete($id);
        }
        else{
            $this->Photo->delete($id);
            $path = sprintf('img' . DS . 'Uploads' . DS . $photo['Photo']['file_name']);
            unlink($path);
        }
        return $this->redirect('/');
    }
}
