<!-- File: app/View/Users/login.ctp -->
 <?php $this->assign('title','Sign In') ?>
<div class="h2"><h2> LOG IN </h2> </div>

<div class="error" style="color: red"><?php echo $this->Flash->render(); ?></div>

<?php echo $this->Form->create('User',array('url' => 'login')); ?>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
    <?php  
        echo $this->Form->input('email', array(
            'class' => 'form-control', 'id' => 'inputEmail3',
            'placeholder' => 'Email', 'label' => false,
            'type' => 'email'
            )
        );
    ?>
    </div>
</div>

<div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
    <?php  
        echo $this->Form->input('password', array(
            'class' => 'form-control', 'id' => 'inputPassword3',
            'placeholder' => 'Password', 'label' => false,
            'type' => 'password'
            )
        );
    ?>
    </div>
</div>

<div class="form-group row" style="padding-left: 75px">
    <div class="offset-sm-2 col-sm-10" >
    <?php  
        echo $this->Form->button('Sign in', array(
            'type' => 'submit', 'class' => 'btn btn-primary'
            )
        );
    ?>
    </div>
</div>

<div class="foot"><?php echo 'Not registered? ' . $this->Html->link('Create an account', array('controller' => 'users','action' => 'signup')); ?> </div>