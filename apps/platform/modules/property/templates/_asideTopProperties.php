<p class="head head1">
    <span class="step">4</span>
    <?php if(null===$oCountry): ?>
        <?=__('topratedproperties')?>
    <?php else: ?>
        <?=__('topratedpropertiesin')?> <?=$sf_user->getCountry()->getTitle()?>
    <?php endif;?>
</p>
<ul class="block topRated small">
<?php $i=0; foreach($aProperty as $oProperty): ?>
    <?php include_partial('property/propertyItemPhotoSmall', array('left' => $i%2==0, 'oProperty' => $oProperty)); ?>
<?php $i++; endforeach; ?>
</ul>
<a class="button float_right gray raquo" href="<?=null!==$sf_user->getCountry() ? (MSHTools::getCountryPropertiesUrl($sf_user->getCountry())) : MSHTools::getChooseCountryUrl()?>" title="<?=__('text.seeallproperties')?>"><?=__('text.seeallproperties')?></a>