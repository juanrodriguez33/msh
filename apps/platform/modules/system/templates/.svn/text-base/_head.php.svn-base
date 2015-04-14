        
<base href="http://<?php echo $_SERVER['HTTP_HOST'] ?>" />

<?php //removed from default.css?>
<link href="/css/fonts.css"  media="screen" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css"  media="screen" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,400italic"  media="screen" rel="stylesheet" type="text/css" />

<link href="/css/default.css?version=<?=date('YmdHi')?>"  media="screen" rel="stylesheet" type="text/css" />
<link href="/css/blocks.css?version=<?=date('YmdHi')?>"   media="screen" rel="stylesheet" type="text/css" />
<link href="/css/elements.css?version=<?=date('YmdHi')?>" media="screen" rel="stylesheet" type="text/css" />
<link href="/css/print.css?version=<?=date('Ymd')?>" media="print" rel="stylesheet" type="text/css" />

<!--[if IE 8]><link rel="stylesheet" type="text/css" href="./css/ie8.css"><![endif]-->
<!--[if IE]><link rel="stylesheet" type="text/css" href="./css/ie.css"><![endif]-->

<link href="/css/mobile.css?version=<?=date('YmdHi')?>" media="screen and (max-device-width: 480px) and (max-device-width: 768px)" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="/graphics/favicon.png?version=<?php echo date('YmdHi') ?>" />
<link rel="apple-touch-icon-precomposed" href="/graphics/touch.png?version=<?php echo date('YmdHi') ?>" />

<meta charset="UTF-8" />
<meta content="KiwiMedia" name="author" />
<meta content="<?=MSHTools::seoReplace(get_slot('meta_description'),get_slot('seoReplacements', array()))?>" name="description" />

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-stale=0, post-check=0, pre-check=0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Vary" content="*" />


<?php if(strpos($sf_request->getHost(), "www.") !== FALSE):?>
<meta content="index, follow" name="robots" />
<?php else: ?>
<meta content="noindex, nofollow" name="robots" />
<?php endif; ?>

<meta content="width=980" name="viewport" />

<?php /*
<meta content="IE=EmulateIE9" http-equiv="X-UA-Compatible" />
*/?>

<script src="/js/jquery.js" type="text/javascript"></script>
<?php //use_javascript("/js/jquery.js?version=<?=date('Ymd')")?>

<script src="/js/functions.js?version=<?=date('YmdHis')?>" type="text/javascript"></script>
<?php //use_javascript("/js/functions.js?version=<?=date('YmdHis')")?>

<script src="/js/objects.js" type="text/javascript"></script>
<?php //use_javascript("/js/objects.js?version=<?=date('YmdHis')")?>

<!--<script src="/js/html5.js?version=<?=date('Ymd')?>" type="text/javascript"></script>-->
<?php use_javascript("/js/html5.js")?>

<script src="/js/slideshow.min.js"></script>
<?php //use_javascript("/js/slideshow.min.js?version=<?=date('Ymd')")?>

<!--<script src="/js/touchswipe.min.js?version=<?=date('Ym')?>" type="text/javascript"></script>-->
<?php use_javascript("/js/touchswipe.min.js")?>

<!--<script type="text/javascript" src="/tinymce/tiny_mce.js?version=<?=date('Ymd')?>"></script>-->
<?php use_javascript("/tinymce/tiny_mce.js")?>

<!--<script type="text/javascript" src="/js/editor.js?version=<?=date('Ymd')?>"></script>-->
<?php use_javascript("/js/editor.js")?>

<!--<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
<?php use_javascript("http://code.jquery.com/ui/1.10.3/jquery-ui.js")?>

<!--<script src="/js/markerclusterer_packed.js?version<?=date('Y')?>"></script>-->
<?php use_javascript("/js/markerclusterer_packed.js")?>

<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
<?php use_javascript("http://maps.googleapis.com/maps/api/js?sensor=false")?>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?=Functions::getAnalyticsTracker()?>', {'cookieDomain': '<?=Functions::getAnalyticsCookieDomain()?>'});
  ga('send', 'pageview');

</script>


<?php if(null!==get_slot('doubleclick_head', null)): ?>
    <?=get_slot('doubleclick_head') ?>
<?php else: ?>
<?php endif; ?>


<script type='text/javascript'>
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' == document.location.protocol;
    gads.src = (useSSL ? 'https:' : 'http:') + 
    '//www.googletagservices.com/tag/js/gpt.js';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);
    })();
    </script>
    
    <script type='text/javascript'>
    googletag.cmd.push(function() {
    googletag.defineSlot('/21500282/mysecondhome.nl_336x280_1', [336, 280], 'div-gpt-ad-1375351082958-0').addService(googletag.pubads());
    googletag.defineSlot('/21500282/mysecondhome.nl_468x60_1', [468, 60], 'div-gpt-ad-1375351082958-1').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
    });
</script>


<title><?=MSHTools::seoReplace(get_slot('meta_title', 'My Second Home'),get_slot('seoReplacements', array()))?></title>

<a href="https://plus.google.com/114964715175496845132" rel="publisher" ></a>