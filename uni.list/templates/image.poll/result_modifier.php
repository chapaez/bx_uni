<?php
 foreach ($arResult['ITEMS'] as $k => $item) {
     $arResult['ITEMS'][$k]['PICTURE_1'] = CFile::GetPath($item['PROPERTY_PHOTO_1_VALUE']);
     $arResult['ITEMS'][$k]['PICTURE_2'] = CFile::GetPath($item['PROPERTY_PHOTO_2_VALUE']);
 }