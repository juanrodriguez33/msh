
<?php $i=0; foreach($aProvider as $oProvider):?>
    <?php include_partial('providerItem', array('left' => $i%3==0, 'oProvider' => $oProvider)); ?>
<?php $i++; endforeach;?>


<script>
    initFavorites();
</script>
