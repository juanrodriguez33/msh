<div class="searchBoxContainer">
    
     <?php $oI18n = sfContext::getInstance()->getI18N(); ?>
    
    <form id="search_box_form" action="/<?=Functions::slugify($oI18n->__('url.phaseFind'))?>/<?=$currentCountrySlug?>" method="post">
    <input type="hidden" id ="url" value="<?=$sUrl?>"/>
        
        <div class="suggestions">
            <p class="mb-min-11" for="region_dd"><?=__('text.selectregioncity') ?>: </p>
            <div class="ddowns">
                <div class="suggestions">            
                    <div style="margin-top:-20px">
                        <span class="dropdown"></span>
                        <select id="region_dd" name="region_dd">
                            <option value="-1"><?=__('text.regions')?></option>
<?php /*                            <?php foreach ($aRegion as $region):?>*/?>
                            
                            
                            <?php foreach ($aFacets['region_id'] as $sLabel => $aFacet):?>
                            
                            <option value="<?=$aFacet['sKey']?>" <?php if ($selectedRegionId == $aFacet['sKey']){ echo "selected";} ?>><?=$aFacet['sLabel']?></option>
                        <?php /*  <option value="<?=$region->getId()?>" <?php if ($selectedRegionId == $region->getId()){ echo "selected";} ?>><?=$region->getTitle()?></option> */?>
                            <?php endforeach;?>
                        </select>
                        <input id="filter_term" class="term" type="text" name="city_input" maxlength="255" value="<?=$selectedCity?>" placeholder="<?=__('text.selectcity')?>" autocomplete='off'>
                    </div>
                    <div id="div_suggestions">
                    </div>
                    <script>
                        initSuggestions('filter_term', 'div_suggestions', '<?=$sUrl?>?box=suggest&input=%INPUT%', '<?=$sUrl?>?box=filter');
                    </script>
                </div>
            </div>
        </div>
        
    
         <div class="price1">
            <p class="mb-min-11"><?=__('text.filterprice')?></p>
            <span class="dropdown"></span>
            <select id="select_price_range" name="filter[price][from]">
                <option value="-1" href="<?=$sUrl?>?filter[price][from]=0"><?=__('filter.minprice')?></option>
                <?php for($i=1;$i<min($aMax['price'],100000);$i+=10000): ?>
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
    
        <div class="bedrooms">
            <p class="mb-min-11"><?=__('text.filterbedrooms')?></p>
            <span class="dropdown small"></span>
            <select id="select_rooms" name="filter[bedrooms][from]">
                <option value="0" href="<?=$sUrl?>?filter[bedrooms][from]=0"><?=__('filter.choose')?></option>
                <?php for($i=1;$i<=$aMax['bedrooms'];$i++): ?>
                    <option <?=intval($aFilters['bedrooms']['min']) == $i ? 'selected' : ''?> href="<?=$sUrl?>?filter[bedrooms][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=$i?></option>
                <?php endfor;?>
            </select>
        </div>
    
        <input type="submit" value="<?=__('filter.search')?>">
    </form>
</div>

<script>
$('#search_box_form').submit(function(e) {
    e.preventDefault(); 
    document.cookie='ypos=0';
    document.cookie="last-viewed-page-/<?=Functions::slugify($oI18n->__('url.phaseFind'))?>" + "/" + "<?=$currentCountrySlug?>=1;path=/";
    this.submit();
});
</script>