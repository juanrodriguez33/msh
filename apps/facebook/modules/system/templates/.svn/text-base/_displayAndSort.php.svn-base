<div class="sort" id="div_sort">

    <p class="head head1"><?=__('topratedproperties');?></p>

    <a class="button a_icon a_icon_delete orange" href="<?=$sUrl?>?clearfilters=true" id="aResetFilter" title="<?=__('text.eraseFilters')?>"><?=__('text.eraseFilters')?></a>
    <div>
        <strong class="float_left" id="filterCountResult">
            <span id="countResultMultiple" <?=(($iTotal !== 1 && $sf_user->getRefine()=='all') ? '' : 'style="display:none"')?>><span id="countResult"><?=$iTotal?></span> <?= ($searchType == 'property') ? __('text.propertiesFound') : ($searchType == 'provider' ? __('text.providersFound') : __('text.developmentsFound')) ?></span>
            <span id="countResultSingle" <?=(($iTotal == 1 && $sf_user->getRefine()=='all') ? '' : 'style="display:none"')?>> 1 <?= ($searchType == 'property') ? __('text.propertyFound') : ($searchType == 'provider' ? __('text.providerFound') : __('text.developmentFound')) ?></span>

            <span id="countResultFavoritesMultiple" <?=($iFavorite !== 1 && $sf_user->getRefine()=='favorite' ? '' : 'style="display:none"')?>><span id="countResult"><?=$iFavorite?></span> <?= ($searchType == 'property') ? __('text.favoriteProperties') : ($searchType == 'provider' ? __('text.favoriteProviders') : __('text.favoriteDevelopments')) ?></span>
            <span id="countResultFavoritesSingle" <?=($iFavorite == 1 && $sf_user->getRefine()=='favorite' ? '' : 'style="display:none"')?>> 1 <?= ($searchType == 'property') ? __('text.favoriteProperty') : ($searchType == 'provider' ? __('text.favoriteProvider') : __('text.favoriteDevelopment')) ?></span>
        </strong>
        <ul class="float_right">
            <?php if($searchType !== 'provider'): ?>
            <li id="li_index_photos" <?=$sf_user->getResultsDisplay() == 'photos' ? 'class="active"' :''?>>
                <a class="photos" href="<?=$sUrl?>?display=photos" title="<?=__('text.displayImages')?>">
                    <span></span>
                    <?=__('text.displayImages')?>
                </a>
            </li>
            <li id="li_index_list" <?=$sf_user->getResultsDisplay() == 'list' ? 'class="active"' :''?>>
                <a class="list" href="<?=$sUrl?>?display=list" title="<?=__('text.displayList')?>">
                    <span></span>
                    <?=__('text.displayList')?>
                </a>
            </li>
            <?php if($searchType !== 'development'): ?>
            <li id="li_index_map" <?=$sf_user->getResultsDisplay() == 'map' ? 'class="active"' :''?>>
                <a class="map" href="<?=$sUrl?>?display=map" title="<?=__('text.displayMapView')?>">
                    <span></span>
                    <?=__('text.displayMapView')?>
                </a>
            </li>
            <?php endif; ?>
            <?php endif;?>
        </ul>
        <?php if($searchType !== 'provider'): ?>
        <p class="float_right">
            <?=__('text.sorton')?>
            <span class="float_right dropdown active" style="visibility: visible;"></span>
            <select id="select_sort">
                <option <?= ($aUserSort['sKey'] =='created_at' && $aUserSort['sDir'] == 'desc' ? 'selected' : '') ?> href="<?=$sUrl?>?sort[created_at]=desc" value="created_at_desc"><?=__('text.sortcreatedatdesc')?></option>
                <option <?= ($aUserSort['sKey'] =='price' && $aUserSort['sDir'] == 'asc' ? 'selected' : '') ?> href="<?=$sUrl?>?sort[price]=asc" value="price_asc"><?=__('text.sortpriceasc')?></option>
                <option <?= ($aUserSort['sKey'] =='price' && $aUserSort['sDir'] == 'desc' ? 'selected' : '') ?> href="<?=$sUrl?>?sort[price]=desc" value="price_desc"><?=__('text.sortpricedesc')?></option>
            </select>
        </p>
        <?php endif; ?>
    </div>
</div>

<script>
    //initTabsSort('/aanbod/sorteren','/aanbod/filter');
    initTabsSort('<?=$sUrl?>','<?=$sUrl?>?box=filter');
    //initTabsSort('<?=$sUrl?>?box=sort','<?=$sUrl?>?box=filter');
</script>