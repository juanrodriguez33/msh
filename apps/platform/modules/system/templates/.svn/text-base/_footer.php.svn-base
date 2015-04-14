        <footer id="footer">
            <div class="wrapper">
                <a class="website" href="#top" id="scrollToTop" title="%scroll-top%">%scroll-top%</a>
                <section>
                    <p class="head head3">MySecondHome</p>
                    <p>
                        <?=__('mysecondhomedesription')?>
                    </p>
                </section>
                <section>
                    <p class="head head3"><?=__('links')?></p>
                    <ul>
                        <?php foreach($aStaticPage as $oStaticPage): ?>
                            <li><a href="<?=MSHTools::getStaticPageUrl($oStaticPage)?>" title="<?=$oStaticPage?>"><?=$oStaticPage?></a></li>
                        <?php endforeach;?>
                    </ul>
                </section>
                <aside>
                    <p class="head head3"><?=__('menu.follow-us')?></p>
                    <p>
                        <?php if(sfConfig::get('app_socialmedia_facebook_url')):?>
                            <a class="socialmedia_icon facebook" href="<?=sfConfig::get('app_socialmedia_facebook_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Facebook">f</a>
                        <?php endif;?>
                        <?php if(sfConfig::get('app_socialmedia_googleplus_url')):?>
                            <a class="socialmedia_icon google" href="<?=sfConfig::get('app_socialmedia_googleplus_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Google">g</a>
                        <?php endif;?>
                        <?php if(sfConfig::get('app_socialmedia_twitter_url')):?>
                            <a class="socialmedia_icon twitter"  href="<?=sfConfig::get('app_socialmedia_twitter_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Twitter">l</a>
                        <?php endif;?>
                        <?php if(sfConfig::get('app_socialmedia_pinterest_url')):?>
                            <a class="socialmedia_icon pinterest" href="<?=sfConfig::get('app_socialmedia_pinterest_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Pinterest">p</a>
                        <?php endif;?>
                    </p>
                </aside>
            </div>
        </footer>