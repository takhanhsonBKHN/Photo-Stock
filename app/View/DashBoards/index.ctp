<!-- File: app/View/DashBoards/index.ctp (index photo public)-->
<?php $this->assign('title','Photo Stock') ?>

<?php 
	foreach ($images as $value) {
?>

<article class="col-md-3 clearfix media-photo">
	<div class="img">
		<figure>
			<?php echo $this->Html->image("Uploads/".$value['Photo']['file_name'], array('alt' => 'image', 'class' => 'img-responsive', 'url' => array('controller' => 'photos', 'action' => 'view', $value['Photo']['id']))); ?>
		</figure>
	</div>
	<div class="media-action clearfix">
		<p class="pull-left">
			<span					
				class="glyphicon glyphicon-heart-empty"
				style="color:#333"
				aria-hidden="true" 
				id="<?php echo $value['Photo']['id']; ?>" 
				onClick="likeAction(<?php echo $value['Photo']['id'] ?>, null)">
			</span>
			<span class="num-engate" id="<?php echo 'item-'.$value['Photo']['id']; ?>" >
				<?php echo $value['Photo']['like_count'] ?>
			</span>

			<?php  
				echo $this->Html->link(
					'<span class="glyphicon glyphicon-comment"></span>',
					array(
						'controller' => 'photos',
						'action' => 'view', $value['Photo']['id'], $value['Photo']['file_name']
					),
					array(
						'escape' => false,
					)
				);
			?>
			<span class="num-engate" id="<?php echo 'cmt-'.$value['Photo']['id']; ?>" >
				<?php echo $value['Photo']['comment_count'] ?>
			</span>
		</p>
		<?php 	
			//C1: use helper to check user_id
			// echo $this->Custom->checkDel($this->Session->read('userid',$value['Photo']['id']));
			//C2: use session to check user id directly
			if($this->Session->read('userid') == $value['Photo']['user_id']){
				echo $this->Html->link(
					'<span class="glyphicon glyphicon-trash"></span>',
					array(
						'controller' => 'photos',
						'action'   => 'delete', $value['Photo']['id'], $value['Photo']['file_name']
					),

					array(
						'class' => 'btn btn-mini pull-right',
						'escape'   => false,
						'confirm'  => 'Are you sure ?'
					)
				);
			}
		?>
	</div>
</article>
<?php } ?>

<?php foreach ($id_photo_like as $value) { ?>
	<script>checkLike(<?php echo $value; ?>)</script>
<?php } ?>

<!-- paginator -->
<div class="paging">
	<?php
    	echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Hiện thj nút Previous
		echo " | ".$this->Paginator->numbers()." | "; //Hiển thi các số phân trang
		echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Hiển thị nút next
	?>
</div>
