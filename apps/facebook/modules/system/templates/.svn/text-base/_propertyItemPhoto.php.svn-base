<li left="<?=$left ? 'true' : 'false'?>">
    <a href="http://<?=$sf_user->getLanguage()->getDomain()?><?=MSHTools::getCountryPropertyUrl($oProperty)?>" title="<?=$oProperty?>" target="_blank">
        <img alt="<?=$oProperty->getCountry()?>" height="165" width="220" src="<?=$oProperty->getFirstImageUrl(220,165)?>" pagespeed_no_transform />
        <p class="head head4">
            <?=$oProperty->getCity()?>
        </p>
        <p class="details">
            <?=$oProperty->getCountry()->getTitle()?>, <?=$oProperty->getRegion()?><br />
            <?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?><?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getRooms()) > 0):?>, <?php endif;?><?php if(intval($oProperty->getRooms()) > 0):?><?=$oProperty->getRooms()?> <?=__('text.rooms')?><?php endif;?>&nbsp;
        </p>
        <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
        <p class="light">
            <?php if(null!==$sf_user->getViewed($oProperty->getId())): ?>
                <?=__('text.lastseen')?>: <?= format_date($sf_user->getViewed($oProperty->getId()))?>
            <?php else: ?>
                &nbsp;
            <?php endif; ?>
        </p>
    </a>

    <?php if($sf_user->toggleFound($oProperty->getId())):?>
        <script type="text/javascript">
            ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','found','<?=$oProperty->getSlug()?>');
        </script>
    <?php endif;?>
    <script type="text/javascript">
        ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','displayed','<?=$oProperty->getSlug()?>');
    </script>
</li>