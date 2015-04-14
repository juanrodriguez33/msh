
<?php if(isset($aExtraFilter)): ?>
    <div>
        <p>
            <?=$aExtraFilter[0]?>:
        </p>
        <p>
            <?=$aExtraFilter[1]?>
        </p>
    </div>
<?php endif; ?>
 
<?php if($searchType !== 'provider'): ?>

<?php /*
<div class="suggestions">
    <div>
        <p><?=__('text.searchLocation')?></p>
        <p><input id="filter_term" class="term" type="text" name="filter[term]" maxlength="255" value="<?=$sPlace?>"></p>
    </div>
    <div id="div_suggestions">
    </div>
    <script>
        initSuggestions('filter_term', 'div_suggestions', '<?=$sUrl?>?box=suggest&input=%INPUT%', '<?=$sUrl?>?box=filter');
    </script>
</div>





REMOVING OLD FILTERS

if($searchType !== 'development'): ?>
<div>
    <p><?=__('text.filterConstructionType')?></p>
    <ul class="checkbox_list">

        <li>
            <input <?=$aFacets['development'][0]['bSelected'] === 'off' ? 'checked' : ''?> href="<?=$sUrl?>?filter[development][0]=<?=$aFacets['development'][0]['bSelected']?>" id="filter_development_0" type="checkbox" name="filter[development]" value="0">
            <label for="filter_development_0"><?=__('filter.development_existing')?> <span>(<?=$aFacets['development'][0]['iCount']?>)</span></label>
        </li>
        <li>
            <input <?=$aFacets['development'][1]['bSelected'] === 'off' ? 'checked' : ''?> href="<?=$sUrl?>?filter[development][1]=<?=$aFacets['development'][1]['bSelected']?>" id="filter_development_1" type="checkbox" name="filter[development]" value="1">
            <label for="filter_development_1"><?=__('filter.development_newlybuilt')?> <span>(<?=$aFacets['development'][1]['iCount']?>)</span></label>
        </li>
    </ul>
</div>
<?php endif;  ?>
<?php endif; ?>

<div>
    <p><?=__('text.filterRegion')?></p>
    <ul class="checkbox_list">
        <?php foreach ($aFacets['region_id'] as $sLabel => $aFacet):?>
        <li>
            <input <?=$aFacet['bSelected'] == 'off' ? 'checked' : ''?> href="<?=$sUrl?>?filter[region_id][<?=$aFacet['sKey']?>]=<?=$aFacet['bSelected']?>" id="filter_region_<?=$aFacet['sKey']?>" type="checkbox"
                   name="filter[region_id]" value="<?=$aFacet['sKey']?>"/>
            <label for="filter_region_<?=$aFacet['sKey']?>"><?=$aFacet['sLabel']?> <span>(<?=$aFacet['iCount']?>)</span></label>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php if($searchType !== 'provider'): ?>
<div>
    <p class="mb-min-10"><?=__('text.filterprice')?></p>
    <span class="dropdown"></span>
    <select id="select_price_range" name="filter[price][from]">
        <option value="-1" href="<?=$sUrl?>?filter[price][from]=0"><?=__('filter.minprice')?></option>
        <?php for($i=0;$i<min($aMax['price'],100000);$i+=10000): ?>
            <option <?=$aFilters['price']['min'] == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=format_currency_msh($i)?></option>
        <?php endfor;?>
        <?php if($aMax['price'] > 100000): ?>
            <?php for($i=100000;$i<min($aMax['price'],1000000);$i+=100000): ?>
                <option <?=$aFilters['price']['min'] == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=format_currency_msh($i)?></option>
            <?php endfor;?>
        <?php endif;?>
        <?php if($aMax['price'] > 1000000): ?>
            <?php for($i=1000000;$i<min($aMax['price'],10000000);$i+=1000000): ?>
                <option <?=$aFilters['price']['min'] == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=format_currency_msh($i)?></option>
            <?php endfor;?>
        <?php endif;?>
    </select>

    <span class="dropdown"></span>
    <select id="select_price_range2" name="filter[price][till]">
        <option value="-1" href="<?=$sUrl?>?filter[price][till]=0"><?=__('filter.maxprice')?></option>
        <?php for($i=10000;$i<min($aMax['price']+10000,100000);$i+=10000): ?>
            <option <?=intval($aFilters['price']['max']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][till]=<?=$i?>" value="<?=$i?>"><?=__('text.nomorethan')?> <?=format_currency_msh($i)?></option>
        <?php endfor;?>
        <?php if($aMax['price'] > 100000): ?>
            <?php for($i=100000;$i<min($aMax['price']+100000,1000000);$i+=100000): ?>
                <option <?=intval($aFilters['price']['max']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][till]=<?=$i?>" value="<?=$i?>"><?=__('text.nomorethan')?> <?=format_currency_msh($i)?></option>
            <?php endfor;?>
        <?php endif;?>
        <?php if($aMax['price'] > 1000000): ?>
            <?php for($i=1000000;$i<min($aMax['price']+1000000,10000000);$i+=1000000): ?>
                <option <?=intval($aFilters['price']['max']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][till]=<?=$i?>" value="<?=$i?>"><?=__('text.nomorethan')?> <?=format_currency_msh($i)?></option>
            <?php endfor;?>
        <?php endif;?>
    </select>
</div>

<div>
    <p class="mb-min-10"><?=__('text.filterbedrooms')?></p>
    <span class="dropdown"></span>
    <select id="select_rooms" name="filter[bedrooms][from]">
        <option value="0" href="<?=$sUrl?>?filter[bedrooms][from]=0"></option>
        <?php for($i=1;$i<=$aMax['bedrooms'];$i++): ?>
            <option <?=intval($aFilters['bedrooms']['min']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[bedrooms][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=$i?></option>
        <?php endfor;?>
    </select>
</div>

*/ ?>

<div>
    <p class="mb-min-10"><?=__('text.filtersurface')?></p>
    <span class="dropdown"></span>
    <select id="select_dwelling_space" name="filter[surface][from]">
        <option value="0" href="<?=$sUrl?>?filter[surface][from]=0"></option>
        <?php for($i=25;$i<=$aMax['surface'];$i+=25): ?>
            <option <?=intval($aFilters['surface']['min']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[surface][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=$i?></option>
        <?php endfor;?>
    </select>
</div>

<?php if($searchType !== 'development'): ?>
<div>
    <p><?=__('text.filtertype')?></p>
    <ul class="checkbox_list">
        <?php foreach ($aFacets['type_id'] as $sLabel => $aFacet): ?>
        <li>
            <input <?=$aFacet['bSelected'] == 'off' ? 'checked' : ''?> href="<?=$sUrl?>?filter[type_id][<?=$aFacet['sKey']?>]=<?=$aFacet['bSelected']?>" id="filter_type_<?=$aFacet['sKey']?>" type="checkbox"
                   name="filter[type_id]" value="<?=$aFacet['sKey']?>"/>
            <label for="filter_type_<?=$aFacet['sKey']?>"><?=$aFacet['sLabel']?> <span>(<?=$aFacet['iCount']?>)</span></label>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
<?php endif; ?>

<script>
    initFilter('filterBar', '<?=$sUrl?>?box=filter');
</script>

