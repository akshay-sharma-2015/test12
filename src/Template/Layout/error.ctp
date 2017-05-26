<?php 
use Cake\Core\Configure;
$here = $this->request->here();
$canonical = $this->Url->build($here, true);
 $plugin		=	$this->request->params['plugin'];
 $controller	=	$this->request->params['controller'];
 $action		=	$this->request->params['action'];  ?>
<!DOCTYPE html>
<html lang="<?php echo (!empty($Defaultlanguage)) ? $Defaultlanguage :'en'; ?>">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo isset($pageTitle) ? $pageTitle : __('title.homepage');
	$metaDescription	=	(isset($metaDescription) ? $metaDescription : __('metadescription.homepage')); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php if(SUBDIR ==''){ ?>
<meta name="google-site-verification" content="DW0n9hlh9qppmoXsjIlnOHbzW54AwOA0jskLJC6EU7g" />
<?php }
	echo $this->fetch('css1');
	echo $this->Html->meta(
		'description',$metaDescription
	);	
	/* if(Configure::read('debug')){ */
		echo $this->Html->css(array('bootstrap.css','custom.css','stylesheet.css','font.css','font-awesome.css','autocomplete.css','jquery.raty.css','pnotify.custom.min.css'),array('block' =>'css'));
	/* }else{
		echo $this->element('home_page_css',[],['cache' => true]);
	}	 */
	echo $this->fetch('meta');

	echo $this->fetch('css');
	?>
