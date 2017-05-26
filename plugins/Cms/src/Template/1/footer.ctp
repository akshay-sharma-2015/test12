<?php use Cake\Core\Configure; ?>
<?php 
$twitter	=	Configure::read('FollowUsOn.twitter');
$facebook	=	Configure::read('FollowUsOn.facebook'); 
$linkedin	 =	Configure::read('FollowUsOn.linkedin');
$google		 =	Configure::read('FollowUsOn.g+');

if (false === strpos($twitter, '://')) {
$twitter = 'http://' . $twitter;
}
if (false === strpos($facebook, '://')) {
$facebook = 'http://' . $facebook;
}
if (false === strpos($linkedin, '://')) {
$linkedin = 'http://' . $linkedin;
}

if (false === strpos($google, '://')) {
$google = 'http://' . $google;
} ?>

<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="footer-content">
          <h3>Company</h3>
          <ul>
            <li><a href="#<?php //echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms','cms_slug' => 'about-us')); ?>">About</a></li>
            <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'contactUs')); ?>">Contact</a></li>
            <li><a href="#<?php //echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms','cms_slug' => 'affiliates')); ?>">Affiliates</a></li>
            <li><a href="#<?php //echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms','cms_slug' => 'faq')); ?>">FAQ</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <div class="footer-content">
          <h3>Casino Worldwide</h3>
          <ul>
            <li><a href="#">Casino America</a></li>
            <li><a href="#">Casino Europe</a></li>
            <li><a href="#">Casino Asia</a></li>
            <li><a href="#">Casino Africa</a></li>
            <li><a href="#">Casino Oceania</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <div class="footer-content">
          <h3>Legal</h3>
          <ul>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Privacy policy</a></li>
            <li><a href="#">Security</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <div class="footer-content">
          <h3>Language</h3>
          <?php 
			echo $this->Form->create('Language');
			echo $this->Form->select('lan',$languageList,['id' => 'lang_change','default' => $Defaultlanguage]);
			echo $this->Form->end();
			?>
          <div class="social-icons">
            <ul>
			 <li><a target="_blank" href="<?php echo $facebook; ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>f.png" class="img-responsive" /></a></li>
              <li><a target="_blank" href="<?php echo $linkedin; ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>in.png" class="img-responsive" /></a></li>
              <li><a target="_blank" href="<?php echo $twitter; ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>social.png" class="img-responsive" /></a></li>
              <li><a target="_blank" href="<?php echo $google; ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>tw.png" class="img-responsive" /></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="Footer-bottom">
    <div class="container">
      <div class="copyright">
         <p><?php echo Configure::read('Site.copy_write'); ?></p>
      </div>
    </div>
  </div>
</div>