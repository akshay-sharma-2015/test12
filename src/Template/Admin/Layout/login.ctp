<?php use Cake\Core\Configure;
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */


?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
    <!-- Bootstrap Core CSS -->
	<?php echo $this->Html->css(array('admin/bootstrap.min.css','admin/plugins/metisMenu/metisMenu.min.css','admin/plugins/timeline.css','admin/sb-admin-2.css','admin/plugins/morris.css','admin/custom.css','admin/font-awesome-4.1.0/css/font-awesome.min.css'),
	array('block' =>'css')); ?>
   
	<?php 
		
		// echo $this->Html->meta('favicon.png','favicon.png',array('type' => 'icon'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		
		
	?>
</head>
<body>
	<div id="wrapper">
	 <?php 
		// echo $this->element('header');
		echo $this->fetch('content'); 
		 ?>
	</div>
   <?php echo $this->Html->script(array(
	'admin/jquery.js', 
	'admin/bootstrap.min.js',
	'admin/plugins/metisMenu/metisMenu.min.js',
	'admin/sb-admin-2.js'),
	array('block' =>'bottom1')); ?>
	
	<?php 
	echo $this->fetch('bottom1');
	echo $this->fetch('bottom');
	echo $this->fetch('custom_script');
	?>
</body>
</html>
