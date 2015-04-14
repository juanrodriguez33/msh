<?php
/** @var Development $oDevelopment */
$aInfo = $oDevelopment->getDevelopmentInfo();
?>
<?php include_component('content', 'stepHeader'); ?>
<section class="content white">
    <div class="wrapper">

    <a class="button gray back" href="<?=MSHTools::getCountryDevelopmentsUrl($oDevelopment->getCountry())?>"><?=__('text.backtolist')?></a>

        <section class="article big mb-20px" id="homeDetail">
            <a href="<?=$oDevelopment->getFirstImage() !== null ? $oDevelopment->getFirstImage()->getOriginalFormatUrl() : ''?>" id="firstImage" title="">
                <img alt="<?=$oProvider?>" class="loader big" height="240" width="360" src="<?=$oDevelopment->getFirstImage() !== null ? $oDevelopment->getFirstImage()->getFormatUrl(360,240,true) : ''?>" pagespeed_no_transform />
            </a>
            <div id="homeDetailInformation">
                <h1><?=$oDevelopment->getTitle()?></h1>
                <p class="head head4"><?=$oDevelopment->getCountry()->getTitle()?></p>
                <p>
                    <?=$oDevelopment->getCity()?>, <?=$oDevelopment->getRegion()?>
                </p>
                <p class="price from-to">
                    <span><?=__('text.pricefrom')?>:</span>
                    &euro; <?=format_currency_msh($aInfo['min_price'])?>
                </p>
                <p class="price from-to">
                    <span><?=__('text.priceto')?>:</span>
                    &euro; <?=format_currency_msh($aInfo['max_price'])?>
                </p>
                <?php /** NOT available
                <p>
                    <strong>%built-in%:</strong> 1982<br />
                    <strong>%home-types%:</strong> Lorum ipsum
                </p>
                **/?>
                <?php if(strlen($oDevelopment->getPdfMap()) > 0): ?>
                    <div>
                        <a class="button gray" href="<?=$oDevelopment->getPdfMap()?>" id="aFloorMap" title="<?=__('text.seefloormap')?>"><?=__('text.seefloormap')?></a>
                    </div>
                <?php endif; ?>

            </div>

            <aside>
            
                <?php if(null!==$oDevelopment->getAssociation()): ?>
                    <?php if(null===$oDevelopment->getAssociation()->getUserRelatedByContact1Id() && null===$oDevelopment->getAssociation()->getUserRelatedByContact2Id()): ?>
                        <img alt="<?=$oDevelopment->getAssociation()?>" class="loader big" src="<?=$oDevelopment->getAssociation()->getImage() !== null ? $oDevelopment->getAssociation()->getImage()->getFormatUrl(180,120,true) : ''?>" pagespeed_no_transform /><br />
                    <?php else: ?>
                    <ul>
                        <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact1Id()): ?>
                        <li title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?>">
                            <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getImage()): ?>
                                <img alt="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?>" src="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getImage()->getFormatUrl(110,110,true)?>" title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?>" pagespeed_no_transform />
                            <?php endif;?>
                            <p>
                                <strong class="" title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?>"><?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?></strong>
                                <br /><?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getAssociationFunction()?>
                            </p>
                        </li>
                        <?php endif;?>
                        <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact2Id()): ?>
                        <li title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?>">
                            <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getImage()): ?>
                                <img alt="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?>" src="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getImage()->getFormatUrl(110,110,true)?>" title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?>" pagespeed_no_transform />
                            <?php endif;?>
                            <p>
                                <strong class="" title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?>"><?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?></strong>
                                <br /><?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getAssociationFunction()?>
                            </p>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <?php endif;?>
                <?php endif;?>
            
                <a class="button orange" href="#homeDetailContact" id="aContactUs" title="<?=__('text.contactus')?>">
                    <span><?=__('text.moreinfo')?></span>
                    <span><?=__('text.contactus')?></span>
                </a>
            </aside>

            <ul class="block thumbnails_low">
            <?php $i=0; foreach($oDevelopment->getImages() as $oImage):?>
            <?php if(($i<7 && count($oDevelopment->getImages()) > 8) || count($oDevelopment->getImages()) <= 8): ?>
            <li>
                <a href="<?=$oImage->getOriginalFormatUrl()?>" <?=($i==0?'id="firstThumbnail"':'')?>rel="slideshow">
                    <img alt="<?=$oImage?>" class="loader" height="60" width="90" src="<?=$oImage->getFormatUrl(90,60,true)?>" pagespeed_no_transform />
                </a>
            </li>
            <?php elseif($i==7 && count($oDevelopment->getImages()) > 8):?>
            <li>
                <a class="moreImages" href="" id="allImages" title="<?=__('more-pictures')?>">
                    <div><p><?=__('more-pictures')?></p></div>
                </a>
            </li>
            <li style="display: none;">
                <a href="<?=$oImage->getOriginalFormatUrl()?>" <?=($i==0?'id="firstThumbnail"':'')?>rel="slideshow">
                    <img alt="<?=$oImage?>" class="loader" height="60" width="90" src="<?=$oImage->getFormatUrl(90,60,true)?>" pagespeed_no_transform />
                </a>
            </li>
            <?php else: ?>
            <li style="display: none;">
                <a href="<?=$oImage->getOriginalFormatUrl()?>" <?=($i==0?'id="firstThumbnail"':'')?>rel="slideshow">
                    <img alt="<?=$oImage?>" class="loader" height="60" width="90" src="<?=$oImage->getFormatUrl(90,60,true)?>" pagespeed_no_transform />
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

        <section class="full projectDetail">

            <?php   if( $oDevelopment->getUsp1() != NULL || 
                        $oDevelopment->getUsp2() != NULL || 
                        $oDevelopment->getUsp3() != NULL || 
                        $oDevelopment->getUsp4() != NULL || 
                        $oDevelopment->getUsp5() ):?>
            <aside class="article" id="uniqueSellingPoint">
                <p class="head head2"><?=__('text.uniquesellingpoints')?></p>
                <ul>
                    <?=strlen($oDevelopment->getUsp1()) > 0 ? '<li class="ellipsis">' . $oDevelopment->getUsp1() . '</li>' : '' ?>
                    <?=strlen($oDevelopment->getUsp2()) > 0 ? '<li class="ellipsis">' . $oDevelopment->getUsp2() . '</li>' : '' ?>
                    <?=strlen($oDevelopment->getUsp3()) > 0 ? '<li class="ellipsis">' . $oDevelopment->getUsp3() . '</li>' : '' ?>
                    <?=strlen($oDevelopment->getUsp4()) > 0 ? '<li class="ellipsis">' . $oDevelopment->getUsp4() . '</li>' : '' ?>
                    <?=strlen($oDevelopment->getUsp5()) > 0 ? '<li class="ellipsis">' . $oDevelopment->getUsp5() . '</li>' : '' ?>
                </ul>
            </aside>
            <?php else:?>
                <?php $bNoMargin = true; ?>
            <?php endif;?>

            <?php include_partial('system/doubleclick'); ?>

            <?php if($oDevelopment->hasYoutube()): ?>
                <object width="340" height="220" style="<?=(isset($bNoMargin)?'margin-top:0':'')?>">
                  <param name="movie" value="<?=$oDevelopment->getYoutube()?>">
                  <param name="allowScriptAccess" value="always">
                  <embed src="<?=$oDevelopment->getYoutube()?>" type="application/x-shockwave-flash" allowscriptaccess="always" width="340" height="220">
                </object>
            <?php endif; ?>

            <?php if($oDevelopment->getContent()):?>
            <article class="article <?=($oDevelopment->getSurroundings()?'small':'')?>" id="projectDetailDescription">
                <h2><?=__('text.projectDescription')?></h2>
                <div class="expander" id="projectDetailDescriptionExpander">
                    <?=$oDevelopment->getContent(ESC_RAW)?>
                </div>
                <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
            </article>
            
            <?php if($oDevelopment->getSurroundings()):?>
            <article class="article" id="projectDetailSurroundings">
                <h2><?=__('text.projectSurroundings')?></h2>
                <div class="expander" id="projectDetailSurroundingsExpander">
                    <?=$oDevelopment->getSurroundings(ESC_RAW)?>
                </div>
                <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
            </article>
            <?php endif;?>

            <script type="text/javascript">

                //
                var object = { id: 'projectDetailDescription', speed: 250 };
                var Article = new Expander(object);
                Article.Init();
                
                //
                var object2 = { id: 'projectDetailSurroundings', speed: 250 };
                var Article2 = new Expander(object2);
                Article2.Init();

            </script>
            <?php endif; ?>

        </section>
        
        <?php if($oDevelopment->getSurroundings() && sfConfig::get('app_development_surroundings_enabled') === true): ?>
        <section class="full" id="surroundingBlock">
        
            <div id="enlargedMap">Hier de vergrote versie van Google maps</div>
        
            <article class="article removableContent" id="surroundingBlockArticle">
                <h2><?=__('text.projectSurroundings')?></h2>
                <div class="expander" id="surroundingBlockArticleExpander">
                    <?=$oDevelopment->getSurroundings(ESC_RAW)?>
                </div>
                <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
            </article>
            
            <div class="removableContent" id="google_maps">
                <div class="maps_expander">
                    <div id="map-canvas"></div>
                </div>
                <a class="button gray" id="aEnlargeMaps" href="?box=map" target="_blank" title="<?=__('text.enlargemap')?>"><?=__('text.enlargemap')?></a>
                <a class="button gray" id="aStreetView" href="?box=map&mode=streetview" title="<?=__('text.streetview')?>"><?=__('text.streetview')?></a>
            </div>
            
            <script type="text/javascript">

                //
                var object2 = { id: 'surroundingBlockArticle', speed: 250 };
                var Article2 = new Expander(object2);
                Article2.Init();
                
                <?php if($oDevelopment->getLocationLat() != NULL && $oDevelopment->getLocationLong() != NULL):?>
                //
                var map;
                function initialize() {
                    var mapOptions = {
                        zoom: 8,
                        center: new google.maps.LatLng(<?=$oDevelopment->getLocationLat()?>, <?=$oDevelopment->getLocationLong()?>),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    map = new google.maps.Map(document.getElementById('map-canvas'),
                        mapOptions);
                    new google.maps.Marker({

                        position: new google.maps.LatLng(<?=$oDevelopment->getLocationLat()?>, <?=$oDevelopment->getLocationLong()?>),
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
                            initializeEnlargedMap(<?=$oDevelopment->getLocationLat()?>, <?=$oDevelopment->getLocationLong()?>);
                            initStreetViewButton('#aEnlargedStreetView', <?=$oDevelopment->getLocationLat()?>, <?=$oDevelopment->getLocationLong()?>);
                            google.maps.event.trigger(enlargedMap, 'resize');
                        });
                    });
                    
                });

                initStreetViewButton('#aStreetView',<?=$oDevelopment->getLocationLat()?>, <?=$oDevelopment->getLocationLong()?>, true);
                <?php endif;?>

            </script>
        </section>
        <?php endif;?>

        <section id="homesInProject" style="width: 100%;">
            <p class="head head1"><?=__('text.propertiesofdevelopmentin')?> <?=$oDevelopment->getTitle()?></p>
            <ul class="block topRated big">
                <?php $i=0; foreach($aProperty as $oProperty): ?>
                    <?php include_partial('propertyItemPhoto', array('left' => $i%4==0, 'oProperty' => $oProperty)); ?>
                <?php $i++; endforeach; ?>

            </ul>
            <sup>
                <?=__('text.totalofferfordevelopment')?> <?=$oDevelopment?> <?=__('text.is')?> <strong><?=$iCountProperty?> <?=__('text.properties')?></strong>
                <a href="<?=MSHTools::getCountryPropertiesUrl($sf_user->getCountry())?>?development=<?=$oDevelopment->getId()?>" class="button orange raquo">
                    <?=__('text.seeallproperties')?>
                </a>
            </sup>
    </section>

        <section class="article mt-0px" id="homeDetailContact">
            <form method="POST" action="<?=MSHTools::getCountryDevelopmentUrl($oDevelopment)?>">
                <?=$oForm['_csrf_token']->render()?>
                <p class="head head2"><?=__('text.contactform')?></p>

                <?php if($oForm->isBound() && $oForm->isValid()): ?>
                    <p>
                        <?=__('text.thanksforcontactingus')?>
                    </p>
                    <script>
                        ga('send', 'event', '<?=$oDevelopment->getAnalyticsCode()?>','contact','<?=$oDevelopment->getSlug()?>');
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
                                    <label for="contact_request_captcha"><?=__('form.captcha')?></label>
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
            <?php if(null!==$oDevelopment->getAssociation()):?>
            <aside>
            <?php if(null!==$oDevelopment->getAssociation()): ?>
                    <?php if(null===$oDevelopment->getAssociation()->getUserRelatedByContact1Id() && null===$oDevelopment->getAssociation()->getUserRelatedByContact2Id()): ?>
                        <img alt="<?=$oDevelopment->getAssociation()?>" class="loader big" src="<?=$oDevelopment->getAssociation()->getImage() !== null ? $oDevelopment->getAssociation()->getImage()->getFormatUrl(180,120,true) : ''?>" pagespeed_no_transform /><br />
                    <?php else :?>
                        <ul>
                        <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact1Id()): ?>
                            <li title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?>">
                                <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getImage()): ?>
                                    <img alt="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?>" height="110" width="110" src="<?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getImage()->getFormatUrl(110,110,true)?>" pagespeed_no_transform />
                                <?php endif;?>
                                <p>
                                    <strong class=""><?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getName()?></strong>
                                    <br /><?=$oDevelopment->getAssociation()->getUserRelatedByContact1Id()->getAssociationFunction()?>
                                </p>
                            </li>
                        <?php endif; ?>
                        <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact2Id()): ?>
                            <li title="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?>">
                                <?php if(null!==$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getImage()): ?>
                                    <img alt="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?>" height="110" width="110" src="<?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getImage()->getFormatUrl(110,110,true)?>" pagespeed_no_transform />
                                <?php endif;?>
                                <p>
                                    <strong class=""><?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getName()?></strong>
                                    <br /><?=$oDevelopment->getAssociation()->getUserRelatedByContact2Id()->getAssociationFunction()?>
                                </p>
                            </li>
                        <?php endif; ?>
                        </ul>
                    <?php endif;?>
                <?php endif;?>
                <p class="head head4">
                    <?=$oDevelopment->getAssociation()?>
                </p>
                <p>
                    <?=$oDevelopment->getAssociation()->getAddress1()?><br />
                    <?=$oDevelopment->getAssociation()->getCity()?><br />
                    <?=$oDevelopment->getAssociation()->getCountry()->getTitle()?>
                </p>
                <a class="button blue raquo" href="<?=MSHTools::getCountryProviderUrl($oDevelopment->getAssociation())?>" title="<?=$oDevelopment->getAssociation()?>"><?=__('text.seeprovider')?></a>
                <a class="button blue raquo fadeHide" onclick="Javascript:return ga('send', 'event', '<?=$oDevelopment->getAnalyticsCode()?>','phone','<?=$oDevelopment->getSlug()?>');" href="javascript:void(0);" alt="<?=$oDevelopment->getAssociation()->getPhoneNumber()?>" title="<?=__('text.seephonenumber')?>"><?=__('text.seephonenumber')?></a>
            </aside>
            <?php endif; ?>
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
        </script>

    </div>
</section>