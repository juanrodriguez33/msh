<?php
    $country = $oProperty->getCountry();
    $region = $oProperty->getRegion();
    $city = $oProperty->getCity();
    $slug = $oProperty->getSlug();
    $id = $oProperty->getId();

    if (!(empty($country) || empty($region) || empty($city) || empty($slug) || empty($id))) :
        $altText = MSHTools::getImageAltText($oProperty);?>
        <li left="<?=$left ? 'true' : 'false'?>">
            <a href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>" title="<?=$altText?>">
                <img alt="<?=$altText?>" height="60" width="100" src="<?=$oProperty->getFirstImageUrl(100, 60)?>" pagespeed_no_transform />
                <p class="head head4"><?=$oProperty->getCity()?></p>
                <p><?=$oProperty->getCountry()->getTitle()?>,<br /><?=$oProperty->getRegion()?></p>
                <p><?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?>
                <?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getBedrooms()) > 0):?>, <?php endif;?>
                <?php if(intval($oProperty->getBedrooms()) > 0):?><?=$oProperty->getBedrooms()?> <?=__('text.bedrooms')?><?php endif;?>&nbsp;</p>
                <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
            </a>
            <script type="text/javascript">
                ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','displayed','<?=$oProperty->getSlug()?>');
            </script>
        </li>
    
    <?php endif;?>