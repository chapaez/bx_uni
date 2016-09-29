<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR'])) {
	echo $arResult['ERROR'];
	return false; 
}

try {
	if (count($arResult['rows']) == 1) {
		
	} else {
		return false;
	}
} catch (Exception $e) {
	echo $e->getMessage();
}