<!-- File: app/View/DashBoards/index.ctp (index video public)--> 
<?php $this->assign('title','Video Stock')?>

<?php foreach ($videos as $value) {?>

<article class="col-md-3 clearfix media-photo">
	<div class="video">
		<figure>
			<a href="/photostock/videos/view/<?php echo $value['Video']['id'] ?>">
				<video controls style="height: 196px; width: 260px;">
					<source src="/photostock/img/Uploads/<?php echo $value['Video']['file_name'] ?>" type="video/mp4">
				</video>
			</a>
		</figure>
	</div>
	<div class="media-action clearfix">
		<p class="pull-left">
			<span					
				class="glyphicon glyphicon-heart-empty"
				style="color:black"
				aria-hidden="true" 
				id="<?php echo $value['Video']['id']; ?>" 
				onClick="likeAction(null, <?php echo $value['Video']['id'] ?>)">
			</span>
			<span class="num-engate" id="<?php echo 'itemv-'.$value['Video']['id'] ?>" >
				<?php echo $value['Video']['like_count'] ?>
			</span>

			<?php  
				echo $this->Html->link(
					'<span class="glyphicon glyphicon-comment"></span>',
					array(
						'controller' => 'videos',
						'action' => 'view', $value['Video']['id']
					),
					
					array(
						'escape' => false,
					)
				);
			?>
			<span class="num-engate" id="<?php echo 'cmtv-'.$value['Video']['id']; ?>" >
				<?php echo $value['Video']['comment_count'] ?>
			</span>

		</p>
		<?php 	
			if($this->Session->read('userid') == $value['Video']['user_id']){
				echo $this->Html->link(
					'<span class="glyphicon glyphicon-trash"></span>',
					array(
						'controller' => 'videos',
						'action'   => 'delete', $value['Video']['id'], $value['Video']['file_name']
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

<?php foreach ($id_video_like as $value) { ?>
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