<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if ($arResult['ITEM']): ?>
    <div class="active-from"><?=substr($arResult['ITEM']['DATE_ACTIVE_FROM'],0,10)?></div>
    <h1><?=$arResult['ITEM']['NAME']?></h1>
    <div class="detail-pic"><img src="<?=$arResult['ITEM']["DETAIL_PICTURE_SRC"]?>"></div>

    <div class="project_news__description">

        <?=$arResult['ITEM']['DETAIL_TEXT']?>

        <?$APPLICATION->IncludeFile("/includes/social.php");?>
    </div>


<? endif; ?>