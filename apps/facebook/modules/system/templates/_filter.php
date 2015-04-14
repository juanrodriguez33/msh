
<!-- TOEVOEGING -->
<a class="button a_icon a_icon_delete float_left orange" href="<?=$sUrl?>?clearfilters=true" id="aResetFilter2" title="<?=__('text.eraseFilters')?>"><?=__('text.eraseFilters')?></a>
<!-- /TOEVOEGING -->

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

<div>
    <p class="mb-min-10"><?=__('text.filterprice')?></p>
    <span class="dropdown"></span>
    <select id="select_price_range" name="filter[price][from]">
        <option value="0" href="<?=$sUrl?>?filter[price][from]=0"></option>
        <?php for($i=25000;$i<$aMax['price'];$i+=25000): ?>
            <option <?=$aFilters['price']['min'] == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=format_currency_msh($i)?></option>
        <?php endfor;?>
    </select>

    <span class="dropdown"></span>
    <select id="select_price_range2" name="filter[price][till]">
        <option value="0" href="<?=$sUrl?>?filter[price][till]=0"></option>
        <?php for($i=25000;$i<$aMax['price'];$i+=25000): ?>
            <option <?=intval($aFilters['price']['max']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[price][till]=<?=$i?>" value="<?=$i?>"><?=__('text.nomorethan')?> <?=format_currency_msh($i)?></option>
        <?php endfor;?>
    </select>
</div>

<div>
    <p class="mb-min-10"><?=__('text.filterrooms')?></p>
    <span class="dropdown"></span>
    <select id="select_rooms" name="filter[rooms][from]">
        <option value="0" href="<?=$sUrl?>?filter[rooms][from]=0"></option>
        <?php for($i=1;$i<=$aMax['rooms'];$i++): ?>
            <option <?=intval($aFilters['rooms']['min']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[rooms][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=$i?></option>
        <?php endfor;?>
    </select>
</div>

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

<script>
    initFilter('filterBar', '<?=$sUrl?>?box=filter');
</script>

