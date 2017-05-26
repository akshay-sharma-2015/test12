<?php echo $this->Html->script(array(
		WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),
	array('block' =>'bottom'));
	?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Update continent</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<?php foreach($lanagauageList as $lanagauage){ ?>
				<li class="<?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?> "><a data-toggle="tab" href="#<?php echo $lanagauage->code; ?>_div" aria-expanded="true"><?php echo $lanagauage->name; ?></a></li>
			<?php } ?>
		</ul>
		<?php echo $this->Form->create($country,array('role' => 'form','type' => 'file')); ?>
		<div class="tab-content">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Page Title</label>
					<?php echo $this->Form->text("page_title",array('class' => 'form-control'));
					echo $this->Form->error("page_title"); ?>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Meta Description</label>
					<?php echo $this->Form->textarea("meta_description",array('class' => 'form-control'));
					echo $this->Form->error("meta_description"); ?>
				</div>
			</div>
			<?php 	
			foreach($lanagauageList as $lanagauage){
				$code		=	$lanagauage->code;
				$required	=	 ($lanagauage->is_default == 1) ? '' : '' ; ?>
				<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Name</label>
							<?php 
							if($lanagauage->is_default == 1){
								$val 		=	 (!empty($country->_translations[$code]->name)) ? $country->_translations[$code]->name : $country->name;
								echo $this->Form->text('_translations.'.$code.".name",array('class' => 'form-control','placesholder' => 'Name','required' => $required, 'value' => $val));
							}else{
								echo $this->Form->text('_translations.'.$code.".name",array('class' => 'form-control','placesholder' => 'Name','required' => $required));
							}
							echo ($lanagauage->is_default == 1) ? $this->Form->error("name") : ''; ?>
						</div>
						<div class="form-group">
							<label>Head First Block</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".head_first_block",array('class' => 'form-control','placeholdder' => '	head_first_block','id' =>$code.'head_first_block','required' => $required));
							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>head_first_block',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("head_first_block") : ''; ?>
						</div>
						<div class="form-group">
							<label>Head Second Block</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".head_second_block",array('class' => 'form-control','placeholdder' => '	head_second_block','id' =>$code.'head_second_block','required' => $required));
							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>head_second_block',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("head_second_block") : ''; ?>
						</div>
						
						<div class="form-group">
							<label>Icon Title</label>
							<?php 
							echo $this->Form->text('_translations.'.$code.".icon_title",array('class' => 'form-control','placesholder' => 'Name','required' => $required));
							
							echo ($lanagauage->is_default == 1) ? $this->Form->error("icon_title") : ''; ?>
						</div>
						<div class="form-group">
							<label>Middle Title</label>
							<?php 
							echo $this->Form->text('_translations.'.$code.".niddle_title",array('class' => 'form-control','placesholder' => 'Name','required' => $required));
							
							echo ($lanagauage->is_default == 1) ? $this->Form->error("niddle_title") : ''; ?>
						</div>
						<div class="form-group">
							<label>Footer Title</label>
							<?php 
							echo $this->Form->text('_translations.'.$code.".footer_main_title",array('class' => 'form-control','placesholder' => 'Name','required' => $required));
							
							echo ($lanagauage->is_default == 1) ? $this->Form->error("footer_main_title") : ''; ?>
						</div>
						<div class="form-group">
							<label>Footer Description</label>
							<?php 
							 echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body'.$code)); 
							 $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
								CKEDITOR.replace( 'body<?php echo $code; ?>',{} );
							<?php $this->Html->scriptEnd();
							echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>
						</div>	
					</div>
				</div>
			<?php } ?>
			<div class="col-lg-12">
			   <div class="form-group">
				  <label>Head Image</label>
				  <?php echo $this->Form->file("head_image",array('class' => 'form-contro','placesholder' => 'head_image','required' => false));
				echo $this->Form->error("head_image"); ?>
				  <?php
					 if(!empty($country->head_image)  && file_exists(GALLERY_ROOT_PATH.$country->head_image)){
						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$country->head_image);
					 } ?>
			   </div>
			</div>
			<div class="col-lg-12">
			   <div class="form-group">
				  <label>Icon Image</label>
				  <?php echo $this->Form->file("image",array('class' => 'form-contro','placesholder' => 'image','required' => false));
				echo $this->Form->error("image"); ?>
			
				  <?php
					 if(!empty($country->image)  && file_exists(GALLERY_ROOT_PATH.$country->image)){
					 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$country->image);
					 } ?>
			   </div>
			</div>
			<div class="col-lg-12">
			   <div class="form-group">
				  <label>Icon Hover Image</label>
				  
				<?php echo $this->Form->file("back_image",array('class' => 'form-contro','placesholder' => 'Back Image','required' => false));
				echo $this->Form->error("back_image"); ?>
				  <?php
					 if(!empty($country->back_image)  && file_exists(GALLERY_ROOT_PATH.$country->back_image)){
					 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$country->back_image);
					 } ?>
			   </div>
			</div>
			<div class="col-lg-12">
				<button class="btn btn-default" type="submit">Save</button>
				<button class="btn btn-default" type="reset">Reset</button>
			</div>
		</form>
	</div>
</div>