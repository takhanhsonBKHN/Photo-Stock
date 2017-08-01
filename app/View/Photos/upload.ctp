<?php $this->assign('title','Upload Photo') ?>
<?php 
	echo $this->Form->create('Photo', array('enctype'=>'multipart/form-data', 'url' => 'upload')); 
	echo $this->Form->input('file_name', array('type'=>'file', 'label' => 'Upload Photo'));
?>
<div class="end" style="margin-top: 15px">
	<?php echo $this->Form->end('Upload'); ?>
	<br/>
	<span style="color: red;"><?php echo $this->Flash->render() ?></span>
</div>