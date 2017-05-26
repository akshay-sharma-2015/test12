<?php echo $this->Html->script(array(
		WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js',
		WEBSITE_URL.'uploader/assets/js/jquery.js',
		WEBSITE_URL.'uploader/assets/js/jquery-ui-custom.js',
		WEBSITE_URL.'uploader/assets/js/fileupload.js',
		WEBSITE_URL.'uploader/assets/js/lightbox-2.6.min.js',
		WEBSITE_URL.'uploader/assets/js/custom_js.js',
		WEBSITE_ADMIN_JS_URL.'autocomplete.js'
		),
	array('block' =>'bottom')); 
	 echo $this->Html->css(array(
		WEBSITE_ADMIN_CSS_URL.'autocomplete.css',
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
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Form->create($cityDetail,array('role' => 'form')); ?>
								<div class="form-group">
									<label>Country Name</label>
									<?php echo $this->Form->select("country_id",$Countries,array('class' => 'form-control','empty' => false,'required' => true,'id' => 'Countries')); ?>
									<?php echo $this->Form->error("country_id"); ?>
								</div>
								<div class="form-group">
									<label>City Name</label>
									<?php echo $this->Form->text("name",array('class' => 'form-control autocomplete','placesholder' => 'Select City Name','required' => true)); ?>
									<?php echo $this->Form->hidden("city_id",array('id' => 'city_id')); ?>
									<?php echo $this->Form->error("name"); ?>
								</div>
								<div class="form-group">
									<label>Description</label>
									<?php 
									 echo $this->Form->textarea("description",array('class' => 'form-control','placeholdder' => 'Description','required' => true,'id' =>'body')); ?>
					<?php  $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
						CKEDITOR.replace( 'body',{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("description"); ?>
								</div>								
								<div class="form-group">
									<label>Image</label>
									 <div id="container">
										<?php 
										$object_id = rand(999999999,9999999999);
										if(!empty($cityDetail->object_id)){
											$object_id = $cityDetail->object_id;
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
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
$(function() {	
	$(".autocomplete").autocomplete({
		source: function( request, response ) {
			$.ajax({
			  url: "<?php echo $this->Url->build(array('action' => 'cutomer_autocomplete')); ?>",
			  dataType: "json",
			  data: {
				q: request.term+'&'+$("#Countries").val()
			  },
			  success: function( data ) {
				response( data );
			  }
			});
		  },
		  minLength: 1,
		  select: function( event, ui ) {

			name 	=	ui.item.name;
			id 		=	ui.item.id;
			
			setTimeout(function(){
				$(".autocomplete").val(ui.item.name);
			},100);
			 
			 $("#city_id").val(id);
		 },
		  open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		  },
		  close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		  }
	
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		
		 return $( "<li>" )
		.data( "ui-autocomplete-item", item )
		.append("<a href=javascript:void(0);>" + item.name + "</a>")
		.appendTo( ul );
	};
});
<?php $this->Html->scriptEnd(); ?>