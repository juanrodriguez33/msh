<?php
  $altText = MSHTools::getImageAltText($oProperty);
?>
<li class="<?php echo $oProperty->getId() == $sf_user->getLastViewedProperty() ? "lastVisited" : ""?>" left="<?=$left ? 'true' : 'false'?>">
    <a href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>" title="<?=$altText?>">
        <img alt="<?=$altText?>" height="165" width="220" src="<?=$oProperty->getFirstImageUrl(200, 165)?>" pagespeed_no_transform />
        <?php 
        $city = $oProperty->getCity();
        $region = $oProperty->getRegion();
        if (!empty($city)):?>
            <p class="head head4">
                <?=$oProperty->getCity()?>
            </p>
        <?php endif;?>
        <p class="details">
            <?=$oProperty->getCountry()->getTitle()?>, <?php if (!empty($region)):?>  <?=$oProperty->getRegion()?> <?php endif;?> <br />
            <?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?>
            <?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getBedrooms()) > 0):?>, <?php endif;?>
            <?php if(intval($oProperty->getBedrooms()) > 0):?><?=$oProperty->getBedrooms()?> <?=__('text.bedrooms')?><?php endif;?>&nbsp;
        </p>
        <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
        
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
        <?php include_partial('property/favorite', array('oProperty' => $oProperty, 'bFavorite' => $sf_user->isFavorite($oProperty->getId())))?>
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