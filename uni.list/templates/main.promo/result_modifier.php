<?
    foreach ( $arResult['ITEMS'] as $key=>$item ) {
    	
    	
    	$prj = VideomoreTVProgram::getProjectRecentTime($item['PROPERTY_VM_PID_VALUE']);
    	
    	
    	if ( $prj ) {
    		$arResult['ITEMS'][$key]['TIME'] = date('H:i',strtotime($prj->start));
    	}
    	//
        //mdump(VideomoreTVProgram::getProjectRecentTime($item['PROPERTY_VM_PID_VALUE']));
        if ( $item['IBLOCK_CODE'] == "projects" ) {
            $item_type = getXmlIdsByID($item['PROPERTY_TYPE_OF_PROJECT_ENUM_ID']);
            $arResult['ITEMS'][$key]['SLIDER_IMAGE'] = CFile::GetPath($item['PROPERTY_BANNER_IN_SLIDER_VALUE']);
            $arResult['ITEMS'][$key]['URL'] = InitFunctions::getElementUrlById($item['ID'],'projects');
        } else {
        	$arResult['ITEMS'][$key]['SLIDER_IMAGE'] = CFile::GetPath($item['DETAIL_PICTURE']);
            $arResult['ITEMS'][$key]['URL'] = $item['PROPERTY_URL_VALUE'];
        }
    }
?>