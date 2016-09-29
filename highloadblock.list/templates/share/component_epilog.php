<?
if ( count($arResult['rows']) > 0 && ($arResult['rows'][0]['~UF_URL']=='' || $_SERVER['SHORT_TRUE_URL'] == urldecode($arResult['rows'][0]['UF_URL']))) {

    $APPLICATION->SetPageProperty('OGP_IMAGE', CFile::GetPath($arResult['rows'][0]['~UF_IMAGE']));
    if (strlen($arResult['rows'][0]['~UF_NAME']) > 0)
        $APPLICATION->SetPageProperty("OGP_TITLE", $arResult['rows'][0]['UF_NAME']);

    if (strlen($arResult['rows'][0]['~UF_DESCRIPTION']) > 0)
        $APPLICATION->SetPageProperty("OGP_DESCRIPTION", $arResult['rows'][0]['UF_DESCRIPTION']);
    
    if ($_GET['share_type'] == 'gif') {
        $APPLICATION->SetPageProperty('OGP_URL', 'https://'.$_SERVER['SERVER_NAME'].CFile::GetPath($arResult['rows'][0]['~UF_GIF_IMAGE']));
        
        //gif by video meta
        $gif_ar = CFile::GetFileArray($arResult['rows'][0]['~UF_GIF_IMAGE']);
        $ogp = '<meta property="og:type" content="video.other">
                <meta property="og:image" content="http://' . $_SERVER['SERVER_NAME'] . $gif_ar['SRC'] . '">
                <meta property="og:image:url" content="http://' . $_SERVER['SERVER_NAME'] . $gif_ar['SRC'] . '">
                <meta property="og:image:secure_url" content="https://' . $_SERVER['SERVER_NAME'] . $gif_ar['SRC'] . '">
                <meta property="og:image:width" content="'.$gif_ar['WIDTH'].'">
                <meta property="og:image:height" content="'.$gif_ar['HEIGHT'].'">';
 
        if($_GET["type"]=='odk' && $arResult['rows'][0]['~UF_BIG_IMAGE']) {
            $jpeg_ar = CFile::GetFileArray($arResult['rows'][0]['~UF_BIG_IMAGE']);
            $ogp .= '<meta property="og:type" content="video">
                <meta property="og:image" content="https://' . $_SERVER['SERVER_NAME'] . $jpeg_ar['SRC'] . '">
                <meta property="og:image:width" content="' . $jpeg_ar['WIDTH'] . '">
                <meta property="og:image:height" content="' . $jpeg_ar['HEIGHT'] . '">';
        }else {
            $jpeg_ar = CFile::GetFileArray($arResult['rows'][0]['~UF_IMAGE']);
            $ogp .= '<meta property="og:type" content="video">
                <meta property="og:image" content="https://' . $_SERVER['SERVER_NAME'] . $jpeg_ar['SRC'] . '">
                <meta property="og:image:width" content="' . $jpeg_ar['WIDTH'] . '">
                <meta property="og:image:height" content="' . $jpeg_ar['HEIGHT'] . '">';
        }
        $APPLICATION->SetPageProperty('OGP_ADDITIONAL', $ogp);
        
        $twitter_card = '<meta name="twitter:card" content="player">
                         <meta name="twitter:title" content="'.$APPLICATION->GetProperty('OGP_TITLE').'">
                         <meta name="twitter:site" content="@ctclove">
                         <meta name="twitter:description" content="'.InitFunctions::smart_cut_text(strip_tags($APPLICATION->GetProperty('OGP_DESCRIPTION')),200).'">
                         <meta name="twitter:player" content="https://'.$_SERVER['SERVER_NAME'].'/services/twitter_iframe/'.$arResult['rows'][0]['UF_HASH'].'">
                         
                         
                         ';
        $APPLICATION->SetPageProperty('OGP_TWITTER_MEDIA',$twitter_card);
        
        
        
    } else {
        $APPLICATION->SetPageProperty('OGP_URL', $_SERVER['TRUE_URL'] . '?share=' . $arResult['rows'][0]['UF_HASH']);
    }
    
    



    SeoStuff::ogp_text();
}
