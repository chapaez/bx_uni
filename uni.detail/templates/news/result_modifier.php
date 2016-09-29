<?
preg_match_all('/#TEXT_INSERTION_TOMCAT_([^#]+)#/uim', $arResult['ITEM']['DETAIL_TEXT'], $d);
if (sizeof($d) > 1) {//есть коты
    global $teo_id;
    $tagStr = array();
    foreach ($d[1] as $tag_id) {//идем по всем котам
        $arAttr = array();
        ob_start();
        $teo_id=$tag_id;
        $APPLICATION->IncludeComponent("custom:highloadblock.list","teodor_share_block",Array(
                "BLOCK_ID" => "3",
                "ADDITIONAL_CACHE_TAG"=>$teo_id,
                "USER_IS_ADMIN"  => $USER->IsAdmin(),
                "FILTER"=>Array("ID"=>$teo_id),
                "CACHE_TIME"=>1
            )
        );
        $myStr = ob_get_contents();
        ob_end_clean();
        $tagStr[]=$myStr;
    }
    $arResult['ITEM']['DETAIL_TEXT']=str_replace($d[0], $tagStr, $arResult['ITEM']['DETAIL_TEXT']	);
}
?>