<?= include_component('content', 'stepHeader'); ?>
<?php
/** @var Page $oArticle */
?>
    <section class="content gray">
        <div class="wrapper pt-10px">

            <section class="large" id="">
                <p class="head head1 mt-2px">
                    <?=$oArticle->getCategory()?>
                </p>
                <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_article_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch'))))) ?>

                <script type="text/javascript">
                    submitOnReturn($('#form_information_search'), $('#form_information'));
                </script>

                <?php include_component('content','subjectSelection'); ?>

                <div class="bar">
                    <?php if($sCurrentSubject == 'all'){ ?>
                        <a class="button gray back" href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectall')))?>"><?=__('backtolist')?></a>
                    <?php } else if($sCurrentSubject == 'search'){?>
                        <a class="button gray back" href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch')))?>"><?=__('backtolist')?></a>
                    <?php } else { ?>
                        <a class="button gray back" href="<?=MSHTools::getSubjectUrl(Functions::slugify($sCurrentSubject))?>"><?=__('backtolist')?></a>
                    <?php } ?>
                </div>
                <?php include_partial('content/articleDetail', array('oArticle' => $oArticle)) ?>

                <aside class="article" id="articleCommentsParent">
                    <p class="head head3"><?=sizeof($oArticle->getComments())?> <?=sizeof($oArticle->getComments())== 1 ? __('articlecomment') : __('articlecomments')?></p>
                    
                    <a class="button down gray raquo" id="a_show_comments" state1="<?=sizeof($oArticle->getComments())== 0 ? __('comments.add') :  __('comments.see')?>" state2="<?=__('comments.hide')?>" title="<?=sizeof($oArticle->getComments())== 0 ? __('comments.add') :  __('comments.see')?>"><?=sizeof($oArticle->getComments())== 0 ? __('comments.add') :  __('comments.see')?></a>
                    <div id="articleComments" style="<?=(isset($_GET['a']) && $_GET['a']=="show_comments" ? 'display: block' : '')?>">

                        <ul>
                            <?php foreach($oArticle->getComments() as $oComment): ?>
                                <li class="no-js" id="comment_<?=$oComment->getId()?>">
                                    <a class="item">
                                        <h5 <?= (null===$oComment->getUser()) ? 'class="no-indent"' :''?>>
                                            <?php if(null!==$oComment->getUser()):?>
                                                <?=__('by')?>: <em><?=$oComment->getUser()->getName()?></em>
                                            <?php else:?>
                                                <?=__('by')?>: <em><?=$oComment->getName()?></em>
                                            <?php endif;?>
                                            <div class="posted">
                                                <time><?=__('on')?> <?=format_date($oComment->getCreatedAt(), 'D')?></time>
                                            </div>
                                        </h5>
                                        <p class="expander">
                                            <?php if(null!==$oComment->getUser()): ?>
                                                <img alt="<?=$oComment->getUser()->getName()?>" class="loader white" src="<?=$oComment->getUser()->getImage() !== null ? $oComment->getUser()->getImage()->getFormatUrl(40,40) : ''?>" pagespeed_no_transform />
                                            <?php endif;?>
                                            <?=$oComment->getContent(ESC_RAW)?>
                                        </p>
                                    </a>
                                    <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>

                                    <script type="text/javascript">
                                        var object      = { id: 'comment_<?=$oComment->getId()?>', speed: <?=sfConfig::get('app_expander_speed')?> };
                                        var Comment_<?=$oComment->getId()?> = new Expander(object);
                                        Comment_<?=$oComment->getId()?>.Init();
                                    </script>
                                </li>
                            <?php endforeach;?>

                            <li>
                                <form id="form_comment" method="post" enctype="multipart/form-data">
                                    <?=$oForm['_csrf_token']->render()?>
                                    
                                    <?php if($oForm->isBound() && $oForm->isValid()): ?>
                                        <p><?=__('comment.thanks')?></p>
                                        <script>
                                        </script>
                                    <?php else: ?>
                                        <p class="head head3"><?=__('comment.add')?></p>
                                    <table class="form">
                                        <tbody>
                                            <tr>

                                                <td>
                                                    <label for="form_comment_name"><?=__('form.name')?></label>
                                                    <?php if($sf_user->isAuthenticated()): ?>
                                                        <br />Expert: <?=$sf_user->getUser()->getName()?>
                                                    <?php else:?>
                                                        <?=$oForm['name']->render(array('tabindex' => 1))?>
                                                        <?=$oForm['name']->renderError()?>
                                                    <?php endif;?>

                                                </td>

                                                <td rowspan="2">
                                                    <label for="form_comment_message"><?=__('comment.message')?></label>
                                                    <?=$oForm['content']->render(array('tabindex' => 3))?>
                                                    <?=$oForm['content']->renderError()?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    <?php if($sf_user->isAuthenticated()): ?>

                                                    <?php else:?>
                                                        <label for="form_comment_email_address"><?=__('form.email')?></label>
                                                        <?=$oForm['email']->render(array('tabindex' => 2))?>
                                                        <?=$oForm['email']->renderError()?>
                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="form_comment_captcha"><?=__('form.captcha')?></label>
                                                </td>
                                                <td>
                                                    <?php echo $oForm['captcha']->render(array('tabindex' => 4)); ?>
                                                    <?php if($oForm['captcha']->hasError()) echo $oForm['captcha']->renderError() ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <input class="button orange raquo" tabindex="3" type="submit" value="<?=__('comments.post')?> &raquo;" />
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php endif; ?>
                                </form>
                            </li>

                        </ul>

                    </div>
                </aside>

                <?php $aContent = $oArticle->getCategory()->getRecentUnreadContent(4, 'page', null, $oArticle->getId());?>
                <?php if(sizeof($aContent) >0): ?>
                    <aside class="article" id="relatedArticles">
                        <p class="head head3"><?=__('relatedarticles')?></p>
                        <ul>
                        <?php foreach($aContent as $oContent): if($oContent->getId() == $oArticle->getId()) continue;?>
                            <li <?=$sf_user->hasRead($oContent->getId()) ? 'class="read"' : ''?>>
                                <a href="<?=MSHTools::getContentUrl($oContent)?>" title="<?=$oContent?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                    <p class="head head4" itemprop="name">
                                        <?=$oContent?>
                                    </p>
                                    <div class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                        <meta itemprop="worstRating" content="1" />
                                        <meta itemprop="bestRating" content="5" />
                                        <?php $iApp = $oArticle->getAppreciationScore();?>
                                        <span class="<?=($iApp>=1 ? 'highlite' : '' )?>" <?=($iApp==1?'itemprop="ratingValue"':'')?>>1</span>
                                        <span class="<?=($iApp>=2 ? 'highlite' : '' )?>" <?=($iApp==2?'itemprop="ratingValue"':'')?>>2</span>
                                        <span class="<?=($iApp>=3 ? 'highlite' : '' )?>" <?=($iApp==3?'itemprop="ratingValue"':'')?>>3</span>
                                        <span class="<?=($iApp>=4 ? 'highlite' : '' )?>" <?=($iApp==4?'itemprop="ratingValue"':'')?>>4</span>
                                        <span class="<?=($iApp>=5 ? 'highlite' : '' )?>" <?=($iApp==5?'itemprop="ratingValue"':'')?>>5</span>
                                    </div>
                                    <img alt="" class="loader white" src="<?=null!==$oContent->getImage() ? $oContent->getImage()->getFormatUrl(50,50): '' ?>" pagespeed_no_transform />
                                    <p itemprop="description">
                                        <?=$oContent->getIntro()?>
                                    </p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </aside>
                <?php endif; ?>

            </section>

            <script type="text/javascript">

                var oComments;
                var object      = { id: 'articleComments', speed: <?=sfConfig::get('app_expander_speed')?>, trigger: 'a_show_comments' };
                
                //
                oComments = new Comments(object);
                oComments.Init();
                
                <?php if(($oForm->isBound() && $oForm->isValid()) || $oForm->hasErrors()): ?>
                oComments.Load(); scrollToElement('articleCommentsParent');
                <?php endif; ?>
                
            </script>

            <aside class="small" id="asideBanner">
                <?php include_partial('system/doubleclick'); ?>
                <?php include_component('property','asideTopProperties');?>
            </aside>

        </div>
    </section>