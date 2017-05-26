<?php echo $this->Html->script(array(WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),array('block' =>'bottom')); 	?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php echo  $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add News</h1>
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
		<?php echo $this->Form->create($newsPage,array('role' => 'form','type' => 'file')); ?>			
			<div class="tab-content">
				<div class="col-lg-12">			
					<div class="form-group"><br/>
						<label>Category</label>
						<?php  echo $this->Form->select("master_id",$master_id,array('class' => 'form-control'));
						echo ($lanagauage->is_default == 1) ? $this->Form->error("master_id") : ''; ?>
					</div>	
				</div>
				<div class="col-lg-12">			
					<div class="form-group">
						<label>News By</label>
						<?php  echo $this->Form->select("news_user",$news_user,array('class' => 'form-control'));
						echo ($lanagauage->is_default == 1) ? $this->Form->error("news_user") : ''; ?>
					</div>	
				</div>
				<div class="col-lg-12 <?php echo (!empty($this->Form->error("slug"))) ? '' : 'hide'; ?>" id="c_title">
					<div class="form-group">
						<label>Url</label>
						<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1','required' => false));
						echo $this->Form->error("slug"); ?>
					</div>
				</div>	
				<?php 
			foreach($lanagauageList as $lanagauage){
				$code		=	$lanagauage->code;
				$required	=	 ($lanagauage->is_default == 1) ? 'false' : '' ;?>
				<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">
					<div class="col-lg-12">
						<h2><?php echo 'Data in '.$lanagauage->name; ?></h2>
						<div class="form-group">
							<label>Title</label>
							<?php 
							
					if ($lanagauage->is_default == 1){
							echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control c_title','placesholder' => 'Title','required' => $required,'id' => 'focus'));
					}else{						
						echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control','placesholder' => 'Title','required' => $required));						
					}
							echo ($lanagauage->is_default == 1) ? $this->Form->error("title") : ''; ?>
						</div>
						<div class="form-group">
							<label>Description</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));
							$this->Html->scriptStart(array('block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>body',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>
						</div>
						<div class="form-group">
							<label>Page Title</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".meta_keyword",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));
							echo ($lanagauage->is_default == 1) ? $this->Form->error("meta_keyword") : ''; ?>
						</div>	
						<div class="form-group">
							<label>Meta description</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".meta_description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));
							echo ($lanagauage->is_default == 1) ? $this->Form->error("meta_description") : ''; ?>
						</div>										
					</div>
				</div>
		<?php } ?>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Image</label>
					<?php  
					echo $this->Form->file("image");
					echo $this->Form->error("meta_description"); ?>
				</div>
			</div>	
			<div class="col-lg-12">				
				<button class="btn btn-default" type="submit">Save</button>
				<button class="btn btn-default" type="reset">Reset</button>
			</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<?php  
 $this->Html->scriptStart(array('block' => 'custom_script')); ?>

 var slug = function(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}
$(".c_title").keyup(function(){
	$('#c_title').removeClass('hide');	
	$('#c_title1').val(slug($(this).val()));	
});
// $("#focus").trigger('keyup');
<?php $this->Html->scriptEnd();  ?>