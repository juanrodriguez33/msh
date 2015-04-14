<article class="article" id="article" itemprop="review" itemscope itemtype="http://schema.org/Review">
    <img alt="" class="loader white" height="200" width="701" src="<?=null!==$oArticle->getImage() ? $oArticle->getImage()->getFormatUrl(701,200): '' ?>" pagespeed_no_transform />
    <h1 itemprop="name"><?=$oArticle?></h1>
    <time class="icon" itemprop="datePublished" content="<?=$oArticle->getCreatedAt('Y-m-d')?>"><?=format_date($oArticle->getCreatedAt(),'D')?></time>
    <?php if(sizeof($oArticle->getAppreciations()) >= sfConfig::get('app_appreciation_min')): ?>
    <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
        <?=__('appreciation')?>
        <meta itemprop="worstRating" content="1" />
        <meta itemprop="bestRating" content="5" />
        <?php $iApp = $oArticle->getAppreciationScore();?>
        <span class="<?=($iApp>=1 ? 'highlite' : '' )?>" <?=($iApp==1?'itemprop="ratingValue"':'')?>>1</span>
        <span class="<?=($iApp>=2 ? 'highlite' : '' )?>" <?=($iApp==2?'itemprop="ratingValue"':'')?>>2</span>
        <span class="<?=($iApp>=3 ? 'highlite' : '' )?>" <?=($iApp==3?'itemprop="ratingValue"':'')?>>3</span>
        <span class="<?=($iApp>=4 ? 'highlite' : '' )?>" <?=($iApp==4?'itemprop="ratingValue"':'')?>>4</span>
        <span class="<?=($iApp>=5 ? 'highlite' : '' )?>" <?=($iApp==5?'itemprop="ratingValue"':'')?>>5</span>
        <mark><?=sizeof($oArticle->getAppreciations())?>x</mark>
    </div>
    <?php endif; ?>
    <?php $aCategory = $oArticle->getLinkPageCategorys(); ?>
    <div class="categories">
    <?php foreach($aCategory as $oCat): ?>
        <a href="<?=MSHTools::getSubjectUrl($sf_user->getContentTab())?>?type=<?=$oCat->getCategory()->getId()?>" title=""><?=$oCat->getCategory()?></a>
    <?php endforeach;?>
    </div>
    <span itemprop="description">
        <?=$oArticle->getContent(ESC_RAW)?>
    </span>

    <div class="rating">
        <p class="head head4 ml-0px"><?=__('appreciation.rate')?></p>
        <div id="userRating">
            <?php if($sf_user->hasRated($oArticle->getId())) {
                $aRate = $sf_user->getRated($oArticle->getId()); $iApp = $aRate[1];
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