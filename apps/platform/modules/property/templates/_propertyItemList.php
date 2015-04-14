<?php
  $altText = MSHTools::getImageAltText($oProperty);
?>

<li class="itemList <?php echo $oProperty->getId() == $sf_user->getLastViewedProperty() ? "lastVisited" : ""?>" left="<?=$left?>" type="<?=$type?>">
    <a href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>" title="<?=$altText?>">
        <img alt="<?=$altText?>" height="140" width="220" src="<?=$oProperty->getFirstImageUrl(220,140)?>" pagespeed_no_transform />
        <p class="head head4">
            <?=$oProperty->getCity()?>
        </p>
        <p class="head head5">
            <?=$oProperty->getCountry()->getTitle()?>, <?=$oProperty->getRegion()?>
        </p>
        <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
        <p class="details">
            <?=$oProperty->getCity()?>, <?=$oProperty->getRegion()?><br />
            <?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?>
            <?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getBedrooms()) > 0):?>, <?php endif;?>
            <?php if(intval($oProperty->getBedrooms()) > 0):?><?=$oProperty->getBedrooms()?> <?=__('text.bedrooms')?><?php endif;?>&nbsp;
        </p>
        
        <?php if($oProperty->getId() == $sf_user->getLastViewedProperty()): ?>
            <p class="light lastVisited">
                <?=__('text.justseen')?>
            </p>
        <?php else: ?>
            <p class="light">
                <?php if(null!==$sf_user->getViewed($oProperty->getId())): ?>
                    <?=__('text.lastseen')?>: <?= format_date($sf_user->getViewed($oProperty->getId()))?>
                <?php else: ?>
                    &nbsp;
                <?php endif; ?>
            </p>
        <?php endif; ?>
    </a>
    <span id="span_favorite_<?=$oProperty->getId()?>" container="favorite">
        <a class="a_icon a_icon_favorite" onclick="Javascript:void(0);" href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>?box=favorite" title="<?=__('text.addasfavorite')?>">
            <?=__('text.addasfavorite')?>
        </a>
    </span>
    <?php if($sf_user->toggleFound($oProperty->getId())):?>
        <script type="text/javascript">
            ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','found','<?=$oProperty->getSlug()?>');
        </script>
    <?php endif;?>
    <script type="text/javascript">
        ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','displayed','<?=$oProperty->getSlug()?>');
    </script>
</li>