<p class="head head2">
    <?=__('recentnews')?>
</p>
<ul id="recentNewsItems">
    <?php if(sizeof($aNews)==0) :?>
        <?=__('text.nonewsavailable')?>
    <?php endif; ?>
<?php foreach($aNews as $oNews):?>
    <li>
        <a href="<?=MSHTools::getContentUrl($oNews)?>" title="<?=$oNews?>">
            <time><?=format_date($oNews->getCreatedAt())?></time>
            <?=$oNews?>
        </a>
    </li>
<?php endforeach;?>
</ul>