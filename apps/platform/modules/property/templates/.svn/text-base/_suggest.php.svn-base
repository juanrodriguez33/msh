<?php if($iTotal == 0):?>
    <p><em><?=__('text.nothingfound')?></em></p>
<?php else:?>
<ul>

    <?php /**

    <?php if(isset($aLocations['region']) && sizeof($aLocations['region'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestRegion')?></li>
    <?php foreach($aLocations['region'] as $iLocation => $aLocation): if($aLocation['iCount'] == 0) continue; $i++; if($i > 5 || ( $bMultiple && $iTotal > 5 && $i>3) ) break; $sLabel = substr($aLocation['sLabel'],12);?>
        <li class="option"><a href="<?=$sBaseLink?>[region]=<?=$aLocation['sKey']?>" value="<?=$aLocation['sLabel']?>" title="<?=__('text.searchforpropertiesinregion')?> <?=$sLabel?>"><?=preg_replace('/('.$sTerm.')/i','<span>$1</span>' , $sLabel,1);?> <span class="count">(<?= $aLocation['iCount'] ?>)</span></a></li>
    <?php endforeach;?>
    <?php endif;?>
    <?php if(isset($aLocations['city']) && sizeof($aLocations['city'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestCity')?></li>
    <?php foreach($aLocations['city'] as $iLocation => $aLocation): if($aLocation['iCount'] == 0) continue; $i++; if($i > 5 || ( $bMultiple && $iTotal > 5 && $i>3) ) break; $sLabel = substr($aLocation['sLabel'],12);?>
        <li class="option"><a href="<?=$sBaseLink?>[city]=<?=$aLocation['sKey']?>" value="<?=$aLocation['sLabel']?>" title="<?=__('text.searchforpropertiesincity')?> <?=$sLabel?>"><?=preg_replace('/('.$sTerm.')/i','<span>$1</span>' , $sLabel,1);?> <span class="count">(<?= $aLocation['iCount'] ?>)</span></a></li>
    <?php endforeach;?>
    <?php endif;?>
    **/ ?>

    <?php if(isset($aLocations['region']) && sizeof($aLocations['region'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestRegion')?></li>
    <?php foreach($aLocations['region'] as $iLocation => $sLocation):  if($i > 5 ) break; $sLabel = substr($sLocation,12);?>
        <li class="option"><a href="<?=$sBaseLink?>?setPlace[region]=<?=$iLocation?>" value="<?=$sLocation?>" title="<?=__('text.searchforpropertiesinregion')?> <?=$sLabel?>"><?=$sLocation;?> </a></li>
    <?php endforeach;?>
    <?php endif;?>
    <?php if(isset($aLocations['city']) && sizeof($aLocations['city'])>0): $i=0; ?>
    <li class="type"><?=__('text.suggestCity')?></li>
    <?php foreach($aLocations['city'] as $iLocation => $sLocation): if($i > 5 ) break; $sLabel = substr($sLocation,12);?>
        <li class="option"><a href="<?=$sBaseLink?>?setPlace[city]=<?=$iLocation?>" value="<?=$sLocation?>" title="<?=__('text.searchforpropertiesincity')?> <?=$sLabel?>"><?=$sLocation;?> </a></li>
    <?php endforeach;?>
    <?php endif;?>


</ul>
<?php endif;?>