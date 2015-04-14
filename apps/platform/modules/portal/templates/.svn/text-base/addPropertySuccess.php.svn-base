<?php include_component('portal', 'header'); ?>

<section class="content" id="sectionLogin">
<div class="wrapper">
<h1><?=__('text.addProperty')?></h1>
    <a class="button gray laquo mt-10px" href="<?=url_for('portal_properties')?>" title="<?=__('portal.backtooverview')?>"><?=__('portal.backtooverview')?></a>
<form class="account_form" id="form_property" method="post" enctype="multipart/form-data">
<?= $form['_csrf_token']->render()?>

<div class="column half">

<?php if($sf_user->hasCredential('ROLE_ASSOCIATION')): ?>
<div>
    <p class="head head2"><?=__('portal.form.isdevelopment')?></p>
    <p><?=__('portal.form.description.development')?></p>
    <table class="form">
        <tbody>
        <tr>
            <th>
                <?= $form['isdevelopment']->renderLabel()?>
            </th>
            <td>
                <?= $form['isdevelopment']->render()?>
                <?= $form['isdevelopment']->renderError()?>
            </td>
        </tr>
        <tr class="tr_property_development_new" style="display: none;">
            <th>
                <?= $form['development_id']->renderLabel()?>
            </th>
            <td>
                <span class="dropdown"></span>
                <?= $form['development_id']->render()?>
                <?= $form['development_id']->renderError()?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<?php endif; ?>

<div>
    <p class="head head2"><?=__('portal.form.address')?></p>
    <p><?=__('portal.form.description.address')?></p>
    <table class="form">
        <tbody>
        <tr>
            <th>
                <?= $form['address1']->renderLabel()?>
            </th>
            <td>
                <?= $form['address1']->render()?>
                <?= $form['address1']->renderError()?>
            </td>
        </tr>
        <tr>
            <th>
                <?= $form['address2']->renderLabel()?>
            </th>
            <td>
                <?= $form['address2']->render()?>
                <?= $form['address2']->renderError()?>
            </td>
        </tr>
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
    <p class="head head2"><?=__('portal.form.data')?></p>
    <p><?=__('portal.form.description.data')?></p>
    <table class="form">
        <tbody>
        <tr>
            <th>
                <?= $form['price']->renderLabel()?>
            </th>
            <td>
                <?= $form['price']->render()?>
                <span>&euro;</span>
                <?= $form['price']->renderError()?>
            </td>
        </tr>
        <tr>
            <th>
                <?= $form['type_id']->renderLabel()?>
            </th>
            <td>
                <span class="dropdown"></span>
                <?= $form['type_id']->render()?>
                <?= $form['type_id']->renderError()?>
            </td>
        </tr>
        <tr>
            <th>
                <?= $form['volume']->renderLabel()?>
            </th>
            <td>
                <?= $form['volume']->render()?> m<sup>3</sup>
                <?= $form['volume']->renderError()?>
            </td>
        </tr>
        <tr>
            <th>
                <?= $form['surface']->renderLabel()?>
            </th>
            <td>
                <?= $form['surface']->render()?> m<sup>2</sup>
                <?= $form['surface']->renderError()?>
            </td>
        </tr>
        <?= $form['rooms']->renderRow() ?>
        <?= $form['bedrooms']->renderRow() ?>
        <?= $form['bathrooms']->renderRow() ?>

        </tbody>
    </table>
</div>

<div>
    <p class="head head2"><?=__('portal.form.condition')?></p>
    <p><?=__('portal.form.description.condition')?></p>
    <table class="form">
        <tbody>
        <?= $form['furnished']->renderRow() ?>
        <?= $form['constructionyear']->renderRow() ?>
        <?= $form['renovationyear']->renderRow() ?>
        <?= $form['isolation']->renderRow() ?>
        <?= $form['doubleglass']->renderRow() ?>
        <?= $form['interior_state']->renderRow() ?>
        <?= $form['exterior_state']->renderRow() ?>
        <?= $form['wheelchair']->renderRow() ?>
        </tbody>
    </table>
</div>

