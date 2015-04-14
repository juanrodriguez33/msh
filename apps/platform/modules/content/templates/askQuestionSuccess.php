<?= include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper">
    
        <aside class="small mt-0px" id="asideBanner">
            <?php include_partial('system/doubleclick'); ?>
            <?php include_component('content', 'askExpert'); ?>
        </aside>

        <section class="large pt-10px" id="">
            <p class="ellipsis head head1 mt-2px">
                <?=__('questions')?>
            </p>
            <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_question_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch')), null, true))) ?>

            <script type="text/javascript">
                submitOnReturn($('#form_information_search'), $('#form_information'));
            </script>

            <?php include_component('content','subjectSelection', array('bQuestion' => true)); ?>

            <div class="bar">
                <a class="button gray back" href="<?=MSHTools::getSubjectUrl(Functions::slugify($sCurrentSubject),null, true)?>"><?=__('backtolist')?></a>
            </div>
        </section>

        <section class="large article" id="postQuestion">
            <form action="" enctype="multipart/form-data" id="form_question" method="post" name="form_question">

                <?=$oForm['_csrf_token']->render()?>
        
                <p class="head head3"><?=__('question.post')?></p>
                <p>
                    <?=__('text.question.postDescription')?>
                </p>
    
    
                <?php if($oForm->isBound() && $oForm->isValid()): ?>
                    <p class="pb-20px">
                        <?=__('question.thanks')?>
                    </p>
                    <script type="text/javascript">
                        scrollToElement('form_question');
                    </script>
                <?php else: ?>
                <table class="form">
                    <tbody>
                        <tr>
                            <td>
                                <label for="form_question_name"><?=__('form.name')?></label>
                                <?=$oForm['name']->render(array('tabindex' => 1))?>
                                <?=$oForm['name']->renderError()?>
                            </td>
                            <td>
                                <label for="form_question_subect"><?=__('form.subject')?></label>
                                <?=$oForm['title']->render(array('tabindex' => 5))?>
                                <?=$oForm['title']->renderError()?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="form_question_email_address"><?=__('form.email')?></label>
                                <?=$oForm['email']->render(array('tabindex' => 2))?>
                                <?=$oForm['email']->renderError()?>
                                <br />
                                <label for="form_question_category"><?=__('form.category')?></label>
                                <span class="dropdown"></span>
                                <?=$oForm['category_id']->render(array('tabindex' => 3))?>
                                <?=$oForm['category_id']->renderError()?>
                                <br />
                                <br />
                                <label for="form_question_captcha"><?=__('form.captcha')?></label>
                                <?php echo $oForm['captcha']->render(array('tabindex' => 4)); ?>
                                <?php if($oForm['captcha']->hasError()) echo $oForm['captcha']->renderError() ?>
                            </td>
                            <td>
                                <label for="form_question_content"><?=__('form.question')?></label>
                                <?=$oForm['content']->render(array('tabindex' => 6))?>
                                <?=$oForm['content']->renderError()?>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <input class="button orange raquo" tabindex="6" type="submit" value="<?=__('postquestion')?> &raquo;" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <?php endif; ?>
            </form>
        </section>

    </div>
</section>