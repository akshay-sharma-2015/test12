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
		echo $this->element('header');
		?><div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<p  style="margin:10%"><b>Oopss...</b> this is embarassing, either you tried to access a non existing page, or our server has gone crazy....</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><?php 
		 ?>
	</div>
	<?php $plugin		=	$this->request->params['plugin']; ?>
	<?php $controller	=	trim($this->request->params['controller']); ?>
	<?php $action		=	$this->request->params['action']; ?>
	<?php $slug			=	isset($this->request->params['pass'][0]) ? $this->request->params['pass'][0] : ''; ?>
	
	<script>
var ajaxUrl = '<?php echo WEBSITE_URL.'uploader/' ?>ajax.php';
var assetsUrl = '<?php echo  WEBSITE_URL.'uploader/' ?>aassets/';
	</script>
   <?php 
   echo $this->Html->script(array(
	'admin/jquery.js', 
	'admin/bootstrap.min.js'
	),
   array('block' =>'bottom1'));   
   
	echo $this->fetch('angular');
	echo $this->fetch('bottom1');
	echo $this->fetch('bottom');
	echo $this->fetch('custom_script');
	?>
	<script>
		$(".bbt").click(function(e){
			e.preventDefault();
			try{
				$(this).next('ul').collapse("toggle");
			}
			catch (e){
				
			}
		});
	</script>
</body>
</html>
