<?php include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper">

        <section class="large" id="">
            <h1>
                <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_article_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch'))))) ?>
                <?=__('inform.about')?> <?=$sf_user->getCountry()->getTitle()?>
            </h1>

            <script type="text/javascript">
                submitOnReturn($('#form_information_search'), $('#form_information'));
            </script>

            <?php include_component('content','subjectSelection'); ?>

            <article class="article detailInformation" id="countryDetail">
                <h1><?=__('inform.country')?></h1>

                <aside>
                    <?php $i=0; foreach($oCountry->getImages() as $k => $oImage): ?>
                        <a class="<?=$i===0 ?'big' : ''?>" left="<?=(($k-1)%3==0?'true':'')?>" href="<?=$oImage->getFormatUrl(1024,768)?>" rel="slideshow">
                            <img alt="" class="loader <?=$i===0 ?'big' : ''?>" src="<?=$i===0 ? $oImage->getFormatUrl(310,200) : $oImage->getFormatUrl(90,60)?>" pagespeed_no_transform />
                        </a>
                        <?php if($k == 8 && count($oCountry->getImages()) > 9):?>
                            <a class="moreImages" href="Javascript:slideshow.Open($('#countryDetail > aside > a:first-child'));" title="%count%-more-images%">
                                <div><p><?=__('more-pictures')?></p></div>
                            </a>
                        <?php endif; ?>
                    <?php $i++; endforeach; ?>
                </aside>

                <div id="expandParent">
                    <div class="expander">
                        <?=$oCountry->getContent(ESC_RAW)?>
                    </div>
                    <a class="button down gray raquo" href="index.php?p=step2" state1="%read-more%" state2="%read-less%" title="%read-more%">%read-more%</a>
                </div>

                <div class="devider"></div>

                <h1><?=__('inform.areas')?> <?=$oCountry->getTitle()?></h1>
                <ul class="block theme-detail">
                <?php $i=0; foreach($aRegion as $oRegion): if($i==8)break;?>
                    <li left="<?=($i%4==0?'true':'')?>" type="<?=($i%4==0?'odd':'even')?>">
                        <a href="<?=MSHTools::getCountryRegionUrl($oRegion)?>" title="<?=$oRegion?>, <?=$sf_user->getCountry()?>">
                            <img alt="" src="<?=$oRegion->getFirstImageUrl(220,135)?>" pagespeed_no_transform />
                            <h4><?=$oRegion?></h4>
                        </a>
                    </li>
                <?php $i++; endforeach;?>
                </ul>
            </article>
        </section>

        <script type="text/javascript">

            // Expanding
            var object  = { id: 'countryDetail', speed: <?=sfConfig::get('app_expander_speed')?> };
            var Article = new Expander(object);

            Article.Init();

            // Slideshow
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

        <aside class="small" id="asideBanner">


            <?php include_partial('system/doubleclick'); ?>

            <?php include_component('property','asideTopProperties');?>

            <?php $oExperience = $oCountry->getRecentExperience($sf_user->getCulture()) ?>
            <?php if(null!==$oExperience):?>
            <h1>
                <span class="step">3</span>
                <?=__('experiences about')?> <?=$oCountry?>
            </h1>
            <a href="<?=MSHTools::getCountryExperienceUrl($oExperience)?>" id="experience" title="<?=$oExperience?>">
                <img alt="Jeroen Hauser" class="loader white" src="<?=null!==$oExperience->getImage() ? $oExperience->getImage()->getFormatUrl(45,45): '' ?>" pagespeed_no_transform />
                <span class="title"><?=$oExperience->getName()?></span>
                <span><?=$oExperience->getTitle()?></span>
                <?=$oExperience->getIntro()?>
            </a>
            <?php endif; ?>

        </aside>

    </div>
</section>