</head>
<body>
<?php if(SUBDIR ==''){ ?>
<script>
!function(e,t,a,n,c,s,o){e.GoogleAnalyticsObject=c,e[c]=e[c]||function(){(e[c].q=e[c].q||[]).push(arguments)},e[c].l=1*new Date,s=t.createElement(a),o=t.getElementsByTagName(a)[0],s.async=1,s.src=n,o.parentNode.insertBefore(s,o)}(window,document,"script","https://www.google-analytics.com/analytics.js","ga"),ga("create","UA-84809368-1","auto"),ga("send","pageview");
</script>
<?php }else{ ?>
	<script>
// !function(e,t,a,n,c,s,o){e.GoogleAnalyticsObject=c,e[c]=e[c]||function(){(e[c].q=e[c].q||[]).push(arguments)},e[c].l=1*new Date,s=t.createElement(a),o=t.getElementsByTagName(a)[0],s.async=1,s.src=n,o.parentNode.insertBefore(s,o)}(window,document,"script","https://www.google-analytics.com/analytics.js","ga"),ga("create","UA-90022735-1","auto"),ga("send","pageview");
</script>
<?php } ?>
<div id="ajax-loader" class="loading-indicator fancy hide"><div class="clock"><div class="hand minute"></div><div class="hand hour"></div></div></div>
<?php echo $this->element('header_menu'); ?>
<script>WEBSITE_UPLOADS_URL ='<?php echo WEBSITE_URL; ?>';</script>
<?php 
if(Configure::read('debug')){
echo $this->fetch('content');
}else{
	?>
	<div class="mid_wrapper">
<div class="pageErar">
<div class="container">
<h1>404!</h1>
<h2><?php  echo __('error.page_not_found'); ?></h2>
<div class="block"><a href="<?php echo WEBSITE_URL; ?>" class="btn addBtn"><?php  echo __('error.back_to_homepage'); ?></a></div>
</div>
</div>
</div>
	<?php
}
echo $this->element('footer');
if(!$this->request->session()->read('Auth.User')){
	echo $this->element('signup');
}
if(Configure::read('debug')){
	echo $this->Html->script(array('jquery.min.js','bootstrap.min.js','angular.min.js','jquery.flexslider.js','jquery.form.min.js','autocomplete.js','jquery.raty.js','pnotify.custom.min.js','lazyload.js'),array('block' =>'script'));
}else{
	echo $this->element('javascript',[],['cache' => true]);
}
echo $this->fetch('script'); 
echo $this->fetch('footer_script'); 
echo $this->fetch('custom_script'); ?>
<script type="text/javascript">
$("a[rel='nofollow']").click(function(){
	title = $(this).attr('data-title');
	href  = $(this).attr('data-url');
	ga("send", "event", "Affliate Url", title+'(www.casinolineup.com'+$(this).attr('href')+')', "Visited");
});
$(".readonly").raty({
    halfShow: true,
    readOnly: !0,
    score: function() { 
		score	=	$(this).attr("data-score");
		// score	=	60+(score*40/10);
        // return $(this).attr("data-score")
		// alert(score);
		// score	=	score/2/10;
        return score
    }
});
$("img.lazy").lazyload();
<?php if($controller =='Users' && $action =='index'){ ?>
showChar = 130, $(window).load(function() {
    ph = 0, $(".ppppp ul").each(function() {
        h = $(this).height(), h > ph && (ph = h)
    }), $(".ppppp ul").height(ph), ph = 0, $(".whole-block").each(function() {
        h = $(this).height(), h > ph && (ph = h)
    }), $(".whole-block").css("min-height", ph), $(".flexslider").flexslider({
        animation: "fade",
        slideshowSpeed: 7e3,
        controlNav: !1,
        directionNav: !0,
        pausePlay: !1
    })
});
<?php }  ?>
$(function() {
<?php /* if(in_array($action,array('locations','onlineCasino','promotion','news','casinoSlug')) || (in_array($action,array('index')) && in_array($controller,array('Users')))){ */ ?>
    $(".autocomplete").keydown(function(e) {
        13 == e.keyCode && (url = $(".search-back-a").attr("data-ng-href"), window.location = url)
    }), $(".autocomplete").autocomplete({
        source: function(e, a) {
            var t = ($(this), $(this.element)),
                l = t.data("jqXHR");
            l && l.abort(), t.data("jqXHR", $.ajax({
                url: "<?php echo $this->Url->build(array('plugin' =>'','controller' =>'Users','action' =>'city_autocomplete')); ?>",
                dataType: "json",
                data: {q: e.term
                },
                success: function(e) {a(e), $(".autocomplete").removeClass("ui-autocomplete-loading")
                }
            }))
        },
        minLength: 1,
        select: function(e, a) {
            name = a.item.label, cc_fips = a.item.value, setTimeout(function() {
                $(".autocomplete").val(a.item.name)
            }, 2), $("#city_id").val(cc_fips)
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
			<?php if($controller =='Users' && $action =='index' || $action =='casinoSlug'){ ?>
			 $("#ui-id-1").addClass("index-page");
			<?php }else{ ?>
			 $("#ui-id-1").addClass("index-page");
			<?php } ?>
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all")
        }
    }).data("ui-autocomplete")._renderItem = function(e, a) {
        return type = a.type, "country" == type ? (name = a.name, $("<li class='cuntryIc'>").data("ui-autocomplete-item", a).append("<a href='<?php if(!empty($Defaultlanguage) && $Defaultlanguage !='en'){ echo WEBSITE_URL.$Defaultlanguage.'/'; }else{ echo WEBSITE_URL; } ?>" + a.slug + "'><i class=''></i><em></em>" + name + "</a>").appendTo(e)) : "city" == type ? (name = a.name + ", " + a.country, $("<li class='cityIc'>").data("ui-autocomplete-item", a).append("<a href='<?php if(!empty($Defaultlanguage) && $Defaultlanguage !='en'){ echo WEBSITE_URL.$Defaultlanguage.'/'; }else{ echo WEBSITE_URL; } ?>"+a.country_slug+"/"+ a.slug + "'><i class=''></i><em></em>" + name + "</a>").appendTo(e)) : "online" == type ? (name = a.name, $("<li class='onlinecasinoIc'>").data("ui-autocomplete-item", a).append("<a href='<?php if(!empty($Defaultlanguage) && $Defaultlanguage !='en'){ echo WEBSITE_URL.$Defaultlanguage.'/'; }else{ echo WEBSITE_URL; } ?>online-casinos/" + a.slug + "'><i class=''></i><em></em>" + name + "</a>").appendTo(e)) : (name = a.name, $("<li class='casinoIc'>").data("ui-autocomplete-item", a).append("<a href='<?php if(!empty($Defaultlanguage) && $Defaultlanguage !='en'){ echo WEBSITE_URL.$Defaultlanguage.'/'; }else{ echo WEBSITE_URL; } ?>casino/" + a.slug + "'><i class=''></i><em></em>" + name + "</a>").appendTo(e))
    }
<?php /* } */ ?>
});
$(function() {
    $(".autocomplete").click(function() {
        if ($("#ui-id-1").length > 1) {
            $("#ui-id-1").show();
        }
    });
    $("#lang_change option[value='<?php echo $Defaultlanguage; ?>']").attr("selected", true);
	<?php /*
    $("#lang_change").change(function() {
        val = $(this).val();
        $.ajax({
            url:'<?php echo $this->Url->build(array('plugin' =>'','controller' =>'users','action' =>'change_lang')) ?>',
            async: false,
            type:'POST',
            data: {
               'val': val
            },
            success: function() {
                <?php 	if(isset($slugName)){ ?>
                if (val =='es') {window.location ='<?php echo $this->Url->build(array('plugin' => $this->request->plugin,'controller' => $this->request->controller,'language_set' => true,'language' =>'es','action' => $slugName,$slugName => $slug)); ?>'
                } else if (val =='de') {window.location ='<?php echo $this->Url->build(array('plugin' => $this->request->plugin,'controller' => $this->request->controller,'language_set' => true,'language' =>'de','action' => $slugName,$slugName => $slug)); ?>'
                } else {window.location ='<?php echo $this->Url->build(array('plugin' => $this->request->plugin,'controller' => $this->request->controller,'language_set' => true,'action' => $slugName,$slugName => $slug)); ?>'
                }
                <?php }else{ ?>
                if (val =='es') {window.location ='<?php echo $this->Url->build(array('language_set' => true,'language' =>'es','plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action)); ?>'
                } else if (val =='de') {window.location ='<?php echo $this->Url->build(array('language_set' => true,'language' =>'de','plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action)); ?>'
                } else {window.location ='<?php echo $this->Url->build(array('language_set' => true,'plugin' => $this->request->plugin,'controller' => $this->request->controller,'action' => $this->request->action)); ?>'
                }
                <?php } ?>
            }
        })
    });*/ ?>
}); /*Notice functon*/
function notice(s, e, t) {
    "" == e && (e = s, s = t), s = s.replace(/^[a-z]/, function(s) {
        return s.toUpperCase()
    }), new PNotify({
        title: s,
        text: e,
        type: t,
        hide: !0,
        shadow: !0,
        delay: 6e3,
        mouse_reset: !0,
        buttons: {
            closer: !0,
            sticker: !1
        }
    })
}
var showChar = showChar ? showChar : 300,
    ellipsestext = "...",
    lesstext = "Read less",
    moretext = "Read more";
