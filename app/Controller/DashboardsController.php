<!-- app/Controller/UsersController.php -->

<?php
	class DashboardsController extends AppController{
		public $helpers = array('Html','Form','Custom');
		public $components = array('Paginator');
		public $uses = array('Photo','Like','Video');

		// use layout
		public $layout = 'pshome';

		public function index(){
			$this->Photo->recursive = 0;
			$this->paginate = array(
				'limit' => 8,// mỗi page có 8 record
	       		'order' => array('Photo.id' => 'desc')//giảm dần theo id
			);

			$photo_like = $this->Like->find('all', array('conditions' => array('Like.user_id' => $this->Auth->user('id'))));

			$id_photo_like = array();
			foreach ($photo_like as $key => $value) {
				$id_photo_like[] = $value['Like']['photo_id'];
			}
			$this->set('id_photo_like',$id_photo_like);
			$this->set('images', $this->Paginator->paginate('Photo'));
		}
  		//show your own video
  		public function index1(){

			$user_id_ = $this->Session->read('userid');
			$this->Photo->recursive = 0;

			$this->paginate = array(
				'conditions' => array('user_id' => $user_id_),
				'limit' => 8,// mỗi page có 8 record
	       		'order' => array('Video.id' => 'desc')//giảm dần theo id
			);
			
			$video_like = $this->Like->find('all', array('conditions' => array('Like.user_id' => $this->Auth->user('id'))));

			$id_video_like = array();
			foreach ($video_like as $key => $value) {
				$id_video_like[] = $value['Like']['video_id'];
			}

			$this->set('id_video_like',$id_video_like);
			$this->set('videos', $this->Paginator->paginate('Video'));
		}
		//show your own photo
		public function index2(){

			$user_id_ = $this->Session->read('userid');
			$this->Photo->recursive = 0;

			$this->paginate = array(
				'conditions' => array('user_id' => $user_id_),
				'limit' => 8,// mỗi page có 8 record
	       		'order' => array('Photo.id' => 'desc')//giảm dần theo id
			);
			
			$photo_like = $this->Like->find('all', array('conditions' => array('Like.user_id' => $this->Auth->user('id'))));

			$id_photo_like = array();
			foreach ($photo_like as $key => $value) {
				$id_photo_like[] = $value['Like']['photo_id'];
			}

			$this->set('id_photo_like',$id_photo_like);
			$this->set('images', $this->Paginator->paginate('Photo'));
		}

		public function index3(){
			$this->Video->recursive = 0;
			$this->paginate = array(
				'limit' => 8,// mỗi page có 8 record
	       		'order' => array('Video.id' => 'desc')//giảm dần theo id
			);

			$video_like = $this->Like->find('all', array('conditions' => array('Like.user_id' => $this->Auth->user('id'))));

			$id_video_like = array();
			foreach ($video_like as $key => $value) {
				$id_video_like[] = $value['Like']['video_id'];
			}

			$this->set('id_video_like',$id_video_like);
			$this->set('videos', $this->Paginator->paginate('Video'));
		}
	}
?>
