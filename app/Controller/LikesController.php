<?php
App::uses('AppController', 'Controller');

class LikesController extends AppController {

    public $components = array('RequestHandler');
    public $uses = array('Photo','Like','Video','User');

    public function like(){
        $this->autoRender = false;

        if($this->request->is('ajax')){
            $photo_id = $this->request->data('photo_id_to_send');
            $video_id = $this->request->data('video_id_to_send');
            //
            $find_like_record = $this->Like->find('first',array('conditions' => array(
                                                                'Like.photo_id' => $photo_id,
                                                                'Like.video_id' => $video_id,
                                                                'Like.user_id' => $this->Auth->user('id'))));
            if($find_like_record == null){  //photo or video hasn't been liked
                $this->Like->set(array(
                    'photo_id' => $photo_id,
                    'video_id' => $video_id,
                    'user_id' => $this->Auth->user('id')
                ));
                if($this->Like->save()){
                    if ($video_id == null) {
                        $like_count = $this->Like->Photo->find('first', array ('conditions' => array('Photo.id' => $photo_id)));
                        return json_encode(array(   'likecount' => $like_count['Photo']['like_count'],
                                                    'isLike' => 1));
                    } else {
                        $like_count = $this->Like->Video->find('first', array ('conditions' => array('Video.id' => $video_id)));
                        return json_encode(array(   'likecount' => $like_count['Video']['like_count'],
                                                    'isLike' => 1));
                    }
                }
            } else {
                if($this->Like->delete($find_like_record['Like']['id'])){
                    if ($video_id == null) {
                        $id_photo_like = $this->Like->Photo->find('first', array(
                                                                            'conditions' => array(
                                                                            'Photo.id' => $photo_id)));
                        return json_encode(array(   'likecount' => $id_photo_like['Photo']['like_count'],
                                                    'isLike' => 0));
                    } else {
                        $id_video_like = $this->Like->Video->find('first', array(
                                                                            'conditions' => array(
                                                                            'Video.id' => $video_id)));
                        return json_encode(array(   'likecount' => $id_video_like['Video']['like_count'],
                                                    'isLike' => 0));
                    }
                }
            }
        }    
    }
}