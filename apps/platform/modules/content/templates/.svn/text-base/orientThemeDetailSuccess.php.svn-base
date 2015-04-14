<?= include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper">

        <section class="full" id="">
            <p class="head head1">
                <?=__('themes.detail')?>
            </p>
            <?php include_partial('themeBar', array('aTheme' => $aTheme, 'sCurrent' => $oTheme->getSlug()));?>
        </section>

        <article class="full detailInformation" id="themes">
            <h1><?=$oTheme?></h1>

            <aside>
                <ul class="thumbnails">
                <?php $bFirst = true; foreach($oTheme->getImages() as $k => $oImage): ?>
                    <li class="<?= $bFirst ? 'big' : ''?>" left="<?=(($k-1)%3==0?'true':'')?>" style="<?=($k>=9?'display:none;':'')?>">
                        <a href="<?=$oImage->getFormatUrl(1024,768)?>" class="<?= $bFirst ? 'big' : ''?>" left="<?=(($k-1)%3==0?'true':'')?>" style="<?=($k>=9?'display:none;':'')?>" rel="slideshow">
                            <img alt="" class="loader <?= $bFirst ? 'big' : ''?>" src="<?=$bFirst ? $oImage->getFormatUrl(310,200) : $oImage->getFormatUrl(90,60)?>" pagespeed_no_transform />
                        </a>
                    </li>
                <?php if($k == 8 && count($oTheme->getImages()) > 9):?>
                    <li>
                        <a class="moreImages" href="Javascript:slideshow.Open($('#themes > aside > ul li a:first-child'));" title="<?=__('text.moreimages')?>">
                            <div><p><?=__('more-pictures')?></p></div>
                        </a>
                    </li>
                <?php endif; ?>
                <?php $bFirst = false; endforeach; ?>
                </ul>
            </aside>

            <div id="expandParent">
                <div class="expander">
                    <?=$oTheme->getContent(ESC_RAW);?>
                </div>
                <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
            </div>

            <div class="devider"></div>

            <p class="head head1"><?=__('themes.countries')?></p>
            <ul class="block theme-detail">
            <?php $aCountry = $oTheme->getCountries();?>
            <?php $i=0; foreach($aCountry as $sCountry => $oCountry) { ?>
                <li left="<?=($i%6==0?'true':'false')?>">
                    <a href="<?=MSHTools::getCountryUrl($oCountry)?>" title="<?=$oCountry->getTitle()?>">
                        <img alt="<?=$oCountry?>" class="loader white" src="<?=$oCountry->getFirstImageUrl(132,80)?>" pagespeed_no_transform />
                        <p class="head head4"><?=$oCountry->getTitle()?></p>
                    </a>
                </li>
            <?php $i++; } ?>
            </ul>
        </article>

        <script type="text/javascript">

            // Expander
            var object  = { id: 'themes', speed: <?=sfConfig::get('app_expander_speed')?> };
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
                    }, threshold: <?=sfConfig::get('app_slideshow_touch_threshold');?>
                    
                });
            });
        </script>

    </div>
</section>