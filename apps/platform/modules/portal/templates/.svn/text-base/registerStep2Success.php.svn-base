<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 */
?>

<?php if(get_slot('bDisableBreadcrumb', false) !== true): ?>
    <section class="content" id="title">
        <div class="wrapper">
            <h1>
                <?=__('title.registerStep2')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>
<?php endif; ?>

    <section class="content" id="sectionLogin">
        <div class="wrapper">

            <div id="selling-steps">

                <?php if($sType == 'business'): ?>
                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 1))?>" title="<?=__('portal.text.step')?>1: <?=__('portal.text.choosepackage')?>">
                        <?=__('portal.text.step')?>1: <?=__('portal.text.choosepackage')?>
                    </a>

                    <a class="active button noTransition proceed" href="<?=url_for('portal_register', array('step' => 2))?>" title="<?=__('portal.text.step')?>2: <?=__('portal.text.yourdata')?>">
                        <?=__('portal.text.step')?>2: <?=__('portal.text.yourdata')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 3))?>" title="<?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>">
                        <?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>">
                        <?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>
                    </a>
                <?php else: ?>
                    <a class="active button noTransition proceed" href="<?=url_for('portal_register', array('step' => 2))?>" title="<?=__('portal.text.step')?>1: <?=__('portal.text.yourdata')?>">
                        <?=__('portal.text.step')?>1: <?=__('portal.text.yourdata')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 3))?>" title="<?=__('portal.text.step')?>2: <?=__('portal.text.termsandconditions')?>">
                        <?=__('portal.text.step')?>2: <?=__('portal.text.termsandconditions')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.text.step')?>3: <?=__('portal.text.submitandpay')?>">
                        <?=__('portal.text.step')?>3: <?=__('portal.text.submitandpay')?>
                    </a>
                <?php endif; ?>



            </div>

            <h1 class="mb-10px">
                <?=__('portal.text.step')?><?= ($sType=='private')? '1' : '2'?>: <?=__('portal.text.yourdata')?>
            </h1>
            <p class="mt-0px">
                <?=__('portal.description.yourdata')?>
            </p>
            
            <p class="mt-0px">
                <?=__('portal.selected-package')?>: 
                <strong>&#34;<?=$oSelectedPackage?>&#34;</strong>
            </p>
            
            <section class="article" id="newAccount">
                <form action="<?=url_for('portal_register', array('step' => 3))?>" id="form_newaccount" method="POST">
                    <?=$oForm['_csrf_token']->render()?>
                    <?php if($sType == 'business'): ?>
                    <div>
                        <p class="head head1"><?=__('portal.text.companydata')?></p>
                        <table class="form">
                            <tbody>
                            <?=$oForm['company_name']->renderRow();?>
                            <?=$oForm['email']->renderRow();?>
                            <?php /*
                            <?=$oForm['phone']->renderRow();?>
                            */?>
                            <tr>
                                <th>
                                    <?= $oForm['phone']->renderLabel();?>
                                </th>
                                <td class="posRel">
                                    <?= $oForm['phone']->render(array('class' => 'currency w115'))?>
                                    <span class="mt-5px">+</span>
                                    <?= $oForm['phone']->renderError()?>
                                </td>
                            </tr>
                            <?=$oForm['address1']->renderRow();?>
                            <?=$oForm['address2']->renderRow();?>
                            <tr>
                                <th>
                                    <label for="property_address_country" title="<?=__('portal.form.country')?>"><?=__('portal.form.country')?></label>
                                </th>
                                <td>
                                    <span class="dropdown"></span>
                                    <?= $oForm['country_id']->render()?>
                                    <?= $oForm['country_id']->renderError()?><br />
                                    <div id='div_country_new' style="display:none">
                                        <?= $oForm['country_new']->render();?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="property_address_region" title="<?=__('portal.form.region')?>"><?=__('portal.form.region')?></label>
                                </th>
                                <td>
                                    <span class="dropdown"></span>
                                    <?= $oForm['region_id']->render()?>
                                    <?= $oForm['region_id']->renderError()?><br />
                                    <div id='div_region_new' <?= intval($oForm['region_id']->getValue()) !== -1 ? 'style="display:none"' : ''?>>
                                        <?= $oForm['region_new']->render();?>
                                        <?= $oForm['region_new']->renderError();?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="property_address_city" title="<?=__('portal.form.city')?>"><?=__('portal.form.city')?></label>
                                </th>
                                <td>
                                    <span class="dropdown"></span>
                                    <?= $oForm['city_id']->render()?>
                                    <?= $oForm['city_id']->renderError()?><br />
                                    <div id='div_city_new' <?= intval($oForm['city_id']->getValue()) !== -1 ? 'style="display:none"' : ''?>>
                                        <?= $oForm['city_new']->render();?>
                                        <?= $oForm['city_new']->renderError();?>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>

                    <div>
                        <p class="head head1"><?=__('portal.text.personaldata')?></p>
                        <table class="form">
                            <tbody>
                            <?=$oForm['personal_surname']->renderRow();?>
                            <?=$oForm['personal_firstname']->renderRow();?>
                            <?php if($sType == 'business'): ?>
                                <?=$oForm['personal_function']->renderRow();?>
                            <?php endif;?>
                            <?=$oForm['personal_email']->renderRow();?>
                            </tbody>
                        </table>
                        <p>
                            <?=__('text.portal.registerstep2.description')?>
                        </p>
                    </div>



                <div id="step2Submit">
                    <input class="float_right shadow" type="submit" value="<?=__('portal.text.savedata')?> &raquo;" />
                </div>

                </form>
            </section>
        </div>
    </section>

<script>

    $(function() {

        initLocationSelectors('register_country_id', 'register_region_id', 'register_city_id', '<?=url_for('api_region_options')?>', '<?=url_for('api_city_options')?>');
    });

</script>