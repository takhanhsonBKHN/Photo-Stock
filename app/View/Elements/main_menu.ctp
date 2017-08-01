<nav class="navbar navbar-default">
	<div class="container-fluid" style="background-image: url(http://flourgirlweddingcakes.com/wp-content/uploads/2013/11/background.png);background-repeat: no-repeat;";>
		<h1 style="margin-top: 2px; margin-bottom: -44px; margin-right: 17%; margin-left: 33%;font-family: Chalkduster, fantasy;font-size: 48px;">Photo Stock</h1>
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/photostock" style="margin-top: 0px; font-family:Jazz Let, fantasy;">Photos</a>
			<a class="navbar-brand" href="/photostock/dashboards/index3" style="margin-top: 0px;font-family:Jazz Let, fantasy;">Videos</a>

		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span> Upload</span></a>
					<ul class="dropdown-menu">
							<li><a href="/photostock/photos/upload"><span class="glyphicon glyphicon-camera" aria-hidden="true" style="margin: 0 10px"></span>Photo </a></li>
							<li><a href="/photostock/videos/upload"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true" style="margin: 0 10px"></span>Video </a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

						<?php
							if($this->Session->read('Auth.User.name')){							    
							    echo "Hello <strong>".$this->Session->read('Auth.User.name');
							     echo " </strong>";				    
							}
						?>
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link('My Videos', array('controller' =>'Dashboards','action' => 'index1')) ?>
						</li>
						<li>
							<?php echo $this->Html->link('My Photos', array('controller' =>'Dashboards','action' => 'index2')) ?>
						</li>
						<li><!-- <a href="">Đăng Xuất</a> -->
							<?php echo $this->Html->link('Log out', array('controller' =>'users','action' => 'logout')) ?>
						</li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>