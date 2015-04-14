<?php include_component('portal', 'header'); ?>

<section class="content" id="sectionLogin">
    <div class="wrapper">
    <h1><?=__('text.editDevelopment')?></h1>
    <a class="button gray laquo mt-10px" href="<?=url_for('portal_developments')?>" title="<?=__('portal.backtooverview')?>"><?=__('portal.backtooverview')?></a>

    <form class="account_form" id="form_development" method="post" enctype="multipart/form-data">

    <?= $form['_csrf_token']->render()?>

    <?php foreach($aLang as $oLang): ?>
        <?= $form[$oLang->getCulture()]['id']->render()?>
        <?= $form[$oLang->getCulture()]['culture']->render()?>
    <?php endforeach; ?>

    <div class="column half">

        <div>
            <p class="head head2"><?=__('portal.form.address')?></p>
            <table class="form">
                <tbody>
                <?= $form['address1']->renderRow() ?>
                <?= $form['address2']->renderRow() ?>
                <tr>
                    <th>
                        <label for="property_address_country" title="<?=__('portal.form.country')?>"><?=__('portal.form.country')?></label>
                    </th>
                    <td>
                        <span class="dropdown"></span>
                        <?= $form['country_id']->render()?>
                        <?= $form['country_id']->renderError()?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="property_address_region" title="<?=__('portal.form.region')?>"><?=__('portal.form.region')?></label>
                    </th>
                    <td>
                        <span class="dropdown"></span>
                        <?= $form['region_id']->render()?>
                        <?= $form['region_id']->renderError()?>
                        <div id='div_region_new' class='float_left' <?= intval($form['region_id']->getValue()) !== -1 ? 'style="display:none"' : ''?>>
                            <?= $form['region_new']->render();?>
                            <?= $form['region_new']->renderError();?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="property_address_city" title="<?=__('portal.form.city')?>"><?=__('portal.form.city')?></label>
                    </th>
                    <td>
                        <span class="dropdown"></span>
                        <?= $form['city_id']->render()?>
                        <?= $form['city_id']->renderError()?>
                        <div id='div_city_new' class='float_left' <?= intval($form['city_id']->getValue()) !== -1 ? 'style="display:none"' : ''?>>
                            <?= $form['city_new']->render();?>
                            <?= $form['city_new']->renderError();?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div>
            <p class="head head2"><?=__('portal.form.developmentdescription')?></p>
            <table class="form">
                <tbody>
                <tr id="development_description_language_switch" style="display: none;">
                    <th>
                        <label for="development_description_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                    </th>
                    <td>
                        <span class="dropdown"></span>
                        <select id="development_description_language" tabindex="8">
                            <?php foreach($aLang as $oLang): ?>
                                <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <?php foreach($aLang as $oLang): ?>
                    <tr class="language1" id="development_description_language_<?=$oLang->getCulture()?>">
                        <th><label for="development_<?=$oLang->getCulture()?>_title" title="<?=__('portal.formlabel.developmenttitle')?>"><?=__('portal.formlabel.developmenttitle')?></label></th>
                        <td>
                            <?= $form[$oLang->getCulture()]['title']->render(array('class' => 'w205'))?>
                            <?= $form[$oLang->getCulture()]['title']->renderError()?>
                        </td>
                        <td colspan="2">
                            <?= $form[$oLang->getCulture()]['content']->render()?>
                            <?= $form[$oLang->getCulture()]['content']->renderError()?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a class="button blue" href="http://www.translate.google.com" id="googleTranslate" tabindex="58" target="_blank" title="<?=__('text.wehelpyoutranslate')?>"><?=__('text.wehelpyoutranslate')?></a>
        </div>

        <div>
            <p class="head head2"><?=__('portal.form.usps')?></p>
            <table class="form">
                <tbody>
                <tr id="development_usp_language_switch" style="display: none;">
                    <th>
                        <label for="development_usp_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                    </th>
                    <td>
                        <span class="dropdown"></span>
                        <select id="development_usp_language" tabindex="13">
                            <?php foreach($aLang as $oLang): ?>
                                <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <?php foreach($aLang as $oLang): ?>
                    <tr class="largeInput language4" id="development_usp_language_<?=$oLang->getCulture()?>">
                        <th><label for="a" title="#1">#1</label></th>
                        <td>
                            <?= $form[$oLang->getCulture()]['usp1']->render(array('class' => 'w380'))?>
                            <?= $form[$oLang->getCulture()]['usp1']->renderError()?>
                        </td>
                        <th><label for="b" title="#2">#2</label></th>
                        <td>
                            <?= $form[$oLang->getCulture()]['usp2']->render(array('class' => 'w380'))?>
                            <?= $form[$oLang->getCulture()]['usp2']->renderError()?>
                        </td>
                        <th><label for="c" title="#3">#3</label></th>
                        <td>
                            <?= $form[$oLang->getCulture()]['usp3']->render(array('class' => 'w380'))?>
                            <?= $form[$oLang->getCulture()]['usp3']->renderError()?>
                        </td>
                        <th><label for="d" title="#4">#4</label></th>
                        <td>
                            <?= $form[$oLang->getCulture()]['usp4']->render(array('class' => 'w380'))?>
                            <?= $form[$oLang->getCulture()]['usp4']->renderError()?>
                        </td>
                        <th><label for="e" title="#5">#5</label></th>
                        <td>
                            <?= $form[$oLang->getCulture()]['usp5']->render(array('class' => 'w380'))?>
                            <?= $form[$oLang->getCulture()]['usp5']->renderError()?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <div class="column half">

        <div>
            <p class="head head2"><?=__('portal.form.promovideo')?></p>
            <table class="form">
                <tbody>
                <tr id="development_promovideo_language_switch" style="display: none;">
                    <th>
                        <label for="development_promovideo_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                    </th>
                    <td>
                        <span class="dropdown"></span>
                        <select id="development_promovideo_language" tabindex="29">
                            <?php foreach($aLang as $oLang): ?>
                                <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <?php foreach($aLang as $oLang): ?>
                    <tr class="language3" id="development_promovideo_language_<?=$oLang->getCulture()?>">
                        <td colspan="2">
                            <?= $form[$oLang->getCulture()]['youtube_url']->render(array('class' => 'w385'))?>
                            <?= $form[$oLang->getCulture()]['youtube_url']->renderError()?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div>
            <p class="head head2"><?=__('portal.form.pdfmap')?></p>
            <table class="form">
                <tbody>
                <tr>
                    <td colspan="2">
                        <?= $form['pdf_map']->render()?>
                        <?= $form['pdf_map']->renderError()?>
                    </td>
                </tr>
                </tbody>
            </table>
            <p>
                <?=__('uploader.maxsizepdf')?>: <?=sfConfig::get('app_uploader_maxsizepdf')?> MB
            </p>
        </div>

        <div>
            <p class="head head2"><?=__('portal.form.surroundings')?></p>
            <table class="form">
                <tbody>
                <tr id="development_environment_language_switch" style="display: none;">
                    <th>
                        <label for="development_environment_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                    </th>
                    <td>
                        <span class="dropdown"></span>
                        <select id="development_environment_language" tabindex="37">
                            <?php foreach($aLang as $oLang): ?>
                                <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <?php foreach($aLang as $oLang): ?>
                    <tr class="language2" id="development_environment_language_<?=$oLang->getCulture()?>">
                        <td colspan="2">
                            <?= $form[$oLang->getCulture()]['surroundings']->render()?>
                            <?= $form[$oLang->getCulture()]['surroundings']->renderError()?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a class="button blue" href="http://www.translate.google.com" id="googleTranslate_" tabindex="58" target="_blank" title="<?=__('text.wehelpyoutranslate')?>"><?=__('text.wehelpyoutranslate')?></a>
        </div>

        <div>
            <p class="head head2"><?=__('portal.form.pictures')?></p>
            <div class="uploader" id="uploader"></div>
            <div class="uploader_hidden_fields hidden">
                <input name="development_image_order" class="hidden" id="development_images_sortable_order" type="hidden" />
            </div>
            <p>
                <?=__('uploader.imageformats')?>. <?=__('uploader.maxsizepictures')?>: <?=sfConfig::get('app_uploader_maxsizepicture')?> MB
            </p>

            <p class="head head3"><?=__('portal.form.pictures.order')?></p>
            <div id="existingImages">
                <ul class="sortable" id="development_images_sortable">
                    <?php foreach($oDevelopment->getSequencedLinkedImages() as $oLinkImage): $oImage = $oLinkImage->getImage();?>
                        <li data-id="<?=$oLinkImage->getId()?>">
                            <img src="<?=$oImage->getFormatUrl(90,60)?>">
                            <a href="<?=$oImage->getFormatUrl(1024,768)?>" class="action edit" title="<?=__('upload.view')?>" rel="portal_pictures"><?=__('upload.view')?><img src="<?=$oImage->getFormatUrl(90,60)?>"></a>
                            <a href="<?=url_for('portal_developments_image_delete')?>?id=<?=$oLinkImage->getId()?>" class="action delete" title="<?=__('upload.delete')?>"><?=__('upload.delete')?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>

    </div>

    <div class="devider"></div>

    <div class="column" id="formFooter">
        <div>
            <input class="float_left shadow" tabindex="43" type="submit" value="<?=__('portal.form.savedevelopment')?>" />

            <a class="a_icon_delete button float_right gray" href="<?=url_for('portal_developments_delete', array('id' => $oDevelopment->getId()))?>" id="a_delete_development_<?=$oDevelopment->getId()?>" tabindex="45" title="<?=__('portal.form.deletedevelopment')?>"><?=__('portal.form.deletedevelopment')?></a>
            <p>
                <?=__('portal.form.15minutewarning')?>
            </p>
            
            <script type="text/javascript">
                setConfirm('a_delete_development_<?=$oDevelopment->getId()?>', '<?=__('portal.development.confirm.delete')?>');
            </script>
        </div>
    </div>

    </form>

    <script type="text/javascript">

        // Hidden descriptions / multilanguage
        var object1            = { id: 'development_description_language', fields: 'language1' };
        var languageSelector1 = new LanguageSelection(object1);
        languageSelector1.Init();

        var object2           = { id: 'development_environment_language', fields: 'language2' };
        var languageSelector2 = new LanguageSelection(object2);
        languageSelector2.Init();

        var object3           = { id: 'development_promovideo_language', fields: 'language3' };
        var languageSelector3 = new LanguageSelection(object3);
        languageSelector3.Init();

        var object4           = { id: 'development_usp_language', fields: 'language4' };
        var languageSelector4 = new LanguageSelection(object4);
        languageSelector4.Init();


        //

        $(function() {
            $( ".datepicker" ).datepicker();

            initLocationSelectors('development_country_id', 'development_region_id', 'development_city_id', '<?=url_for('api_region_options')?>', '<?=url_for('api_city_options')?>');
        });

    </script>

    <script type="text/javascript">

        // Slideshow
        var slideshow = new Slideshow();
        var object = { navigation: true, thumbnails: true, thumbnails_hidden: true };

        //
        slideshow.Init(object);

        $(function() {
            $('#div_slideshow').swipe( {
                //Generic swipe handler for all directions
                swipe:function(event, direction, distance, duration, fingerCount) {
                    if(direction == "left")  slideshow.Slide('next');
                    if(direction == "right") slideshow.Slide('prev');
                    if(direction == "up")    slideshow.ShowThumbnails();
                    if(direction == "down")  slideshow.HideThumbnails();
                }, threshold: 75
            });
        });
    </script>
    <?php include_partial('portal/plupload', array('type' => 'developmentimage', 'development' => $oDevelopment->getId())); ?>

    </div>
</section>