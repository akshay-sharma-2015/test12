<?php /*use Cake\Core\Configure;  ?>
<div class="col_12" style="text-align: center;">
	<form method="post" class="form-horizontal" id="page-info">
		<?php 
		$record_select_box1	=	explode(',',Configure::read("Reading.record_select_box"));
		$record_select_box2	=	explode(',',Configure::read("Reading.record_select_box"));
		$record_select_box	=	array_combine(array_keys(array_flip($record_select_box1)), $record_select_box2);
		
		echo $this->Form->select($model.".recordsPerPage",$record_select_box,array('class' => 'form-control','onchange' => 'numpage()','empty' => 'Records per page')) ?>
	</form>
 </div>
 <script>
	function numpage(){
		$("#page-info").submit();
	}
 </script>*/?><div class="col_12" style="text-align: center;">&nbsp;</div>
 