$(".readmoretext").each(function() {
    var s = $(this).html();
    if (s.length > showChar) {
        var e = s.substr(0, showChar),
            t = s.substr(showChar, s.length - showChar),
            a = e +'<span class="moreellipses">' + ellipsestext +'&nbsp;</span><span class="morecontent"><span>' + t +'</span>&nbsp;&nbsp;<a href="" class="readmorelink">' + moretext + "</a></span>";
        $(this).html(a)
    }
}), $(document).on("click", ".readmorelink", function() {
    return $(this).hasClass("less") ? ($(this).removeClass("less"), $(this).html(moretext)) : ($(this).addClass("less"), $(this).html(lesstext)), $(this).parent().prev().toggle(), $(this).prev().toggle(), !1
});
<?php  echo $this->Flash->render(); ?> /*header scroll functon*/

 // scr();
$(window).scroll(function(){
	$("#ui-id-1").hide();
 // scr();
 });
$('.header').addClass('fixed');

$(".search_box span").click(function(){
	val	=	$(".headersearch").val();
	location.href ='<?php echo WEBSITE_URL ?>search/'+val;
});
$(".headersearch").keypress(function(event) {
    if (event.which == 13) {
		location.href ='<?php echo WEBSITE_URL ?>search/'+$(this).val();
    }
});
</script><?php if(SUBDIR ==''){ ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-565d96972a53c29c"></script>
<?php } ?>
</body>
</html>