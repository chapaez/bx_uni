<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $result = $arResult['ITEM']; ?>
<? $filter = InitFunctions::getObjectArrayById($result['PROPERTY_FILTER_GENRES_VALUE']);?>
<?$APPLICATION->AddChainItem($filter['NAME']);?>
<?$APPLICATION->AddChainItem($result['NAME']);?>

<!--<h1>
    <span class="icon yellow_back hidden-xs"><i class="cinema"></i></span>
    <?/*=$result['NAME']*/?>
</h1>-->
<div class="gif-wrap">
    <div class="gif">
        <img src="<?= CFile::GetPath($result['PREVIEW_PICTURE']); ?>" alt="">
    </div>
</div>
<? $APPLICATION->IncludeFile("/includes/shares_beautiful.php"); ?>
<div class="clearfix"></div>
