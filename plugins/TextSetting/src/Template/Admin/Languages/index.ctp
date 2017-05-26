<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Language List</h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link('Add New Language',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="50%"><?php echo 'Language'; ?></th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($languages as $language):
										$id	=	$language->id;
										?>
										<tr>
											<td><?= h($language->name) ?></td>
											<td>
												<?php 
												if($language->is_default == 1){
													echo 'Default Language';
												}else{
													echo $this->Html->link('Click to set default language',array('action' => 'default_language',$id),array('class' => 'btn btn-default','title' => 'Click to set default language'));													
												} ?>
												<?php 
												if($language->is_default != 1){
													$title	=	($language->is_active == 1) ? 'Active' : 'Inactive';
													$title2	=	($language->is_active == 1) ? 'Inactive' : 'Active';
													
													$class	=	($language->is_active == 0) ? 'btn btn-info' : 'btn btn-success';
													$status	=	($language->is_active == 1) ? 1 : 0;
													
													echo $this->Html->link($title,array('action' => 'active',$id,$status),array('class' => $class,'title' => 'Click to mark as '.$title2)); 
												}
												?>
												
												
												<?= $this->Html->link(__('Edit'), ['action' => 'edit', $language->id],['class' => 'btn btn-primary']) ?>
												<?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $language->id], ['confirm' => __('Are you sure you want to delete # {0}?', $language->id),'class' => 'btn btn-danger']) ?>
											</td>
										</tr>	
									 <?php endforeach;

								if(!isset($id)){ ?>
								<tr class="odd gradeX">
									<td colspan="5" class="text-center">No record found</td>
								</tr>
									<?php
									
								} ?>
							</tbody>
						</table>
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