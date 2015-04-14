<option value=""></option>
<?php if($bAllowNew): ?>
    <option id="city_new" value="-1"><?=__('portal.text.addnewcity')?></option>
<?php endif; ?>
<?php foreach($aCity as $oCity):?>
    <option data-id="<?=$oCity->getId()?>" value="<?=$oCity->getId()?>"><?=$oCity?></option>
<?php endforeach; ?>