<div class="bar" id="bar">
    <nav>
        <ul>
        <?php $aExtra = get_slot('subjectExtra',array()) ?>

        <li <?=sizeof($aExtra)==0 && $sCurrent == "all" ? "class='current'" : ""?>>
            <a href="<?=MSHTools::getSubjectUrl('all', null, $bQuestion)?>" title="<?=__('subject.all')?>">
                <?=__('subject.all')?>
            </a>
        </li>
        <?php foreach($aCategory as $oCat): ?>
            <li class="<?=(sizeof($aExtra)==0 && $oCat->getSlug() == $sCurrent? 'current' : '')?>">
                <a href="<?=MSHTools::getSubjectUrl($oCat->getSlug(), null, $bQuestion)?>" title="<?=$oCat->getTitle()?>">
                    <?=$oCat->getTitle()?>
                </a>
            </li>
        <?php endforeach;?>
        <?php if($sCurrent == 'search'): ?>
            <li class="current">
                <a href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch')), null, $bQuestion)?>" title="<?=__('subject.search')?>">
                    <?=__('subject.search')?>
                </a>
            </li>
        <?php endif; ?>

        <?php foreach($aExtra as $sUrl => $sTitle):?>
            <li class="current">
                <a href="<?=$sUrl?>" title="<?=$sTitle?>">
                    <?=$sTitle?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </nav>
</div>