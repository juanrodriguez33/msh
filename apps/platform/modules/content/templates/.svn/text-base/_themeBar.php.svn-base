<div class="bar" id="bar">
    <nav>
        <ul>
        <li <?=$sCurrent == "all" ? "class='current'" : ""?>>
            <a href="<?=MSHTools::getThemesUrl()?>" title="<?=__('subject.all')?>">
                <?=__('subject.all')?>
            </a>
        </li>
        <?php foreach($aTheme as $oTheme): ?>
            <li class="<?=($oTheme->getSlug() == $sCurrent? 'current' : '')?>">
                <a href="<?=MSHTools::getThemeUrl($oTheme)?>" title="<?=$oTheme->getTitle()?>">
                    <?=$oTheme->getTitle()?>
                </a>
            </li>
        <?php endforeach;?>
        </ul>
    </nav>
</div>