<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Please Sign In</h3>
				</div>
				<div class="panel-body">
				<?php 
				echo $this->Form->create(); ?>
						<fieldset>
							<div class="form-group">
									<?php  echo $this->Flash->render(); ?>
							</div>
							<div class="form-group">
								<?php echo $this->Form->text("username",array('class' => 'form-control','placeholder' => 'E-mail','autofocus' => true)); ?>
							</div>
							<div class="form-group">
							   <?php echo $this->Form->password("password",array('class' => 'form-control','placeholder' => 'Password','value' => '')); ?>
							</div>
						<?php	/*
							<div class="checkbox">
								<label>
									<?php echo $this->Form->input("auto_login", array('type' => 'checkbox', 'label' => false,'div' => false)); ?> Remember Me 
								</label>
							</div>
							
						   <?php */ echo $this->Form->submit("Login",array('class' => 'btn btn-lg btn-success btn-block')); ?>
							<?php //echo $this->Html->link('Forgot password',array('action' => 'forgot_password')); ?>
						</fieldset>
				  <?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.col-lg-12{float:none;}
</style>