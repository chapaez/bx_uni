<? if (count($arResult['CLEAR_ANSWERS']) > 0): ?>
<div class="container"><div class="bride__heading bride__heading--narrow">Анкеты участниц</div></div>



<div class="items slick__items">
<? foreach ($arResult['CLEAR_ANSWERS'] as $res_id => $answers): ?>
    <div class="item__wrap">
        <div class="item"><a href="<?=$arResult['URL']?>?anketa_id=<?=$res_id?>" class="item__link">
            <? $text = ''; ?>
            <? foreach ($answers as $key => $arAnswer): ?>
                <? if ($arAnswer['COMMENTS'] == 'photo'): ?>
                    <?
                    $resize = CFile::ResizeImageGet($arAnswer['USER_FILE_ID'], Array("width" => 242, "height" => 200));
                    ?>
                    <div class="box  item__image" style="background-image: url('<?= $resize['src']?>');">
                    </div>
                <? endif; ?>
                <? if ($arAnswer['COMMENTS'] == 'name'): ?>
                    <? ob_start(); ?>
                    <div class="item__name"><?=$arAnswer['USER_TEXT']?></div>
                    <? $text .= ob_get_contents(); ob_end_clean(); ?>
                <? endif; ?>
                <? if ($arAnswer['COMMENTS'] == 'city'): ?>
                    <? ob_start(); ?>
                    <div class="item__city"><?=$arAnswer['USER_TEXT']?></div>
                    <? $text .= ob_get_contents(); ob_end_clean(); ?>
                <? endif; ?>
            <? endforeach; ?>
            <div class="box  item__data"><?=$text?></div>
        </a></div>
    </div>
<? endforeach; ?>
</div>
<div class="wrapper">
<a href="<?=$arResult['URL']?>?get=list" class="btn btn--transparent">смотреть все анкеты</a>
</div>


<? endif; ?>

