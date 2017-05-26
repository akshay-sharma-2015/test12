<div class="container-fluid login_register header_area deximJobs_tabs">
   <div class="row">
      <div class="container main-container-home">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-pills ">
               <li class="<?php echo ($tab == 'register') ? 'active' : ''; ?>"><a data-toggle="tab" href="#register-account">Register</a></li>
               <li class="<?php echo ($tab == 'login') ? 'active' : ''; ?>"><a data-toggle="tab" href="#login">Login</a></li>
            </ul>
            <div class="tab-content">
               <div id="register-account" class="tab-pane fade in <?php echo ($tab == 'register') ? 'active' : ''; ?> white-text">
                <?php echo $this->Form->create("User",['class' => 'contact_us']); ?>
					<p>Sinup to your account.</p>
					<?php  echo ($tab == 'register') ? $this->Flash->render() : ''; ?>
					<div class="col-lg-6 col-md-6  col-sm-12 col-xs-12 zero-padding-left">
						<div class="form-group">
						   <label>Full Name *</label>
						   <?php echo $this->Form->hidden("type",["value"=>"register"]); ?>
						   <?php echo $this->Form->text("full_name",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>Comapny *</label>
						  <?php echo $this->Form->text("comapny",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>Title*</label>
						   <?php echo $this->Form->text("title",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>Office Phone*</label>
						   <?php echo $this->Form->text("office_phone",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>Mobile Phone</label>
						    <?php echo $this->Form->text("mobile_phone"); ?>
						</div>						
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 zero-padding-left">
						<div class="form-group">
						   <label>Street Address*</label>
						    <?php echo $this->Form->text("street_address",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>City*</label>
						    <?php echo $this->Form->text("city",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>State*</label>
						    <?php echo $this->Form->text("state",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>Postal/Zip*</label>
						    <?php echo $this->Form->text("zip",["data-validation"=>"required"]); ?>
						</div>
						<div class="form-group">
						   <label>Website</label>
						    <?php echo $this->Form->text("website"); ?>
						</div>					
					</div>				
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 zero-padding-left">
						<div class="form-group">
						   <label>Email*</label>
						    <?php echo $this->Form->email("email",["data-validation"=>"email",'data-validation' => 'server','data-validation-url' => $this->Url->build(['controller' => 'users','action' => 'validationCheck'])]); ?>
						</div>
						<div class="form-group">
						   <label>Password*</label>
						    <?php echo $this->Form->password("password_confirmation",["data-validation"=>"required",'data-validation' => 'strength','data-validation-strength' => 2]); ?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 zero-padding-left">
						<div class="form-group">
						   <label>Retype your email*</label>
						    <?php echo $this->Form->email("confirm_email",["data-validation"=>"email",'data-validation'=>"confirmation" ,'data-validation-confirm'=>"email"]); ?>
						</div>						
						<div class="form-group">
						   <label>Retype your password*</label>
						   <?php echo $this->Form->password("password",["data-validation"=>"required",'data-validation'=>"confirmation"]); ?>
						</div>					
					</div><?php /*			
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zero-padding-left">						
						<div class="form-group">
						   <label>How did you hear about us?</label>
						    <?php echo $this->Form->textarea("here_about_us",['class' => '']); ?>
						</div>	
					</div>*/ ?>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zero-padding-left">
						<div class="form-group submit">
                           <label>Submit</label>
                           <input name="submit" value="Submit" class="signin" id="Submit" type="submit">
                        </div>					
					</div>
				<?php echo $this->Form->end(); ?>
               </div>
               <div id="login" class="tab-pane fade in <?php echo ($tab == 'login') ? 'active' : ''; ?> white-text">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 zero-padding-left">
                     <p>Login to your Recruiter account.</p>
                       <?php echo $this->Form->create("User",['class' => 'contact_us']); ?>
						<?php  echo ($tab == 'login') ? $this->Flash->render() : ''; ?>
						<div class="form-group">
						   <label>Email *</label>
						   <?php echo $this->Form->hidden("type",["value"=>"login"]); ?>
						   <?php echo $this->Form->email("email",["data-validation"=>"email"]); ?>
						</div>
						<div class="form-group">
						   <label>Password *</label>
						  <?php echo $this->Form->password("password",["data-validation"=>"required"]); ?>
						</div>
                        <div class="form-group submit">
                           <label>Submit</label>
                           <input type="submit" name="submit" value="Sign in" class="signin" id="signin">
                           <?php /*<a href="lost-password.html" class="lost_password">Lost Password?</a>*/?>
                        </div>
				<?php echo $this->Form->end(); ?>
                  </div>
                  <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12  pull-right sidebar">
                     <div class="widget">
                        <h3>Don't have an account?</h3>
                        <ul>
                           <li>
                              <p> If you'd like to find out more about how Jobsite can help you with your recruitment needs, please complete this enquiry form.</p>
                           </li>
                           <li>
                              <p>A member of our Sales team will contact you shortly.</p>
                           </li>
                           <li>
                              <a href="" class="label job-type register">Register</a>
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