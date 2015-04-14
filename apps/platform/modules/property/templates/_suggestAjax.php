<?php if(($iTotal == 0) || (!isset($aLocations['city']))) :?>
    <p><em><?=__('text.nothingfound')?></em></p>
<?php else:?>
<ul>
     <?php if(isset($aLocations['city']) && sizeof($aLocations['city'])>0): $i=0; ?>
        <li class="type"><?=__('text.suggestCity')?></li>
        <?php foreach($aLocations['city'] as $iLocation => $sLocation): if($i > 5 ) break; $sLabel = substr($sLocation,12);?>
            <li class="option"><a data-demography="city#<?=$sLocation?>" href="#" value="<?=$sLocation?>" title="<?=__('text.searchforpropertiesincity')?> <?=$sLocation?>"><?=$sLocation;?></a></li>
        <?php endforeach;?>
    <?php else:?>
        <p><em><?=__('text.nothingfound')?></em></p>
    <?php endif;?>


</ul>
<?php endif;?>