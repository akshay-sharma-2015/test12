<?php use Cake\Core\Configure;
use Cake\Error\Debugger;
$this->layout = 'error'; ?>
<div class="mid_wrapper">
<div class="pageErar">
<div class="container">
<h1>404!</h1>
<h2><?php  echo __('error.page_not_found'); ?></h2>
<div class="block"><a href="<?php echo WEBSITE_URL; ?>" class="btn addBtn"><?php  echo __('error.back_to_homepage'); ?></a></div>
</div>
</div>
</div>