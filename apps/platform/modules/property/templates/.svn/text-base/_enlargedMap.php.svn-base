<div id="enlarged_google_maps">
    <div id="enlarged-map-canvas"></div>
    <a class="button gray" id="aShrinkMaps" href="" target="_blank" title="<?=__('text.shrinkmap')?>"><?=__('text.shrinkmap')?></a>
    <a class="button gray" id="aEnlargedStreetView" href="" title="<?=__('text.streetview')?>"><?=__('text.streetview')?></a>
</div>

<script type="text/javascript">

    $(function () {
        initShrinkMapsButton();
        <?php if($bStreetview): ?>
            initStreetViewButton('#aEnlargedStreetView', <?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>, false)

        <?php else: ?>
            initMapviewButton('#aEnlargedStreetView', <?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>)
        <?php endif; ?>
    })

</script>