<?php
/** @var Association $oProvider **/
?>

<li left="<?=$left ? 'true' : 'false'?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
    <a href="<?=MSHTools::getCountryProviderUrl($oProvider)?>" title="<?=$oProvider?>">
        <img alt="<?=$oProvider?>" height="140" width="220" src="<?=$oProvider->getImage() != null ? $oProvider->getImage()->getFormatUrl(220,140,true) : ''?>" pagespeed_no_transform />
        <p class="head head4" itemprop="name"><?=$oProvider?></p>

        <?php if ($oProvider->getCountry() != null):?>
            <p class="settled"><?=__('text.settledin')?>: <strong><?=$oProvider->getCountry()->getTitle()?></strong></p>
        <?php endif; ?>
        <p itemprop="description"><?php $iCount = $oProvider->getPropertyCount($sf_user);?>
            <?=$iCount?> <?=$iCount==1 ? __('text.property') : __('text.properties')?>
        </p>

        <?php $iScores = $oProvider->getAppreciationScores(ESC_RAW); ?>
        <?php $iScore = $oProvider->getAverageAppreciationScore(ESC_RAW); ?>
        <?php if($iScores['cnt'] >= sfConfig::get('app_appreciation_min')):?>
        <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
            <meta itemprop="worstRating" content="1" />
            <meta itemprop="bestRating" content="5" />
            <span class="<?=($iScore>=1 ? 'highlite' : '' )?>">1</span>
            <span class="<?=($iScore>=2 ? 'highlite' : '' )?>">2</span>
            <span class="<?=($iScore>=3 ? 'highlite' : '' )?>">3</span>
            <span class="<?=($iScore>=4 ? 'highlite' : '' )?>">4</span>
            <span class="<?=($iScore>=5 ? 'highlite' : '' )?>">5</span>
            &nbsp;(<?=$iScores['cnt']?>x)
        </div>
        <?php endif; ?>
    </a>
</li>