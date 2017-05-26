<?php use Cake\Core\Configure;  ?>
<div id="page-wrapper">
	<div class="row">
		<?php echo  $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Blog List</h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link('Add Blog',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
											<?php echo $this->element('paging_info'); ?>
										</label>
									</div>
								</div>
								<div class="col-sm-9">
									<?php echo $this->Form->create("Blogs",array('type' => 'get')); ?>
									<div class="col-sm-4">
									</div>
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
									<th  class="td-head"width="20%"><?php echo 'Category'; ?></th>
									<th  class="td-head"width="30%"><?php echo $this->Paginator->sort('title','Title'); ?></th>
									<th  class="td-head"width="25%">Modified</th>
									<th class="td-head">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($blogPages as $records){
										$id	=	$records->id; ?>
										<tr>
											<td><?php echo $records->master->name; ?></td>
											<td><?php echo $records->title; ?></td>
											<td><?php echo date(Configure::read('Reading.date_time_format'),strtotime($records->created)); ?></td>
											<td>
												<?php echo $this->Html->link('Edit',array('action' => 'edit',$id),array('class' => 'btn btn-primary')); ?>&nbsp;
												<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $records->id], ['confirm' => __('Are you sure you want to delete # {0}?', $records->title),'class' => 'btn btn-danger']) ?>
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
						echo $this->element('pagination');
						?>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>