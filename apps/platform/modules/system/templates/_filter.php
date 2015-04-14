<aside id="filter">
    <div>
        <h1><?=__('title.findyoursecondhome')?></h1>
        <p>
            <?=__('text.findyoursecondhomeoutof')?> <em><?=$iTotal?> <?=__('properties')?></em> <?=__('in')?> <em><?=$iCountry?> <?=__('text.homepagesearchcountries')?></em>
        </p>
        <form id="form_filter" name="filter" method="POST">

            <input id="hidden_demography" type="hidden" name="demography" value="">

            <div class="suggestions">
                <div id="div_suggestions" class="" style="">
                </div>
            </div>

            <input autocomplete="off" id="filter_search" name="filter[search]" autofocus placeholder="<?=__('searchplaceholder')?>" value="" type="text" />

            <span class="dropdown"></span>
            <select id="filter_sort1" name="filter_price_min">
                <option value="-1"><?=__('filter.minprice')?></option>
                <?php for($i=0;$i<min($aMax['price'],100000);$i+=10000): ?>
                    <option <?=$aFilters['price']['min'] == $i ? 'selected' : ''?> href="?filter[price][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=format_currency_msh($i)?></option>
                <?php endfor;?>
                <?php if($aMax['price'] > 100000): ?>
                    <?php for($i=100000;$i<min($aMax['price'],1000000);$i+=100000): ?>
                        <option <?=$aFilters['price']['min'] == $i ? 'selected' : ''?> href="?filter[price][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=format_currency_msh($i)?></option>
                    <?php endfor;?>
                <?php endif;?>
                <?php if($aMax['price'] > 1000000): ?>
                    <?php for($i=1000000;$i<min($aMax['price'],10000000);$i+=1000000): ?>
                        <option <?=$aFilters['price']['min'] == $i ? 'selected' : ''?> href="?filter[price][from]=<?=$i?>" value="<?=$i?>"><?=__('text.nolessthan')?> <?=format_currency_msh($i)?></option>
                    <?php endfor;?>
                <?php endif;?>
            </select>

            <span class="dropdown"></span>
            <select id="filter_sort2" name="filter_price_max">
                <option value="-1"><?=__('filter.maxprice')?></option>
                <?php for($i=10000;$i<min($aMax['price']+10000,100000);$i+=10000): ?>
                    <option <?=intval($aFilters['price']['max']) == $i ? 'selected' : ''?> href="?filter[price][till]=<?=$i?>" value="<?=$i?>"><?=__('text.nomorethan')?> <?=format_currency_msh($i)?></option>
                <?php endfor;?>
                <?php if($aMax['price'] > 100000): ?>
                    <?php for($i=100000;$i<min($aMax['price']+100000,1000000);$i+=100000): ?>
                        <option <?=intval($aFilters['price']['max']) == $i ? 'selected' : ''?> href="?filter[price][till]=<?=$i?>" value="<?=$i?>"><?=__('text.nomorethan')?> <?=format_currency_msh($i)?></option>
                    <?php endfor;?>
                <?php endif;?>
                <?php if($aMax['price'] > 1000000): ?>
                    <?php for($i=1000000;$i<min($aMax['price']+1000000,10000000);$i+=1000000): ?>
                        <option <?=intval($aFilters['price']['max']) == $i ? 'selected' : ''?> href="?filter[price][till]=<?=$i?>" value="<?=$i?>"><?=__('text.nomorethan')?> <?=format_currency_msh($i)?></option>
                    <?php endfor;?>
                <?php endif;?>
            </select>

            <input type="submit" value="<?=__('search')?>" />
        </form>
    </div>
    <script>
        initSuggestions('filter_search', 'div_suggestions', '?box=suggest&input=%INPUT%');
    </script>
</aside>