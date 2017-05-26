<?php use Cake\Core\Configure;  ?>
<div id="page-wrapper">
	<div class="row">
		<?php  $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Contact Message</h1>
			</div>
			<div class="col-lg-6">
				<?php //echo $this->Html->link('Add Email Templates',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
			</div>
		</div>
	</div>
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
									
									<div class="col-sm-3">
										<?php echo $this->Form->text("name",array('class' =>'form-control','placeholder' => 'Search by name','value' => isset($requestedQuery['name']) ? $requestedQuery['name'] : '')); ?>
									</div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("email",array('class' =>'form-control','placeholder' => 'Search by email','value' => isset($requestedQuery['email']) ? $requestedQuery['email'] : '')); ?>
									</div>
									<div class="col-sm-3">
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
									<th><?= $this->Paginator->sort('name') ?></th>
									<th><?= $this->Paginator->sort('email') ?></th>
									<th><?= $this->Paginator->sort('created') ?></th>
									<th class="actions"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($contacts as $contact){
										$id	=	$contact->id;
										?>
										 <tr>
											<td><?= h($contact->name) ?></td>
											<td><?= h($contact->email) ?></td>
											<td><?= h($contact->created) ?></td>
											<td class="actions">
												<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id),'class' => 'btn btn-danger']) ?>
												<?= $this->Html->link(__('View'), ['action' => 'view', $contact->id],['class' => 'btn btn-primary']); ?>
											</td>
										</tr>
										<?php
									}
								if(!isset($id)){
									?>
								<tr class="odd gradeX">
									<td colspan="6" class="text-center">No record found</td>
								</tr>
									<?php									
								} ?>
							</tbody>
						</table>
						<?php echo $this->element('pagination'); ?>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>