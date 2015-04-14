<?php include_component('portal', 'header'); ?>

<section class="content" id="sectionLogin">
    <div class="wrapper">
        <h1><?=__('portal.title.editprofile')?></h1>

        <form action="<?=url_for('portal_profile')?>" class="account_form" id="form_profile" method="post" enctype="multipart/form-data">
        <?=$oForm['_csrf_token']->render()?>


        <?php foreach($aLang as $oLang): ?>
            <?= $oForm[$oLang->getCulture()]['id']->render()?>
            <?= $oForm[$oLang->getCulture()]['culture']->render()?>
        <?php endforeach; ?>

        <div class="column half">

            <div>
                <p class="head head2"><?=__('portal.text.companyinfo')?></p>
                <table class="form">
                    <tbody>
                    <?=$oForm['title']->renderRow();?>
                    <?=$oForm['email_address']->renderRow();?>
                    <?php /*
                            <?=$oForm['phone']->renderRow();?>
                            */?>
                    <tr>
                        <th>
                            <?= $oForm['phone_number']->renderLabel();?>
                        </th>
                        <td class="posRel">
                            <?= $oForm['phone_number']->render(array('class' => 'currency w205'))?>
                            <span class="">+</span>
                            <?= $oForm['phone_number']->renderError()?>
                        </td>
                    </tr>
                    <?=$oForm['url']->renderRow();?>
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


            <div>
                <p class="head head2"><?=__('portal.profile.promovideo')?></p>
                <p><?=__('portal.profile.description.promovideo')?></p>
                <table class="form">
                    <tbody>
                    <tr id="profile_promovideo_language_switch" style="display: none;">
                        <th>
                            <label for="profile_promovideo_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                        </th>
                        <td>
                            <span class="dropdown"></span>
                            <select id="profile_promovideo_language" tabindex="30">
                                <?php foreach($aLang as $oLang): ?>
                                    <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <?php foreach($aLang as $oLang): ?>
                        <tr class="language" id="profile_promovideo_language_<?=$oLang->getCulture()?>">
                            <td colspan="2">
                                <?= $oForm[$oLang->getCulture()]['youtube_url']->render(array('class' => 'w385'))?>
                                <?= $oForm[$oLang->getCulture()]['youtube_url']->renderError()?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div>
                <p class="head head2"><?=__('portal.text.contacts')?></p>
                <table class="form">
                    <tr>
                        <th>
                            <label for="" title="<?=__('portal.text.contact1')?>"><?=__('portal.text.contact1')?></label>
                        </th>
                        <td>
                            <span class="dropdown"></span>
                            <?= $oForm['contact1_id']->render();?>
                            <?= $oForm['contact1_id']->renderError();?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="" title="<?=__('portal.text.contact2')?>"><?=__('portal.text.contact2')?></label>
                        </th>
                        <td>
                            <span class="dropdown"></span>
                            <?= $oForm['contact2_id']->render();?>
                            <?= $oForm['contact2_id']->renderError();?>
                        </td>
                    </tr>
                </table>
            </div>

            <div>
                <p class="head head2"><?=__('portal.text.employees')?></p>
                <ul id="profile_employees">
                    <?php foreach($oProvider->getUsers() as $oUser): ?>
                    <li>
                        <a class="" href="<?=url_for('portal_profile_edit_user', array('id' => $oUser->getId()))?>" title="<?=$oUser->getName()?>">
                            <img class="employeePlaceholder small" alt="&nbsp;<?=$oUser->getName()?>" src="<?=null !== $oUser->getImage() ? $oUser->getImage()->getFormat(118, 118, true)->getFile() : ''?>">
                            <br>
                            <span class="ellipsis"><?=$oUser->getName()?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a class="button orange" href="<?=url_for('portal_profile_add_user')?>" title="<?=__('portal.text.employee.add')?>"><?=__('portal.text.employee.add')?></a>
            </div>

            <div>
                <p class="head head2"><?=__('portal.text.xml.importurl')?></p>
                <table class="form">
                    <tbody>
                        <tr>
                            <th>
                                <?=$oForm['import_xml_system']->renderLabel();?>
                            </th>
                            <td>
                                <span class="dropdown"></span>
                                <?=$oForm['import_xml_system']->render(array());?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <?=$oForm['import_url']->renderLabel();?>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?=$oForm['import_url']->render(array('class' => 'w385'));?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="column half">

            <div>
                <p class="head head2"><?=__('portal.profile.logo')?></p>
                <table class="form">
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <?= $oForm['image_id']->render(array('class' => 'w385'))?>
                            <?= $oForm['image_id']->renderError()?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="mt-0px">
                    <?=__('portal.profile.imagecriteria')?>
                </p>
            </div>

            <div>
                <p class="head head2"><?=__('portal.profile.description')?></p>

                <table class="form">
                    <tbody>
                    <tr id="profile_description_language_switch" style="display: none;">
                        <th>
                            <label for="profile_description_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                        </th>
                        <td>
                            <span class="dropdown"></span>
                            <select id="profile_description_language" tabindex="30">
                                <?php foreach($aLang as $oLang): ?>
                                    <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <?php foreach($aLang as $oLang): ?>
                        <tr class="language1" id="profile_description_language_<?=$oLang->getCulture()?>">
                            <td colspan="2">
                                <?= $oForm[$oLang->getCulture()]['content']->render()?>
                                <?= $oForm[$oLang->getCulture()]['content']->renderError()?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="button blue" href="http://www.translate.google.com" id="googleTranslate" tabindex="58" target="_blank" title="<?=__('text.wehelpyoutranslate')?>"><?=__('text.wehelpyoutranslate')?></a>
            </div>

            <div>
                <p class="head head2"><?=__('portal.profile.usps')?></p>
                <table class="form">
                    <tbody>
                    <tr id="profile_usp_language_switch" style="display: none;">
                        <th>
                            <label for="profile_usp_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                        </th>
                        <td>
                            <span class="dropdown"></span>
                            <select id="profile_usp_language" tabindex="30">
                                <?php foreach($aLang as $oLang): ?>
                                    <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <?php foreach($aLang as $oLang): ?>
                        <tr class="language2" id="profile_usp_language_<?=$oLang->getCulture()?>">
                            <th><label for="a" title="#1">#1</label></th>
                            <td><?= $oForm[$oLang->getCulture()]['usp1']->render(array('class' => 'w205'))?>
                                <?= $oForm[$oLang->getCulture()]['usp1']->renderError()?></td>
                            <th><label for="b" title="#2">#2</label></th>
                            <td><?= $oForm[$oLang->getCulture()]['usp2']->render(array('class' => 'w205'))?>
                                <?= $oForm[$oLang->getCulture()]['usp2']->renderError()?></td>
                            <th><label for="c" title="#3">#3</label></th>
                            <td><?= $oForm[$oLang->getCulture()]['usp3']->render(array('class' => 'w205'))?>
                                <?= $oForm[$oLang->getCulture()]['usp3']->renderError()?></td>
                            <th><label for="d" title="#4">#4</label></th>
                            <td><?= $oForm[$oLang->getCulture()]['usp4']->render(array('class' => 'w205'))?>
                                <?= $oForm[$oLang->getCulture()]['usp4']->renderError()?></td>
                            <th><label for="e" title="#5">#5</label></th>
                            <td><?= $oForm[$oLang->getCulture()]['usp5']->render(array('class' => 'w205'))?>
                                <?= $oForm[$oLang->getCulture()]['usp5']->renderError()?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a class="button blue" href="http://www.translate.google.com" id="googleTranslate" tabindex="58" target="_blank" title="<?=__('text.wehelpyoutranslate')?>"><?=__('text.wehelpyoutranslate')?></a>
            </div>



        </div>

        <div class="devider"></div>

        <div class="column" id="formFooter">
            <div>
                <p class="mt-0px lh-30px">
                    <input class="float_left shadow" tabindex="63" type="submit" value="<?=__('portal.form.saveprofile')?>" />
                    <?=__('portal.form.15minutewarning')?>
                </p>
            </div>
        </div>

        </form>

        <script src="./js/jquery.form2.js"></script>

        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

        <script>

            //
            var object            = { id: 'profile_promovideo_language', fields: 'language' };
            var languageSelector  = new LanguageSelection(object);
            languageSelector.Init();

            //
            var object1            = { id: 'profile_description_language', fields: 'language1' };
            var languageSelector1 = new LanguageSelection(object1);
            languageSelector1.Init();

            //
            var object2           = { id: 'profile_usp_language', fields: 'language2' };
            var languageSelector2 = new LanguageSelection(object2);
            languageSelector2.Init();

            /* */

            (function() {

                var bar = $('.bar');
                var percent = $('.percent');
                var status = $('#status');


            })();

            /* */
            $(function() {
                $( ".datepicker" ).datepicker();

                initLocationSelectors('association_country_id', 'association_region_id', 'association_city_id', '<?=url_for('api_region_options')?>', '<?=url_for('api_city_options')?>');
            });

        </script>

    </div>
</section>