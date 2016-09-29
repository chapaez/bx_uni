<?php
/**
 * Date: 27.04.16
 * Time: 16:04
 */

$arResult['FILTER'] = htmlspecialchars($_REQUEST['filter']);

$genre_q = CIBlockElement::GetList(
    array('sort' => "desc"),
    array(
        'IBLOCK_CODE' => "genres",
        'ACTIVE'      => "Y"
    ),
    false,
    false,
    array('ID', 'CODE', 'NAME')
);

while ($genre = $genre_q->GetNext()) {
    $genres[$genre['ID']] = [$genre['NAME'], $genre['CODE']]; // [0] = name, [1] = code
}

// достаем все фильмы
$all_movies_query = CIBlockElement::GetList(
    ['sort' => "desc"],
    ['PROPERTY_TYPE_OF_PROJECT_VALUE' => "Фильм", 'IBLOCK_CODE' => "projects", 'ACTIVE' => "Y"],
    ['PROPERTY_FILTER_GENRES']
);
// пробегаемся по всем фильмам
while ($ar = $all_movies_query->GetNext()) {
    if (!empty($ar['PROPERTY_FILTER_GENRES_VALUE'])) { // если у фильма указаны жанры
        if (!key_exists($genres[$ar['PROPERTY_FILTER_GENRES_VALUE']][1], $arResult['GENRES'])) // если их нет в массиве жанров, то добавляем
            $arResult['GENRES'][$genres[$ar['PROPERTY_FILTER_GENRES_VALUE']][1]] = $genres[$ar['PROPERTY_FILTER_GENRES_VALUE']][0];
    }
}
// добавляем в элементы нгазвания жанров
foreach ($arResult['ITEMS'] as $k => $item) {
    foreach ($arResult['ITEMS'][$k]['FILTER_GENRES']['VALUE'] as $id) {
        $arResult['ITEMS'][$k]['FILTER_GENRES']['NAMES'][] = $genres[$id][0];
    }
}

$current_date = date("Y-m-d H:i:s");

// get projects for slider
$slider_filter = [
    'IBLOCK_CODE'                    => "projects",
    'PROPERTY_TYPE_OF_PROJECT_VALUE' => "Фильм",
    [
        'LOGIC' => 'OR',
        [   // стоят обе отметки о паказе в слайдерах, а также заданы даты начала и конца активности
            'PROPERTY_SHOW_IN_MOVIE_SLIDER_VALUE' => "yes",
            '<PROPERTY_ACTIVE_IN_SLIDER_FROM' => $current_date,
            '>PROPERTY_ACTIVE_IN_SLIDER_TO' => $current_date,
            'PROPERTY_SHOW_IN_GENRE_MOVIE_SLIDER_VALUE' => "yes"
        ],
        [   // стоят обе отметки о паказе в слайдерах, но не заданы даты начала и окнчания активности
            'PROPERTY_SHOW_IN_MOVIE_SLIDER_VALUE' => "yes",
            '<PROPERTY_ACTIVE_IN_SLIDER_FROM' => false,
            '>PROPERTY_ACTIVE_IN_SLIDER_TO' => false,
            'PROPERTY_SHOW_IN_GENRE_MOVIE_SLIDER_VALUE' => "yes"
        ],
        [   // стоит отметка о показе в слайдере на главной, а также заданы даты начала и конца активности
            'PROPERTY_SHOW_IN_MOVIE_SLIDER_VALUE' => "yes",
            '!PROPERTY_SHOW_IN_GENRE_MOVIE_SLIDER_VALUE' => "yes",
            '<PROPERTY_ACTIVE_IN_SLIDER_FROM' => $current_date,
            '>PROPERTY_ACTIVE_IN_SLIDER_TO' => $current_date,
        ],
        [   // стоит отметка о показе в слайдере на главной, а также задана дата начала активности, но не стоит даты окончания активности 
            'PROPERTY_SHOW_IN_MOVIE_SLIDER_VALUE' => "yes",
            '!PROPERTY_SHOW_IN_GENRE_MOVIE_SLIDER_VALUE' => "yes",
            '<PROPERTY_ACTIVE_IN_SLIDER_FROM' => $current_date,
            'PROPERTY_ACTIVE_IN_SLIDER_TO' => false,
        ],
        [   // стоит отметка о показе в слайдере на главной, а также задана дата окнчания активности, но не стоит даты начала активности 
            'PROPERTY_SHOW_IN_MOVIE_SLIDER_VALUE' => "yes",
            '!PROPERTY_SHOW_IN_GENRE_MOVIE_SLIDER_VALUE' => "yes",
            'PROPERTY_ACTIVE_IN_SLIDER_FROM' => false,
            '>PROPERTY_ACTIVE_IN_SLIDER_TO' => $current_date,
        ],
        [   // стоит отметка о показе в слайдере на главной, даты начала и окончания активности не заданы
            'PROPERTY_SHOW_IN_MOVIE_SLIDER_VALUE' => "yes",
            '!PROPERTY_SHOW_IN_GENRE_MOVIE_SLIDER_VALUE' => "yes",
            'PROPERTY_ACTIVE_IN_SLIDER_FROM' => false,
            'PROPERTY_ACTIVE_IN_SLIDER_TO' => false,
        ],
        [
            '!PROPERTY_SHOW_IN_MOVIE_SLIDER_VALUE' => "yes",
            'PROPERTY_SHOW_IN_GENRE_MOVIE_SLIDER_VALUE' => "yes"
        ],
    ]
];
$slider_select = [];
$slider_order = [
    "sort" => "asc", "active_from" => "desc", "created_date" => "desc"
];
// запрашиваем все фильмы, которые подходят под вывод в жанровом слайдере
$slider_q = CIBlockElement::GetList($slider_order, $slider_filter, false, false, $slider_select);

