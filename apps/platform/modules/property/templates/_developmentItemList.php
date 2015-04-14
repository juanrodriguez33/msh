<?php
/** @var Development $oDevelopment */
$aInfo = $oDevelopment->getDevelopmentInfo();
?>
<li left="<?=$left ? 'true' : 'false'?>">
    <a href="<?=MSHTools::getCountryDevelopmentUrl($oDevelopment)?>" title="<?=$oDevelopment?>">
        <img alt="<?=$oDevelopment?>" height="140" width="220" src="<?=$oDevelopment->getFirstImageUrl(220,140)?>" pagespeed_no_transform />
        <p class="head head4"><?=$oDevelopment?></p>
        <p class="head head5"><?=$oDevelopment->getCountry()->getTitle()?></p>
        <p>
            <?=$oDevelopment->getCity()?>, <?=$oDevelopment->getRegion()?><br>
            <?=$aInfo['count']?> <?=__('text.properties')?>
        </p>
        <p class="price from-to"><span><?=__('text.pricefrom')?>:</span> &euro; <?=format_currency_msh($aInfo['min_price'])?></p>
        <p class="price from-to"><span><?=__('text.priceto')?>:</span> &euro; <?=format_currency_msh($aInfo['max_price'])?></p>
        <p class="light"><?php if(null!==$sf_user->getViewed($oDevelopment->getId())): ?>
                <?=__('text.lastseen')?>: <?= format_date($sf_user->getViewed($oDevelopment->getId(), 'development'))?>
            <?php else: ?>
                &nbsp;
            <?php endif; ?>
        </p>
    </a>
</li>