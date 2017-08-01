<?php 
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class CustomHelper extends AppHelper {
    public function checkDel($id, $photoId){

		App::import("Model", "Photo");
		$photoModel = new Photo();
		$photo = $photoModel->find('first',array('conditions' => array('Photo.id' => $photoId))); 
		if($photo['Photo']['user_id'] == $id){
			return 
				$this->Html->link(
					'<span class="glyphicon glyphicon-trash"></span>',
					array(
						'controller' => 'photos',
						'action'   => 'delete', $value['Photo']['id']
					),

					array(
						'class' => 'btn btn-mini pull-right',
						'escape'   => false,
						'confirm'  => 'Are you sure ?'
					)
				);
		}
    }
}