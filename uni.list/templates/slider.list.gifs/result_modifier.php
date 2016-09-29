<?php

$arResult['FILTER'] = htmlspecialchars($_REQUEST['filter']);


$genre_q = CIBlockElement::GetList(
	array('sort' => "desc"),
	array(
		'IBLOCK_CODE' => "gifs_genre",
		'ACTIVE'      => "Y"
	),
	false,
	false,
	array('ID', 'CODE', 'NAME')
);


while ($genre = $genre_q->GetNext()) {
	$genres[$genre['ID']] = [$genre['NAME'], $genre['CODE']]; // [0] = name, [1] = code
}

global $genres_list;
$genres_list = $genres;

foreach ($arResult['ITEMS'] as $k => $item) {
	foreach ($arResult['ITEMS'][$k]['FILTER_GENRES']['VALUE'] as $id) {
		$arResult['ITEMS'][$k]['FILTER_GENRES']['NAMES'][] = $genres[$id][0];

		if (!key_exists($genres[$id][1], $arResult['GENRES']))
			$arResult['GENRES'][$genres[$id][1]] = $genres[$id][0];
	}

	if (!empty($arResult['FILTER'])) {
		if ($item['SHOW_IN_GENRE_MOVIE_SLIDER']['VALUE_XML_ID'] != null) {
			$arResult['SLIDER'][] = $arResult['ITEMS'][$k];
		}
	} else {
		if ($item['SHOW_IN_MOVIE_SLIDER']['VALUE_XML_ID'] != null) {
			$arResult['SLIDER'][] = $arResult['ITEMS'][$k];
		}
	}
}