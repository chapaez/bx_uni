<?
function time_to_iso8601_duration($time) {
	$units = array(
			"Y" => 365*24*3600,
			"D" =>     24*3600,
			"H" =>        3600,
			"M" =>          60,
			"S" =>           1,
	);

	$str = "P";
	$istime = false;

	foreach ($units as $unitName => &$unit) {
		$quot  = intval($time / $unit);
		$time -= $quot * $unit;
		$unit  = $quot;
		if ($unit > 0) {
			if (!$istime && in_array($unitName, array("H", "M", "S"))) { // There may be a better way to do this
				$str .= "T";
				$istime = true;
			}
			$str .= strval($unit) . $unitName;
		}
	}

	return $str;
}

if ($arResult['ITEM']) {
	$arResult["ITEM"]["NAME_OF_SEASON"] = InitFunctions::getSeasonNameById($arResult["ITEM"]["IBLOCK_SECTION_ID"]);
	
	$size = getimagesize($_SERVER['DOCUMENT_ROOT'] . $arResult['ITEM']['DETAIL_PICTURE_SRC']);

	$arResult['ITEM']['DETAIL_PICTURE_SIZE']['WIDTH']  = $size[0];
	$arResult['ITEM']['DETAIL_PICTURE_SIZE']['HEIGHT'] = $size[1];
}
$first_video = InitFunctions::getFirstSerie($arResult['ITEM']['PROPERTY_PROJECT_VALUE']);
if (isset($first_video['ID']) && $first_video['ID'] > 0) {
	$arResult['FIRST_SERIE_URL'] = InitFunctions::getElementUrlById($first_video['ID'], "video");
	$arResult['FIRST_SERIE_ID']  = $first_video['ID'];
}

if ($arResult['ITEM']['PROPERTY_DURATION_VALUE'] > 0) {
	$arResult['ITEM']['DURATION'] = time_to_iso8601_duration($arResult['ITEM']['PROPERTY_DURATION_VALUE']);
}



$arResult['DATE'] = (strlen($arResult['ITEM']['ACTIVE_FROM']) > 0) ? date('Y-m-d', strtotime($arResult['ITEM']['ACTIVE_FROM'])) : date('Y-m-d', strtotime($arResult['ITEM']['CREATED_DATE']));
