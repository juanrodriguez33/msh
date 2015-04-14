<section class="results">
    <ul class="block providers">
    <?php $i=0; foreach($oResult as $oProperty): $oProvider = $oProperty->getAssociation() ?>
        <?php include_partial('providerItem', array('left' => $i%3==0, 'oProvider' => $oProvider)); ?>
    <?php $i++; endforeach;?>
    <?php include_partial('system/doubleclick'); ?>
    </ul>
    <?php if($iPageCount > 1): ?>
        <a id="button_next_page" class="button down gray raquo" href="" title="<?=__('text.viewmoreproviders')?>"><?=__('text.viewmoreproviders')?></a>
    <?php endif; ?>
</section>

<script>
    initPositions('<?=$sUrl?>?page=%PAGE%', <?=$iPageCount?>);
    setTotalCount(<?=$iTotal?>, 0, 0);
</script>
