<?= include_component('content', 'stepHeader'); ?>
<?php
/** @var Page $oArticle */
?>
    <section class="content gray">
        <div class="wrapper">

            <section class="large pt-10px" id="">
                <p class="ellipsis head head1 mt-2px">
                    <?=$oQuestion?>
                </p>
                <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_question_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch')), null, true))) ?>

                <script type="text/javascript">
                    submitOnReturn($('#form_information_search'), $('#form_information'));
                </script>

                <?php include_component('content','subjectSelection', array('bQuestion' => true)); ?>

                <div class="bar">
                    <a class="button gray back" href="<?=MSHTools::getSubjectUrl(Functions::slugify($sCurrentSubject),null,true)?>"><?=__('backtolist')?></a>
                </div>
                <?php include_partial('content/questionDetail', array('oQuestion' => $oQuestion)) ?>

                <aside class="article" id="asideArticleComments">
                    <p class="head head2"><?=sizeof($oQuestion->getComments())?> <?=sizeof($oQuestion->getComments())== 1 ? __('comment') : __('comments')?></p>
                    <a class="button down gray raquo" id="a_show_comments" state1="<?=sizeof($oQuestion->getComments())== 0 ? __('comments.add') :  __('comments.see')?>" state2="<?=__('comments.hide')?>" title="<?=sizeof($oQuestion->getComments())== 0 ? __('comments.add') :  __('comments.see')?>"><?=sizeof($oQuestion->getComments())== 0 ? __('comments.add') :  __('comments.see')?></a>
                    <div id="articleComments" style="<?=(isset($_GET['a']) && $_GET['a']=="show_comments" ? 'display: block' : '')?>">

                        <ul>
                            <?php foreach($oQuestion->getComments() as $oComment): ?>
                                <li class="no-js" id="comment_<?=$oComment->getId()?>">
                                    <?php //<a class="item"> ?>
                                        <p class="head head5 <?= (null===$oComment->getUser()) ? 'no-indent' :''?>">
                                            <?php if(null!==$oComment->getUser()):?>
                                                <?=__('by')?>: <em><?=$oComment->getUser()->getName()?></em>
                                            <?php else:?>
                                                <?=__('by')?>: <em><?=$oComment->getName()?></em>
                                            <?php endif;?>

                                        </p>
                                            <div class="posted">
                                                <time><?=__('on')?> <?=format_date($oComment->getCreatedAt(), 'D')?></time>
                                            </div>
                                        <p class="expander">
                                            <?php if(null!==$oComment->getUser()):?>
                                                <img alt="<?=$oComment->getUser()->getName()?>" class="loader white" style="position: relative; left: 0;" src="<?=$oComment->getUser()->getImage() !== null ? $oComment->getUser()->getImage()->getFormatUrl(40,40) : ''?>" pagespeed_no_transform />
                                            <?php endif;?>
                                            <?=$oComment->getContent(ESC_RAW)?>
                                        </p>
                                    <?php //</a> ?>
                                    <?php /*
                                    <a class="button down gray raquo" state1="<?=__('readmore')?>" state2="<?=__('readless')?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
                                    */ ?>

                                    <script type="text/javascript">
                                        <?php /*
                                        var object      = { id: 'comment_<?=$oComment->getId()?>', speed: <?=sfConfig::get('app_expander_speed')?> };
                                        var Comment_<?=$oComment->getId()?> = new Expander(object);
                                        Comment_<?=$oComment->getId()?>.Init();
                                        */ ?>
                                    </script>
                                </li>
                            <?php endforeach;?>

                            <li>
                                <form id="form_comment" method="post" enctype="multipart/form-data">
                                    <?=$oForm['_csrf_token']->render()?>
                                    <p class="head head3"><?=__('comment.add')?></p>

                                    <?php if($oForm->isBound() && $oForm->isValid()): ?>
                                        <p><?=__('comment.thanks')?></p>
                                        <script>
                                        </script>
                                    <?php else: ?>

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
                                                    <label for="comment_captcha"><?=__('form.captcha')?></label>
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
                                                    <input class="button orange raquo" tabindex="4" type="submit" value="<?=__('comments.post')?> &raquo;" />
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

            </section>

            <script type="text/javascript">

                var oComments;
                var object      = { id: 'articleComments', speed: <?=sfConfig::get('app_expander_speed')?>, trigger: 'a_show_comments' };

                //
                oComments = new Comments(object);
                oComments.Init();
                
                <?php if($oForm->isBound() && $oForm->isValid()): ?>
                    oComments.Load();
                    scrollToElement('form_comment');
                <?php endif;?>
                
            </script>

            <aside class="small" id="asideBanner">
                <?php include_partial('system/doubleclick'); ?>
                <?php include_component('content', 'askExpert', array('bHideExperts' => true)); ?>
                <?php include_component('property','asideTopProperties');?>
            </aside>

        </div>
    </section>