<form method="post" id="form_languages">

    <section class="block full">
        <h1>
            Translations for <?=format_language($oLanguage->getCulture())?>
        </h1>

        <div class="flat">


                <table>
                    <tr>
                        <th>Source</th>
                        <th>Comment</th>
                        <th>Target</th>
                    </tr>
                    <?php foreach ($aMessagesEN as $sKey => $aValue): ?>
                        <tr>

                            <td><?=$sKey?></td>
                            <td>
                                <?php if(!$bMainLang):?>
                                    <?=$aValue[2]?>
                                <?php else: ?>
                                    <?=$oForm[$sKey . '_comment']->render()?>
                                <?php endif;?>
                            </td>
                            <td><?=$oForm[$sKey . '_value']->render()?></td>
                        </tr>
                    <?php endforeach?>
                </table>
            </form>
        </div>
    </section>

    <section class="block full">
        <div>
            <ul class="actions">
                <li>
                    <input type="submit">
                    <a class="a_button" href="JavaScript: $('#form_languages').submit()"><span>Opslaan</span></a>
                </li>
                <li class="demarcation"><a class="a_icon a_icon_index" href="/language">Terug naar het overzicht</a></li>
            </ul>
        </div>
    </section>
</form>
