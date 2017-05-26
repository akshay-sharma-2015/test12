<?php
    $paginator    =    $this->Paginator;	
 ?>
<div class="row">
	<div class="col-sm-12 text-right">
		<ul class="pagination">	
		<?php
			echo $paginator->prev(__('Prev', true),
				array(
					'id'=> 'p_prev',
					'tag'=> 'li',
					'escape'=>false
				),
				null,
				array(
					'class'=>'pagination',
					'escape'=>false,
				   'tag'=> 'li',
					'disabledTag'=>'a'
				)
			);
			echo $paginator->numbers(array(
			   'tag'=> 'li',
				'span'=>false,
				'currentClass' => 'pagination',
				'currentTag' => 'a',
				'separator' => false,
				'class' => "pagination"
				
			));    
			echo $paginator->next(__('Next', true),
				array(
					'id'=> 'p_next',
					'tag'=> 'li',
					'escape'=>false
				),
				null,
				array(
					'class'=>'pagination',
					'escape'=>false,
				   'tag'=> 'li',
					'disabledTag'=>'a'
				)
			);
		?>
		</ul>
	</div>
 </div>
<style>
.pagination {
    border-radius: 4px;
    display: inline-block;
    margin: 0px 0;
    padding-left: 0;
}
</style>