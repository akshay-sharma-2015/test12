<!DOCTYPE html>
<?php 
use Cake\Core\Configure;
$controller 	=	strtolower($this->request->params['controller']); ?>
<?php $action 		=	strtolower($this->request->params['action']); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo Configure::read("Site.title"); ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
	<link href="css/agency.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/flexslider.css" rel="stylesheet">
</head>
<body id="page-top" class="index">
   <?php 
    echo $this->element('header_menu');
	echo $this->fetch('content');
	echo $this->element('footer'); ?>
	<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright"><?php echo Configure::read("Site.copy_write"); ?></span>
                </div>
                <div class="col-md-4">
				<?php 
$twitter	=	Configure::read('FollowUsOn.twitter');
$facebook	=	Configure::read('FollowUsOn.facebook'); 
$linkedin	 =	Configure::read('FollowUsOn.li');

if (false === strpos($twitter, '://')) {
$twitter = 'http://' . $twitter;
}
if (false === strpos($facebook, '://')) {
$facebook = 'http://' . $facebook;
}
if (false === strpos($linkedin, '://')) {
$linkedin = 'http://' . $linkedin;
} ?>
                    <ul class="list-inline social-buttons">
                        <li><a target="_blank" href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a target="_blank" href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a target="_blank" href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','privacy-policy')); ?>">Privacy Policy</a>
                        </li>
                        <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','terms-of-use')); ?>">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

  
    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>
    <script src="js/jquery.flexslider.js"></script>
	<script>
	$(".flexslider").flexslider({
        animation: "fade",
        slideshowSpeed: 7e3,
        controlNav: false,
        directionNav: false,
        pausePlay: true,
		 drag: true
    })
	</script>
</body>
</html>