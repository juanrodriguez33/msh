<?php if($sf_data->getRaw('bIsHomepage')): ?>

<div class="no-js" id="banner">
    <aside></aside>
    <?php foreach($aBanner as $k => $oBanner): ?>
        <div><img width="1582" height="450" id="<?=($k==0?'bannerImg'.$k:'')?>" src="<?=$oBanner->getImage()->getFormatUrl(1582,450)?>"/></div>
    <?php endforeach; ?>
    <section></section>
</div>

<script type="text/javascript">
    var Banner;
    var options = { parent: "banner", delay: <?=sfConfig::get('app_banner_delay')?>, speed: <?=sfConfig::get('app_banner_speed')?> };
    Banner = new Banner(options);
    <?php if(count($aBanner) > 1): ?>Banner.Init();<?php endif;?>
</script>

<?php else: ?>

<div class="website" id="banner">
    <aside></aside>
    <?php $iRand = rand(0, intval(count($aBanner)-1));?>
    <?php if(isset($aBanner[$iRand])):/*foreach($aBanner as $oBanner):*/ ?>
        <div><img width="1582" height="220" id="bannerImg0" src="<?=$aBanner[$iRand]->getImage()->getFormatUrl(1582,220)?>"/></div>
    <?php endif;/*endforeach; */?>
</div>

<script type="text/javascript">
    fixBanner();    
</script>

<?php endif; ?>
