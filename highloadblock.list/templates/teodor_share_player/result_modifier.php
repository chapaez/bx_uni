<?
foreach($arResult['rows'] as $k=>$row){
    if(!empty($row['~UF_GIF_IMAGE']))
        $arResult['rows'][$k]['UF_GIF_IMAGE_SRC']=CFile::GetPath($row['~UF_GIF_IMAGE']);
    if(!empty($row['~UF_IMAGE']))
        $arResult['rows'][$k]['UF_IMAGE_SRC']=CFile::GetPath($row['~UF_IMAGE']);
    if(!empty($row['~UF_BIG_IMAGE']))
        $arResult['rows'][$k]['UF_BIG_IMAGE_SRC']=CFile::GetPath($row['~UF_BIG_IMAGE']);
}