while ($slider_ar = $slider_q->GetNextElement()) {
    $item = array_merge($slider_ar->GetFields(), $slider_ar->GetProperties());
    $genre_codes = [];
    foreach ($item['FILTER_GENRES']['VALUE'] as $genre) {
        $genre_codes[] = $genres[$genre][1];
        $item['FILTER_GENRES']['NAMES'][] = $genres[$genre][0]; // добавляем жанры
    }

    shuffle($item['FILTER_GENRES']['NAMES']);
    // если есть жанры и слайдер жанровый 
    if (count($genre_codes) > 0 && !empty($arResult['FILTER']) && /*in_array(strtolower($arResult['FILTER']), $genre_codes)*/ strtolower($arResult['FILTER']) == $genre_codes[0]  && $item['SHOW_IN_GENRE_MOVIE_SLIDER']['VALUE_XML_ID'] == "yes") {
        $arResult['SLIDER'][] = $item;
    }
    if (empty($arResult['FILTER']) && $item['SHOW_IN_MOVIE_SLIDER']['VALUE_XML_ID'] == "yes") {
        
        $arResult['SLIDER'][] = $item;
    }
}

if ($arResult['SLIDER'] === null) {
    foreach ($arResult['ITEMS'] as $k => $item) {
        if ($k == 3)
            break;
        $arResult['SLIDER'][] = $item;
    }
}

$arResult['SLIDER_NUM'] = count($arResult['SLIDER']);

if (empty($arResult['FILTER'])) {
    usort($arResult['SLIDER'], "slider_sort");
}

function slider_sort($a, $b) {
    if (intval($a['POSITION_IN_SLIDER']['VALUE']) == intval($b['POSITION_IN_SLIDER']['VALUE'])) {
        return 0;
    }
    if (intval($a['POSITION_IN_SLIDER']['VALUE']) != 0 && intval($a['POSITION_IN_SLIDER']['VALUE']) < intval($b['POSITION_IN_SLIDER']['VALUE'])) {
        return -1;
    }
    if (intval($b['POSITION_IN_SLIDER']['VALUE']) != 0 && intval($a['POSITION_IN_SLIDER']['VALUE']) > intval($b['POSITION_IN_SLIDER']['VALUE'])) {
        return 1;
    }
    if (intval($b['POSITION_IN_SLIDER']['VALUE']) == 0 && intval($a['POSITION_IN_SLIDER']['VALUE']) > intval($b['POSITION_IN_SLIDER']['VALUE'])) {
        return -1;
    }
    if (intval($a['POSITION_IN_SLIDER']['VALUE']) == 0 && intval($a['POSITION_IN_SLIDER']['VALUE']) < intval($b['POSITION_IN_SLIDER']['VALUE'])) {
        return 1;
    }
}