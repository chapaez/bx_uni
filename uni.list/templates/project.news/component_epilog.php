<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$is = ( count($arResult['ITEMS'])>0 ) ? true : false;
$APPLICATION->SetPageProperty('news', $is);
?>