<!DOCTYPE html>
<html id="facebook">
<head>
    <?= include_partial('system/head'); ?>
    <link href="/css/fb.css?version=<?=date('Ymd')?>" media="screen" rel="stylesheet" type="text/css" />
    <link href="/css/facebook.css?version=<?=date('Ymd')?>" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
#<div id="fbWrapper">
#    <div class="fbTimelineSection mtm pageAppTab">
?>
        <?php echo $sf_content ?>
<?php
#    </div>
#</div>
?>

</body>
</html>
