<div class="banner_inner banner_back_top  img_block10 New_details">
   <div class="banner_info banner_textblock">
      <div class="container bannerNews">
         <h1><?php echo $newsBlock->title; ?></h1>
         <div class="newsText">
            <div class="row">
               <div class="col-md-6">
                  <?php echo $newsBlock->description; ?>
               </div>
               <div class="col-md-6">                  
                  <?php echo $newsBlock->second_description; ?>
               </div>
            </div>
         </div>
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
      <div class="container"><?php if(!empty($mainNews)){ ?>
         <div class="newsInfo">
            <div class="row">
               <div class="col-md-6">
                  <div class="CAsino_derails_info">
                     <div class="CAsino_derails">
                        <h2><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>"><?php echo $mainNews->title; ?></a></h2>
						<p><span><?php echo $mainNews->created->format('F d, Y');  ?></span> / by:  <?php echo $mainNews->user->name; ?></p>
                     </div>
                     <div class="newsPera"><?php echo $mainNews->sdescription; ?><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>">more...</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="imageBox"><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>"><?php 
					 if(!empty($mainNews->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$mainNews->image)){
						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=578px&height=320px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$mainNews->image,['alt' => 'Image','height'=>320, 'width'=>578]);
					 } ?></a></div>
               </div>
            </div>
         </div><?php } ?>
         <div class="filtrInner">
            <div class="newsList">
               <ul>
                 <?php foreach($result as $records){ ?>
                  <li>
                     <div class="pull-left"><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $records->slug)); ?>"><?php 
					 if(!empty($records->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$records->image)){
						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=272px&height=154px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$records->image,['alt' => 'Image','height'=>154, 'width'=>272]);
					 } ?></a></div>
                     <div class="newsDetail">
                        <h2><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $records->slug)); ?>"><?php echo $records->title; ?></a></h2>
                        <div class="block"><span><?php echo $records->created->format('F d, Y'); ?></span>&nbsp;/ by: <?php echo $records->user->name; ?></div>
                        <div class="newsPera"><?php echo $records->sdescription; ?><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $records->slug)); ?>">more...</a></div>
                        <div class="block comment"><span class="pull-right"><?php echo $records->question_count; ?> comments</span></div>
                     </div>
                  </li>
				 <?php } if($result->isEmpty()){
					 ?>
					 <li class="text-center">
					 No Record found
					 </li>
					 <?php
				 } ?>
               </ul>
               <div class="block Pagination_info2"><?php echo $this->element('pagination2',['modelName' => 'News']); ?></div>
            </div>
			<div class="newsaws_info">
			   <div class="newsaws_post">
				<?php echo $this->Form->create('News',['url' => '/news']); ?>
				  <div class="search_boxDetails newsSearch">
				<?php echo $this->Form->text('search',['placeholder' => 'Search news']); ?>
					 <button type="Submit"><img src="<?php echo WEBSITE_IMG_URL; ?>search_img.png" alt="img" /></button>
				  </div>	  
				<?php echo $this->Form->end(); ?>
							<?php echo $this->cell('Inbox::news_right_side_bar_index', [], ['cache' => ['config' => 'longlong', 'key' => 'news_index_'.$Defaultlanguage]]); ?>
							
							 </div>
			</div>
		
		  </div>
      </div>
   </div>
</div>