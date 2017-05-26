<!-- Header -->
<header>
	<div class="1">
		   <div class="flexslider">
			  <ul class="slides fsl">
				 <?php foreach($sliders as $images){ ?>
				 <li><img src="<?php echo SLIDER_IMG_URL.$images->image ?>" class="img-responsive" alt="Image loading" /></li>
				
				 <?php } ?>
			  </ul>
		   </div>
	</div>
</header>
<!-- Services Section -->
<section id="services">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading">Services</h2>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-4">
				<span class="fa-stack fa-4x">
					<i class="fa fa-circle fa-stack-2x text-primary"></i>
					<i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
				</span>
				<h4 class="service-heading">E-Commerce</h4>
				<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
			</div>
			<div class="col-md-4">
				<span class="fa-stack fa-4x">
					<i class="fa fa-circle fa-stack-2x text-primary"></i>
					<i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
				</span>
				<h4 class="service-heading">Responsive Design</h4>
				<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
			</div>
			<div class="col-md-4">
				<span class="fa-stack fa-4x">
					<i class="fa fa-circle fa-stack-2x text-primary"></i>
					<i class="fa fa-lock fa-stack-1x fa-inverse"></i>
				</span>
				<h4 class="service-heading">Web Security</h4>
				<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
			</div>
		</div>
	</div>
</section>

<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading">Blogs</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-6 portfolio-item">
				<a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					<img src="img/portfolio/roundicons.png" class="img-responsive" alt="">
				</a>
				<div class="portfolio-caption">
					<h4>Round Icons</h4>
					<p class="text-muted">Graphic Design</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 portfolio-item">
				<a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					<img src="img/portfolio/startup-framework.png" class="img-responsive" alt="">
				</a>
				<div class="portfolio-caption">
					<h4>Startup Framework</h4>
					<p class="text-muted">Website Design</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 portfolio-item">
				<a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					<img src="img/portfolio/treehouse.png" class="img-responsive" alt="">
				</a>
				<div class="portfolio-caption">
					<h4>Treehouse</h4>
					<p class="text-muted">Website Design</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 portfolio-item">
				<a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					<img src="img/portfolio/golden.png" class="img-responsive" alt="">
				</a>
				<div class="portfolio-caption">
					<h4>Golden</h4>
					<p class="text-muted">Website Design</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 portfolio-item">
				<a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					<img src="img/portfolio/escape.png" class="img-responsive" alt="">
				</a>
				<div class="portfolio-caption">
					<h4>Escape</h4>
					<p class="text-muted">Website Design</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 portfolio-item">
				<a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
					<div class="portfolio-hover">
						<div class="portfolio-hover-content">
							<i class="fa fa-plus fa-3x"></i>
						</div>
					</div>
					<img src="img/portfolio/dreams.png" class="img-responsive" alt="">
				</a>
				<div class="portfolio-caption">
					<h4>Dreams</h4>
					<p class="text-muted">Website Design</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- About Section -->
<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading">News</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 animate-box fadeInUp animated-fast">
				<div class="course">
					<a href="#" class="course-img" style="background-image: url(img/portfolio/golden.png);">
					</a>
					<div class="desc">
						<h3><a href="#">Web Master</a></h3>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
					</div>
				</div>
			</div>
			<div class="col-md-6 animate-box fadeInUp animated-fast">
				<div class="course">
					<a href="#" class="course-img" style="background-image: url(img/portfolio/golden.png);">
					</a>
					<div class="desc">
						<h3><a href="#">Business &amp; Accounting</a></h3>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
					</div>
				</div>
			</div>
			<div class="col-md-6 animate-box fadeInUp animated-fast">
				<div class="course">
					<a href="#" class="course-img" style="background-image: url(img/portfolio/golden.png);">
					</a>
					<div class="desc">
						<h3><a href="#">Science &amp; Technology</a></h3>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
					</div>
				</div>
			</div>
			<div class="col-md-6 animate-box fadeInUp animated-fast">
				<div class="course">
					<a href="#" class="course-img" style="background-image: url(img/portfolio/golden.png);">
					</a>
					<div class="desc">
						<h3><a href="#">Health &amp; Psychology</a></h3>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						<span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Contact Section -->
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading">Contact Us</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form name="sentMessage" id="contactForm" novalidate>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
								<p class="help-block text-danger"></p>
							</div>
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
								<p class="help-block text-danger"></p>
							</div>
							<div class="form-group">
								<input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
								<p class="help-block text-danger"></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
								<p class="help-block text-danger"></p>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-lg-12 text-center">
							<div id="success"></div>
							<button type="submit" class="btn btn-xl">Send Message</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
