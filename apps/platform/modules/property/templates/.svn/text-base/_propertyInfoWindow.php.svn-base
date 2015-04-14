<?php foreach($aProperty as $k => $oProperty): ?>
    <a class="infoWindow <?=($k%2==0?'odd':'even')?>" id="infoWindow_<?=$oProperty->getId()?>" href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>" title="<?=$oProperty?>">
        <img alt="<?=$oProperty->getCountry()?>" src="<?=$oProperty->getFirstImageUrl(220, 140, true)?>" pagespeed_no_transform />
        <h4>
            <?=$oProperty->getCity()?>
            <input type="checkbox" class="favorite" onclick="Javascript:void(0);" value="<?=__('text.addasfavorite')?>" />
        </h4>
        <p class="details">
            <?=$oProperty->getCountry()->getTitle()?>, <?=$oProperty->getRegion()?><br />
            <?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?><?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getRooms()) > 0):?>, <?php endif;?><?php if(intval($oProperty->getRooms()) > 0):?><?=$oProperty->getRooms()?> <?=__('text.rooms')?><?php endif;?>&nbsp;
        </p>
        <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
        <?php if(null!==$sf_user->getViewed($oProperty->getId())): ?>
            <p class="light"><?=__('text.lastseen')?>: <?= format_date($sf_user->getViewed($oProperty->getId()))?></p>
        <?php endif; ?>
        <script type="text/javascript">
            //_gaq.push(['_trackEvent','<?=$oProperty->getAnalyticsCode()?>','displayed','<?=$oProperty->getSlug()?>']);
            ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','displayed','<?=$oProperty->getSlug()?>');
        </script>
    </a>
<?php endforeach; ?>