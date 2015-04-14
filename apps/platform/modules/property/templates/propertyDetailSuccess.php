<?php include_component('content', 'stepHeader'); ?>

<?php /** @var Property $oProperty */ ?>
<section class="content white">
    <div class="wrapper">
        <div class="pt-20px">
            <?php if($sf_user->toggleViewed($oProperty->getId())):?>
                <script type="text/javascript">
                    ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','viewed','<?=$oProperty->getSlug()?>');
                </script>
            <?php endif;?>
    
            <a class="button gray back" href="<?=MSHTools::getCountryRegionCityUrl($oProperty->getCity())?>"><?=__('text.backtolist')?></a>
            
            <div id="detailFavoriteBox">
                <span id="span_favorite_<?=$oProperty->getId()?>" container="favorite">
                    <?php include_partial('property/favorite', array('oProperty' => $oProperty, 'bFavorite' => $sf_user->isFavorite($oProperty->getId())))?>
                </span>
                <script>
                    initFavorites();
                </script>
            </div>
            
            <section class="article" id="homeDetail">
    
                <a href="<?=$oProperty->getFirstImageUrl()?>" id="firstImage" title="<?=$altText?>">
                    <img title="<?=$altText?>" alt="<?=$altText?>" class="loader big" height="240" width="360" src="<?=$oProperty->getFirstImageUrl(360,240)?>" pagespeed_no_transform />
                </a>
                <div id="homeDetailInformation">
                    <h1><?=$oProperty->getCity()?>, <?=$oProperty->getRegion()?></h1>
                    <?php /*
                    <p class="head head4"><?=$oProperty->getAddress1()?></p>
                    */ ?>
                    <p>
                        <?=$oProperty->getPropertyType()?><br />
                        <?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?><?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getRooms()) > 0):?>, <?php endif;?><?php if(intval($oProperty->getRooms()) > 0):?><?=$oProperty->getRooms()?> <?=__('text.rooms')?><?php endif;?>&nbsp;
                    </p>
                    <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
    
                    <div>
                        <?php if($oProperty->getPdfMap()):?>
                            <a class="button gray" onclick="Javascript:return ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','floormap','<?=$oProperty->getSlug()?>');" href="<?=$oProperty->getPdfMap()?>" target="_blank" id="aFloorMap" title="<?=__('see-floormap')?>"><?=__('see-floormap')?></a>
                        <?php endif;?>
                        <?php if(1==2):?>
                            <a class="button gray" onclick="Javascript:return ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','brochure','<?=$oProperty->getSlug()?>');" href="" id="aBrochure" title="<?=__('see-brochure')?>"><?=__('see-brochure')?></a>
                        <?php endif;?>
                    </div>
    
                </div>
    
                <aside>
                
                    <?php if(null!==$oProperty->getAssociation()): ?>
                        <?php if(null===$oProperty->getAssociation()->getUserRelatedByContact1Id() && null===$oProperty->getAssociation()->getUserRelatedByContact2Id()): ?>
                            <img alt="<?=$oProperty->getAssociation()?>" class="loader big" src="<?=$oProperty->getAssociation()->getImage() !== null ? $oProperty->getAssociation()->getImage()->getFormatUrl(180,120,true) : ''?>" pagespeed_no_transform width="180" height="120"/><br />
                        <?php else: ?>
                        <ul>
                            <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact1Id()): ?>
                            <li title="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>">
                                <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact1Id()->getImage()): ?>
                                    <img alt="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>" src="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getImage()->getFormatUrl(110,110,true)?>" title="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>" pagespeed_no_transform width="110" height="110"/>
                                <?php endif;?>
                                <p>
                                    <strong class="" title="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>"><?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?></strong>
                                    <br /><?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getAssociationFunction()?>
                                </p>
                            </li>
                            <?php endif;?>
                            <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact2Id()): ?>
                            <li title="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>">
                                <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact2Id()->getImage()): ?>
                                    <img alt="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>" src="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getImage()->getFormatUrl(110,110,true)?>" title="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>" pagespeed_no_transform width="110" height="110"/>
                                <?php endif;?>
                                <p>
                                    <strong class="" title="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>"><?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?></strong>
                                    <br /><?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getAssociationFunction()?>
                                </p>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <?php endif;?>
                    <?php endif;?>
                
                    <a class="button orange" onclick="Javascript:return ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','contact_request','<?=$oProperty->getSlug()?>');" href="#homeDetailContact" id="aContactUs" title="<?=__('text.contactus')?>">
                        <span><?=__('text.moreinfo')?></span>
                        <span><?=__('text.contactus')?></span>
                    </a>
                </aside>
    
                <ul class="block thumbnails_low">
                <?php $i=0; foreach($oProperty->getImages() as $oImage):?>
                    <?php if(($i<6 && count($oProperty->getImages()) > 7) || count($oProperty->getImages()) <= 7): ?>
                    <li>
                        <a href="<?=$oImage->getOriginalFormatUrl()?>" <?=($i==0?'id="firstThumbnail"':'')?>rel="slideshow">
                            <img alt="<?=$oImage?>" class="loader" height="60" width="90" src="<?=$oImage->getFormatUrl(90, 60, true, false, $oProperty->getImportId()) ?>" pagespeed_no_transform />
                        </a>
                    </li>
                    <?php elseif($i==6 && count($oProperty->getImages()) > 7):?>
                    <li>
                        <a class="moreImages" href="" id="allImages" title="<?=__('more-pictures')?>">
                            <div><p><?=__('more-pictures')?></p></div>
                        </a>
                    </li>
                    <li style="display: none;">
                        <a href="<?=$oImage->getOriginalFormatUrl()?>" <?=($i==0?'id="firstThumbnail"':'')?>rel="slideshow">
                            <img alt="<?=$oImage?>" class="loader" height="60" width="90" src="<?=$oImage->getFormatUrl(90, 60, true, false, $oProperty->getImportId())?>" pagespeed_no_transform />
                        </a>
                    </li>
                    <?php else: ?>
                    <li style="display: none;">
                        <a href="<?=$oImage->getOriginalFormatUrl()?>" <?=($i==0?'id="firstThumbnail"':'')?>rel="slideshow">
                            <img alt="<?=$oImage?>" class="loader" height="60" width="90" src="<?=$oImage->getFormatUrl(90, 60, true, false, $oProperty->getImportId())?>" pagespeed_no_transform />
                        </a>
                    </li>
                    <?php endif;?>
                <?php $i++; endforeach;?>
                </ul>
                
                <script type="text/javascript">
                    
                    //
                    $('#firstImage').unbind('click');
                    $('#firstImage').bind('click', function(e){
                        e.preventDefault();
                        $('#firstThumbnail').trigger('click');
                    });
                    
                    //
                    $('#allImages').unbind('click');
                    $('#allImages').bind('click', function(e){
                        e.preventDefault();
                        $('#firstThumbnail').trigger('click');
                    });
                    
                </script>
            </section>
    
            <aside id="similarHomes">
                <p class="head head4"><?=__('text.similarhomes')?></p>
    
                <ul class="block topRated small">
                    <?php $i=0; foreach($aSimilarProperty as $oSimilarProperty): ?>
                        <?php if (!empty($oSimilarProperty)): ?>
                            <?php include_partial('property/propertyItemPhotoSmall', array('left' => true, 'oProperty' => $oSimilarProperty)); ?>
                        <?php endif; ?>
                    <?php $i++; endforeach; ?>
                </ul>
            </aside>
    
            <section class="mt-0px" id="homeDetailSpecs">
            
                <div id="enlargedMap"></div>
    
                <article class="article removableContent" id="articleSpecs">
                    <p class="head head2"><?=__('text.propertyfeatures')?></p>
                    <?/*<div class="expander">*/?>
    
                    <?php if(null!==$oProperty->getDevelopment()):?>
                        <p><?=__('text.propertypartofdevelopment')?>. <a class="bold no-margin" href="<?=MSHTools::getCountryDevelopmentUrl($oProperty->getDevelopment())?>" title="<?=$oProperty->getDevelopment()?>"><?=__('text.seedevelopmentproject')?></a>&nbsp;&raquo;</p>
                    <?php endif;?>
    
                        <table class="specs">
                            <tbody>
                                <?php if($oProperty->getPropertyType() !== NULL):?>
                                <tr>
                                    <th>Type</th>
                                    <td><?=$oProperty->getPropertyType()->getTitle()?></td>
                                </tr>
                                <?php endif;?>
                                <?php if($oProperty->getVolume()):?>
                                <tr>
                                    <th><?=__('text.propertyvolume')?></th>
                                    <td><?=$oProperty->getVolume()?> m<sup>3</sup></td>
                                </tr>
                                <?php endif;?>
                                <?php if($oProperty->getSurface()):?>
                                <tr>
                                    <th><?=__('text.propertysurface')?></th>
                                    <td><?=$oProperty->getSurface()?> m<sup>2</sup></td>
                                </tr>
                                <?php endif;?>
                                <?php if($oProperty->getRooms()):?>
                                <tr>
                                    <th><?=__('text.propertyroomcount')?></th>
                                    <td><?=$oProperty->getRooms()?></td>
                                </tr>
                                <?php endif;?>
                                <?php if($oProperty->getBedrooms()):?>
                                <tr>
                                    <th><?=__('text.propertybedroomscount')?></th>
                                    <td><?=$oProperty->getBedrooms()?></td>
                                </tr>
                                <?php endif;?>
                                <?php if($oProperty->getBathrooms()):?>
                                <tr>
                                    <th><?=__('text.propertybathroomscount')?></th>
                                    <td><?=$oProperty->getBathrooms()?></td>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                        
                        <?php if(
                            null!==$oProperty->getFurnished() &&
                            null!==$oProperty->getConstructionYear() &&
                            null!==$oProperty->getRenovationyear() &&
                            null!==$oProperty->getIsolation() &&
                            null!==$oProperty->getDoubleGlass() && 
                            null!==$oProperty->getInteriorState() &&
                            null!==$oProperty->getExteriorState() &&
                            null!==$oProperty->getWheelchair()
                        ):?>
                        <p class="showHideOnExpand head head3"><?=__('portal.form.condition')?></p>
                        <table class="showHideOnExpand specs">
                            <tbody>
                                <?php if(null!==$oProperty->getFurnished()):?>
                                <tr>
                                    <th><?=__('text.propertyfurnished')?></th>
                                    <td><?=$oProperty->getFurnished() ? __('text.yes') : __('text.no') ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getConstructionYear()):?>
                                <tr>
                                    <th><?=__('text.propertyconstructionyear')?></th>
                                    <td><?=$oProperty->getConstructionYear() ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getRenovationyear()):?>
                                <tr>
                                    <th><?=__('text.propertyrenovationyear')?></th>
                                    <td><?=$oProperty->getRenovationyear() ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getIsolation()):?>
                                <tr>
                                    <th><?=__('text.propertyisolation')?></th>
                                    <td><?=$oProperty->getIsolation() ? __('text.yes') : __('text.no') ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getDoubleGlass()):?>
                                <tr>
                                    <th><?=__('text.propertydoubleglass')?></th>
                                    <td><?=$oProperty->getDoubleGlass() ? __('text.yes') : __('text.no') ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getInteriorState()):?>
                                <tr>
                                    <th><?=__('text.propertyinteriorstate')?></th>
                                    <td><?=__(constant('PROPERTY::OPTION_'.$oProperty->getInteriorState())) ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getExteriorState()):?>
                                <tr>
                                    <th><?=__('text.propertyexteriorstate')?></th>
                                    <td><?=__(constant('PROPERTY::OPTION_'.$oProperty->getExteriorState())) ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getWheelchair()):?>
                                <tr>
                                    <th><?=__('text.propertywheelchair')?></th>
                                    <td><?=$oProperty->getWheelchair() ? __('text.yes') : __('text.no') ?></td>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                        
                        <?php if(
                            sizeof($oProperty->getLinkPropertySurroundings())>0 &&
                            sizeof($oProperty->getLinkPropertyViews())>0 &&
                            null!==$oProperty->getHoreca() &&
                            null!==$oProperty->getAmusement()
                        ):?>
                        <p class="showHideOnExpand head head3"><?=__('portal.form.surroundingsinformation')?></p>
                        <table class="showHideOnExpand specs">
                            <tbody>
                                <?php if(sizeof($oProperty->getLinkPropertySurroundings())>0):?>
                                <tr>
                                    <th><?=__('text.propertysurrounding')?></th>
                                    <td>
                                        <?= $oProperty->getSurroundingsTitles()?>
                                    </td>
                                </tr>
                                <?php endif;?>
                                <?php if(sizeof($oProperty->getLinkPropertyViews())>0):?>
                                <tr>
                                    <th><?=__('text.propertyview')?></th>
                                    <td>
                                        <?= $oProperty->getViewsTitles()?>
                                    </td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getHoreca()):?>
                                <tr>
                                    <th><?=__('text.propertyhoreca')?></th>
                                    <td><?=__(constant('PROPERTY::CHOICE_'.$oProperty->getHoreca())) ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getAmusement()):?>
                                <tr>
                                    <th><?=__('text.propertyentertainment')?></th>
                                    <td><?=__(constant('PROPERTY::CHOICE_'.$oProperty->getAmusement())) ?></td>
                                </tr>
                                <?php endif;?>
    
                            </tbody>
                        </table>
                        <?php endif; ?>
                        
                        <?php if(
                            null!==$oProperty->getTrial() &&
                            null!==$oProperty->getRentingAllowed()
                        ):?>
                        <p class="showHideOnExpand head head3"><?=__('portal.form.rentaldata')?></p>
                        <table class="showHideOnExpand specs">
                            <tbody>
                                <?php if(null!==$oProperty->getTrial()):?>
                                <tr>
                                    <th><?=__('text.propertytrial')?></th>
                                    <td><?=$oProperty->getTrial() ? __('text.yes') : __('text.no') ?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(null!==$oProperty->getRentingAllowed()):?>
                                    <tr>
                                        <th><?=__('text.propertyrentingallowed')?></th>
                                        <td><?=$oProperty->getRentingAllowed() ? __('text.yes') : __('text.no') ?></td>
                                    </tr>
                                    <?php if(0!==intval($oProperty->getMaxRentingPeriod())):?>
                                        <tr>
                                            <th><?=__('text.propertymaxrentingperiod')?></th>
                                            <td><?=$oProperty->getMaxRentingPeriod() ?> <?=__('text.months')?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(0.0 < floatval($oProperty->getRentIndication())):?>
                                        <tr>
                                            <th><?=__('text.propertyrentindication')?></th>
                                            <td>&euro; <?=format_currency_msh($oProperty->getRentIndication()) ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    
                    <?php /*
                    </div>
                    <a class="button down gray raquo" id="_expand" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
                    */ ?>
                </article>
    
                <?php if($oProperty->getLocationLat() != NULL && $oProperty->getLocationLong() != NULL):?>
                <div class="removableContent" id="google_maps">
                    <div class="maps_expander">
                        <div id="map-canvas"></div>
                    </div>
                    <a class="button gray" id="aEnlargeMaps" href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>?box=map" target="_blank" title="<?=__('text.enlargemap')?>"><?=__('text.enlargemap')?></a>
                    <a class="button gray" id="aStreetView" href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>?box=map&mode=streetview" title="<?=__('text.streetview')?>"><?=__('text.streetview')?></a>
                </div>
                <?php endif;?>
    
                <?php include_partial('system/doubleclick'); ?>
    
                <?php if($oProperty->getContent()):?>
                <article class="article removableContent" id="articleDescription">
                    <p class="head head2"><?=__('text.homeDescription')?></p>
                    <div id="expandParent">
                        <div class="expander">
                            <?=$oProperty->getContent(ESC_RAW); ?>
                        </div>
                        <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
                    </div>
                </article>
                <?php endif;?>
    
                <div class="removableContent" id="homeDetailAdvertisement">
                    <img alt="" src="" />
                </div>
    
                <script type="text/javascript">
                
                    <?php
                    /* 
                    //
                    $(function(){
                        $('.showHideOnExpand').css('visibility','hidden');
                    });
                        
                    //
                    $('#_expand').click(function(){
                        
                        $('.showHideOnExpand').css('visibility','hidden');
                    
                        if($('#articleSpecs div.expander').hasClass('open')){
                            $('.showHideOnExpand').css('visibility','hidden');
                        }else{
                            $('.showHideOnExpand').css('visibility','visible');
                        }
                    });
                    
    
                    //
                    var object = { id: 'articleSpecs', speed: 250 };
                    var Article = new Expander(object);
                    Article.Init();
                    */?>
    
                    <?php if($oProperty->getContent()):?>
                    //
                    var object2 = { id: 'articleDescription', speed: 250 };
                    var Article2 = new Expander(object2);
                    Article2.Init();
                    <?php endif;?>
    
                    <?php if($oProperty->getLocationLat() != NULL && $oProperty->getLocationLong() != NULL):?>
                    //
                    var map;
                    function initialize() {
                        var mapOptions = {
                            zoom: 8,
                            center: new google.maps.LatLng(<?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById('map-canvas'),
                            mapOptions);
                        new google.maps.Marker({
    
                            position: new google.maps.LatLng(<?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>),
                            map: map,
                            icon: new google.maps.MarkerImage(
                                'graphics/website/elements/marker/default.png',
                                new google.maps.Size(40, 47),
                                new google.maps.Point(0,0),
                                new google.maps.Point(12, 43)
                            ),
                            zIndex: 1
    
                        });
                    }
                    
                    google.maps.event.addDomListener(window, 'load', initialize);
                    
                    //
                    $('#aEnlargeMaps').unbind('click');
                    $('#aEnlargeMaps').bind('click', function(e){
                        e.preventDefault();
                        
                        //
                        $('.removableContent').fadeOut();
                        
                        //
                        $('#enlargedMap').load($(this).attr('href'), function(){
                            $(this).fadeIn('fast', function() {
                                initializeEnlargedMap(<?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>);
                                initStreetViewButton('#aEnlargedStreetView', <?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>);
                                google.maps.event.trigger(enlargedMap, 'resize');
                            });
                        });
                        
                    });
    
                    initStreetViewButton('#aStreetView',<?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>, true);
                    <?php endif;?>
    
                    /*$('#aStreetView').unbind('click');
                    $('#aStreetView').bind('click', function(e){
                        e.preventDefault();
    
                        //
                        $('.removableContent').fadeOut();
    
                        //
                        $('#enlargedMap').load($(this).attr('href'), function(){
                            $(this).fadeIn('fast', function () {
                                initMapviewButton('#aEnlargedStreetView', <?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>);
                                triggerStreetview(<?=$oProperty->getLocationLat()?>, <?=$oProperty->getLocationLong()?>, 'enlarged-map-canvas');
                            });
                        });
    
                    });*/
    
                </script>
    
            </section>
    
            <section class="article" id="homeDetailContact">
                <form method="POST" action="<?=MSHTools::getCountryPropertyUrl($oProperty)?>">
                    <?=$oForm['_csrf_token']->render()?>
                    <p class="head head2"><?=__('text.contactform')?></p>
    
                    <?php if($oForm->isBound() && $oForm->isValid()): ?>
                        <p>
                            <?=__('text.thanksforcontactingus')?>
                        </p>
                        <script>
                            ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','contact','<?=$oProperty->getSlug()?>');
                        </script>
                    <?php else: ?>
    
                        <p>
                            <?=__('text.contactusdescription')?>
                        </p>
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th>
                                        <label class="ellipsis" for="contact_name"><?=__('form.name')?></label>
                                    </th>
                                    <td>
                                        <?= $oForm['name']->render(array('tabindex' => 1))?><?= $oForm['name']->renderError()?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="ellipsis" for="contact_email_address"><?=__('form.email')?></label>
                                    </th>
                                    <td>
                                        <?= $oForm['email_address']->render(array('tabindex' => 2))?><?= $oForm['email_address']->renderError()?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="ellipsis" for="contact_phonenumber"><?=__('form.phone')?></label>
                                    </th>
                                    <td>
                                        <?= $oForm['phone_number']->render(array('tabindex' => 3))?><?= $oForm['phone_number']->renderError()?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label class="ellipsis" for="contact_message"><?=__('form.contactmessage')?></label>
                                    </th>
                                    <td>
                                        <?= $oForm['content']->render(array('tabindex' => 4))?><?= $oForm['content']->renderError()?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="contact_captcha"><?=__('form.captcha')?></label>
                                    </th>
                                    <td>
                                        <?php echo $oForm['captcha']->render(array('tabindex' => 5)); ?>
                                        <?php if($oForm['captcha']->hasError()) echo $oForm['captcha']->renderError() ?>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <td class="lh-30px">
                                        <input class="button float_right orange raquo" tabindex="6" type="submit" value="<?=__('form.contactsend')?> &raquo;">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <?php if($oForm->hasErrors()):?>
                        <script type="text/javascript">
                            scrollToElement('homeDetailContact');
                        </script>
                        <?php endif;?>
                    <?php endif;?>
                </form>
                <aside>
                    <?php if(null!==$oProperty->getAssociation()): ?>
                        <?php if(null===$oProperty->getAssociation()->getUserRelatedByContact1Id() && null===$oProperty->getAssociation()->getUserRelatedByContact2Id()): ?>
                            <img alt="<?=$oProperty->getAssociation()?>" class="loader big" src="<?=$oProperty->getAssociation()->getImage() !== null ? $oProperty->getAssociation()->getImage()->getFormatUrl(180,120,true) : ''?>" pagespeed_no_transform width="180" height="120"/><br />
                        <?php else :?>
                            <ul>
                                <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact1Id()): ?>
                                    <li title="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>">
                                        <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact1Id()->getImage()): ?>
                                            <img alt="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>" src="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getImage()->getFormatUrl(110,110,true)?>" title="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>" pagespeed_no_transform width="110" height="110"/>
                                        <?php endif;?>
                                        <p>
                                            <strong class="<?php //ellipsis ?>" title="<?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?>"><?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getName()?></strong>
                                            <br /><?=$oProperty->getAssociation()->getUserRelatedByContact1Id()->getAssociationFunction()?>
                                        </p>
                                    </li>
                                <?php endif; ?>
                                <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact2Id()): ?>
                                    <li title="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>">
                                        <?php if(null!==$oProperty->getAssociation()->getUserRelatedByContact2Id()->getImage()): ?>
                                            <img alt="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>" src="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getImage()->getFormatUrl(110,110,true)?>" title="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>" pagespeed_no_transform width="110" height="110"/>
                                        <?php endif;?>
                                        <p>
                                            <strong class="<?php //ellipsis ?>" title="<?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?>"><?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getName()?></strong>
                                            <br /><?=$oProperty->getAssociation()->getUserRelatedByContact2Id()->getAssociationFunction()?>
                                        </p>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                        <p class="head head4"><?=$oProperty->getAssociation()?></p>
                        <?php /* Op verzoek Aders weg gehaald
                        <p>
                            <?=$oProperty->getAssociation()->getAddress1()?><br />
                            <?=$oProperty->getAssociation()->getCity()?><br />
                            <?=$oProperty->getAssociation()->getCountry()->getTitle()?>
                        </p>
                        */ ?>
                        <?php if(MSHTools::getCountryProviderUrl($oProperty->getAssociation())):?>
                            <a class="button blue raquo" href="<?=MSHTools::getCountryProviderUrl($oProperty->getAssociation())?>" title="<?=$oProperty->getAssociation()?>"><?=__('text.seeprovider')?></a>
                        <?php endif;?>
                        <?php if($oProperty->getAssociation()->getPhoneNumber()):?>
                            <a class="button blue raquo fadeHide" onclick="Javascript:return ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','phone','<?=$oProperty->getSlug()?>');" href="javascript:void(0);" alt="<?=$oProperty->getAssociation()->getPhoneNumber()?>" title="<?=__('text.seephonenumber')?>"><?=__('text.seephonenumber')?></a>
                        <?php endif;?>
                        <?php if($oProperty->getAssociation()->getUrl() !== NULL):?>
                            <a class="button blue raquo" onclick="Javascript:return ga('send', 'event', '<?=$oProperty->getAnalyticsCode()?>','website','<?=$oProperty->getSlug()?>');" href="<?=$oProperty->getAssociation()->getUrl()?>" target="_blank" title="<?=__('text.gotowebsite')?>"><?=__('text.gotowebsite')?></a>
                        <?php endif;?>
                    <?php elseif(null!== $oProperty->getUser()): ?>
                    <?php endif; ?>
    
                </aside>
            </section>
    
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
                            if(direction == "left")  slideshow.Slide('next');
                            if(direction == "right") slideshow.Slide('prev');
                            if(direction == "up")    slideshow.ShowThumbnails();
                            if(direction == "down")  slideshow.HideThumbnails();
                        }, threshold: 75
                    });
                });
                
                <?php if($oForm->isBound() && $oForm->isValid()): ?>
                    initNotification('info','<?=__('text.thanksforcontactingus')?>');
                <?php endif; ?>
            </script>
        </div>
    </div>
</section>