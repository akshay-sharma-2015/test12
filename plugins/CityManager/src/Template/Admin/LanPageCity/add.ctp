<div id="page-wrapper" style="min-height: 140px;">
<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>	
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add new casino image</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12" ng-app="plunker"  ng-controller="MainCtrl">
							<?php echo $this->Form->create($lanPageCity,array('type' => 'file','novalidate' => true)); ?>
								<div class="form-group">
									<label>Casino name</label>
									<?php echo $this->Form->text("city_id1",array('class' => 'form-control autocomplete','empty' => true,'placeholder' => 'Search Any Casino','required' => true));  ?>   
									<?php echo $this->Form->hidden("city_id",array('id' => 'city_id'));  ?>   
									<?php echo $this->Form->error("city_id"); ?>
								</div>
								<div class="form-group">
									<label>Image</label>
									<?php echo $this->Form->file("image",['required' => true]); ?>   
									<?php echo $this->Form->error("image"); ?>
								</div>						
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
<?php echo $this->Html->script(array(
		// WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js',
		WEBSITE_ADMIN_JS_URL.'autocomplete.js'
		),
	array('block' =>'bottom')); 
	 echo $this->Html->css(array(
		WEBSITE_ADMIN_CSS_URL.'autocomplete.css'
		),
	array('block' =>'css')); 
	?>
<?php  
$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
$(function () {	
	$(".autocomplete").autocomplete({
		source: function( request, response ) {
			$.ajax({
			  url: "<?php echo $this->Url->build(array('action' => 'city_autocomplete')); ?>",
			  dataType: "json",
			  data: {
				q: request.term
			  },
			  success: function( data ) {
				response( data );
			  }
			});
		  },
		  minLength: 1,
		  select: function( event, ui ) {

			id 		=	ui.item.id;
			
			setTimeout(function(){
				$(".autocomplete").val(ui.item.title);
			},2);
			 
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
		.append("<a href=javascript:void(0);>" + item.title + "</a>")
		.appendTo( ul );
	};
});
<?php $this->Html->scriptEnd(); ?>