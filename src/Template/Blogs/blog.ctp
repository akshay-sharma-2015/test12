 <!--header section -->
	<div class="container-fluid page-title">
		<div class="row blue-banner">
			<div class="container main-container">
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<h3 class="white-heading">Blog</h3>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-12 colxs-12 capital">
					<h5>Keep up to date with the latest news</h5>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
					<form class="search" name="search" id="search">
						<div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-9">
							<input type="text" name="sarch" placeholder="Enter keywords"/>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-3 submit">
							<input type="submit" name="seatch" value="search"/>
							<span class="glyphicon fa fa-search" aria-hidden="true"></span>
						</div>
					</form>
				</div>
			</div>
		</div> 
	</div> 
  	 <!--header section -->
    
    <!--blog Lists--> 
     <div class="container-fluid white-bg blog-posts">
    	<div class="row">
        	<div class="container main-container">
            	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 posts-list">
				<?php foreach($result as $res){ //pr($res); ?>
					<div class="post">
						<div class="post-thumb">
							 <a href="<?php echo $this->Url->build(['controller' => 'blogs','action' => 'blog_view','blog_view' => $res->slug]); ?>"><img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=749px&height=308px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$res->image; ?>" alt=""/></a>
							<div class="post-date">
								<span class="date postdate"><?php echo $res->created->format('d'); ?></span>
								<span class="date postmonth"><?php echo $res->created->format('M'); ?></span>
							</div>
						</div>
						<div class="data-post">
							<h3><?php  echo $res->title; ?></h3>
							<div><?php  echo $res->sdescription; ?></div>
							<a href="<?php echo $this->Url->build(['controller' => 'blogs','action' => 'blog_view','blog_view' => $res->slug]); ?>" class="btn btn-getstarted bg-red">Read More</a>
						</div>
					</div>
				<?php } ?>                           
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="blog-sidebar">                	
					<?php echo $this->cell('Inbox::blogSideMenu'); ?>
                </div>
            </div>
        </div>
    </div>
    <!--blog Lists--> 

   <!-- Blue Area -->
	<div class="container-fluid blue-banner">
		<div class="row">
			<div class="container main-container">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
					<h3 class="white-heading">Got a question?</h3>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><span class="call-us">send us an email or <strong>call us at 1 (800) 555-5555</strong></span></div>
				<div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
					<a href="blog-post.html" class="btn btn-getstarted bg-red">get started now</a>
				</div>
			</div>
		</div>
	</div>
   
   <!-- Blue Area -->
   
   