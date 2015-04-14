<div class="bar" id="bar">
    <nav>
        <ul>
        <li <?=$sCurrent == "all" ? "class='current'" : ""?>>
            <a href="<?=MSHTools::getCountryRegionsUrl($sf_user->getCountry())?>" title="<?=__('subject.all')?>">
                <?=__('subject.all')?>
            </a>
        </li>
        <?php foreach($aRegion as $oRegion): ?>
            <li class="<?=($oRegion->getSlug() == $sCurrent? 'current' : '')?>">
                <a href="<?=MSHTools::getCountryRegionUrl($oRegion)?>" title="<?=$oRegion->getTitle()?>">
                    <?=$oRegion->getTitle()?>
                </a>
            </li>
        <?php endforeach;?>
        </ul>
    </nav>
</div>