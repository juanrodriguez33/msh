<?php if ($form->isNew()): ?>
<form id="form_object" action="<?php echo url_for('page_create') ?>" method="post" enctype="multipart/form-data">
    <?php else: ?>
    <form id="form_object" action="<?php echo url_for('page_update', $page) ?>" method="post"
          enctype="multipart/form-data">
        <input type="hidden" name="sf_method" value="put"/>
        <?php endif; ?>

        <?php echo $form->renderHiddenFields() ?>

        <?php if ($form->hasGlobalErrors()): ?>
            <section class="block full">
                <div>
                    <?php echo $form->renderGlobalErrors() ?>
                </div>
            </section>
        <?php endif; ?>

        <div class="column">


            <section class="block half">
                <div class="flat">
                    <table class="form">
                        <tr class="bar">
                            <th colspan="2">Article</th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>
                                <?php echo $form['title']->renderError() ?>
                                <?php echo $form['title']->render() ?>
                                <?php if ($help = $form['title']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Introduction</th>
                            <td>
                                <?php echo $form['intro']->renderError() ?>
                                <?php echo $form['intro']->render() ?>
                                <?php if ($help = $form['intro']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Body</th>
                            <td>
                                <?php echo $form['content']->renderError() ?>
                                <?php echo $form['content']->render() ?>
                                <?php if ($help = $form['content']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                <?php echo $form['image_id']->renderError() ?>
                                <?php echo $form['image_id']->render() ?>
                                <?php if ($help = $form['image_id']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Square Image</th>
                            <td>
                                <?php echo $form['square_image_id']->renderError() ?>
                                <?php echo $form['square_image_id']->render() ?>
                                <?php if ($help = $form['square_image_id']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>

        </div>

        <div class="column">

            <section class="block half">
                <div class="flat">
                    <table class="form">
                        <tr class="bar">
                            <th colspan="2">Relation</th>
                        </tr>
                        <tr>
                            <th>Language</th>
                            <td>
                                <?php echo $form['language_id']->renderError() ?>
                                <?php echo $form['language_id']->render() ?>
                                <?php if ($help = $form['language_id']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>
                                <?php echo $form['category_id']->renderError() ?>
                                <?php echo $form['category_id']->render() ?>
                                <?php if ($help = $form['category_id']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Subcategories</th>
                            <td>
                                <?php echo $form['tags']->renderError() ?>
                                <?php echo $form['tags']->render() ?>
                                <?php if ($help = $form['tags']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php if(intval($form['phase']->getValue()) !== 0): ?>
                        <tr>
                            <th>Country</th>
                            <td>
                                <?php echo $form['country_id']->renderError() ?>
                                <?php echo $form['country_id']->render() ?>
                                <?php if ($help = $form['country_id']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </section>


            <section class="block half">
                <div class="flat">
                    <table class="form">
                        <tr class="bar">
                            <th colspan="2">SEO</th>
                        </tr>
                        <tr>
                            <th>Alternate URL</th>
                            <td>
                                <?php echo $form['custom_url']->renderError() ?>
                                <?php echo $form['custom_url']->render() ?>
                                <?php if ($help = $form['custom_url']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Meta title</th>
                            <td>
                                <?php echo $form['meta_title']->renderError() ?>
                                <?php echo $form['meta_title']->render() ?>
                                <?php if ($help = $form['meta_title']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Meta description</th>
                            <td>
                                <?php echo $form['meta_description']->renderError() ?>
                                <?php echo $form['meta_description']->render() ?>
                                <?php if ($help = $form['meta_description']->renderHelp()): ?>
                                    <br/><span><?php echo __($help, array(), 'messages') ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>

        </div>

        <section class="block full">
            <div>
                <?php include_partial('page/form_actions', array('page' => $page, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
                <p>Het kan tot 15 minuten duren voordat wijzigingen doorkomen op Vind je Plek.</p>
            </div>
        </section>

    </form>