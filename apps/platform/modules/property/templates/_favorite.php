<?php if($bFavorite): ?>
  <a class="a_icon a_icon_defavorite" href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>?box=favorite&favorite=false" title="<?=__('text.removeasfavoriteproperty')?>"><?=__('text.removeasfavoriteproperty')?></a>
  <script>
      <?php if(isset($bChanged)): ?>
          initNotification('info', '<?=__('text.propertyaddedasfavorite')?>');
      <?php endif;?>

  </script>
<?php else: ?>
  <a class="a_icon a_icon_favorite" href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>?box=favorite&favorite=true" title="<?=__('text.addasfavoriteproperty')?>"><?=__('text.addasfavoriteproperty')?></a>
  <script>
      <?php if(isset($bChanged)): ?>
          initNotification('info', '<?=__('text.propertyremovedasfavorite')?>');
      <?php endif;?>
  </script>
<?php endif; ?>

<script type="text/javascript">
    <?php if(isset($iFavorite)): ?>
        setFavoriteCount(<?=$iFavorite?>);
        initFavorites();
    <?php endif; ?>
</script>