<?= include_component('content', 'stepHeader'); ?>

<?= include_component('property','footerTopProperties'); ?>

<?php if($oCountry->getContent() || count($aRegion)>0):?>
<section class="content white" id="">
    <div class="wrapper">
        <?php if($oCountry->getContent()):?>
        <article class="" id="countryDescription">
            <h1>
                <?=__('inform.areas')?> <?=$oCountry->getTitle()?>
            </h1>

            <div id="expandParent">
                <div class="expander">
                    <?=$oCountry->getContent(ESC_RAW)?>
                </div>
                <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
            </div>
    
            <script type="text/javascript">
                var object      = { id: 'countryDescription', speed: <?=sfConfig::get('app_expander_speed')?> };
                var country_description_expander = new Expander(object);
                country_description_expander.Init();
            </script>

        </article>

        <div class="devider"></div>
        <?php endif;?>

        <?php if(count($aRegion)>0):?>
        <ul class="block topRated area">
        <?php $i=0; foreach($aRegion as $oRegion):?>
            <li left="<?=($i%4==0?'true':'')?>" type="<?=($i%4==0?'odd':'even')?>">
                <a href="<?=MSHTools::getCountryRegionUrl($oRegion)?>" title="<?=$oRegion?>, <?=$sf_user->getCountry()->getTitle()?>">
                    <img alt="" height="135" width="220" src="<?=$oRegion->getFirstImageUrl(220,135)?>" pagespeed_no_transform />
                    <p class="head head4"><?=$oRegion?></p>
                </a>
            </li>
        <?php $i++; endforeach;?>
        </ul>
        <?php endif;?>
    </div>
</section>

<section class="content gray">
    <div class="wrapper pt-10px">
        <p class="head head1 mt-2px">
            <?=__('inform.about')?> <?=$oCountry->getTitle()?>
        </p>
        <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_article_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch'))))) ?>
        <?php if(sizeof($aCategory) == 2 || sizeof($aCategory) == 4): ?>
            <ul class="block twoByTwo">
                <?php $i=0; foreach($aCategory as $oCategory):?>
                    <li left="<?=($i%2==0?'true':'')?>" type="<?=($i%2==0?'odd':'even')?>">
                        <img alt="<?=$oCategory?>" height="160" width="300" src="<?=null!==$oCategory->getImage() ? $oCategory->getImage()->getFormatUrl(600,320,true): '' ?>" pagespeed_no_transform />
                        <p class="head head4"><?=$oCategory?></p>
                        <?php $aContent = $oCategory->getRecentUnreadContent(3);?>
                        <ul class="li-gt">
                            <?php foreach($aContent as $oContent): ?>
                            <li>
                                <a href="<?=MSHTools::getContentUrl($oContent)?>" title="<?=$oContent?>"><?=$oContent?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="button gray raquo" href="<?=MSHTools::getSubjectUrl($oCategory->getSlug())?>"><?=__('readmore')?></a>
                    </li>
                <?php $i++; endforeach;?>
            </ul>
        <?php else: ?>
            <ul class="block oneThird" id="secondHomeArticles">
                <?php $i=0; foreach($aCategory as $oCategory):?>
                    <li <?=($i%4==0 ? 'left="true"' : '')?>>
                        <a class="noBlock" href="<?=MSHTools::getSubjectUrl($oCategory->getSlug())?>" title="<?=__('readmore')?>">
                            <img alt="<?=$oCategory?>" height="160" width="300" src="<?=null!==$oCategory->getImage() ? $oCategory->getImage()->getFormatUrl(300,160): '' ?>" pagespeed_no_transform />
                        </a>
                        <p class="head head4">
                            <a href="<?=MSHTools::getSubjectUrl($oCategory->getSlug())?>" title="<?=__('readmore')?>">
                                <?=$oCategory?>
                            </a>
                        </p>
                        <?php $aContent = $oCategory->getRecentUnreadContent(3);?>
                        <ul class="li-gt">
                            <?php foreach($aContent as $oContent): ?>
                            <li>
                                <a href="<?=MSHTools::getContentUrl($oContent)?>" title="<?=$oContent?>"><?=$oContent?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="button gray raquo" href="<?=MSHTools::getSubjectUrl($oCategory->getSlug())?>"><?=__('readmore')?></a>
                    </li>
                <?php $i++; endforeach;?>
            </ul>
        <?php endif;?>
    </div>
</section>
<?php endif; ?>