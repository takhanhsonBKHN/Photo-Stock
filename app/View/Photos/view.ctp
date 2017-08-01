<!-- File: app/View/Photos/view.ctp -->
<div class="name" style="color: #0000ff; float: left; width: 50%">
	<?php echo "Name: ".$photo['Photo']['file_name']; ?>
	<br/>
	<?php echo "Uploaded by: ".$username['User']['name'] ?>
	<br/>
<?php echo $this->Html->image("Uploads/".$photo['Photo']['file_name'], array('width' => '100%')); ?>
</div>

<div class="detailBox">
    <div class="titleBox" >
        <span class="glyphicon glyphicon-heart-empty" id="<?php echo $photo['Photo']['id'] ?>"  onClick="likeAction(<?php echo $photo['Photo']['id'] ?>, null)"></span>
        <span class="num-engate" id='item-<?php echo $photo['Photo']['id'] ?>'><?php echo $photo['Photo']['like_count'] ?></span>
        <span class="glyphicon glyphicon-comment" style="color: #00ace6"></span>
        <span class="num-engate" id="number"><?php echo $photo['Photo']['comment_count'] ?></span>
        <?php
            if($this->Session->read('userid') == $photo['Photo']['user_id']){
                    echo $this->Html->link(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        array(
                            'controller' => 'photos',
                            'action'   => 'delete', $photo['Photo']['id'], $photo['Photo']['file_name']
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

    <div class="actionBox">
    	<form class="form-inline" role="form">
            <?php echo $this->Form->create('Comment'); ?>
                <div class="form-group">
                    <?php
    			        echo $this->Form->input( null, array(
    			            'class' => 'form-control', 
    			            'placeholder' => 'Your comments',
                            'label' => false,
    			            'type' => 'text',
                            'id' => 'msg'
    			            )
    			        );
    	    		?>
                </div> 
                <div class="form-group">
                    <?php
                        $user_name = $this->Session->read('user_name');
                        $photo_id = $photo['Photo']['id'];
    			    ?>
                    <input type="submit" class="btn btn-default" onclick=" return commentAction()" value="Add">
                </div>
        </form>

        <ul class="commentList">
            <?php foreach ($comment as $value) { ?>
                <li id="<?php echo 'cmt-'.$value['Comment']['id']; ?>">
                    <?php if($this->Session->read('userid') == $value['Comment']['user_id']){ ?>
                        <input type="button" class="close" aria-hidden="true" onClick="if(confirm('Are you sure?')) deleteComment(<?php echo $value['Comment']['id']; ?>)" value="&times;">
                    <?php } ?> 
                    <div class="commentName">
                        <b><?php echo $value['User']['name']; ?></b>
                        <span class="commentText"><?php echo $value['Comment']['message'] ?></span> 
                    </div>

                    <div>
                    	<p class="date sub-text">on <?php echo $this->Time->format($value['Comment']['create_at'],'%d/%m/%Y %H:%M',null,'Asia/Ho_Chi_Minh') ?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>
        
    </div>
</div>
<?php 
if($check == 1){?>
    <script> checkLike(<?php echo $photo['Photo']['id']; ?>)</script>
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>