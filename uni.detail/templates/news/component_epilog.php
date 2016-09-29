<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetPageProperty("seo_element", Array($arResult['ITEM'],'element'));
$APPLICATION->SetTitle($arResult['ITEM']['NAME'].' - Новости CTC Love');
$APPLICATION->SetPageProperty("h1", 'Новости телеканала CTC Love');
$APPLICATION->AddChainItem($arResult['ITEM']['NAME']);
global $seriya;
$seriya=$arResult['ITEM'];
?>