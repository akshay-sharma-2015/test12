<?php echo $this->Html->script(array(
	WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),
	array('block' =>'bottom')); ?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Add new email template</h1>
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
							<?php echo $this->Form->create($emailTemplate,array('role' => 'form')); ?>
								<div class="form-group">
									<label>Subject</label>
									<?php echo $this->Form->text("subject",array('class' => 'form-control','placesholder' => 'Title','required' => false)); ?>
									<?php echo $this->Form->error("subject"); ?>
								</div>
								<div class="form-group">
									<label>Action</label>
									<?php echo $this->Form->select("action_id",$actions,array('class' => 'form-control action_id','empty' => false,'required' => false)); ?>
									<?php echo $this->Form->error("action_id"); ?>
								</div>
								<div class="form-group">
									<label>Constant</label>
									<?php echo $this->Form->select("constant",'',array('class' => 'form-control constant','empty' => false,'required' => false,'id' => 'EmailTemplateConstant')) ?>
									<?php echo $this->Form->button('Insert veriable',array('class' => 'btn btn-primary','type' => 'button','onclick' => 'insert()')) ?>
								</div>
								<div class="form-group">
									<label>Body</label>
									<?php //echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));
									 echo $this->Form->textarea("body",array('class' => 'form-control','placeholdder' => 'Description','required' => false,'id' =>'body')); ?>
					<?php $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
						CKEDITOR.replace( 'body',
						{} );
					<?php $this->Html->scriptEnd(); ?>
					<?php echo $this->Form->error("body"); ?>
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

<?php $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
	$(function(){
		$(".action_id").change(function(){
			id	=	$(this).val();
			get(id);
		});
	});
	
	function get(id){
		$.post( "<?php echo $this->Url->build(array('action' => 'get_consatant')); ?>/"+id, function( data ) {
			$( ".constant" ).html( data );
		});
	}
	
	function insert(){
		val	=	$("#EmailTemplateConstant  option:selected").text();
		val	=	"{"+val+"}";
		<!-- $(".ckeditor").append(val); -->
		
		var oEditor = CKEDITOR.instances["body"] ;
			oEditor.insertHtml(val) 
	}
		
		id1	=	$(".action_id").val();
		get(id1);
	
<?php $this->Html->scriptEnd(); ?>