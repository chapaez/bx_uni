<?
foreach($arResult['rows'] as $k=>$row){
    if(!empty($row['~UF_GIF_IMAGE']))
        $arResult['rows'][$k]['UF_GIF_IMAGE_SRC']=CFile::GetPath($row['~UF_GIF_IMAGE']);
}