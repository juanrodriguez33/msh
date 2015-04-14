<?php include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper">

        <section class="large" id="">
            <article class="article" id="article">
                <img alt="" class="loader white" src="<?=null!==$oExperience->getImage() ? $oExperience->getImage()->getFormatUrl(700,200): '' ?>" pagespeed_no_transform />
                <?php /*<p class="ellipsis head head3"><?=$oExperience?></p>*/ ?>
                <h1 class="ellipsis"><?=$oExperience?></h1>
                <time class="icon"><?=format_date($oExperience->getCreatedAt(),'D')?></time>
                <p>
                    <?=$oExperience->getContent(ESC_RAW)?>
                </p>
            </article>
            <?php if(sizeof($aOtherExperiences) >0): ?>
                <aside class="article" id="relatedArticles">
                    <p class="head head3"><?=__('relatedexperiences')?></p>
                    <ul style="margin-top: 0px !important;">
                    <?php $i=0;foreach($aOtherExperiences as $oOtherExperience): if($oOtherExperience->getId() == $oExperience->getId()) continue;?>
                        <li <?=$sf_user->hasRead($oOtherExperience->getId(), 'experience') ? 'class="read"' : ''?>>
                            <a href="<?=MSHTools::getCountryExperienceUrl($oOtherExperience)?>" title="<?=$oOtherExperience?>">
                                <p class="head head4 mt-0px" style="margin-top: 0px !important;">
                                    <?=$oOtherExperience?>
                                </p>
                                <img alt="" class="loader white" src="<?=null!==$oOtherExperience->getSquareImage() ? $oOtherExperience->getSquareImage()->getFormatUrl(50,50): '' ?>" pagespeed_no_transform />
                                <p>
                                    <?=$oOtherExperience->getIntro()?>
                                </p>
                            </a>
                        </li>
                    <?php $i++; endforeach; ?>
                    </ul>
                </aside>
            <?php endif; ?>
        </section>

        <aside class="small" id="asideBanner">

            <?php include_partial('system/doubleclick'); ?>
            <?php include_component('property','asideTopProperties');?>
        </aside>

    </div>
</section>