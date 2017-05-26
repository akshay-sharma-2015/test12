<?php use Cake\Core\Configure;
use Cake\Utility\Inflector; ?>
<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Language Translate</h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link('Add New Text',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
								<?php /*
								<div class="col-sm-3">
									<div class="dataTables_length">
										<label>
											<?php echo $this->element('paging_info'); ?>
										</label>
									</div>
								</div>*/?>
								<div class="col-sm-12">
									<?php echo $this->Form->create($model,array('type' => 'get')); ?>
									<div class="col-sm-3">
										<?php echo $this->Form->select("module",Configure::read('language_translate_module'),array('class' =>'form-control','empty' => 'Search By Module','value' => isset($requestedQuery['module']) ? $requestedQuery['module'] : '')); ?>
									</div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("msgid",array('class' =>'form-control','placeholder' => 'Search By Original Text','value' => isset($requestedQuery['msgid']) ? $requestedQuery['msgid'] : '')); ?>
									</div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("msgstr",array('class' =>'form-control','placeholder' => 'Search By Translate Text','value' => isset($requestedQuery['msgstr']) ? $requestedQuery['msgstr'] : '')); ?>
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
									<th width="10%"><?= $this->Paginator->sort('language') ?></th>
									<?php if(isset($requestedQuery['module']) && ($requestedQuery['module'] == 'metadescription' || $requestedQuery['module'] == 'title')){ ?>
										<th><?= 'Page Name'; ?></th>										
									<?php }else{ ?>
										<th width="10%"><?= 'Module'; ?></th>										
									<?php } ?>
									<th width="30%"><?= $this->Paginator->sort('t.msgstr','Original string') ?></th>
									<th  width="30%" class="actions"><?= __('Translate String') ?></th>
									<th class="actions"><?= __('Actions') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;	
								foreach ($textSettings as $textSetting):
									$i=0;
									// pr($textSetting->t);
									?>
								<tr>
									<td><?= $textSetting->language->name ?></td>
									<?php if(isset($requestedQuery['module']) && ($requestedQuery['module'] == 'metadescription' || $requestedQuery['module'] == 'title')){ ?>
										<td><?php
									if(strpos($textSetting->msgid, '.')){
										$arr = explode(".", $textSetting->msgid);
										echo Inflector::humanize($arr[1]);

										// echo  Configure::read('language_translate_module.'.$arr[0]);
									}	?></td>									
									<?php }else{ ?>
										<td><?php
									if(strpos($textSetting->msgid, '.')){
										$arr = explode(".", $textSetting->msgid);
										
										echo  Configure::read('language_translate_module.'.$arr[0]);
									}	?></td>										
									<?php } ?>
									<td><?= h($textSetting->t['msgstr']) ?></td>
									<td><?= h($textSetting->msgstr) ?></td>
									<td class="actions">
										<?= $this->Html->link(__('Edit'), ['action' => 'edit', $textSetting->id],['class' => 'btn btn-primary']) ?>
										<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $textSetting->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $textSetting->id)]) ?>

									</td>
								</tr>
								<?php endforeach; if($i){
									?>
									<tr>
										<td colspan="4" class="text-center">No record found</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
						<?php   $paginator    =    $this->Paginator; ?>
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