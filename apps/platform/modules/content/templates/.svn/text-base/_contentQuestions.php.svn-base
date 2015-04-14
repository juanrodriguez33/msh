<?php /** @var myUser $sf_user */ ?>
<?php /** @var Question $oQuestion */ ?>
<?php if(sizeof($aQuestion) == 0 && $iPage == 0): ?>
    <li>
        <p class="head head3"><?=__('message.noresults')?></p>
    </li>
<?php endif; ?>
<?php foreach($aQuestion as $oQuestion): ?>
    <li <?=$sf_user->hasRead($oQuestion->getId(), 'question') ? 'class="read"' : ''?> itemprop="review" itemscope itemtype="http://schema.org/Review">
        <p class="head head3" itemprop="name">
            <a href="<?=MSHTools::getQuestionUrl($oQuestion)?>" title="<?=__('readmore')?>">
                <?=$oQuestion?>
            </a>
        </p>
        <?php if(sizeof($oQuestion->getAppreciations()) >= sfConfig::get('app_appreciation_min')): ?>
        <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
            <meta itemprop="worstRating" content="1" />
            <meta itemprop="bestRating" content="5" />
            <?php $iApp = $oQuestion->getAppreciationScore();?>
            <span class="<?=($iApp>=1 ? 'highlite' : '' )?>" <?=($iApp==1?'itemprop="ratingValue"':'')?>>1</span>
            <span class="<?=($iApp>=2 ? 'highlite' : '' )?>" <?=($iApp==2?'itemprop="ratingValue"':'')?>>2</span>
            <span class="<?=($iApp>=3 ? 'highlite' : '' )?>" <?=($iApp==3?'itemprop="ratingValue"':'')?>>3</span>
            <span class="<?=($iApp>=4 ? 'highlite' : '' )?>" <?=($iApp==4?'itemprop="ratingValue"':'')?>>4</span>
            <span class="<?=($iApp>=5 ? 'highlite' : '' )?>" <?=($iApp==5?'itemprop="ratingValue"':'')?>>5</span>
            <mark><?=sizeof($oQuestion->getAppreciations())?>x</mark>
        </div>
        <?php endif;?>

        <time class="icon" itemprop="datePublished" content="<?=$oQuestion->getCreatedAt('Y-m-d')?>"><?=$oQuestion->getCreatedAt('d-m-Y')?></time>
        <p itemprop="description">
            <?=$oQuestion->getContent(ESC_RAW)?>
        </p>
        <div>
            <span class="float_left"><?=sizeof($oQuestion->getComments())?> <?=sizeof($oQuestion->getComments())== 1 ? __('comment_question') : __('comments_question')?></span>
            <a class="bottom button gray raquo" href="<?=MSHTools::getQuestionUrl($oQuestion)?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
        </div>
    </li>
<?php endforeach;?>

<script type="text/javascript">
    <?php if(isset($iPage) && $iPage == 0): ?>
        if(typeof oArticles !== 'undefined') {
            oArticles.UpdatePageTotal(<?=$iPages?>);
        }
    <?php endif; ?>
</script>