<div>
    <p class="head head2"><?=__('portal.form.surroundingsinformation')?></p>
    <p><?=__('portal.form.description.surrounding')?></p>
    <table class="form">
        <tbody>
        <?= $form['surrounding']->renderRow() ?>
        <?= $form['view']->renderRow() ?>
        <tr>
            <th>
                <?= $form['horeca']->renderLabel()?>
            </th>
            <td>
                <span class="dropdown"></span>
                <?= $form['horeca']->render()?>
                <?= $form['horeca']->renderError()?>
            </td>
        </tr>
        <tr>
            <th>
                <?= $form['amusement']->renderLabel()?>
            </th>
            <td>
                <span class="dropdown"></span>
                <?= $form['amusement']->render()?>
                <?= $form['amusement']->renderError()?>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div>
    <p class="head head2"><?=__('portal.form.rentaldata')?></p>
    <p><?=__('portal.form.description.rentaldata')?></p>
    <table class="form">
        <tbody>
            <?= $form['trial']->renderRow() ?>
            <?= $form['renting_allowed']->renderRow() ?>
            <?= $form['max_renting_period']->renderRow() ?>
            <tr>
                <th>
                    <?= $form['rent_indication']->renderLabel()?>
                </th>
                <td>
                    <?= $form['rent_indication']->render()?>
                    <span>&euro;</span>
                    <?= $form['rent_indication']->renderError()?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</div>
<div class="column half">



<div>
    <p class="head head2"><?=__('portal.form.contactinformation')?></p>
    <p><?=__('portal.form.description.contact')?></p>
    <table class="form">
        <tbody>
        <?= $form['email_address']->renderRow() ?>
        <?= $form['phone_number']->renderRow() ?>
        </tbody>
    </table>
</div>

<div>
    <p class="head head2"><?=__('portal.form.propertydescription')?></p>
    <p><?=__('portal.form.description.description')?></p>
    <table class="form">
        <tbody>
        <tr id="property_description_language_switch" style="display: none;">
            <th>
                <label for="property_description_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
            </th>
            <td>
                <span class="dropdown"></span>
                <select id="property_description_language" tabindex="30">
                    <?php foreach($aLang as $oLang): ?>
                        <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <?php foreach($aLang as $oLang): ?>
            <tr class="language" id="property_description_language_<?=$oLang->getCulture()?>">
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
    <p class="head head2"><?=__('portal.form.floormap')?></p>
    <p><?=__('portal.form.description.floormap')?></p>
    <table class="form">
        <tbody>
            <tr>
                <td colspan="2">
                    <?=$form['pdf_map']->render()?>
                    <?=$form['pdf_map']->renderError()?>
                </td>
            </tr>
        <?php /*
        <tr>
            <td colspan="2">
                <input accept="*.pfd" class="" id="property_floormap_pdf" name="property[floormap_pdf]" multiple tabindex="59" type="file" />
            </td>
        </tr>*/ ?>
        </tbody>
    </table>
    <p>
        <?=__('uploader.maxsizepdf')?>: <?=sfConfig::get('app_uploader_maxsizepdf')?> MB
    </p>
</div>

<div>
    <p class="head head2"><?=__('portal.form.pictures')?></p>
    <p><?=__('portal.form.description.pictures')?></p>
    <div class="uploader" id="uploader"></div>
    <div class="uploader_hidden_fields hidden">
        <input name="property_image_order" class="hidden" id="property_images_sortable_order" type="hidden" />
    </div>
    <p>
        <?=__('uploader.imageformats')?>. <?=__('uploader.maxsizepictures')?>: <?=sfConfig::get('app_uploader_maxsizepicture')?> MB
    </p>
    
    <p class="head head3"><?=__('portal.form.pictures.order')?></p>
    <p><?=__('portal.form.description.pictureorder')?></p>
    <div id="existingImages">
        <ul class="sortable" id="property_images_sortable">
            <?php foreach($aImage as $oLinkImage): $oImage = $oLinkImage->getImage();?>
                <li data-id="<?=$oLinkImage->getId()?>">
                    <img width="90" height="60" src="<?=$oImage->getFormatUrl(90, 60)?>">
                    <a href="<?=$oImage->getFormatUrl(1024,768)?>" class="action edit" title="<?=__('upload.view')?>" rel="portal_pictures"><?=__('upload.view')?><img width="90" height="60" src="<?=$oImage->getOriginalFormatUrl()?>"></a>
                    <a href="<?=url_for('portal_properties_image_delete')?>?id=<?=$oLinkImage->getId()?>" class="action delete" title="<?=__('upload.delete')?>"><?=__('upload.delete')?></a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>

