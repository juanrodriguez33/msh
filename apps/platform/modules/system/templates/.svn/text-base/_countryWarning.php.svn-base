<p class="head head1"><?=__('text.welcome-back');?></p>
<p>
    <?=__('text.country-selected-on-last-visit');?>: <img height="12" width="16" src="<?=$sf_user->getCountry()->getFlagImageUrl()?>" class="flag_image" /> <strong><?=$sf_user->getCountry()->getTitle()?></strong>
</p>

<a class="button gray" href="?resetcountry=true" id="resetcountry" title="<?=__('text.forget-country');?>">
    <?=__('text.forget-country');?>
</a>

<a class="button orange raquo" href="<?=MSHTools::getCountryUrl($sf_user->getCountry())?>" id="hidePopup" title="<?=__('text.proceed-country');?>">
    <?=__('text.proceed-country');?>
</a>

<script type="text/javascript">
    $('#hidePopup').live('click', function(e){ e.preventDefault(); $('#countryPopUp').fadeOut('slow'); });
    $('#resetcountry').live('click', function(e){ e.preventDefault(); document.location.href=document.location.href+'?resetcountry=true' });
</script>