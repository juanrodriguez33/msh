<section class="results">
    <ul class="<?=($sf_user->getResultsDisplay() == 'photos') ? 'block topRated big' : 'block category topRated'?>">
    <?php $i=0; foreach($oResult as $oProperty): $oDevelopment = $oProperty->getDevelopment()?>
        <?php
            if($sf_user->getResultsDisplay() == 'photos') {
                include_partial('developmentItemPhoto', array('left' => $i%3==0, 'oDevelopment' => $oDevelopment));
            } else if($sf_user->getResultsDisplay() == 'list') {
                include_partial('developmentItemList', array('left' => true, 'type' => ($i%2==0?'odd':'even'), 'oDevelopment' => $oDevelopment));
            }
        ?>
        <?php include_partial('system/doubleclick'); ?>
    <?php $i++; endforeach;?>
    </ul>
    <?php if($iPageCount > 1): ?>
        <a class="button down gray raquo" href="" title="<?=__('text.viewmoredevelopments')?>"><?=__('text.viewmoredevelopments')?></a>
    <?php endif; ?>

</section>

<script>
    initPositions('<?=$sUrl?>?page=%PAGE%', <?=$iPageCount?>);
    setTotalCount(<?=$iTotal?>, 0, 0);
</script>