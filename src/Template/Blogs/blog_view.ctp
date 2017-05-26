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
					<form class="search"  name="search" id="search">
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
    <div class="container-fluid white-bg blog-posts">
    	<div class="row">
        	<div class="container main-container">
            	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 posts-list">
                	<div class="post" id="post-1">
						<div class="post-thumb">
							<img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=749px&height=308px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$result->image; ?>" alt=""/>
							<div class="post-date">
								<span class="date postdate"><?php echo $result->created->format('d'); ?></span>
								<span class="date postmonth"><?php echo $result->created->format('M'); ?></span>
							</div>
						</div>
						<div class="data-post">
							<h3><?php  echo $result->title; ?></h3>
							<?php /* <p>by <span class="post-author"><a href="#">deximjobs</a></span></p> */ ?>
							<div><?php  echo $result->sdescription; ?></div>
							<div><?php  echo $result->description; ?></div>
                        </div><?php /*                            
                            <div class="comment-section">
                            	<h3>Comments <span>(1)</span></h3>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 zero-padding-right">
                               		<img src="<?php echo WEBSITE_URL; ?>assets/images/job-admin.png" class="img-responsive" alt=""/>
                               </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 no-padding">
                                	<div class="view-comments">
                                    	<p><strong>Martin</strong><br />October 21, 2016 at 1:32 pm </p>
                                         <a href="#">Log in to Reply</a>
                                        <hr />
                                        <p>Test Comments</p>
                                    </div>
									<span class="login-ins">You must be <a href="#">logged</a> in to post a comment.</span>
                                </div>
                                <div class="col-lg-12">
                                	<div class="leave-reply" id="form-style-2">
                                		<h3>Leave a Reply</h3>
                                        <form name="contact_us">
                                        <div class="form-group">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Comment :</label></div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                            	<textarea rows="6"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Name:</label></div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><input type="text" name="name"></div>
                                        </div>
                                          <div class="form-group">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Email:</label></div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><input type="email" name="email"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><label>Website:</label></div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><input type="text" name="www"></div>
                                        </div>
                                      <div class="form-group">
                                      <div class="col-lg-4 col-lg-push-2 col-md-4 col-md-push-2 col-sm-4 col-sm-push-2 col-xs-12">
                                        	<input type="submit" name="submit" id="post-comments" value="Post a comment"></div>
                                    </div>
                        
                        			</form>
                                	</div>
                                </div>
                            </div>*/ ?>
					</div>
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
   