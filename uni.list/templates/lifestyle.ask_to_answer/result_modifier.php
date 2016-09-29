<?
global $USER, $guru_list;

foreach($arParams['GURU'] as $guru) {
    $guru_list[$guru['code']] = $guru;
}
foreach($arResult['ITEMS'] as $key => &$item) {
    $likes=array_unique(array_filter(explode(";",$item['PROPERTY_LIKES_VALUE'])));
    $item["I_LIKE"] = (array_search($USER->getID(),$likes)!==false);
    $item['LIKES_COUNT']=count($likes);
    if($item['PROPERTY_VMID_ANSWER_VALUE']){
        //$vm_quote=VideomoreApi::getQuoteById($item["PROPERTY_VMID_ANSWER_VALUE"]);
        //$item['VIDEO_ANSWER']['URL']=$vm_quote->url_shared;
        //$item['VIDEO_ANSWER']['TRACK_ID']=$vm_quote->track_id;
        //$item['VIDEO_ANSWER']['QUOTE_ID']=$vm_quote->id;
    }
    $item['GURU']=$guru_list[$item['PROPERTY_GURU_VALUE']];
    if(!$item['DETAIL_PICTURE_SRC'])
        $item['DETAIL_PICTURE_SRC']=DEFAULT_USERPHOTO;
    if($item['PROPERTY_GURU_VALUE']=="all" || $item['PROPERTY_GURU_VALUE']==""){
        if($item["PROPERTY_ANSWERED_VALUE"])
            $item['GURU']=$guru_list[$item['PROPERTY_ANSWERED_VALUE']];
        $item["GURU"]['plashka']='всем ведущим';
    }
}
?>