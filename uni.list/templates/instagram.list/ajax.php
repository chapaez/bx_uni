<?php
/**
 * Created by PhpStorm.
 * User: vnilov
 * Date: 02.09.15
 * Time: 12:07
 */
require_once ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$in = InitFunctions::getIbIDByCode('instagram_video');

$APPLICATION->IncludeComponent(
    "custom:uni.list",
    "instagram.list.ajax",
    Array(
        'FILTER' => array('IBLOCK_ID'=>$in,'SECTION_CODE'=>"newyearMBAND", 'ACTIVE'=>"Y"),
        'SELECT' => array(
            'PROPERTY_USER_NAME',
            'PROPERTY_USER_PICTURE',
            'PROPERTY_VIDEO',
            'PROPERTY_PACKSHOT',
        ),
        'ONPAGE' => 6,
        "PAGE"=>intval($_GET['page']),
        "CACHE_TIME"=>10,
        'ORDER'  => array(
            'created'=>"desc"
        )
    )
);

require_once ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
