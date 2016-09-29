<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetPageProperty("seo_element", Array($arResult['ITEM'],'element'));
$APPLICATION->SetTitle($arResult['ITEM']['NAME']);
$APPLICATION->SetPageProperty("h1", $arResult['ITEM']['NAME']);
$APPLICATION->AddChainItem($arResult['ITEM']['NAME']);
global $persona_id;
$persona_id = $arResult['ITEM']['ID'];
?>