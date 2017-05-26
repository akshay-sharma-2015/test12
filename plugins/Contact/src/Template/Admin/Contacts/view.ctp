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
				<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<table class="table ">
				<tr>
					<th><?= __('Name') ?></th>
					<td><?= h($contact->name) ?></td>
				</tr>
				<tr>
					<th><?= __('Email') ?></th>
					<td><?= h($contact->email) ?></td>
				</tr>
				<tr>
					<th><?= __('Created') ?></th>
					<td><?= h($contact->created) ?></td>
				</tr>
				<tr>
					<th><?= __('Message') ?></th>
					<td><?= $this->Text->autoParagraph(h($contact->message)); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
