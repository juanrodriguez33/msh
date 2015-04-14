<ul>
    <?php foreach($aRegion as $oRegionI18n): $oRegion = $oRegionI18n->getRegion();?>
        <li class="option">
            <a value="<?=$oRegionI18n->getTitle() . ', ' . $oRegion->getCountry()->getTitle() . ' # ' . $oRegion->getId()?>"><?=$oRegionI18n->getTitle() . ', ' . $oRegion->getCountry()->getTitle()?></a>
        </li>
    <?php endforeach; ?>
    <?php if($bAllowAdd): ?>
        <li class="option">
            <a value="<?=$sTerm?>">Add as new: <?=$sTerm?></a>
        </li>
    <?php endif;?>
</ul>

<?php if(!$bAllowAdd && sizeof($aRegion) == 0): ?>
<p>
    <em>Nothing found</em>
</p>
<?php endif; ?>