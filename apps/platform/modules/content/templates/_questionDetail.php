<article class="article" id="article" itemprop="review" itemscope itemtype="http://schema.org/Review">
    <h1 class="ellipsis"><?=$oQuestion?></h1>
    <time class="icon" itemprop="datePublished" content="<?=$oQuestion->getCreatedAt('Y-m-d')?>"><?=format_date($oQuestion->getCreatedAt(),'D')?></time>
    <span class="by" itemprop="name"><?=__('by')?>: <em><?=$oQuestion->getName()?></em></span>
    <?php if(sizeof($oQuestion->getAppreciations()) >= sfConfig::get('app_appreciation_min')): ?>
    <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
        <?=__('appreciation')?>
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
    <?php endif; ?>
    <p itemprop="description">
        <?=$oQuestion->getContent(ESC_RAW)?>
    </p>

    <div class="rating">
        <p class="head head4"><?=__('appreciation.rate')?></p>
        <div id="userRating">
            <?php if($sf_user->hasRated($oQuestion->getId(), 'question')) {
                $aRate = $sf_user->getRated($oQuestion->getId(), 'question'); $iApp = $aRate[1];
            } else { $iApp = 0; } ?>
            <a class="<?=($iApp>=5 ? 'highlite' : '' )?>" href="">5</a>
            <a class="<?=($iApp>=4 ? 'highlite' : '' )?>" href="">4</a>
            <a class="<?=($iApp>=3 ? 'highlite' : '' )?>" href="">3</a>
            <a class="<?=($iApp>=2 ? 'highlite' : '' )?>" href="">2</a>
            <a class="<?=($iApp>=1 ? 'highlite' : '' )?>" href="">1</a>
        </div>
    </div>
    <script type="text/javascript">

        //
        var object = { id: 'userRating', article: 'article' };
        var Rating = new Rating(object);

        //
        Rating.Init();
        <?php if(isset($bShowRatingThanks)): ?>
            initNotification('info', '<?=__('text.thanksforrating')?>');
        <?php endif; ?>

    </script>

</article>