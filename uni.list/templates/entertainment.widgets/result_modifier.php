<?
/*$ibid=InitFunctions::getIbIDByCode('entertainment_widgets');*/

$props_obj=CIBlockPropertyEnum::GetList(array('SORT'=>'ASC'),array("IBLOCK_ID"=>InitFunctions::getIbIDByCode('entertainment_widgets'),"CODE"=>"WIDGET_TYPE"));
while($props_arr=$props_obj->GetNext()){
	$props_arr['MNAME']=InitFunctions::getEntertainmentMName($props_arr['XML_ID']);
	$arResult['ENTERTAINMENT_TYPES'][$props_arr['ID']]=$props_arr;
}
unset($props_obj,$props_arr);

//mdump($arResult);
//$item['PROPERTY_WIDGET_TYPE_ENUM_ID']);
foreach($arResult["ITEMS"] as $key=>&$item):
	$item['PROPERTY_WIDGET_TYPE_XML']=$arResult['ENTERTAINMENT_TYPES'][$item['PROPERTY_WIDGET_TYPE_ENUM_ID']]['XML_ID'];
	$item['DATE']=(!empty($item['DATE_ACTIVE_FROM']) ? $item['DATE_ACTIVE_FROM'] : $item['DATE_CREATE']);
	//$item['DATE_INT'] = strtotime($item['DATE']);
	
	switch ($item['PROPERTY_WIDGET_TYPE_XML']){
		case "casting":
			if (isset($item['PROPERTY_EXT_LINK_VALUE'])) {
				$item['URL'] = $item['PROPERTY_EXT_LINK_VALUE'];
			} else {
				$item['URL'] = InitFunctions::getElementUrlById($item['PROPERTY_LINK_VALUE'], 'casting');
			}
			$item['WIDGET']['BG_CLASS']='violet';
			$item['WIDGET']['PIC_CLASS']='yellow';
			$item['WIDGET']['BUTTON']['TEXT']='участвовать';
			$item['WIDGET']['CATEGORY']='кастинг';
			$item['WIDGET']['PIC']='casting';
			break;
		case "quiz":
			$item['URL']=InitFunctions::getElementUrlById($item['PROPERTY_LINK_VALUE'],'quiz');
			$item['WIDGET']['BG_CLASS']='blue';
			$item['WIDGET']['PIC_CLASS']='yellow';
			$item['WIDGET']['BUTTON']['TEXT']='участвовать';
			$item['WIDGET']['CATEGORY']='викторина';
			$item['WIDGET']['PIC']='quiz';
			break;	
		case "vote":
			$item['URL']=InitFunctions::getElementUrlById($item['PROPERTY_LINK_VALUE'],'vote');
			$item['WIDGET']['BG_CLASS']='yellow';
			$item['WIDGET']['PIC_CLASS']='yellow';
			$item['WIDGET']['BUTTON']['TEXT']='участвовать';
			$item['WIDGET']['CATEGORY']='опрос';
			$item['WIDGET']['PIC']='vote';
			break;
		case "test":
			$item['URL']=InitFunctions::getElementUrlById($item['PROPERTY_LINK_VALUE'],'test');
			$item['WIDGET']['BG_CLASS']='yellow';
			$item['WIDGET']['PIC_CLASS']='yellow';
			$item['WIDGET']['BUTTON']['TEXT']='участвовать';
			$item['WIDGET']['CATEGORY']='тест';
			$item['WIDGET']['PIC']='test';
			break;
	}
endforeach;

//usort($arResult['ITEMS'], \InitFunctions::cmp_by_key('DATE_INT'));

$banner_type=CIBlockPropertyEnum::GetList(array('SORT'=>'ASC'),array("XML_ID"=>"240x400"))->GetNext();
$q = CIBlockElement::GetList(
		$_order,
		array(
				'ACTIVE'      => "Y",
				'ACTIVE_DATE' => "Y",
				'IBLOCK_CODE' => "banners",
				'PROPERTY_TYPE_OF_BANNER_VALUE' => array(
						$banner_type['ID']
				)
		),
		false,
		array('nTopCount'=>count($ar_blocks)),
		array(
				'ID',
				'NAME',
				'SORT',
				'PROPERTY_URL',
				'DETAIL_TEXT',
				'DETAIL_PICTURE',
				'PROPERTY_TYPE_OF_BANNER',
				'PROPERTY_MIN_AGE'
		)
);
if ( $banners_ar = $q->GetNext() ) {
	$banners_ar['PROPERTY_WIDGET_TYPE_XML']     = "banner240";
	$banners_ar['URL']      = $banners_ar['PROPERTY_URL_VALUE'];
	$banners_ar['PICTURE']  = CFile::GetPath($banners_ar['DETAIL_PICTURE']);
}
$tvprogramm['PROPERTY_WIDGET_TYPE_XML']     = "tvprogramm";
$tvprogramm['PROJECTS'] = VideomoreTVProgram::getInstance()->getNProjects(4);
$tvprogramm['PROJECT']  = InitFunctions::getProjectByVPId($tvprogramm['PROJECTS'][0]->vm_project_id);
$tvprogramm['PICTURE']  = $tvprogramm['PROJECT']['PROPERTY_BANNER_IN_WIDGET_SRC'];
$tvprogramm['GENRE']  = $tvprogramm['PROJECTS'][0]->genre;
//mdump($tvprogramm);
$arResult["R_COLUMN_ITEMS"]=Array();//правая колонка, баннер, программа, соцсетки
$arResult["R_COLUMN_ITEMS"][]=$banners_ar;//добавляем блок 240 баннера
if(!$arParams['TYPE'])
	$arResult["R_COLUMN_ITEMS"][]=array("PROPERTY_WIDGET_TYPE_XML"=>"social");//добавляем блок соцсеточек
$arResult["R_COLUMN_ITEMS"][]=$tvprogramm;//добавляем блок телепрограммы

?>