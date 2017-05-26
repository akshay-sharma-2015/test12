<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php  $this->Flash->render(); ?>
	</div>
	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Edit profile</h1>
		</div>
		<div class="col-lg-6">
			<?php //echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Form->create($result, [
    'context' => [
        'validator' => 'adminEditProfile'
    ]
]);  ?>
								<div class="form-group">
									<label>Email</label>
									<?php echo $this->Form->text("email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
									<span><?php echo $this->Form->error("email"); ?></span>
								</div>
								<div class="form-group">
									<label>Old Password</label>
									<?php echo $this->Form->password("old_password",array('class' => 'form-control','placesholder' => 'Old Password','required' => false,'value' => '')); ?>
									<span><?php echo $this->Form->error("old_password"); ?></span>
								</div>
								<div class="form-group">
									<label>New Password</label>
									<?php echo $this->Form->password("new_password",array('class' => 'form-control','placesholder' => 'New Password','required' => false,'value' => '')); ?>
									<span><?php echo $this->Form->error("new_password"); ?></span>
								</div>
								<div class="form-group">
									<label>Confirm Password</label>
									<?php echo $this->Form->password("password",array('class' => 'form-control','placesholder' => 'Password','required' => false,'value' => '')); ?>
									<span><?php echo $this->Form->error("confirm_password"); ?></span>
								</div>
								
								<button class="btn btn-default" type="submit">Save</button>
								<button class="btn btn-default" type="reset">Reset</button>
							</form>
						</div>
						<!-- /.col-lg-6 (nested) -->
					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>