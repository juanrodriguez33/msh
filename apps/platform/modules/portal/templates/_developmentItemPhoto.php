<?php
/** @var Development $oDevelopment */
$aInfo = $oDevelopment->getDevelopmentInfo();
?>
<li left="<?=$left ? 'true' : 'false'?>">
    <a class="actions edit" href="<?=url_for('portal_developments_edit',array('id'=>$oDevelopment->getId()))?>" title="<?=__('portal.development.edit')?>">
        <img alt="<?=$oDevelopment?>" height="165" width="220" src="<?=$oDevelopment->getFirstImageUrl(220,165)?>" pagespeed_no_transform />
        <p class="head head4">
            <?=$oDevelopment?>
            <?php /*
            <a class="actions edit" href="<?=url_for('portal_developments_edit',array('id'=>$oDevelopment->getId()))?>" title="<?=__('portal.development.edit')?>"><?=__('portal.development.edit')?></a>
            */ ?>
        </p>
        <p class="head head5">
            <?=null!==$oDevelopment->getCountry() ? $oDevelopment->getCountry()->getTitle() :''?>
        </p>
        <p>
            <?=$oDevelopment->getCity()?>, <?=$oDevelopment->getRegion()?><br>
            <?=$aInfo['count']?> <?=__('text.properties')?>
        </p>
        <?php if(!isset($aInfo['min_price'])):?>
            <p><?=__('text.developmenthasnopropertiesyet')?></p>
        <?php else: ?>
            <p class="price from-to"><span><?=__('text.pricefrom')?>:</span> &euro; <?=format_currency_msh($aInfo['min_price'])?></p>
            <p class="price from-to"><span><?=__('text.priceto')?>:</span> &euro; <?=format_currency_msh($aInfo['max_price'])?></p>
        <?php endif; ?>
        <p class="light">
            <?=__('portal.addedon')?>: <?= format_date($oDevelopment->getCreatedAt())?>
        </p>
    </a>
</li>