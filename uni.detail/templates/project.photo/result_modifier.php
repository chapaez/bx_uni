<?
$project = CTCLove\Project::i()->getProject();
$arFilter=Array("IBLOCK_CODE"=>"photo","PROPERTY_PROJECT"=>$project["ID"]);
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, Array());
