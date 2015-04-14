<?php if($iTotal == 0):?>
    <p><em><?=__('text.nothingfound')?></em></p>
<?php else:?>
<ul>
    <?php if(isset($aLocations['region']) && sizeof($aLocations['region'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestRegion')?></li>
    <?php foreach($aLocations['region'] as $iLocation => $sLocation):  if($i > 5 ) break; $sLabel = substr($sLocation,12);?>
        <li class="option"><a href="<?=$sUrl?>?setPlace[region]=<?=$iLocation?>" value="<?=$sLocation?>" title="<?=__('text.searchforpropertiesinregion')?> <?=$sLabel?>"><?=$sLocation;?> </a></li>
    <?php endforeach;?>
    <?php endif;?>
    <?php if(isset($aLocations['city']) && sizeof($aLocations['city'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestCity')?></li>
    <?php foreach($aLocations['city'] as $iLocation => $sLocation): if($i > 5 ) break; $sLabel = substr($sLocation,12);?>
        <li class="option"><a href="<?=$sUrl?>?setPlace[city]=<?=$iLocation?>" value="<?=$sLocation?>" title="<?=__('text.searchforpropertiesincity')?> <?=$sLabel?>"><?=$sLocation;?> </a></li>
    <?php endforeach;?>
    <?php endif;?>


</ul>
<?php endif;?>