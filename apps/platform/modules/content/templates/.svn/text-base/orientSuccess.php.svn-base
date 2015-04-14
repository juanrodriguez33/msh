<?php include_component('content', 'stepHeader'); ?>
<?php /** @var Category $oCategory  */ ?>
<section class="content gray">
    <div class="wrapper">
        <p class="head head1 mt-2px">
            <?=__('orient.articles')?>
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
                    <li <?=($i%3==0 ? 'left="true"' : '')?>>
                        <a class="noBlock" href="<?=MSHTools::getSubjectUrl($oCategory->getSlug())?>" title="<?=__('readmore')?>">
                            <img alt="<?=$oCategory?>" height="160" width="300" src="<?=null!==$oCategory->getImage() ? $oCategory->getImage()->getFormatUrl(600,320,true): '' ?>" pagespeed_no_transform />
                        </a>
                        <p class="head head4">
                            <a class="" href="<?=MSHTools::getSubjectUrl($oCategory->getSlug())?>" title="<?=__('readmore')?>">
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
                        <a class="button gray raquo" href="<?=MSHTools::getSubjectUrl($oCategory->getSlug())?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
                    </li>
                <?php $i++; endforeach;?>
            </ul>
        <?php endif;?>
    </div>
</section>

<section class="content white">
    <div class="wrapper">
        <p class="head head1"><?=__('themes')?></p>
        <ul class="block oneThird" id="secondHomeSurroundings">
        <?php $i=0; foreach($aTheme as $oTheme):?>
            <li left="<?=($i%3==0 ? 'true' : '')?>">
                <a class="noBlock" href="<?=MSHTools::getThemeUrl($oTheme)?>" title="<?=__('readmore')?>">
                    <img alt="<?=$oTheme?>" height="160" width="300" src="<?=$oTheme->getFirstImageUrl(300,160)?>">
                </a>
                <p class="head head4">
                    <a class="" href="<?=MSHTools::getThemeUrl($oTheme)?>" title="<?=__('readmore')?>">
                        <?=$oTheme?>
                    </a>
                </p>
                <?php $aCountry = $oTheme->getCountries();?>
                <ul class="li-gt">
                    <?php $a=0; foreach($aCountry as $sCountry => $oCountry) { ?>
                        <?php if($a>3) break;?>
                        <li>
                            <a href="<?=MSHTools::getCountryUrl($oCountry)?>" title="<?=$oCountry->getTitle()?>"><?=$oCountry->getTitle()?></a>
                        </li>
                    <?php $a++; } ?>
                </ul>
                <a class="button gray raquo" href="<?=MSHTools::getThemeUrl($oTheme)?>"><?=__('readmore')?></a>
            </li>
        <?php $i++;endforeach;?>
        </ul>
    </div>
</section>