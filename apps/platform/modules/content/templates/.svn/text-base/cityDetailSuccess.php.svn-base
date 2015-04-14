<?= include_component('content', 'stepHeader'); ?>

<?= include_component('property','footerTopProperties'); ?>

<section class="content gray">
    <div class="wrapper">

        <article class="full detailInformation" id="city">
            <h1><?=__('text.buypropertyin')?> <?=$oCity->getTitle()?></h1>

<?php /*?>
<!--    <aside>
                <ul class="thumbnails">
                <?php $bFirst = true; foreach($oCity->getImages() as $k => $oImage): ?>
                    <li class="<?= $bFirst ? 'big' : ''?>" left="<?=(($k-1)%3==0?'true':'')?>" style="<?=($k>=9?'display:none;':'')?>">
                        <a class="<?= $bFirst ? 'big' : ''?>" left="<?=(($k-1)%3==0?'true':'')?>" href="<?=$oImage->getFormatUrl(1024,768)?>" style="<?=($k>=9?'display:none;':'')?>" rel="slideshow">
                            <img alt="" class="loader <?= $bFirst ? 'big' : ''?>" src="<?=$bFirst ? $oImage->getFormatUrl(310,200) : $oImage->getFormatUrl(90,60)?>" pagespeed_no_transform />
                        </a>
                    </li>
                <?php if($k == 8 && count($oTheme->getImages()) > 9):?>
                    <li>
                        <a class="moreImages" href="Javascript:slideshow.Open($('#themes > aside > a:first-child'));" title="%count%-more-images%">
                            <div><p><?=__('more-pictures')?></p></div>
                        </a>
                    </li>
                <?php endif; ?>
                <?php $bFirst = false; endforeach; ?>
                </ul>
            </aside> -->         
*/?>
            <div id="expandParent">
                <div class="expander">
                    <?=$cCity->getContent(ESC_RAW);?>
                </div>
                <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
            </div>

            <div class="devider"></div>

        </article>

        <script type="text/javascript">

            // Expander
            var object  = { id: 'city', speed: <?=sfConfig::get('app_expander_speed')?>, };
            var Article = new Expander(object);

            Article.Init();

        </script>

    </div>
</section>