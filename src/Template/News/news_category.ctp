<div class="banner_inner banner_back_top  img_block10 New_details">
   <div class="banner_info banner_textblock">
      <div class="container bannerNews">
         <h1><?php echo $masters->name; ?> News</h1>
         <div class="topics_info">
            <ul>
               <li>Topic</li>
				<?php echo $this->cell('Inbox::news_category', [], ['cache' => ['config' => 'longlong', 'key' => 'news_category_'.$Defaultlanguage]]); ?>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="mid_wrapper">
   <div class="casinoSearch">
      <div class="container">
         <div class="filtrInner">
            <div class="newsInfo newsInfo3">
               <div class="CAsino_derails_info">
                  <div class="CAsino_derails">
                        <h2><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>"><?php echo $mainNews->title; ?></a></h2>
					   <p><span><?php echo $mainNews->created->format('F d, Y');  ?></span> / by:  <?php echo $mainNews->user->name; ?></p>
                  </div>
               </div>
                  <?php if(!empty($casinoImage)){ ?>
				  <div class="detail_banner"> 
					<div class="flexslider banner_slide"  id="photoslider" >
						<ul class="slides">
							<?php
							foreach($casinoImage as $image)
							{ 
								if(file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){ ?>
									<li class="w449">
										<?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=807px&height=454px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>
									</li>
								<?php 
								}
							} ?>
						</ul>
					</div>
					<?php if($casinoImage->count() > 1){ ?>
						<span class="left-span"><a href="javascript:void(0);" class="prev"><img src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span> 
						<span class="right-span"><a href="javascript:void(0);" class="next"><img src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a></span>
					<?php } ?>
					</div>
		<?php } ?>
               <div class="newsDetail">
                 <div class="newsPera"><?php echo $mainNews->sdescription; ?><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>">more...</a></div>
                  <div class="block comment"><span class="pull-right"><?php echo $mainNews->question_count; ?> comments</span></div>
               </div>
               <div class="newsList">
                  <ul>
                       <?php foreach($result as $records){ ?>
					  <li>
						 <div class="pull-left"><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>"><?php 
						 if(!empty($records->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$records->image)){
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=272px&height=154px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$records->image,['alt' => 'Image','height'=>154, 'width'=>272]);
						 } ?></a></div>
						 <div class="newsDetail">
							<span><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>"><?php echo $records->title; ?></a></span>
							<div class="block"><span><?php echo $records->created->format('F d, Y'); ?></span>&nbsp;/ by: <?php echo $records->user->name; ?></div>
							<div class="newsPera"><?php echo $records->sdescription; ?><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $records->slug)); ?>">more...</a></div>
							<div class="block comment"><span class="pull-right"><?php echo $records->question_count; ?> comments</span></div>
						 </div>
					  </li>
					 <?php } ?>
                  </ul>
               <div class="block Pagination_info2"><?php //$paginator    =    $this->Paginator;  ?>
 <?php if( isset($this->request->params['paging'][$this->request->params['controller']]['pageCount']) && $this->request->params['paging'][$this->request->params['controller']]['pageCount'] > 1){ ?>
<div class="Pagination_nav">
	<ul>
	<?php
	$current	=	$this->request->params['paging'][$this->request->params['controller']]['page'];
	$page		=	$this->request->params['paging'][$this->request->params['controller']]['page'];
	$prevPage	=	$this->request->params['paging'][$this->request->params['controller']]['prevPage'];
	$nextPage	=	$this->request->params['paging'][$this->request->params['controller']]['nextPage'];
	$pageCount	=	$this->request->params['paging'][$this->request->params['controller']]['pageCount'];
	// pr($this->request->params['paging']); ?>	
	<li class="prev <?php echo (!empty($prevPage)) ? '' : 'disabled'; ?>"><a href="<?php echo (!empty($prevPage)) ? $this->Url->build(['plugin' => '','controller' => 'News','action' => 'news_view','news_view' => $slug]).'?page='.($current-$prevPage) : 'javascript:void(0);'?>"><i class="fa fa-caret-left"></i></a></li>	
	<?php for($i=1; $i <= $pageCount; $i++){		?>
		<li class="<?php echo ($i == $page) ? 'active' : ''; ?>"><a href="<?php echo ($i != $page) ? $this->Url->build(['plugin' => '','controller' => 'News','action' => 'news_view','news_view' => $slug]).'?page='.($i) : 'javascript:void(0);'?>"><?php echo $i; ?></a></li>
		<?php
	} ?>
	<li class="prev <?php echo (!empty($nextPage)) ? '' : 'disabled'; ?>"><a href="<?php echo (!empty($nextPage)) ? $this->Url->build(['plugin' => '','controller' => 'News','action' => 'news_view','news_view' => $slug]).'?page='.($current+$nextPage) : 'javascript:void(0);'?>"><i class="fa fa-caret-right"></i></a></li>
	</ul>
</div>
	<?php  } ?>
	
	</div>
               </div>
            </div>
			<?php //echo $this->element('news_right_side_bar',[],['cache' => true]); ?>
			<?php echo $this->cell('Inbox::news_right_side_bar', [], ['cache' => ['config' => 'longlong', 'key' => 'news_right_side_bar_'.$Defaultlanguage]]); ?>
	   </div>
      </div>
   </div>
</div>
<?php 
echo $this->element('add_review_popup');
/* echo $this->Html->css(array(
		WEBSITE_CSS_URL.'flexslider.css'
	),array('block' =>'css'));
echo $this->Html->script(array(WEBSITE_JS_URL.'jquery.flexslider.js'),array('block' =>'footer_script'));
	 */
	$this->Html->scriptStart(array('block' => 'custom_script'));
	?>
		$('#photoslider').flexslider({
            animation: 'fade',
            controlsContainer: '.flex-container',
			controlNav: false,
			directionNav: false
        });
		
		$(".prev").click(function() {
			$('#photoslider').flexslider("prev")
		});
		
		$("#<?php echo $slug ?>").addClass('active');
		
		$(".next").click(function() {
			$('#photoslider').flexslider("next")
		});
<?php $this->Html->scriptEnd(); ?>
	