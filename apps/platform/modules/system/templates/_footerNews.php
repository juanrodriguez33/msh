<section class="content" id="newsFooter">
    <div class="wrapper">
        <section>
            <?= include_component('property', 'footerTopPropertiesSmall'); ?>
        </section>
        <aside>
            <?= include_component('content', 'footerRecentNews'); ?>
        </aside>
        <aside>
            <p class="head head2"><?=__('newsletter')?></p>
            <p>
                <?=__('newsletterdescription')?>
            </p>

            <div id="mc_embed_signup">
                <form action="http://MySecondHome.us7.list-manage.com/subscribe/post?u=0f5521258b26c1dc3b79a9d09&id=3cf19d6c46" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <input type="hidden" value="<?=strtoupper($sf_user->getCulture())?>" name="LANG">
                    <?php if($sf_user->hasCountry()): ?>
                        <input type="hidden" value="<?=$sf_user->getCountry()->getTitle('en')?>" name="COUNTRY">
                    <?php endif;?>
                    <table class="form">
                        <tbody>
                        <tr>
                            <td><input id="newsletter_email_address" name="EMAIL" placeholder="<?=__('newslettersignupplaceholder')?>" tabindex="101" type="text" value="" /></td>
                            <td><input class="blue" tabindex="102" type="submit" value="<?=__('signup')?>" /></td>
                        </tr>
                        </tbody>
                    </table>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                </form>
            </div>
        </aside>
    </div>
</section>