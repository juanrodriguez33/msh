<?php/** @var Association $oProvider **/ ?>

<?php include_component('content', 'stepHeader'); ?>

    <section class="content white"> 
        <div class="wrapper">
            
            <a class="button gray back" href="<?=MSHTools::getCountryProvidersUrl($sf_user->getCountry())?>"><?=__('text.backtolist')?></a>
        
            <section class="article big mb-20px" id="homeDetail">
                <a href="<?=$oProvider->getImage() !== null ? $oProvider->getImage()->getOriginalFormatUrl() : ''?>" rel="slideshow" title="">
                    <img alt="<?=$oProvider?>" class="loader big" height="240" width="360" src="<?=$oProvider->getImage() !== null ? $oProvider->getImage()->getFormatUrl(360,240,true) : ''?>" pagespeed_no_transform />
                </a>
                <div class="slider" id="homeDetailInformation" itemprop="review" itemscope itemtype="http://schema.org/Review">
                    <h1 itemprop="name"><?=$oProvider?></h1>
                    <?php if ($oProvider->getCountry() != null):?>
                        <p class="head head4"><?=$oProvider->getCountry()->getTitle()?></p>
                    <?php endif;?>
                    <p itemprop="description">
                        <?=$oProvider->getAddress1()?><br />
                        <?=$oProvider->getAddress2()?><br />
                        <?=$oProvider->getCity()?><br />
                        <?=$oProvider->getRegion()?>
                    </p>
                    <?php if($oProvider->getFounded()): ?>
                    <p>
                        <?=__('text.provideractivefrom')?>: <?=format_date($oProvider->getFounded(), 'dd-MM-yyyy')?>
                    </p>
                    <?php endif; ?>
                    
                    <div>
                        <?php //if(sfConfig::get('app_provider_appreciate_enabled') === true):?>
                        <a class="button gray" href="Javascript:void(0);" id="aAppreciation" title="<?=__('text.appreciation')?>"><?=__('text.appreciation')?></a>
                        <?php //endif;?>
                    </div>
                    
                </div>
                
                <aside class="slider" status="off">
                    <div>
                        <div>
                            <ul class="provider">
                                <?php if(null!==$oProvider->getUserRelatedByContact1Id()): ?>
                                    <li title="<?=$oProvider->getUserRelatedByContact1Id()->getName()?>">
                                        <?php if(null!==$oProvider->getUserRelatedByContact1Id()->getImage()): ?>
                                            <img alt="<?=$oProvider->getUserRelatedByContact1Id()->getName()?>" height="90" width="90" src="<?=$oProvider->getUserRelatedByContact1Id()->getImage()->getFormatUrl(90,90,true)?>" pagespeed_no_transform />
                                        <?php endif;?>
                                        <p>
                                            <strong class=""><?=$oProvider->getUserRelatedByContact1Id()->getName()?></strong>
                                            <br /><?=$oProvider->getUserRelatedByContact1Id()->getAssociationFunction()?>
                                        </p>
                                    </li>
                                <?php endif; ?>
                                <?php if(null!==$oProvider->getUserRelatedByContact2Id()): ?>
                                    <li title="<?=$oProvider->getUserRelatedByContact2Id()->getName()?>">
                                        <?php if(null!==$oProvider->getUserRelatedByContact2Id()->getImage()): ?>
                                            <img alt="<?=$oProvider->getUserRelatedByContact2Id()->getName()?>" height="90" width="90" src="<?=$oProvider->getUserRelatedByContact2Id()->getImage()->getFormatUrl(90,90,true)?>" pagespeed_no_transform />
                                        <?php endif;?>
                                        <p>
                                            <strong class=""><?=$oProvider->getUserRelatedByContact2Id()->getName()?></strong>
                                            <br /><?=$oProvider->getUserRelatedByContact2Id()->getAssociationFunction()?>
                                        </p>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <a class="button orange" href="#homeDetailContact" id="aContactUs" title="<?=__('text.contactus')?>">
                                <span><?=__('text.moreinfo')?></span>
                                <span><?=__('text.contactus')?></span>
                            </a>
                        </div>
                        <div id="divProviderAppreciation">
                            <?php include_component('property','providerAppreciation'); ?>
                        </div>
                    </div>
                </aside>
                
            </section>
    
            <section class="full projectDetail">
            
            <?php $bAppreciation = false;?>
            <?php $aAppreciation = $oProvider->getAppreciationScores(); ?>
            
            <?php if($aAppreciation['cnt'] >= sfConfig::get('app_appreciation_min')):?>
                <?php $bAppreciation = true; ?>
                <aside class="article" id="appreciationDetailBlock">
                    <p title="<?=__('text.appreciation.country_knowledge')?>">
                        <strong><?=__('text.appreciation.country_knowledge')?>:</strong>
                    </p>                        
                    <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="1" />
                        <meta itemprop="bestRating" content="5" />
                        <span class="<?=($aAppreciation['country']>=1 ? 'highlite' : '' )?>" <?=($aAppreciation['country']==1?'itemprop="ratingValue"':'')?>>1</span>
                        <span class="<?=($aAppreciation['country']>=2 ? 'highlite' : '' )?>" <?=($aAppreciation['country']==2?'itemprop="ratingValue"':'')?>>2</span>
                        <span class="<?=($aAppreciation['country']>=3 ? 'highlite' : '' )?>" <?=($aAppreciation['country']==3?'itemprop="ratingValue"':'')?>>3</span>
                        <span class="<?=($aAppreciation['country']>=4 ? 'highlite' : '' )?>" <?=($aAppreciation['country']==4?'itemprop="ratingValue"':'')?>>4</span>
                        <span class="<?=($aAppreciation['country']>=5 ? 'highlite' : '' )?>" <?=($aAppreciation['country']==5?'itemprop="ratingValue"':'')?>>5</span>
                    </div>

                    <p title="<?=__('text.appreciation.communication')?>">
                        <strong><?=__('text.appreciation.communication')?>:</strong>
                    </p>
                    <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="1" />
                        <meta itemprop="bestRating" content="5" />
                        <span class="<?=($aAppreciation['communication']>=1 ? 'highlite' : '' )?>" <?=($aAppreciation['communication']==1?'itemprop="ratingValue"':'')?>>1</span>
                        <span class="<?=($aAppreciation['communication']>=2 ? 'highlite' : '' )?>" <?=($aAppreciation['communication']==2?'itemprop="ratingValue"':'')?>>2</span>
                        <span class="<?=($aAppreciation['communication']>=3 ? 'highlite' : '' )?>" <?=($aAppreciation['communication']==3?'itemprop="ratingValue"':'')?>>3</span>
                        <span class="<?=($aAppreciation['communication']>=4 ? 'highlite' : '' )?>" <?=($aAppreciation['communication']==4?'itemprop="ratingValue"':'')?>>4</span>
                        <span class="<?=($aAppreciation['communication']>=5 ? 'highlite' : '' )?>" <?=($aAppreciation['communication']==5?'itemprop="ratingValue"':'')?>>5</span>
                    </div>

                    <p title="<?=__('text.appreciation.financial_knowledge')?>">
                        <strong><?=__('text.appreciation.financial_knowledge')?>:</strong>
                    </p>
                    <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="1" />
                        <meta itemprop="bestRating" content="5" />
                        <span class="<?=($aAppreciation['financial']>=1 ? 'highlite' : '' )?>" <?=($aAppreciation['financial']==1?'itemprop="ratingValue"':'')?>>1</span>
                        <span class="<?=($aAppreciation['financial']>=2 ? 'highlite' : '' )?>" <?=($aAppreciation['financial']==2?'itemprop="ratingValue"':'')?>>2</span>
                        <span class="<?=($aAppreciation['financial']>=3 ? 'highlite' : '' )?>" <?=($aAppreciation['financial']==3?'itemprop="ratingValue"':'')?>>3</span>
                        <span class="<?=($aAppreciation['financial']>=4 ? 'highlite' : '' )?>" <?=($aAppreciation['financial']==4?'itemprop="ratingValue"':'')?>>4</span>
                        <span class="<?=($aAppreciation['financial']>=5 ? 'highlite' : '' )?>" <?=($aAppreciation['financial']==5?'itemprop="ratingValue"':'')?>>5</span>
                    </div>

                    <p title="<?=__('text.appreciation.guidance')?>">
                        <strong><?=__('text.appreciation.guidance')?>:</strong>
                    </p>
                    <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <meta itemprop="worstRating" content="1" />
                        <meta itemprop="bestRating" content="5" />
                        <span class="<?=($aAppreciation['guidance']>=1 ? 'highlite' : '' )?>" <?=($aAppreciation['guidance']==1?'itemprop="ratingValue"':'')?>>1</span>
                        <span class="<?=($aAppreciation['guidance']>=2 ? 'highlite' : '' )?>" <?=($aAppreciation['guidance']==2?'itemprop="ratingValue"':'')?>>2</span>
                        <span class="<?=($aAppreciation['guidance']>=3 ? 'highlite' : '' )?>" <?=($aAppreciation['guidance']==3?'itemprop="ratingValue"':'')?>>3</span>
                        <span class="<?=($aAppreciation['guidance']>=4 ? 'highlite' : '' )?>" <?=($aAppreciation['guidance']==4?'itemprop="ratingValue"':'')?>>4</span>
                        <span class="<?=($aAppreciation['guidance']>=5 ? 'highlite' : '' )?>" <?=($aAppreciation['guidance']==5?'itemprop="ratingValue"':'')?>>5</span>
                    </div>
                </aside>
                <?php endif; ?>
                
                <?php if(   $oProvider->getUsp1() != NULL ||
                            $oProvider->getUsp2() != NULL ||
                            $oProvider->getUsp3() != NULL ||
                            $oProvider->getUsp4() != NULL ||
                            $oProvider->getUsp5() != NULL
                         ):?>
                <aside class="article" id="uniqueSellingPoint">
                    <p class="head head2"><?=__('text.uniquesellingpoints')?></p>
                    <ul>
                        <?=strlen($oProvider->getUsp1()) >0 ? '<li class="ellipsis">' . $oProvider->getUsp1() . '</li>' : '' ?>
                        <?=strlen($oProvider->getUsp2()) >0 ? '<li class="ellipsis">' . $oProvider->getUsp2() . '</li>' : '' ?>
                        <?=strlen($oProvider->getUsp3()) >0 ? '<li class="ellipsis">' . $oProvider->getUsp3() . '</li>' : '' ?>
                        <?=strlen($oProvider->getUsp4()) >0 ? '<li class="ellipsis">' . $oProvider->getUsp4() . '</li>' : '' ?>
                        <?=strlen($oProvider->getUsp5()) >0 ? '<li class="ellipsis">' . $oProvider->getUsp5() . '</li>' : '' ?>
                    </ul>
                </aside>
                <?php endif; ?>

                <?php include_partial('system/doubleclick'); ?>
                
                <?php if($oProvider->hasYoutube()): ?>
                    <object width="340" height="220">
                      <param name="movie" value="<?=$oProvider->getYoutube()?>">
                      <param name="allowScriptAccess" value="always">
                      <embed src="<?=$oProvider->getYoutube()?>" type="application/x-shockwave-flash" allowscriptaccess="always" width="340" height="220">
                    </object>
                <?php endif; ?>

                <?php if($oProvider->getContent()):?>
                <article class="article <?=($bAppreciation?'larger':'')?>" id="projectDetailDescription">
                    <h2><?=__('text.providerDescription')?></h2>
                    <div class="expander" id="projectDetailDescriptionExpander">
                        <?=$oProvider->getContent(ESC_RAW)?>
                    </div>
                    <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
                </article>
                                    
                <script type="text/javascript">var object={id:'projectDetailDescription',speed:250};var Article=new Expander(object);Article.Init();</script>
                <?php endif;?>
                
            </section>

            <section id="homesInProject">
                    <p class="head head1"><?=__('text.propertiesofproviderin')?> <?=$sf_user->getCountry()->getTitle()?></p>
                    <ul class="block topRated big">
                        <?php $i=0; foreach($aProperty as $oProperty): ?>
                            <?php include_partial('propertyItemPhoto', array('left' => $i%4==0, 'oProperty' => $oProperty)); ?>
                        <?php $i++; endforeach; ?>

                    </ul>
            </section>
            
            <sup>
                <?=__('text.totalofferforprovider')?> <?=$oProvider?> <?=__('text.in')?> <?=$sf_user->getCountry()->getTitle()?> <?=__('text.is')?> <strong><?=$iCountProperty?> <?=__('text.properties')?></strong>
                <a href="<?=MSHTools::getCountryPropertiesUrl($sf_user->getCountry())?>?provider=<?=$oProvider->getId()?>" class="button orange raquo">
                    <?=__('text.seeallproperties')?>
                </a>
            </sup>
            
            <section class="article" id="homeDetailContact">
                <form method="POST" action="<?=MSHTools::getCountryProviderUrl($oProvider)?>">
                    <?=$oForm['_csrf_token']->render()?>
                    <p class="head head2"><?=__('text.contactform')?></p>

                    <?php if($oForm->isBound() && $oForm->isValid()): ?>
                        <p>
                            <?=__('text.thanksforcontactingus')?>
                        </p>
                        <script>
                            ga('send', 'event', '<?=$oProvider->getAnalyticsCode()?>','contact','<?=$oProvider->getSlug()?>');
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
                <aside>
                    <?php if(null===$oProvider->getUserRelatedByContact1Id() && null===$oProvider->getUserRelatedByContact2Id()): ?>
                        <img alt="<?=$oProvider?>" class="loader big" src="<?=$oProvider->getImage() !== null ? $oProvider->getImage()->getFormatUrl(180,120,true) : ''?>" pagespeed_no_transform /><br />
                    <?php else :?>
                    <ul>
                        <?php if(null!==$oProvider->getUserRelatedByContact1Id()): ?>
                            <li title="<?=$oProvider->getUserRelatedByContact1Id()->getName()?>">
                                <?php if(null!==$oProvider->getUserRelatedByContact1Id()->getImage()): ?>
                                    <img alt="<?=$oProvider->getUserRelatedByContact1Id()->getName()?>" height="110" width="110" src="<?=$oProvider->getUserRelatedByContact1Id()->getImage()->getFormatUrl(110,110, true)?>" pagespeed_no_transform />
                                <?php endif;?>
                                <p>
                                    <strong class=""><?=$oProvider->getUserRelatedByContact1Id()->getName()?></strong>
                                    <br /><?=$oProvider->getUserRelatedByContact1Id()->getAssociationFunction()?>
                                </p>
                            </li>
                        <?php endif; ?>
                        <?php if(null!==$oProvider->getUserRelatedByContact2Id()): ?>
                            <li title="<?=$oProvider->getUserRelatedByContact2Id()->getName()?>">
                                <?php if(null!==$oProvider->getUserRelatedByContact2Id()->getImage()): ?>
                                    <img alt="<?=$oProvider->getUserRelatedByContact2Id()->getName()?>" height="110" width="110" src="<?=$oProvider->getUserRelatedByContact2Id()->getImage()->getFormatUrl(110,110, true)?>" pagespeed_no_transform />
                                <?php endif;?>
                                <p>
                                    <strong class=""><?=$oProvider->getUserRelatedByContact2Id()->getName()?></strong>
                                    <br /><?=$oProvider->getUserRelatedByContact2Id()->getAssociationFunction()?>
                                </p>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <?php endif;?>
                    
                    <p class="head head4"><?=$oProvider->getTitle()?></p>
                    <p>
                        <?=$oProvider->getAddress1()?><br />
                        <?=$oProvider->getCity()?><br />
                        <?php if ($oProvider->getCountry() != null):?>
                            <?=$oProvider->getCountry()->getTitle()?>
                        <?php endif;?>    
                    </p>
                    <?php if($oProvider->getPhoneNumber()):?>
                        <a class="button blue raquo fadeHide" onclick="Javascript:return ga('send', 'event', '<?=$oProvider->getAnalyticsCode()?>','phone','<?=$oProvider->getSlug()?>');" href="javascript:void(0);" alt="<?=$oProvider->getPhoneNumber()?>" title="<?=__('text.seephonenumber')?>"><?=__('text.seephonenumber')?></a>
                    <?php endif;?>
                    <?php if($oProvider->getUrl() !== NULL):?>
                        <a class="button blue raquo" onclick="Javascript:return ga('send', 'event', '<?=$oProvider->getAnalyticsCode()?>','website','<?=$oProvider->getSlug()?>');" href="<?=$oProvider->getUrl()?>" target="_blank" title="<?=__('text.gotowebsite')?>"><?=__('text.gotowebsite')?></a>
                    <?php endif;?>

                </aside>
            </section>
            
            <script type="text/javascript">var slideshow=new Slideshow();var object={navigation:true,thumbnails:true,thumbnails_hidden:true};slideshow.Init(object);$(function(){$('#div_slideshow').swipe({swipe:function(event,direction,distance,duration,fingerCount){if(direction=="left")slideshow.Slide('next');if(direction=="right")slideshow.Slide('prev');if(direction=="up")slideshow.ShowThumbnails();if(direction=="down")slideshow.HideThumbnails();},threshold:75});});</script>
            
        </div>
    </section>
