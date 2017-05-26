<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false)); ?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo $key ?> Setting</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Form->create($model,array('role' => 'form','type' => 'file'));  ?>
						<?php   if(!empty($res)){
									foreach($res as $val){
										$tag_type		=	$val->tag_type;
										$value			=	$val->value;
										$title			=	$val->title;
										$id				=	$val->id;
										switch($tag_type){
											case  'text':
											
											case  'textarea':
												echo '<div class="form-group"><label>'.$title.'</label>';
												echo $this->Form->{$tag_type}($id,array('class' => 'form-control','value' => $value,'required' => true));
												echo  '</div>';
											break;
											case  'text_editor':
												echo '<div class="form-group"><label>'.$title.'</label>';
												 echo $this->Form->textarea($id,array('class' => 'form-control ckeditor','placeholdder' => 'Description','required' => true,'value' => $value));
												echo  '</div>';
											break;
											case  'file':
												echo '<div class="form-group"><label>'.$title.'</label>';
												 echo $this->Form->file($id,array('class' => 'form-control1'));
												 echo $this->Html->image($value,array('height' => '100'));
												echo  '</div>';
											break;
											case  'checkbox':
												echo '<div class="form-group"><label>'.$title.'</label>';
												
												echo $this->Form->checkbox($id,array('class' => 'checkbox','default' => $value));
												echo  '</div>';
											
											break;
										}
									}
								} ?>
								<button class="btn btn-default" type="submit">Save</button>
								<button class="btn btn-default" type="reset">Reset</button>
							</form>
						</div>
						<!-- /.col-lg-6 (nested) -->
					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>