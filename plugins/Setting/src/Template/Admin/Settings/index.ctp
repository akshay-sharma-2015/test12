<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Site setting</h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link('Add New setting',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive1">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-3">
									<div class="dataTables_length">
										<label>
											<?php //echo $this->element('paging_info'); ?>
										</label>
									</div>
								</div>
								<div class="col-sm-9">
									<?php echo $this->Form->create($model,array('type' => 'get')); ?>
									<div class="col-sm-5"> <?php echo $this->Form->text("key_name",array('class' =>'form-control','placeholder' => 'Search by key','value' => isset($requestedQuery['key_name']) ? $requestedQuery['key_name'] : '')); ?></div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("title",array('class' =>'form-control','placeholder' => 'Search by title','value' => isset($requestedQuery['title']) ? $requestedQuery['title'] : '')); ?>
									</div>
									<div class="col-sm-4">
										<input type="submit" value="Search" class="btn btn-primary">
										<?php echo $this->Html->link("Reset",array('action' => 'index'),array('class' => 'btn btn-default')); ?>
									 </div>
									 <?php echo $this->Form->end(); ?>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="25%"><?= $this->Paginator->sort('title') ?></th>
									<th width="25%"><?= $this->Paginator->sort('key_name') ?></th>
									<th width="25%"><?= $this->Paginator->sort('value') ?></th>
									<th class="actions"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach($result as $records){
									$id	=	$records->id; ?>
									<tr>
										<td><?php echo $this->Text->truncate($records->title,25); ?></td>
										<td><?php echo $records->key_name?></td>
										<td><?php echo $records->value ?></td>
										<td>
											<?php echo $this->Html->link('Edit',array('action' => 'edit',$id),array('class' => 'btn btn-primary')); ?>
											<?php echo $this->Html->link('Delete',array('action' => 'delete',$id),array('class' => 'btn btn-danger','confirm' => 'Are you sure to delete?')); ?>
										</td>
									</tr>	
									<?php
								}
								if(!isset($id)){
									?>
								<tr class="odd gradeX">
									<td colspan="4" class="text-center">No record found</td>
								</tr>
									<?php
									
								} ?>
							</tbody>
						</table>
						<?php 
					// if(!empty($result)){	
						echo $this->element('pagination');
					// }	?>
					</div>
					
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<!-- /.row -->
	<!-- /.row -->
	<!-- /.row -->
</div>
        <!-- /#page-wrapper -->
