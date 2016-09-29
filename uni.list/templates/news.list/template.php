<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if ( count($arResult["ITEMS"]) > 0 ):

?>
    <div class="list-wrapper clearfix">
        	<div class="item">
            <? foreach($arResult["ITEMS"] as $key=>$item):
            	$url = InitFunctions::getElementUrlById($item["ID"],$arParams['IBLOCK_CODE']);
            	?>
                <?if ( $key%2 == 0 && $key != 0 ) echo '</div><div class="item">';?>
                <div class="list_item col-sm-6">
                    <div class="image shadow">
                    	<a href="<?=$url?>" class="image">
                    	<img src="<?=$item['DETAIL_PICTURE_SRC']?>" class="img-responsive"/>
	                    </a>
	                </div>
                    <div class="active_from"><?=substr($item["DATE_ACTIVE_FROM"],0,10)?></div>
                    <div class="name"><a href="<?=$url?>"><?=$item['NAME']?></a></div>
                    <div class="description"><?=InitFunctions::smart_cut_text_clean_new($item["DETAIL_TEXT"], 100)?></div>
                    
                </div>
            <? endforeach; ?>
			</div>

        <?=$arResult["NAV_STRING"]?>
    </div>
<? endif; ?>
<?/*<div class="seo-wrapper"><?=InitFunctions::getSeoText()?></div>*/?>