</div>

<div class="devider"></div>

<div class="column" id="formFooter">
    <div>
        <p class="mt-0px">
            <input class="float_left shadow" tabindex="63" type="submit" value="<?=__('portal.form.saveproperty')?>" />
            <span class="lh-30px ml-20px">
                <input type="checkbox" id="property_activate_checkbox_" name="property_activate" value="1" <?= $bActivate ? 'checked="checked"' :''?>>
                <label for="property_activate_checkbox_"><?=__('portal.directlyactivateproperty')?></label>
            </span>
        </p>

        <p class="mt-10px">
            <?=__('portal.form.15minutewarning')?>
        </p>
    </div>
</div>

</form>


<script>

    // Hidden field
    $('#property_isdevelopment').on('change', function(){
        if($(this).is(':checked')) {
            $('.tr_property_development_new').slideDown('slow');
        }
        else {
            
            $('#property_country_id').removeAttr('disabled');
            $('#property_region_id').removeAttr('disabled');
            $('#property_city_id').removeAttr('disabled');
            
            initLocationSelectors('property_country_id', 'property_region_id', 'property_city_id', '<?=url_for('api_region_options')?>', '<?=url_for('api_city_options')?>');
            $('.tr_property_development_new').slideUp('slow');
            
            // reset dropdowns
            $('#property_development_id').val($('#property_development_id option:first').val());
            $('#property_country_id').val($('#property_country_id option:first').val());
            $('#property_region_id option').remove();
            $('#property_city_id option').remove();
        }
    });


    $('#property_development_id').on('change', function() {
        var el = $(this);
        if($(this).val() > 0) {
            $('#property_country_id').unbind('change');
            $('#property_country_id').attr('disabled', 'disabled');
            $('#property_region_id').unbind('change');
            $('#property_region_id').attr('disabled', 'disabled');
            $('#property_city_id').unbind('change');
            $('#property_city_id').attr('disabled', 'disabled');

            $.ajax('<?=url_for('api_development_info')?>'+ '?development_id='+$(this).val())

                .done(function(res) {
                    $('#property_country_id').val(res.country_id);
                    $('#property_region_id option').remove();
                    $('#property_region_id').append('<option value="'+res.region_id+'">'+res.region_title+'</option>');
                    $('#property_city_id option').remove();
                    $('#property_city_id').append('<option value="'+res.city_id+'">'+res.city_title+'</option>');
                })
        } else {
        
            $('#property_country_id').removeAttr('disabled');
            $('#property_region_id').removeAttr('disabled');
            $('#property_city_id').removeAttr('disabled');
            
            // reset dropdowns
            $('#property_development_id').val($('#property_development_id option:first').val());
            $('#property_country_id').val($('#property_country_id option:first').val());
            $('#property_region_id option').remove();
            $('#property_city_id option').remove();
        
            //
            initLocationSelectors('property_country_id', 'property_region_id', 'property_city_id', '<?=url_for('api_region_options')?>', '<?=url_for('api_city_options')?>');
        }
    })

    // edit? cheched?
    $(function(){
        if($('#property_isdevelopment').is(':checked')) {
            $('.tr_property_development_new').show();
        }
        $('#property_development_id').change();
    });

    // Hidden descriptions / multilanguage
    var object           = { id: 'property_description_language', fields: 'language' };
    var languageSelector = new LanguageSelection(object);
    languageSelector.Init();

    /* */
    $(function() {
        $( ".datepicker" ).datepicker();

        initLocationSelectors('property_country_id', 'property_region_id', 'property_city_id', '<?=url_for('api_region_options')?>', '<?=url_for('api_city_options')?>');
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

<?php include_partial('portal/plupload', array('type' => 'propertyimage', 'property' => null)); ?>

</div>
</section>