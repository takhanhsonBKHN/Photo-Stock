<!-- File: app/Controller/VideosController.php -->
<?php
App::uses('AppController', 'Controller'); 

class VideosController extends AppController {
	public $layout = "pshome";
    public $components = array('Flash');

	public function upload(){

        if ($this->request->is('post')) {

            $this->Video->create();

            //Check if video has been uploaded
            if (!empty($this->request->data['Video']['file_name']['name'])) {
                $file = $this->request->data['Video']['file_name'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);

                $arr_ext = array('mp4', 'ogg', 'avi','mpg', 'ogm','webm', '3gp','flv');
                if (in_array($ext, $arr_ext)) {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . DS . 'img' . DS . 'Uploads' . DS . $file['name']);

                    $this->request->data['Video']['file_name'] = $file['name'];
                    $this->request->data['Video']['user_id'] = $this->Session->read('userid');
                }
                else{
                    $this->Flash->error(__('Unable to add your video. Please choose format correct!'));
                    return $this->redirect($this->referer());
                }

                if ($this->Video->save($this->request->data)) {
                    return $this->redirect(array('controller' => 'dashboards', 'action' => 'index3'));
                } else {
                	 $this->Flash->error(__('Upload failed'));
                     return $this->redirect($this->referer());
                }
            }
        }
	}

	public function view($id){
		$video = $this->Video->find('first', array(
			'conditions' => array('Video.id' => $id)
			)
        );

        $this->loadModel('User');
        $user_ = $this->User->find('first',array('conditions' => array('User.id' => $video['Video']['user_id'])));

        $comment = $this->User->Comment->find('all', array( 'conditions' => array('Comment.video_id' => $id),
                                                            'order' => array ('Comment.id' => 'DESC')));
        $checkview = $this->Video->Like->find('first', array(
                    'conditions' => array('Like.user_id' => $this->Auth->user('id'), 'Video.id' => $id)
            )
        );
        if($checkview == null){
            $this->set('check', false);
        }else{
            $this->set('check', true);
        }
        $this->set('comment',$comment);

        $this->set('username',$user_);
		$this->set('video', $video);
        return true;
	}

	public function delete($id = null, $file_name = null){
        if($id == null) {
            return false;
        }
        $video = $this->Video->find('first', array(
            'conditions' => array('Video.id' => $id)
            )
        );
        //if >1 video's name in database will only delete in database else delete both database and /img/uploads
		if($this->Video->find('count', array('conditions' => array('Video.file_name' => $file_name)))>1){
            // delete from database
            $this->Video->delete($id);
        }
        else{
            $this->Video->delete($id);
            $path = sprintf('img' . DS . 'Uploads' . DS . $video['Video']['file_name']);
            unlink($path);
        }
        //return $this->redirect('/dashboards/index3');
		return $this->redirect($this->referer());
	}
    public function delete2($id = null, $file_name = null){
        if($id == null) {
            return false;
        }
        $video = $this->Video->find('first', array(
            'conditions' => array('Video.id' => $id)
            )
        );
        if($this->Video->find('count', array('conditions' => array('Video.file_name' => $file_name)))>1){
            $this->Video->delete($id);
        }
        else{
            $this->Video->delete($id);
            $path = sprintf('img' . DS . 'Uploads' . DS . $video['Video']['file_name']);
            unlink($path);
        }
        return $this->redirect('/dashboards/index3');
    }
}
