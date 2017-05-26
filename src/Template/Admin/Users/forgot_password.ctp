<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Please Sign In</h3>
				</div>
				<div class="panel-body">
				<?php 
				echo $this->Session->flash(); 
				echo $this->Form->create($model,array('role' => 'form')); ?>
						<fieldset>
							<div class="form-group">
								<?php echo $this->Form->email($model.".email",array('class' => 'form-control','placeholder' => 'E-mail','autofocus' => true,'required' => '')); ?>
								<span><?php echo $this->Form->error($model.".email"); ?></span>
							</div>
						<?php	/*
							<div class="checkbox">
								<label>
									<?php echo $this->Form->input($model.".auto_login", array('type' => 'checkbox', 'label' => false,'div' => false)); ?> Remember Me 
								</label>
							</div>
							
						   <?php */ echo $this->Form->submit("Submit",array('class' => 'btn btn-lg btn-success btn-block')); ?>
							<?php echo $this->Html->link('Back To Login',array('action' => 'login')); ?>
						</fieldset>
				  <?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.error-message {
    color: red;
}
</style>
