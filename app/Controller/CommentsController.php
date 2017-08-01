<?php
App::uses('AppController', 'Controller');

class CommentsController extends AppController {
    public $helpers = array('Time');

    public function add(){
        App::uses('CakeTime', 'Utility');
        $this->autoRender = false;

        if ($this->request->is('ajax')) {
            $this->Comment->create();

            $id = $this->request->data('id_to_send');
            $type = $this->request->data('type_to_send');
            $message = $this->request->data('message_to_send');

            $date = new DateTime('now', new DateTimeZone('UTC'));
            $create = $date->format('Y-m-d H:i:s');
            if ($type == 'photos') {
                $this->Comment->set(array(
                    'photo_id' => $id,
                    'video_id' => null));
            } else {
                $this->Comment->set(array(
                    'photo_id' => null,
                    'video_id' => $id));
            }

            $this->Comment->set(array(
                'user_id' => $this->Auth->user('id'),
                'message' => $message,
                'create_at' => $create
            ));

            if ($this->Comment->save()) {
                $comment_id = $this->Comment->getLastInsertId();
                $last_record = $this->Comment->read('create_at', $comment_id);
                $format_create = CakeTime::format($last_record['Comment']['create_at'],'%d/%m/%Y %H:%M',null,'Asia/Ho_Chi_Minh');
                // $this->log($last_record['Comment']['create_at']);
                // $this->log($format_create);
                $readcomment = $this->Comment->read('video_id',$comment_id);
                if($readcomment['Comment']['video_id'] == null){
                    $comment_count = $this->Comment->Photo->find('first', array ('conditions' => array('Photo.id' => $id)));
                    return json_encode(array(   'commentcount' => $comment_count['Photo']['comment_count'],
                                                'commentid' => $comment_id,
                                                'user_name' => $this->Auth->user('name'),
                                                'create' => $format_create));
                } else {
                    $comment_count = $this->Comment->Video->find('first', array ('conditions' => array('Video.id' => $id)));
                    return json_encode(array(   'commentcount' => $comment_count['Video']['comment_count'],
                                                'commentid' => $comment_id,
                                                'user_name' => $this->Auth->user('name'),
                                                'create' => $format_create));
                }             
            }
        }
    }

    public function delete(){
        $this->autoRender = false;
        if($this->request->is('ajax')){
            if ($this->Comment->delete($this->request->data['comment_id'])) {
                $id = $this->request->data('id_to_send');
                if($this->request->data('type_to_send') == 'photos'){
                    $comment_count = $this->Comment->Photo->find('first', array ('conditions' => array('Photo.id' => $id)));
                    return json_encode(array(   'commentcount' => $comment_count['Photo']['comment_count'],));
                } else {
                    $comment_count = $this->Comment->Video->find('first', array ('conditions' => array('Video.id' => $id)));
                    return json_encode(array(   'commentcount' => $comment_count['Video']['comment_count'],));
                }
            }
        }
    }
}