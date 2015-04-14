<ul>
    <?php foreach($aCity as $oCityI18n): $oCity = $oCityI18n->getCity();?>
        <li class="option">
            <a value="<?=$oCityI18n->getTitle() . ', ' . $oCity->getRegion()->getTitle() . ', ' . $oCity->getCountry()->getTitle() . ' # ' . $oCity->getId()?>"><?=$oCityI18n->getTitle() . ', ' . $oCity->getRegion()->getTitle() . ', ' . $oCity->getCountry()->getTitle()?></a>
        </li>
    <?php endforeach; ?>
    <?php if($bAllowAdd): ?>
        <li class="option">
            <a value="<?=$sTerm?>">Add as new: <?=$sTerm?></a>
        </li>
    <?php endif;?>
</ul>

<?php if(!$bAllowAdd && sizeof($aCity) == 0): ?>
<p>
    <em>Nothing found</em>
</p>
<?php endif; ?>