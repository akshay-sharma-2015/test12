<?php echo $this->Html->script(array(
		WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js',
		// WEBSITE_URL.'uploader/assets/js/jquery.js',
		WEBSITE_URL.'uploader/assets/js/jquery-ui-custom.js',
		WEBSITE_URL.'uploader/assets/js/fileupload.js',
		WEBSITE_URL.'uploader/assets/js/lightbox-2.6.min.js',
		WEBSITE_URL.'uploader/assets/js/custom_js.js',
		// WEBSITE_ADMIN_JS_URL.'autocomplete.js'
		),
	array('block' =>'bottom')); 
	 echo $this->Html->css(array(
		// WEBSITE_ADMIN_CSS_URL.'autocomplete.css',
		WEBSITE_URL.'uploader/assets/css/style.css',
		WEBSITE_URL.'uploader/assets/css/lightbox.css',
		),
	array('block' =>'css')); 
	?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add new casino</h1>
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
		<?php echo $this->Form->create($city,array('role' => 'form')); ?>
		<div class="tab-content">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Country Name</label>
					<?php echo $this->Form->select("country_id",$Country,array('class' => 'form-control','empty' => 'Select Country','required' => false,'id' => 'Countries')); ?>
					<?php echo $this->Form->error("country_id"); ?>
				</div>			
			</div>
			<div class="col-lg-12 form-group" id="c_title">
				<label>Slug</label>
				<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1','required' => false));
				echo $this->Form->error("slug"); ?>
			</div>	
			<div class="col-lg-12 form-group">
				<label>Population</label>
				<?php echo $this->Form->text("population",array('class' => 'form-control','required' => false));
				echo $this->Form->error("population"); ?>
			</div>
			<div class="col-lg-12 form-group">
				<label>Altitude</label>
				<?php echo $this->Form->text("altitude",array('class' => 'form-control','required' => false));
				echo $this->Form->error("altitude"); ?>
			</div>				
	<?php 	foreach($lanagauageList as $lanagauage){
				$code		=	 $lanagauage->code;
				$required	=	 ($lanagauage->is_default == 1) ? 'false' : '' ; ?>
				<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">
					<div class="col-lg-12">
						<h2><?php echo 'Data in '.$lanagauage->name; ?></h2>
						<div class="form-group">
							<label>City Name</label>
							<?php 
							if($lanagauage->is_default == 1){
								$val 		=	 (!empty($city->_translations[$code]->name)) ? $city->_translations[$code]->name : $city->name;
								echo $this->Form->text('_translations.'.$code.".name",array('class' => 'form-control c_title','placesholder' => 'City Name','required' => $required, 'value' => $val));
							}else{
								echo $this->Form->text('_translations.'.$code.".name",array('class' => 'form-control','placesholder' => 'City Name','required' => $required));
							}						
							echo ($lanagauage->is_default == 1) ? $this->Form->error("name") : ''; ?>
						</div>
						<div class="form-group" style="display:none">
							<label>Description</label>
							<?php 
							 // echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','required' => $required,'id' =>'body'.$code)); 
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
					<label>Image</label>
					 <div id="container">
						<?php 
						$object_id = rand(999999999,9999999999);
						if(!empty($city->object_id)){
							$object_id = $city->object_id;
						}
						$user_id = ADMIN_ID;   
						$type_id = 1;
						add_uploader($object_id , $user_id, $type_id);
						echo $this->Form->hidden("object_id",array("value" => $object_id)); ?> 
					</div>
					<?php echo $this->Form->error("object_id"); ?>
				</div>
				<button class="btn btn-default" type="submit">Save</button>
				<button class="btn btn-default" type="reset">Reset</button>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<?php  $this->Html->scriptStart(array('block' => 'custom_script')); ?>
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
$('#c_title').removeClass('hide');	
	$('#c_title1').val(slug($(".c_title").val()));
<?php $this->Html->scriptEnd(); ?>