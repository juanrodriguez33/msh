<!DOCTYPE html>
<html lang="nl">
  
  <head>
    <title>MySecondHome Beheerpaneel</title>
    
    <meta charset="UTF-8" />
    <meta name="author" content="KiwiMedia" />
    <meta name="robots" content="noindex, nofollow" />
    
    <base href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/">
    
    <link rel="stylesheet" href="/css/fonts.css?version=<?=date('Ymd');?>" />
    <link rel="stylesheet" href="/css/controlpanel.css?version=<?=date('Ymd');?>" />
    
    <link rel="shortcut icon" href="/graphics/controlpanel/favicon.ico?version=<?=date('Ymd');?>" />
    <link rel="apple-touch-icon-precomposed" href="/graphics/touch.png?version=<?=date('Ymd');?>" />

    <script src="/js/jquery.js?version=<?php echo date('Ymd') ?>"></script>
    <script src="/js/html5.js?version=<?php echo date('Ymd') ?>"></script>
    <script src="/js/functions_admin.js?version=<?php echo date('Ymd') ?>"></script>
  </head>
  
  <body class="splash">
    
    <div id="notification">
    </div>
    
    <div id="topBorder"></div>
    
    <section id="splash">
      <a href="/" title="Ga naar start"><img src="/graphics/controlpanel/logo.png" alt="My Second Home" /></a>
      <?php echo $sf_content ?>
    </section>


    <?php $aNotification = $sf_user->getNotification();
        if($aNotification != null):?>
        <script type="text/javascript">
            initNotification('<?=$aNotification['sClass']?>', '<?=$aNotification['sMessage']?>');
        </script>
    <?php endif;?>
    
    <script type="text/javascript">
        $(document).keypress(function(e){
            if (e.which == 13){
                $("#form_sign_in").submit();
                e.preventDefault();
            };
        });
    </script>
    
  </body>
  
</html>