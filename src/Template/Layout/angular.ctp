<?php use Cake\Core\Configure; ?>
<?php $plugin		=	$this->request->params['plugin']; ?>
<?php $controller	=	$this->request->params['controller']; ?>
<?php $action		=	$this->request->params['action']; ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title><?php  $title = Configure::read('Site.title'); echo __($title,true); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php
echo $this->Html->css(array('bootstrap.css','custom.css','stylesheet.css','font.css'),array('block' =>'css'));

// echo $this->Html->meta('favicon.png','favicon.png',array('type' => 'icon'));
echo $this->fetch('meta');		
echo $this->fetch('css');

	 ?>
</head>
<body>

<div class="header <?php echo ($action != 'index') ? 'header_top' : ''; ?>">
  <div class="container">
    <div class="row">
      <div class="logo"><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'index')); ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>c_logo1.svg" class="img-responsive" /></a></div>
      <nav class="navbar navbar-inverse inver navbar-right">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse clps">
          <ul class="nav navbar-nav">
            <li class=""><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'locations')); ?>"><?php echo __('Destinations',true); ?></a></li>
            <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'onlineCasino')); ?>"><?php echo __('Online Casinos',true); ?></a></li>
            <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'promotion')); ?>"><?php echo __('Promotions',true); ?></a></li>
            <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'addReview')); ?>"><?php echo __('Write a review',true); ?></a></li>
          </ul>
          <div class="signMenu"> <a href="#"><?php echo __('Signup',true); ?></a> <a href="#"><?php echo __('Login',true); ?></a> </div>
        </div>
        <!-- /.nav-collapse --> 
      </nav>
    </div>
  </div>
</div>
<?php 
echo $this->fetch('content');
echo $this->element('footer');
echo $this->Html->script(array('jquery.js' ,'bootstrap.min.js'),array('block' => 'script'));
echo $this->fetch('script'); 

echo $this->fetch('footer_script'); 
echo $this->fetch('custom_script'); ?>
<script>
<?php if($controller == 'Users' && $action == 'index'){ ?>
	$(window).load(function(){
	  $('.flexslider').flexslider({
		animation: "slide",
		controlNav: false,
		directionNav: true,
		pausePlay: false,
	  });
	});
<?php } ?>
$(function(){
 $("#lang_change option[value='<?php echo $Defaultlanguage; ?>']").attr("selected",true);
	$("#lang_change").change(function(){
		val		=	$(this).val();
		$.ajax({
			url : '<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'change_lang')) ?>',
			async : false,
			type : 'POST',
			data : {'val' : val},
			success : function(){console.log(val);
				<?php 
		if(isset($slugPass) && isset($this->request->pass) && !empty($this->request->pass)){
			$pass	=	implode(',',$this->request->pass);
		 ?>
				if(val == 'es'){
					window.location 	=	'<?php echo $this->Url->build(array('language_set' => true,'language' => 'es','plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action,$pass)); ?>'
				}else if(val == 'de'){
					window.location 	=	'<?php echo $this->Url->build(array('language_set' => true,'language' => 'de','plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action,$pass)); ?>'					
				}else{
					window.location 	=	'<?php echo $this->Url->build(array('language_set' => true,'plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action,$pass)); ?>'					
				}
			<?php }else{ ?>
				if(val == 'es'){
					window.location 	=	'<?php echo $this->Url->build(array('language_set' => true,'language' => 'es','plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action)); ?>'
				}else if(val == 'de'){
					window.location 	=	'<?php echo $this->Url->build(array('language_set' => true,'language' => 'de','plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action)); ?>'					
				}else{
					window.location 	=	'<?php echo $this->Url->build(array('language_set' => true,'plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action)); ?>'					
				}
			<?php } ?>
			}			
		})
	});
});
</script>
</body>
</html>
