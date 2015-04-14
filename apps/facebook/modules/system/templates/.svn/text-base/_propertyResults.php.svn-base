
<?php include_partial('system/pager', array('id' => 'ul_top_pager', 'iCurPage' => ($iCurPage?$iCurPage:1), 'iPageCount' => $iPageCount, 'sUrl' => $sUrl));?>

<ul id="ul_pager_expand" class="block topRated big">
<?php $i=0; foreach($oResult as $oProperty): ?>
    <?php
        if($sf_user->getResultsDisplay() == 'photos') {
            include_partial('propertyItemPhoto', array('left' => $i%3==0, 'oProperty' => $oProperty));
        } else if($sf_user->getResultsDisplay() == 'list') {
            include_partial('propertyItemList', array('left' => true, 'type' => ($i%2==0?'odd':'even'), 'oProperty' => $oProperty));
        }
    ?>
<?php $i++; endforeach;?>
</ul>

<?php include_partial('system/pager', array('id' => 'ul_pager', 'iCurPage' => ($iCurPage?$iCurPage:1), 'iPageCount' => $iPageCount, 'sUrl' => $sUrl));?>

<?php if($iPageCount > 1): ?>
<a id="button_next_page" class="button down gray raquo" title="<?=__('text.viewmoreproperties')?>"><?=__('text.viewmoreproperties')?></a>
<?php endif; ?>

<script>
    setTotalCount(<?=$iTotal?>, <?=intval($iFavorite)?>, <?=$sf_user->getRefine()=='favorite' ? 1 : 0?>);
    initTabsSortLinks('ul_top_pager','<?=$sUrl?>?box=filter');
    initTabsSortLinks('ul_pager','<?=$sUrl?>?box=filter');
</script>