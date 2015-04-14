<section class="content topRated">
    <div class="wrapper">
        <p class="head head1">
            <?php if(null===$oCountry && null===$oRegion && null===$oCity): ?>
                <?=__('topratedproperties')?>
            <?php else: ?>
                <?=__('topratedpropertiesin')?> <?=null!==$oCity ? $oCity->getTitle() :( null!==$oRegion ? $oRegion : $sf_user->getCountry()->getTitle())?>
            <?php endif;?>
        </p>
        <ul class="block topRated big">
            <?php $i=0; foreach($aProperty as $oProperty): ?>
                <?php include_partial('property/propertyItemPhoto', array('left' => $i%4==0, 'oProperty' => $oProperty)); ?>
            <?php $i++; endforeach; ?>
        </ul>
        <sup>
            <?php if($oRegion!== null || $sf_user->hasCountry()) :?>
                <?=__('totalofferin')?> <?=null!==$oCity ? $oCity->getTitle() :( null!==$oRegion ? $oRegion : $sf_user->getCountry()->getTitle())?> <?=__('is')?> <?=$iTotal?> <?=__('properties')?>
            <?php else: ?>
                <?=__('totaloffer')?> <?=__('is')?> <?=$iTotal?> <?=__('properties')?>
            <?php endif; ?>
            <a class="button orange raquo" href="<?= null!==$oCity ? MSHTools::getCountryRegionCityUrl($oCity) :                    
                                                                      (null!==$oRegion ? MSHTools::getCountryRegionPropertiesUrl($oRegion) : 
                                                                      (null!==$sf_user->getCountry() ? (MSHTools::getCountryPropertiesUrl($sf_user->getCountry())) : 
                                                                      MSHTools::getChooseCountryUrl().'?phase=3'))?>">
                <?=__('text.seeallproperties')?>
            </a>
        </sup>
    </div>
</section>
<script>
    initFavorites();
</script>