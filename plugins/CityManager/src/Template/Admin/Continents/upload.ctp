<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add new casino</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="panel-body">
<?php echo $this->Form->create($city,array('role' => 'form','type' => 'file')); ?>
<?php 
 echo $this->Form->file("file"); ?>
 
<button class="btn btn-default" type="submit">Save</button>
<button class="btn btn-default" type="reset">Reset</button>
<?php echo $this->Form->end(); ?>