<?php
//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="<?php echo sfContext::getInstance()->getUser()->getCulture();?>">
    <head>
        <?= include_partial('system/head'); ?>
    </head>
    <body class="<?=((get_slot('is_homepage', false)) ? '' : 'detail' ) ?>" itemscope itemtype="http://schema.org/WebPage">

        <div id="notification"></div>
        <div id="topBorder"></div>
        <div name="top"></div>

        <div id="wrapper">
            <div id="menuOverlay"></div>

            <?= include_component('system','header'); ?>

            <?php if(!get_slot('bDisableBanner',false)): ?>
                <?= include_component('system','banner', array('bIsHomepage' => get_slot('is_homepage', false), 'oTheme' => get_slot('theme', null), 'oCountry' => $sf_user->getCountry())); ?>
            <?php endif; ?>
            
            <?php include_javascripts() ?>
            
            <?php echo $sf_content ?>

            <?php if(!get_slot('bDisableFooterTopProperties',false)): ?>
                <?= include_component('property','footerTopProperties'); ?>
            <?php endif; ?>
            <?php if(!get_slot('bDisableFooterMostPopular',false)): ?>
                <?= include_component('system', 'mostPopular') ?>
            <?php endif; ?>
            <?php if(!get_slot('bDisableFooterPhaseOverview',false)): ?>
                <?= include_partial('system/footerPhaseOverview') ?>
            <?php endif; ?>
            <?php if(!get_slot('bDisableFooterNews',false)): ?>
                <?= include_partial('system/footerNews') ?>
            <?php endif; ?>
        </div>

        <?= include_component('system','footer'); ?>

        <?php $aNotification = $sf_user->getNotification();
        if($aNotification != null):?>
            <script type="text/javascript">
                initNotification('<?=$aNotification['sClass']?>', '<?=$aNotification['sMessage']?>');
            </script>
        <?php endif;?>

        <?php /*if((get_slot('is_homepage') || $sf_user->getPhase() == 0) && $sf_request->getAttribute('country.warning.cookie')): ?>
            <script type="text/javascript">
                var CountryPopup = new CountryPopup('<?=url_for('country_warning')?>');
                CountryPopup.Init();
                CountryPopup.Open();
            </script>
        <?php endif; */?>
    </body>
</html>
