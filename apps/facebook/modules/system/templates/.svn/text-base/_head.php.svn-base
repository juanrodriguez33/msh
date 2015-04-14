
<base href="http://<?php echo $_SERVER['HTTP_HOST'] ?>" />

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

<?php if(strpos($sf_request->getHost(), "www.") !== FALSE):?>
    <meta content="index, follow" name="robots" />
<?php else: ?>
    <meta content="noindex, nofollow" name="robots" />
<?php endif; ?>

<meta content="width=980" name="viewport" />

<?php /*
<meta content="IE=EmulateIE9" http-equiv="X-UA-Compatible" />
*/?>

<script src="/js/jquery.js?version=<?=date('Ymd')?>" type="text/javascript"></script>
<script src="/js/functions.js?version=<?=date('YmdHis')?>" type="text/javascript"></script>
<script src="/js/objects.js?version=<?=date('YmdHis')?>" type="text/javascript"></script>
<script src="/js/html5.js?version=<?=date('Ymd')?>" type="text/javascript"></script>
<script src="/js/slideshow.min.js?version=<?=date('Ymd')?>" type="text/javascript"></script>
<script src="/js/touchswipe.min.js?version=<?=date('Ym')?>" type="text/javascript"></script>
<script type="text/javascript" src="/tinymce/tiny_mce.js?version=<?=date('Ymd')?>"></script>
<script type="text/javascript" src="/js/editor.js?version=<?=date('Ymd')?>"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="/js/markerclusterer_packed.js?version<?=date('Y')?>"></script>

<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '<?=Functions::getAnalyticsTracker()?>', {'cookieDomain': '<?=Functions::getAnalyticsCookieDomain()?>'});
    ga('send', 'pageview');

</script>



<title><?=MSHTools::seoReplace(get_slot('meta_title', 'My Second Home'),get_slot('seoReplacements', array()))?></title>
