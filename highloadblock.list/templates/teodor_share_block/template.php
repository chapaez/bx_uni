<link rel="stylesheet" type="text/css" href="/bitrix/components/custom/highloadblock.list/templates/teodor_share_block/styles.css">
<div class="b-img_share-gif">
    <figure>
        <img src="<?= $_SERVER['HTTP_ORIGIN'] . $arResult['rows'][0]['UF_GIF_IMAGE_SRC']?>">
    </figure>
</div>
<?
global $share_phrase, $share_url;
//$share_url="'http://' + location.host + window.parent.location.pathname+'?share=".$arResult['rows'][0]['UF_HASH']."&share_type=gif'";
$share_url="'https://' + location.host + window.location.pathname+'?share=".$arResult['rows'][0]['UF_HASH']."&share_type=gif'";
?>


<?
$share_phrase='Пошарь кота!';
require($_SERVER['DOCUMENT_ROOT'].'/includes/shares_beautiful.php');?> 