<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">City List</h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link('Add New City',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
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
									<div class="col-sm-5"> <?php echo $this->Form->text("title",array('class' =>'form-control','placeholder' => 'Search by title')); ?></div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("email",array('class' =>'form-control','placeholder' => 'Search by email')); ?>
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
									<th width="20%"><?php echo $this->Paginator->sort('country_id','Country'); ?></th>
									<th width="20%"><?php echo $this->Paginator->sort('name','Name'); ?></th>
									<th><?php echo 'Image'; ?></th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($cityDetails as $casino):
										$id	=	$casino->id;
										?>
										<tr>
											<td><?= h($casino->country->name) ?></td>
											<td><?= h($casino->name) ?></td>
											<td>
											<?php 
									if((CASINO_THUMB_IMG_ROOT_PATH.$casino->image)){
										echo $this->Html->image(CASINO_THUMB_IMG_URL.$casino->image,['height' => 100,'width' => 100]);
									} ?></td>
											<td>
												<?= $this->Html->link(__('Edit'), ['action' => 'edit', $casino->id],['class' => 'btn btn-primary']) ?>
												<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $casino->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casino->id),'class' => 'btn btn-danger']) ?>
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
						<?php
						$paginator    =    $this->Paginator; ?>
						<div class="row">
							<div class="col-sm-12 text-right">
								<ul class="pagination">	
								<?php
									echo $paginator->prev(__('Prev', true),
										array(
											'id'=> 'p_prev',
											'tag'=> 'li',
											'escape'=>false
										),
										null,
										array(
											'class'=>'pagination',
											'escape'=>false,
										   'tag'=> 'li',
											'disabledTag'=>'a'
										)
									);
									echo $paginator->numbers(array(
									   'tag'=> 'li',
										'span'=>false,
										'currentClass' => 'pagination',
										'currentTag' => 'a',
										'separator' => false,
										'class' => "pagination"
										
									));    
									echo $paginator->next(__('Next', true),
										array(
											'id'=> 'p_next',
											'tag'=> 'li',
											'escape'=>false
										),
										null,
										array(
											'class'=>'pagination',
											'escape'=>false,
										   'tag'=> 'li',
											'disabledTag'=>'a'
										)
									);
								?>
								</ul>
							</div>
						 </div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>