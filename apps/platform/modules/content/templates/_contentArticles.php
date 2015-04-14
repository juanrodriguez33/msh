<?php /** @var myUser $sf_user */ ?>
<?php if(sizeof($aArticle) == 0 && $iPage == 0): ?>
    <li>
        <p class="empty head head3"><?=__('message.noarticleresults')?></p>
    </li>
<?php endif; ?>
<?php foreach($aArticle as $oArticle): ?>
    <li <?=$sf_user->hasRead($oArticle->getId()) ? 'class="read read2"' : ''?> itemprop="review" itemscope itemtype="http://schema.org/Review">
        <a href="<?=MSHTools::getContentUrl($oArticle)?>" title="<?=__('readmore')?>">
            <img alt="" class="loader white" src="<?=null!==$oArticle->getSquareImage() ? $oArticle->getSquareImage()->getFormatUrl(180,180): '' ?>" pagespeed_no_transform />
        </a>
        <p class="head head3" itemprop="name">
            <a href="<?=MSHTools::getContentUrl($oArticle)?>" title="<?=__('readmore')?>">
                <?=$oArticle?>
            </a>
        </p>
        <?php if(sizeof($oArticle->getAppreciations()) >= sfConfig::get('app_appreciation_min')): ?>
        <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
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
        <?php endif;?>
        <time class="icon" itemprop="datePublished" content="<?=$oArticle->getCreatedAt('Y-m-d')?>"><?=$oArticle->getCreatedAt('d-m-Y')?></time>
        <p itemprop="description">
            <?=$oArticle->getIntro()?>
        </p>
        <div>
            <span class="float_left"><?=sizeof($oArticle->getComments())?> <?=sizeof($oArticle->getComments())== 1 ? __('comment_article') : __('comments_article')?></span>
            <a class="bottom button gray raquo" href="<?=MSHTools::getContentUrl($oArticle)?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
        </div>
        <?php $aCategory = $oArticle->getLinkPageCategorys(); ?>
        <div class="categories">
        <?php foreach($aCategory as $oCat): ?>
            <!--<span><?=$oCat->getCategory()?></span>-->
            <a href="<?=MSHTools::getSubjectUrl($sf_user->getContentTab())?>?type=<?=$oCat->getCategory()->getId()?>" catId="<?=$oCat->getCategory()->getId()?>" title="<?=$oCat->getCategory()?>">
                <?=$oCat->getCategory()?>
            </a>
        <?php endforeach;?>
        </div>
    </li>
<?php endforeach;?>

<script type="text/javascript">
    <?php if(isset($iPage) && $iPage == 0): ?>
        if(typeof oArticles !== 'undefined') {
            oArticles.UpdatePageTotal(<?=$iPages?>);
        }
    <?php endif; ?>

    //
    $('.categories a').live('click', function(e){
        
        //
        e.preventDefault();
        
        //
        if(typeof oArticles !== 'undefined'){
            oArticles.ChangeFilter($(this).attr('catId'), 'type');
        }
    });
    
</script>