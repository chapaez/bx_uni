<?php
/**
 * Created by PhpStorm.
 * User: vnilov
 * Date: 02.09.15
 * Time: 12:07
 */
require_once ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$APPLICATION->IncludeComponent(
    "custom:uni.list",
    "media.list.ajax",
    Array(
        'FILTER' => array('IBLOCK_ID'=>array($in,$tw,$vk),'SECTION_CODE'=>"lovestylelook", 'ACTIVE'=>"Y"),
        'SELECT' => array(
            'PROPERTY_USER_PICTURE',
            'PROPERTY_USER_NAME',
            'PROPERTY_POSTER',
            'PROPERTY_CREATED_TIME',
            'PROPERTY_MESSAGE'
        ),
        'ONPAGE' => 6,
        "PAGE"=>intval($_GET['page']),
        "CACHE_TIME"=>300,
    )
);

require_once ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
