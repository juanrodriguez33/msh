<?php if($sf_user->getResultsDisplay() == 'map') : ?>
    <?php if($iTotal > 0): ?>
        <div id="div_map" class="index_map"></div>
        <script>

            //var aCommands = new Array();
            <?php
                $aMarkers = array();
                foreach($oResult as $oProperty):
            ?>

                    aMarkers[<?=$oProperty->getId()?>] = new Array(<?=floatval($oProperty->getLocationLat())?>, <?=floatval($oProperty->getLocationLong())?>,  '<?=MSHTools::getCountryPropertyUrl($oProperty)?>?box=infoWindow');
                    <?php if($sf_user->toggleFound($oProperty->getId())):?>
                        ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','found','<?=$oProperty->getSlug()?>');
                    <?php endif;?>
                    ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','displayed','<?=$oProperty->getSlug()?>');
            <?php
                endforeach;
            ?>


            initMap('div_map', 6, true, false, true, true);

            /*$(document).ready(function() {
                setTimeout(function(){sendGARequest()},1000);
            })*/

            /*function sendGARequest() {
                _gaq.push.apply(_gaq, aCommands);
            }*/

        </script>

        <script>
            initTabsSortList();
        </script>
    <?php endif; ?>



<?php else: ?>
    <ul id="ul_pager_expand" class="<?=($sf_user->getResultsDisplay() == 'photos') ? 'block topRated big' : 'block category topRated' ?>">
    <?php $i=0; foreach($oResult as $oProperty): ?>
        <?php $url = MSHTools::getCountryPropertyUrl($oProperty);
        if (empty($url)) continue;
            if($sf_user->getResultsDisplay() == 'photos') {
                include_partial('propertyItemPhoto', array('left' => $i%3==0, 'oProperty' => $oProperty));
            } else if($sf_user->getResultsDisplay() == 'list') {
                include_partial('propertyItemList', array('left' => true, 'type' => ($i%2==0?'odd':'even'), 'oProperty' => $oProperty));
            }
        ?>
    <?php $i++; endforeach;?>
    <?php include_partial('system/doubleclick'); ?>
    </ul>

    <ul id="ul_pager" class="pager">
        <li class="active"><a href="<?=$sUrl?>?page=1" title="Ga naar pagina 1">1</a></li>
        <?php for($i=2; $i<= $iPageCount; $i++): ?>
            <li><a href="<?=$sUrl?>?page=<?=$i?>" title="Ga naar pagina <?=$i?>"><?=$i?></a></li>
        <?php endfor; ?>
    </ul>
    <?php if($iPageCount > 1): ?>
    <a id="button_next_page" class="button down orange raquo" title="<?=__('text.viewmoreproperties')?>"><?=__('text.viewmoreproperties')?></a>
    <?php endif; ?>
<?php endif; ?>

<script>
    $('.index_list').last().attr('id','ul_pager_expand');
    initFavorites();
    initPositions('<?=$sUrl?>?page=%PAGE%', <?=$iPageCount?>, <?=$pages?>, "<?=$sUrl?>");
    setTotalCount(<?=$iTotal?>, <?=$iFavorite?>, <?=$sf_user->getRefine()=='favorite' ? 1 : 0?>);
</script>