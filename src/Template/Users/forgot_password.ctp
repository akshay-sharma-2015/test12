 <div class="container-fluid login_register header_area deximJobs_tabs">
	<div class="row">
		<div class="container main-container">
				<div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
					<ul class="nav nav-pills ">
						<li class="active"><a data-toggle="tab" href="#register-account">Lost PAssword ?</a></li>
					</ul>
				<div class="tab-content">
					<div id="lost-password" class="tab-pane fade in active white-text">						
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
							<p>Lost your password? <br />
							Please enter your username or email address. <br />
							You will receive a link to create a new password via email.</p>
							<?php echo $this->Form->create("User",['class' => 'contact_us']); ?>
								<div class="form-group">
									<label>Email</label>
									<?php echo $this->Form->email("email",["data-validation"=>"required"]); ?>
								</div>
								<div class="form-group submit">
									<label>Submit</label>
									<input type="submit" name="submit" value="Reset Password" class="signin" id="signin">
								</div>					
							<?php echo $this->Form->end(); ?>
						</div>
						<div class="col-lg-4 col-md-5 col-sm-6 col-xs-12  pull-right sidebar">
							<div class="widget">
								<h3>Don't have an account?</h3>
								<ul>
									<li>
									<p> If you'd like to find out more about how Jobsite can help you with your recruitment needs, please complete this enquiry form.</p></li>
									<li><p>A member of our Sales team will contact you shortly.</p></li>
									<li>
									<a href="" class="label job-type register" id="register">Register</a>
									
									</li>
								</ul>
							   
							</div> 
						</div>
					</div>
				   
				</div>
					
					
				</div>
				
		</div>
   </div>
</div> 
	
  	