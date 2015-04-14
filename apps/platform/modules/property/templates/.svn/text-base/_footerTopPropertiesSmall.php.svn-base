<p class="head head2">
    <?php if(null===$oCountry): ?>
        <?=__('topratedproperties')?>
    <?php else: ?>
        <?=__('topratedpropertiesin')?> <?php echo $sf_user->getCountry()->getTitle();
        if (!empty($oRegion) && empty($oCity)): 
            echo ", " . $oRegion->getTitle();
        endif;
        
        if (!empty($oCity)): 
            echo ", " . $oCity->getTitle();
        endif; 
        
    endif;?>
</p>
<ul class="block topRated small">
    <?php $i=0; foreach($aProperty as $oProperty): ?>
        <?php include_partial('property/propertyItemPhotoSmall', array('left' => $i%4==0, 'oProperty' => $oProperty)); ?>
    <?php $i++; endforeach; ?>
</ul>
<a class="float_right button gray dark" href="<?=null!==$sf_user->getCountry() ? (MSHTools::getCountryPropertiesUrl($sf_user->getCountry())) : MSHTools::getChooseCountryUrl()?>" title="<?=__('text.seeallproperties')?>">
    <?=__('text.seeallproperties')?>
</a>