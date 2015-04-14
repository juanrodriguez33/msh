<?= include_component('content', 'stepHeader'); ?>

<?= include_component('property','footerTopProperties'); ?>

<section class="content gray">
    <div class="wrapper">

        <section class="full" id="">
            <p class="head head1">
                <?=__('subject.regions')?>
            </p>
            <?php include_partial('regionBar', array('aRegion' => $aRegion, 'sCurrent' => $oRegion->getSlug()));?>
        </section>

        <article class="full detailInformation" id="regions">
            <h1><?=__('text.buypropertyin')?> <?=$oRegion?></h1>

            <aside>
                <ul class="thumbnails">
                <?php $bFirst = true; foreach($oRegion->getImages() as $k => $oImage): ?>
                    <li class="<?= $bFirst ? 'big' : ''?>" left="<?=(($k-1)%3==0?'true':'')?>" style="<?=($k>=9?'display:none;':'')?>">
                        <a class="<?= $bFirst ? 'big' : ''?>" left="<?=(($k-1)%3==0?'true':'')?>" href="<?=$oImage->getFormatUrl(1024,768)?>" style="<?=($k>=9?'display:none;':'')?>" rel="slideshow">
                            <img alt="" class="loader <?= $bFirst ? 'big' : ''?>" src="<?=$bFirst ? $oImage->getFormatUrl(310,200) : $oImage->getFormatUrl(90,60)?>" pagespeed_no_transform />
                        </a>
                    </li>
                <?php if($k == 8 && count($oTheme->getImages()) > 9):?>
                    <li>
                        <a class="moreImages" href="Javascript:slideshow.Open($('#themes > aside > a:first-child'));" title="%count%-more-images%">
                            <div><p><?=__('more-pictures')?></p></div>
                        </a>
                    </li>
                <?php endif; ?>
                <?php $bFirst = false; endforeach; ?>
                </ul>
            </aside>

            <div id="expandParent">
                <div class="expander">
                    <?=$oRegion->getContent(ESC_RAW);?>
                </div>
                <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
            </div>

            <div class="devider"></div>

        </article>

        <script type="text/javascript">

            // Expander
            var object  = { id: 'regions', speed: <?=sfConfig::get('app_expander_speed')?>, };
            var Article = new Expander(object);

            Article.Init();

            var slideshow = new Slideshow();
            var object = { navigation: <?=sfConfig::get('app_slideshow_navigation')?>, speed: <?=sfConfig::get('app_slideshow_speed')?>, thumbnails: <?=sfConfig::get('app_slideshow_thumbnails')?>, thumbnails_hidden: <?=sfConfig::get('app_slideshow_thumbnails_hidden')?> };

            //
            slideshow.Init(object);

            $(function() {
                $('#div_slideshow').swipe( {
                    //Generic swipe handler for all directions
                    swipe:function(event, direction, distance, duration, fingerCount) {
                        if(direction == "left")  slideshow.Slide('next');
                        if(direction == "right") slideshow.Slide('prev');
                        if(direction == "up")    slideshow.ShowThumbnails();
                        if(direction == "down")  slideshow.HideThumbnails();
                    }, threshold: <?=sfConfig::get('app_slideshow_touch_threshold')?>
                    
                });
            });
        </script>

    </div>
</section>

<?php
$totalCities = count($cities);
if ($totalCities  > 0 ):
    switch($totalCities) {
        case $totalCities <= 4 :
            $height = 105;
            break;
        case $totalCities <= 8 :
            $height = 175;
            break;
        case $totalCities <= 12 :
            $height = 240;
            break;
        default:
            $height = 284;
            break;
    }
?>
    <section class="content topRated">
        <div class="wrapper expander">
            <p class="head head1"><?=__('cities')?></p>
                <article class="full detailInformation list" id="cities">
                <p class="head head1"><?=__('content.discover.cities') . " " . $oRegion?></p>
                <div id="expandParentCity">
                    <div class="expander" style="height:<?=$height?>px;">
                        <ul class="block oneThird small">
                        <?php $i=0; foreach($cities as $oCity):?>
                            <li left="<?=($i%4==0?'true':'')?>" type="<?=($i%2==0?'odd':'even')?>">
                                <a href="<?=MSHTools::getCityContentLink($oRegion, $oCity->getId(), $culture)?>" title="<?=$oCity->getTitle()?>, <?=$oRegion->getTitle()?>">
                                    <p class="head head4"><?=$oCity?></p>
                                </a>
                            </li>
                        <?php $i++;endforeach;?>
                        </ul>
                    </div>
                    <a class="button down gray raquo" state1="<?=__('showmore')?>" state2="<?=__('showless')?>" title="<?=__('showmore')?>"><?=__('showmore')?></a>
                 </div>    
                </article>
                
                <script type="text/javascript">
                // Expander
                var object  = { id: 'cities', speed: <?=sfConfig::get('app_expander_speedslow')?> };
                var Article = new Expander(object);
                Article.Init();
            </script>
                
                
            <div class="devider"></div>
    
        </div>
    </section>
<?php endif;?>