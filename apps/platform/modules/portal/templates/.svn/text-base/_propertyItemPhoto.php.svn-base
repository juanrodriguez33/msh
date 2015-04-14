<li left="<?=$left ? 'true' : 'false'?>">
    <?php if(isset($bUpsell) && $bUpsell === true):?>
    <a class="actions upsell" href="<?=url_for('portal_properties_upsell', array('id'=>$oProperty->getId()))?>" title="<?=__('portal.property.upsell')?>">
        <?=__('portal.property.upsell')?>
    </a>
    <a class="actions edit" href="<?=url_for('portal_properties_edit', array('id'=>$oProperty->getId()))?>" title="<?=__('portal.property.edit')?>"><?=__('portal.property.edit')?>
        <?=__('portal.property.edit')?>
    </a>
    <?php endif; ?>
    
    <?php if(isset($bNoLink) && $bNoLink == true):?>
    <a class="" href="Javascript:return false;" title="<?=__('portal.property.edit')?>" style="cursor: default;">
    <?php else:?>
    <a class="" href="<?=url_for('portal_properties_edit', array('id'=>$oProperty->getId()))?>" title="<?=__('portal.property.edit')?>">    
    <?php endif;?>
        <img alt="<?=$oProperty->getCountry()?>" height="165" width="220" src="<?=$oProperty->getFirstImageUrl(220,165)?>" pagespeed_no_transform />
        <?php if($oProperty->isPromoted()): ?>
            <div class="topRatedProperty"><span><?=__('text.propertytoprated')?></span></div>
        <?php endif; ?>
        <p class="head head4">
            <?=$oProperty->getCountryTitle()?>&nbsp;
        </p>
        <p class="details">
            <?=$oProperty->getCity()?>, <?=$oProperty->getRegion()?>&nbsp;<br />
            <?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?><?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getRooms()) > 0):?>, <?php endif;?><?php if(intval($oProperty->getRooms()) > 0):?><?=$oProperty->getRooms()?> <?=__('text.rooms')?><?php endif;?>&nbsp;
        </p>
        <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
        <p class="light">
            <?=__('portal.addedon')?>: <?= format_date($oProperty->getCreatedAt())?>
        </p>
    </a>
</li>