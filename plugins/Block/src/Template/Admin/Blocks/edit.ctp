<?php echo $this->Html->script(array(
	WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),
	array('block' =>'bottom')); ?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Edit Block</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="panel-body">	
		<ul class="nav nav-tabs">
			<?php foreach($lanagauageList as $lanagauage){ ?>
				<li class="<?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?> "><a data-toggle="tab" href="#<?php echo $lanagauage->code; ?>_div" aria-expanded="true"><?php echo $lanagauage->name; ?></a></li>
			<?php } ?>
		</ul>
		<?php echo $this->Form->create($blockPage,array('role' => 'form','type' => 'file')); ?>	
			<div class="col-lg-12 mt10">
				<div class="form-group">
					<label>Page Name</label>
					<?php echo $this->Form->text("page_name",array('class' => 'form-control','placesholder' => 'Page Name','required' => 'required','readonly' => true));
					echo  $this->Form->error("page_name"); ?>
				</div>
			</div>		
			<div class="tab-content">
				<?php 
			foreach($lanagauageList as $lanagauage){
				$code		=	$lanagauage->code;
				$required	=	 ($lanagauage->is_default == 1) ? 'required' : '' ;?>
				<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">
					<div class="col-lg-12">
						<h2><?php echo 'Data in '.$lanagauage->name; ?></h2>
						<div class="form-group">
							<label>Title</label>
							<?php echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control','placesholder' => 'Title','required' => $required,'readonly' => false));
							echo ($lanagauage->is_default == 1) ? $this->Form->error("title") : ''; ?>
						</div>
						
						<div class="form-group"><label>Description</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));
							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>body',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>
						</div>
					</div>
				</div>
		<?php } ?>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Image</label>
					<?php echo $this->Form->file("image",array('class' => 'form-contro','placesholder' => 'Title'));
					
					echo $this->Form->error("image"); ?>
					<?php 
					if(file_exists(GALLERY_ROOT_PATH.$blockPage->image)){ ?><img height="200" width="200" src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=200px&height=200px&cropratio=1:1&image='.GALLERY_IMG_URL.$blockPage->image; ?>" /><?php
					} ?>
				</div>
				<button class="btn btn-default" type="submit">Save</button>
				<button class="btn btn-default" type="reset">Reset</button>
			</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>