<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Edit Setting</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
							<?php echo $this->Form->create($setting,array('role' => 'form'));  ?>
								<div class="form-group">
									<label>Title</label>
									<?php echo $this->Form->text("title",array('class' => 'form-control','placesholder' => 'Title','required' => true)); ?>
								</div>
								<div class="form-group">
									<label>Key</label>
									<?php echo $this->Form->text("key_name",array('class' => 'form-control','placesholder' => 'Title','required' => true)); ?>
								</div>
								<div class="form-group">
									<label>Value</label>
									<?php echo $this->Form->textarea("value",array('class' => 'form-control','placesholder' => 'Title','required' => true)); ?>
								</div>
								<div class="form-group">
									<label>Tag type</label>
									<?php echo $this->Form->select("tag_type",array('text' => 'text','textarea' => 'textarea','checkbox' =>'checkbox','text_editor' => 'text_editor','file' => 'file'),array('class' => 'form-control','placesholder' => 'Title','required' => true,'empty' => false)); ?>
									
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