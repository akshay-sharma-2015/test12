<?php  use Cake\Core\Configure; ?><!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo $this->Url->build('/admin/dashboard') ?>"><b><?php echo Configure::read('Site.title'); ?></b></a>
	</div>
	<ul class="nav navbar-top-links navbar-right">
		 <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="<?php echo $this->Url->build('/admin/edit_profile'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
				</li>
				<li class="divider"></li>
				<li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'logout')); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->
	<?php $plugin		=	$this->request->params['plugin'];
	$controller	=	trim($this->request->params['controller']);
	$action		=	$this->request->params['action']; 
	$slug			=	isset($this->request->params['pass'][0]) ? $this->request->params['pass'][0] : ''; ?>
	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
					<a class="<?php echo ($controller == 'users' && $action == 'dashboard') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/dashboard'); ?>"><i class="fa  <?php echo ($controller == 'users' && $action == 'dashboard') ? 'fa-cog fa-spin' : 'fa-dashboard'; ?> fa-fw"></i> Dashboard</a>
				</li>
				<li>
					<a class="<?php echo ($controller == 'users' && $action == 'dashboard') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/users/index'); ?>"><i class="fa  <?php echo ($controller == 'users' && $action == 'dashboard') ? 'fa-cog fa-spin' : 'fa-user fa-fw'; ?> fa-fw"></i> User Management</a>
				</li>				
				<li class="<?php echo ($plugin == 'emailtemplate' || $slug == 'FollowUsOn'|| $plugin == 'slider'|| $plugin == 'cms') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'emailtemplate' || $slug == 'FollowUsOn'|| $plugin == 'slider'|| $plugin == 'cms') ? 'fa-cog fa-spin' : 'fa-cogs'; ?>  fa-fw"></i> Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'emailtemplate' || $slug == 'FollowUsOn'|| $plugin == 'slider'|| $plugin == 'cms') ? 'collapse in' : 'collapse'; ?>">
						 <li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'setting','controller' => 'settings','action' => 'view','Site')); ?>"> Site Settings</a>
						</li> 
						<li>
							 <a  href="<?php echo $this->Url->build('/admin/email_template/email-templates/index'); ?>"> Email Templates</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'setting','controller' => 'settings','action' => 'view','Debug')); ?>"> Debug Mode</a>
						</li> 
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'cms','controller' => 'cms-pages','action' => 'index')); ?>"> Cms Pages</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'block','controller' => 'blocks','action' => 'index')); ?>"> Blocks</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'contact','controller' => 'contacts','action' => 'index')); ?>"> Contact Us</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'slider','controller' => 'sliders','action' => 'index')); ?>">Homepage slider</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li class="<?php echo ($plugin == 'textsetting') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'textsetting') ? 'fa-cog fa-spin' : 'fa-language'; ?>  fa-fw"></i> Language Setting<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'textsetting') ? 'collapse in' : 'collapse'; ?>">	<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'textsetting','controller' => 'languages','action' => 'index')); ?>">Languages</a>
						</li> 
						 <li>
							<a href="<?php echo $this->Url->build('/admin/textsetting/text-settings/index'); ?>">Language Translate</a>
						</li>
					</ul> 
				</li>
				<li class="<?php echo ($plugin == 'news') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'news') ? 'fa-cog fa-spin' : 'fa-map-marker'; ?>  fa-fw"></i>News Manager<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'news') ? 'collapse in' : 'collapse'; ?>">	
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/news_category'); ?>">News Category</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/news_user'); ?>">News User</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'news','controller' => 'news','action' => 'index')); ?>">News</a>
						</li>
					</ul> 
				</li>
				<li class="<?php echo ($plugin == 'blog') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'blog') ? 'fa-cog fa-spin' : 'fa-map-marker'; ?>  fa-fw"></i>Blog Manager<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'blog') ? 'collapse in' : 'collapse'; ?>">
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/blog_category'); ?>">Blog Category</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/blog_user'); ?>">Blog User</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'blog','controller' => 'blogs','action' => 'index')); ?>">Blog</a>
						</li>
					</ul>
				</li>
                <li>
                    <a class="bbt" href="#"><i class="fa fa-diamond "></i>Category Manager<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo $this->Url->build('/admin/master/masters/index/category_name'); ?>">Category Name</a>
                        </li>                       
                    </ul>
                </li>
			</ul>
		</div>
	</div>
</nav>
