<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add new action</h1>
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
							<?php echo $this->Form->create($model,array('role' => 'form'));  ?>
								<div class="form-group">
									<label>Action in small letter or under score</label>
									<?php echo $this->Form->text($model.".action",array('class' => 'form-control','placesholder' => 'Title','required' => true)); ?>
								</div>
								<div class="form-group">
									<label>Constant</label>
									<?php echo $this->Form->text($model.".constant.",array('class' => 'form-control constant','empty' => false,'required' => true)) ?>
									<div id="append1"></div>
									<?php echo $this->Form->button('Add Constant',array('class' => 'btn btn-primary','type' => 'button','onclick' => 'insert()')) ?>
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

<?php $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
	
	function insert(){
		$("#append1").append('<input type="text" required="required" class="form-control constant" name="data[EmailTemplate][constant][]">');
	}
<?php $this->Html->scriptEnd(); ?>