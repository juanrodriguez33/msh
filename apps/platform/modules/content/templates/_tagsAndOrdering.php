<div class="bar" id="categoryBar">


    <span class="float_left dropdown<?= $bQuestion ? ' hidden' : ''?>"></span>
    <select class="filter<?= $bQuestion ? ' hidden' : ''?>" filter="type">
        <option value="" <?= $sf_user->getContentFilter() == null ? 'selected' :''?>><?=__('category.select')?></option>
        <?php foreach($aTag as $oTag): ?>
            <option value="<?=$oTag->getId()?>" <?= $sf_user->getContentFilter() == $oTag->getId() ? 'selected' :''?>><?=$oTag?></option>
        <?php endforeach; ?>
    </select>

    <span class="float_right dropdown"></span>
    <select class="filter float_right" filter="order" id="select_q">
        <option value="dateDesc"><?=__('sort.date.desc')?></option>
        <option value="dateAsc"><?=__('sort.date.asc')?></option>
        <option value="rateAsc"><?=__('sort.rating.asc')?></option>
        <option value="rateDesc"><?=__('sort.rating.desc')?></option>
    </select>

    <label class="float_right" for="select_q">
        <?=__('content.filter')?>:
    </label>
</div>