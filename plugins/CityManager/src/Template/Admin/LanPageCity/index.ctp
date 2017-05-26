<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Casino List</h1>
			</div>
			<div class="col-lg-6">
				<?php if($city->count() < 10) {
					echo $this->Html->link('Add New',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); 
				} ?>
				    <?php //$this->Html->link(__('Excel'), ['action' => 'excell', '_ext'=>'xlsx']); ?>
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
					<div class="table-responsive1"><?php /*
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
									<?php echo $this->Form->create($model,array('type' => 'get')); /* ?>
									/* <div class="col-sm-4">
										<?php echo $this->Form->select("country_id",$Country,array('class' =>'form-control','empty' => 'Search by country','value' => isset($requestedQuery['country_id']) ? $requestedQuery['country_id'] : '')); ?>
									</div> *//* ?>
									<div class="col-sm-3">
										<?php echo $this->Form->text("name",array('class' =>'form-control','placeholder' => 'Search by name','value' => isset($requestedQuery['name']) ? $requestedQuery['name'] : '')); ?>
									</div>
									<div class="col-sm-4">
										<input type="submit" value="Search" class="btn btn-primary">
										<?php echo $this->Html->link("Reset",array('action' => 'index'),array('class' => 'btn btn-default')); ?>
									 </div>
									 <?php echo $this->Form->end(); ?>
								</div>
							</div>
						</div>*/?>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th  class="td-head"width="40%"><?php echo $this->Paginator->sort('name','Name'); ?></th>
									<?php /*<th  class="td-head"width="20%"><?php echo 'Country Name'; ?></th>*/?>
									<th  class="td-head"width="20%">Image</th>
									<th class="td-head">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								// if(!empty($emailTemplates)){
									foreach($city as $records){ //pr($records);
										$id	=	$records->id;
										?>
										<tr>
											<td><?php echo $records->city->title; ?></td>
											<?php /*<td><?php echo $records->city->country->name; ?></td>*/ ?>
											<td><?php
					 if((GALLERY_ROOT_PATH.$records->image)){
					 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$records->image);
					 } ?></td>
											<td>
												<?php echo $this->Html->link('Edit',array('action' => 'edit',$id),array('class' => 'btn btn-primary')); ?>
												<?php  $this->Form->postLink(__('Delete'), ['action' => 'delete', $records->id], ['confirm' => __('Are you sure you want to delete # {0}?', $records->id),'class' => 'btn btn-danger']) ?>
											</td>
										</tr>	
										<?php
									}
								if(!isset($id)){
									?>
								<tr class="odd gradeX">
									<td colspan="5" class="text-center">No record found</td>
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