<?php if($iTotal == 0):?>
    <p><em><?=__('text.nothingfound')?></em></p>
<?php else:?>
<ul>

    <?php if(isset($aLocations['country']) && sizeof($aLocations['country'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestCountry')?></li>
    <?php foreach($aLocations['country'] as $iLocation => $aLocation):  if($i > 10 ) break; $sLabel = substr($aLocation['sLabel'],12);?>
        <li class="option"><a data-demography="country#<?=$iLocation?>" href="<?=$sBaseLink?>?setPlace[country]=<?=$iLocation?>" value="<?=$aLocation['sLabel']?>" title="<?=__('text.searchforpropertiesincountry')?> <?=$sLabel?>"><?=$aLocation['sLabel'];?> (<?=$aLocation['iCount']?>)</a></li>
    <?php $i++;endforeach;?>
    <?php endif;?>
    <?php if(isset($aLocations['region']) && sizeof($aLocations['region'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestRegion')?></li>
    <?php foreach($aLocations['region'] as $iLocation => $aLocation):  if($i > 10 ) break; $sLabel = substr($aLocation['sLabel'],12);?>
        <li class="option"><a data-demography="region#<?=$iLocation?>" href="<?=$sBaseLink?>?setPlace[region]=<?=$iLocation?>" value="<?=$aLocation['sLabel']?>" title="<?=__('text.searchforpropertiesinregion')?> <?=$sLabel?>"><?=$aLocation['sLabel'];?> (<?=$aLocation['iCount']?>)</a></li>
    <?php $i++;endforeach;?>
    <?php endif;?>
    <?php if(isset($aLocations['city']) && sizeof($aLocations['city'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestCity')?></li>
    <?php foreach($aLocations['city'] as $iLocation => $aLocation): if($i > 10 ) break; $sLabel = substr($aLocation['sLabel'],12);?>
        <li class="option"><a data-demography="city#<?=$iLocation?>" href="<?=$sBaseLink?>?setPlace[city]=<?=$iLocation?>" value="<?=$aLocation['sLabel']?>" title="<?=__('text.searchforpropertiesincity')?> <?=$sLabel?>"><?=$aLocation['sLabel'];?> (<?=$aLocation['iCount']?>)</a></li>
    <?php $i++;endforeach;?>
    <?php endif;?>


</ul>
<?php endif;?>