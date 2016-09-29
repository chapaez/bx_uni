<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $detail_seriya;
$detail_seriya = $arResult['ITEM'];
global $novideo;
global $player;
$player = 1;

$project = CTCLove\Project::i()->getProject();
CTCLove\Project::i()->episode = $arResult['ITEM']['PROPERTY_SERIE_VALUE'];

if ( !$arResult['ITEM'] && $project['PROPERTY_TYPE_OF_PROJECT_VALUE'] != "Фильм")
	$novideo = true;
