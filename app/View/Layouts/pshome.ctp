<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<title>
        <?php echo $this->fetch('title'); ?>
    </title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('1_photos_main');
		echo $this->Html->script('abc');
		echo $this->Html->css('commentStyle');
		
	?>
</head>
<body>
	<header id="cms-header">
		<?php echo $this->element('main_menu'); ?>
	</header>

	<main id="cms-main">

		<div class="container">
			<div class="row">
				<?php echo $this->fetch('content'); ?>	
			</div>
		</div>

	</main>

	<footer id="cms-footer">

		<div class="container">
			<div class="row">

				<small> &copy; Internship Teanm D </small>
			</div>
		</div>
		
	</footer>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<?php echo $this->Html->script('bootstrap.min'); ?>
</body>
</html>