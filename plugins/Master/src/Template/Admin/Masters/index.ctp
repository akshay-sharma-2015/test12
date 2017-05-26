<?php use Cake\Core\Configure;  ?>
<div id="page-wrapper">
	<div class="row">
		<?php echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header"><?php echo $heading; ?></h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link(__('Add new '.$heading),array('action' => 'add',$type),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
									<?php echo $this->Form->create($model,array('type' => 'get')); ?>
									<div class="col-sm-4">
									</div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("name",array('class' =>'form-control','placeholder' => 'Search by name','value' => isset($requestedQuery['name']) ? $requestedQuery['name'] : '')); ?>
									</div>
									<div class="col-sm-4">
										<input type="submit" value="Search" class="btn btn-primary">
										<?php echo $this->Html->link("Reset",array('action' => 'index',$type),array('class' => 'btn btn-default')); ?>
									 </div>
									 <?php echo $this->Form->end(); ?>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th  class="td-head"width="30%"><?php echo $this->Paginator->sort('name','Name'); ?></th>
									<?php if(in_array($type,Configure::read('image_array'))){ ?>
										<th  class="td-head"width="25%">Image</th>
									<?php } ?>
									<th  class="td-head"width="25%">Modified</th>
									<th class="td-head">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($masters as $master){
										$id	=	$master->id; ?>
										<tr>
											<td><?php echo $master->name; ?></td>
											<?php if(in_array($type,Configure::read('image_array'))){ ?>
												<td  class="td-head"width="25%"><?php 
									if(file_exists(AMENITIES_ROOT_PATH.$master->image)){
										echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$master->image);
									} ?></td>
											<?php } ?>
											<td><?php echo date(Configure::read('Reading.date_time_format'),strtotime($master->modified)); ?></td>
											<td>
												<?php echo $this->Html->link('Edit',array('action' => 'edit',$id,$type),array('class' => 'btn btn-primary')); ?>
												 <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $master->id,$type], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $master->id)]) ?>
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
						<?php echo $this->element('pagination');?>
					</div>					
				</div>
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