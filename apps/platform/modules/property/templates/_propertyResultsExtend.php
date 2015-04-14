
<?php $i=0; foreach($oResult as $oProperty): ?>
    <?php
        if($sf_user->getResultsDisplay() == 'photos') {
            include_partial('propertyItemPhoto', array('left' => $i%3==0, 'oProperty' => $oProperty));
        } else if($sf_user->getResultsDisplay() == 'list') {
            include_partial('propertyItemList', array('left' => true, 'type' => ($i%2==0?'odd':'even'), 'oProperty' => $oProperty));
        }
    ?>
<?php $i++; endforeach;?>

<script>
    initFavorites();
</script>