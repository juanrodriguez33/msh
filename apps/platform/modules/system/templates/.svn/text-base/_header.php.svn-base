<?php

/** @var Category $oCat */
/** @var Page $oContent */
/** @var myUser $sf_user */

$iPhase = $sf_user->getPhase();
?>
            <header id="header">

                <noscript>
                    <p><?=__('noscriptwarning')?></p>
                </noscript>

                <div class="wrapper">
                    
                    <a id="a_logo" href="<?=url_for('homepage')?>" title="My Second Home">
                        <img alt="My Second Home Logo"  width="270" height="106" src="./graphics/website/logo.png" pagespeed_no_transform />
                    </a>

                    <?php if(!$sf_user->isAuthenticated()){ ?>
						<?php if ($sf_user->getCulture() == 'fr'): ?>
							<a class="button blue" href="<?=url_for('portal_registration')?>" title="<?=__('menu.sell-your-home')?>">							
								<?=__('menu.sell-your-home')?>							
							</a>
						<?php else: ?>
							<a class="button blue" href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.contact'))))?>" title="<?=__('menu.sell-your-home')?>">							
								<?=__('menu.sell-your-home')?>							
							</a>
						<?php endif;?>
                    <?php } else {?>
                        <a class="button blue" href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.logout'))))?>" title="<?=__('menu.logout')?>">
                            <?=__('menu.logout')?>
                        </a>
                    <?php }?>
                    
                    <nav id="sideMenu">
                        <ul>
                            <?php if(!$sf_user->isAuthenticated()): ?>
                            <li class="home active">
                                <a href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.login'))))?>" title="<?=__('menu.sign-in')?>">
                                    <?=__('menu.sign-in')?>
                                </a>
                            </li>
                            <?php else: ?>
                                <?php if(get_slot('is_portal')): ?>
                                    <li class="home">
                                        <a href="<?=url_for('homepage')?>" title="<?=__('portal.menu.website')?>">
                                            <?=__('portal.menu.website')?>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="<?=url_for('portal_overview')?>" title="<?=__('portal.menu.overview')?>">
                                            <?=__('portal.menu.overview')?>
                                        </a>
                                    </li>
                                <?php endif;?>
                            <?php endif; ?>
                            <li>
                                <a title="<?=__('menu.follow-us')?>">
                                    <?=__('menu.follow-us')?>
                                    <div class="dropdown">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </a>
                                <nav>
                                    <ul>
                                        <?php if(sfConfig::get('app_socialmedia_facebook_url')):?>
                                        <li>
                                            <a href="<?=sfConfig::get('app_socialmedia_facebook_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Facebook">
                                                Facebook
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(sfConfig::get('app_socialmedia_googleplus_url')):?>
                                        <li>
                                            <a href="<?=sfConfig::get('app_socialmedia_googleplus_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Google">
                                                Google+
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(sfConfig::get('app_socialmedia_twitter_url')):?>
                                        <li>
                                            <a href="<?=sfConfig::get('app_socialmedia_twitter_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Twitter">
                                                Twitter
                                            </a>
                                        </li>
                                        <?php endif;?>
                                        <?php if(sfConfig::get('app_socialmedia_pinterest_url')):?>
                                        <li>
                                            <a href="<?=sfConfig::get('app_socialmedia_pinterest_url')?>" rel="external nofollow" target="_blank" title="<?=__('followuson');?> Pinterest">
                                                Pinterest
                                            </a>
                                        </li>
                                        <?php endif;?>
                                    </ul>
                                </nav>
                            </li>
                            <?php  if(sfConfig::get('app_languages_enabled') === true):?>
                            <li>
                                <a title="<?=__('menu.languages')?>">
                                    <?=__('menu.languages')?>
                                    <div class="dropdown">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </a>
                                <nav>
                                    <ul>
                                        <li>
                                            <a title="<?=format_language($sf_user->getCulture())?>"><?=format_language($sf_user->getCulture())?></a>
                                        </li>
                                        <?php foreach($aLanguage as $oLang): if($oLang->getCulture() == $sf_user->getCulture()) continue;?>
                                            <li>
                                                <a class="hiddenLink" data-link="http://<?php echo $oLang->getDomain()?>" title="<?=format_language($oLang->getCulture())?>"><?=format_language($oLang->getCulture(), $oLang->getCulture())?></a>
                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </nav>
                            </li>
                            <?php endif; ?>
                            <?php if(!get_slot('is_portal', false)): ?>
                                <li class="last">
                                    <a id="scrollToNewsletter" href="#subscribe" title="<?=__('menu.newsletter')?>">
                                        <?=__('menu.newsletter')?>
                                    </a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </nav>
                    
                    <nav class="no-js" id="mainMenu">
                        <ul>
                        <?php if(get_slot('is_portal', false)) { ?>
                            <li class="home <?=(get_slot('menu_portal',false) == 'portal' ? 'current' : '' )?>">
                                <a href="<?=url_for('portal_overview')?>" title="<?=__('title.portaloverview')?>">
                                    <?=__('title.portaloverview')?>
                                </a>
                            </li>
                            <li class="no-sub <?=(get_slot('menu_portal',false) == 'properties' ? 'current' : '' )?>">
                                <a href="<?=url_for('portal_properties')?>" title="<?=__('portal.menu.properties')?>">
                                    <?=__('portal.menu.properties')?>
                                </a>
                            </li>
                            <?php if($sf_user->hasCredential('ROLE_ASSOCIATION')): ?>
                            <li class="no-sub <?=(get_slot('menu_portal',false) == 'developments' ? 'current' : '' )?>">
                                <a href="<?=url_for('portal_developments')?>" title="<?=__('portal.menu.developments')?>">
                                    <?=__('portal.menu.developments')?>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="no-sub <?=(get_slot('menu_portal',false) == 'conversions' ? 'current' : '' )?>">
                                <?php if(sfConfig::get('app_conversions_notification') === true): ?>
                                    <span class="new"><?=get_slot('portal.new-conversions')?></span>
                                <?php endif; ?>
                                <a href="<?=url_for('portal_conversions')?>" title="<?=__('portal.menu.conversions')?>">
                                    <?=__('portal.menu.conversions')?>
                                </a>
                            </li>
                            <?php if(sfConfig::get('app_statistics_enabled') === true): ?>
                            <li class="no-sub <?=(get_slot('menu_portal',false) == 'statistics' ? 'current' : '' )?>">
                                <a href="<?=url_for('portal_statistics')?>" title="<?=__('portal.menu.statistics')?>">
                                    <?=__('portal.menu.statistics')?>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($sf_user->hasCredential('ROLE_ASSOCIATION')): ?>
                            <li class="no-sub last <?=(get_slot('menu_portal',false) == 'profile' ? 'current' : '' )?>">
                                <a href="<?=url_for('portal_profile')?>" title="<?=__('portal.menu.portal_profile')?>">
                                    <?=__('portal.menu.portal_profile')?>
                                </a>
                            </li>
                            <?php endif;?>
                            <?php if($sf_user->hasCredential('ROLE_CONSUMER')): ?>
                                <li class="no-sub last <?=(get_slot('menu_portal',false) == 'profile' ? 'current' : '' )?>">
                                    <a href="<?=url_for('portal_profile_consumer')?>" title="<?=__('portal.menu.portal_profile')?>">
                                        <?=__('portal.menu.portal_profile')?>
                                    </a>
                                </li>
                            <?php endif;?>
                        <?php } else { ?>
                            <li class="home <?=(get_slot('is_homepage',false) ? 'current' : '' )?>">
                                <a href="<?=url_for('homepage')?>" title="<?=__('menu.homepage')?>">
                                    <?=__('menu.homepage')?>
                                </a>                          
                            </li>
                            
                            <li class="<?=(!(get_slot('is_homepage',false)) && $sf_user->getPhase() == 0 ? 'current' : '' )?>">
                                <a href="<?=MSHTools::getPhaseUrl(0)?>" title="<?=__('phase.orient')?>">
                                    &nbsp;&nbsp;<?=__('phase.orient')?>
                                </a>
                                <nav>
                                    <?php foreach($aCategoryOrient as $oCat){ ?>
                                    <div>
                                        <p class="head head3">
                                            <a href="<?=MSHTools::getSubjectUrl($oCat->getSlug(),0)?>" title="<?=$oCat?>"><?=$oCat?></a>
                                        </p>
                                        <ul class="li-gt">
                                            <?php $a=0; foreach($oCat->getRecentUnreadContent(5,'page',0) as $oContent): ?>
                                                <?php if($a>3) break; ?>
                                                <li><a href="<?=MSHTools::getContentUrl($oContent)?>" title="<?=$oContent?>"><?=$oContent?></a></li>
                                            <?php $a++; endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                    <div>
                                        <p class="head head3">
                                            <a href="<?=MSHTools::getThemesUrl()?>" title="<?=__('themes')?>"><?=__('themes')?></a>
                                        </p>
                                        <ul class="li-gt">
                                            <?php $a=0; foreach($aTheme as $oTheme): ?>
                                                <?php if($a>3) break; ?>
                                                <li>
                                                    <a href="<?=MSHTools::getThemeUrl($oTheme)?>" title="<?=$oTheme->getTitle()?>">
                                                        <?=$oTheme->getTitle()?>
                                                    </a>
                                                </li>
                                            <?php $a++; endforeach;?>
                                        </ul>
                                    </div>
                                </nav>
                            </li>

                            <li class="<?=(!(get_slot('is_homepage',false)) && $sf_user->getPhase() == 1 ? 'current' : '' )?>">
                                <?php if(!$sf_user->hasCountry()): ?>
                                    <a href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.chooseCountry'))))?>" title="<?=__('phase.inform')?>">
                                <?php else: ?>
                                    <a href="<?=MSHTools::getCountryUrl($sf_user->getCountry());?>" title="<?=__('phase.inform')?>">
                                <?php endif; ?>
                                    &nbsp;&nbsp;<?=__('phase.inform')?>
                                </a>
                                <?php if($sf_user->hasCountry()): ?>
                                <nav>
                                    <?php foreach($aCategoryInform as $oCat){ ?>
                                    <div>
                                        <p class="head head3">
                                            <a href="<?=MSHTools::getSubjectUrl($oCat->getSlug(),1)?>" title="<?=$oCat?>"><?=$oCat?></a>
                                        </p>
                                        <ul class="li-gt">
                                            <?php $a=0; foreach($oCat->getRecentUnreadContent(5,'page',1) as $oContent): ?>
                                                <?php if($a>3) break; ?>
                                                <li><a href="<?=MSHTools::getContentUrl($oContent)?>" title="<?=$oContent?>"><?=$oContent?></a></li>
                                            <?php $a++; endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </nav>
                                <?php endif; ?>
                            </li>
<?php /*
                            <li class="<?=(!(get_slot('is_homepage',false)) && $sf_user->getPhase() == 2 ? 'current' : '' )?>">
                                <?php if(!$sf_user->hasCountry()): ?>
                                    <a href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.chooseCountry'))))?>?phase=2" title="<?=__('phase.advice')?>">
                                <?php else: ?>
                                    <a href="<?=MSHTools::getCountryAdviceUrl($sf_user->getCountry());?>" title="<?=__('phase.advice')?>">
                                <?php endif; ?>

                                    &nbsp;&nbsp;<?=__('phase.advice')?>
                                </a>
                                <?php if($sf_user->hasCountry()): ?>
                                <nav>
                                    <div>
                                        <p class="head head3">
                                            <?php if(!$sf_user->hasCountry()): ?>
                                                <a href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.chooseCountry'))))?>" title="<?=__('questions')?>"><?=__('questions')?></a>
                                            <?php else: ?>
                                                <a href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectall')),3,true)?>" title="<?=__('questions')?>"><?=__('questions')?></a>
                                            <?php endif; ?>
                                        </p>
                                        <ul class="li-gt">
                                            <?php $a=0;foreach($aQuestion as $oQuestion): ?>
                                                <?php if($a>3) break; ?>
                                                <li><a href="<?=MSHTools::getQuestionUrl($oQuestion)?>" title="<?=$oQuestion?>"><?=$oQuestion?></a></li>
                                            <?php $a++; endforeach; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="head head3">
                                            <?php if(!$sf_user->hasCountry()): ?>
                                                <a href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.chooseCountry'))))?>" title="<?=__('experiences')?>"><?=__('experiences')?></a>
                                            <?php else: ?>
                                                <a href="<?=MSHTools::getCountryExperiencesUrl($sf_user->getCountry())?>" title="<?=__('experiences')?>"><?=__('experiences')?></a>
                                            <?php endif; ?>
                                        </p>
                                        <ul class="li-gt">
                                            <?php $a=0;foreach($aExperience as $oExperience): ?>
                                                <?php if($a>3) break; ?>
                                                <li><a href="<?=MSHTools::getCountryExperienceUrl($oExperience)?>" title="<?=$oExperience?>"><?=$oExperience?></a></li>
                                            <?php $a++;endforeach; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="head head3">
                                            <?php if(!$sf_user->hasCountry()): ?>
                                                <a href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.chooseCountry'))))?>" title="<?=__('news')?>"><?=__('news')?></a>
                                            <?php else: ?>
                                                <a href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectall')),3,false)?>" title="<?=__('news')?>"><?=__('news')?></a>
                                            <?php endif; ?>
                                        </p>
                                        <ul class="li-gt">
                                            <?php $a=0;foreach($aNews as $oContent): ?>
                                                <?php if($a>3) break; ?>
                                                <li><a href="<?=MSHTools::getContentUrl($oContent)?>" title="<?=$oContent?>"><?=$oContent?></a></li>
                                            <?php $a++;endforeach; ?>
                                        </ul>
                                    </div>
                                </nav>
                                <?php endif;?>
                            </li>
 */?>
                            <li class="small <?=(!(get_slot('is_homepage',false)) && $sf_user->getPhase() == 3 ? 'current' : '' )?>">
                                <a href="<?=MSHTools::getPhaseUrl(3);?>" title="<?=__('phase.find')?>">
                                    &nbsp;&nbsp;<?=__('phase.find')?>
                                </a>
                                <?php if($sf_user->hasCountry()): ?>
                                <nav>
                                    <div>
                                        <p class="head head3"><?=__('title.ouroffer')?></p>
                                        <ul class="li-gt">
                                            <li><a href="<?=MSHTools::getCountryPropertiesUrl($sf_user->getCountry())?>?clearfilters=true"><?=__('title.propertiesin')?> <?=$sf_user->getCountry()->getTitle()?></a></li>
                                            <li><a href="<?=MSHTools::getCountryDevelopmentsUrl($sf_user->getCountry())?>"><?=__('title.developmentsin')?> <?=$sf_user->getCountry()->getTitle()?></a></li>
                                            <li><a href="<?=MSHTools::getCountryProvidersUrl($sf_user->getCountry())?>"><?=__('title.providersin')?> <?=$sf_user->getCountry()->getTitle()?></a></li>

                                        </ul>
                                    </div>
                                    <?php /**
                                    <div>
                                        <p class="head head3"><?=__('text.propertiesbyregion')?></p>
                                        <ul class="li-gt">
                                            <?php foreach($aRegionResults as $aResult): ?>
                                                <li><a href="<?=MSHTools::getCountryPropertiesUrl($sf_user->getCountry())?>?clear=clear&filter[region_id][<?=$aResult['id']?>]=on" title="<?=__('text.seepropertiesofregion')?> <?=strtolower($aRegion[$aResult['id']])?>"><?=$aRegion[$aResult['id']]?> <span>(<?=$aResult['count']?>)</span></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="head head3"><?=__('text.propertiesbytype')?></p>
                                        <ul class="li-gt">
                                            <?php foreach($aTypeResults as $aResult): ?>
                                                <li><a href="<?=MSHTools::getCountryPropertiesUrl($sf_user->getCountry())?>?clear=clear&filter[type_id][<?=$aResult['id']?>]=on" title="<?=__('text.seepropertiesoftype')?> <?=strtolower($aType[$aResult['id']])?>"><?=$aType[$aResult['id']]?> <span>(<?=$aResult['count']?>)</span></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="head head3"><?=__('text.propertiesbyprice')?></p>
                                        <ul class="li-gt">
                                            <?php foreach($aPriceCountResults as $iPrice => $sResult): ?>
                                                <li><a href="<?=MSHTools::getCountryPropertiesUrl($sf_user->getCountry())?>?clear=clear&filter[price][till]=<?=($iPrice*1000)?>" title="<?=__('text.seepropertiesofpricelessthen')?> &euro; <?=format_currency_msh($iPrice*1000)?>"> <?=__('text.seepropertiesofpricelessthen')?> &euro; <?=format_currency_msh($iPrice*1000)?> <span>(<?=$sResult?>)</span></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>**/ ?>
                                </nav>
                                <?php endif;?>
                            </li>
                            
                            <li class="last">
                                <a href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.chooseCountry'))))?>" title="<?=__('menu.all-countries')?>">
                                    <?php if($sf_user->hasCountry()): ?>
                                        <?=__('menu.country')?>: <?= $sf_user->getCountry()->getTitle()?>
                                    <?php else: ?>
                                        <?=__('menu.all-countries')?>
                                    <?php endif;?>
                                </a>
                                <nav>
                                    <div>
                                        <p class="head head3"><?=__('countries')?></p>

                                        <ul class="flags">
                                            <?php foreach($aCountryMenu as $oCountry):?>
                                                <li>
                                                    <img height="12" width="16" src="<?=$oCountry->getFlagImageUrl()?>" class="flag_image" />
                                                    <a href="<?=$iPhase == 1 ? MSHTools::getCountryUrl($oCountry) : ($iPhase == 2 ? MSHTools::getCountryAdviceUrl($oCountry): MSHTools::getCountryPropertiesUrl($oCountry));?>" title="<?=$oCountry->getTitle()?>">
                                                        <?=$oCountry->getTitle();?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div>
                                        <p class="head head3"><?=__('countries.popular')?></p>
                                        <ul class="flags" id="">
                                            <?php foreach($aCountryPopular as $oCountry):?>
                                                <li>
                                                    <img height="12" width="16" src="<?=$oCountry->getFlagImageUrl()?>" class="flag_image" />
                                                    <a href="<?=$iPhase == 1 ? MSHTools::getCountryUrl($oCountry) : ($iPhase == 2 ? MSHTools::getCountryAdviceUrl($oCountry): MSHTools::getCountryPropertiesUrl($oCountry));?>" title="<?=$oCountry->getTitle()?>">
                                                        <?=$oCountry->getTitle()?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <br clear="all">
                                    <a class="button gray" href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('menu.seeallcountries')?></a>
                                </nav>
                            </li>
                        <?php } ?>
                        </ul>
                    </nav>
                    
                    <script type="text/javascript">
                        initMainMenu();
                        bindLinks();
                    </script>
                    
                    <?php if(get_slot('is_homepage',false)): ?>
                        <?= include_component('system','filter'); ?>
                    <?php endif; ?>
                    
                </div>
                
            </header>
