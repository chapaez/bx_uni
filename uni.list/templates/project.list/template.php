<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if ( count($arResult["ITEMS"]) > 0 ):
?>

<div class="projects left_column">

	    <div class="project_news__all">
	        <a href="<?=PROJECTS_URL?>" class="<?=(!$_REQUEST["filter"]) ? " button yellow-blue" : "" ?>">актуальные</a>
	        <a href="<?=PROJECTS_URL?>?filter=all" class="<?=($_REQUEST["filter"]) ? "button yellow-blue" : "" ?>">ВСЕ</a>
	    </div>
    
    <div class="project-list-wrapper">
    	<div class="item">
            <? foreach($arResult["ITEMS"] as $key=>$item):
            	$type = InitFunctions::getXmlIdsByID($item["PROPERTY_TYPE_OF_PROJECT_ENUM_ID"]);
            	$url = PROJECTS_URL.$type['XML_ID']."/".$item["CODE"]."/";
            	?>
                <?if ( $key%2 == 0 && $key != 0 ) echo '</div><div class="item">';?>
                <div class="project_list__item">
                    <div class="image shadow"><a href="<?=$url?>" class="image">
                    	<?
                    	if($item['PROPERTY_BADGES_VALUE']=="Премьера"){?>
                    		<div class="premier plashka"></div>
                    		<?
                    	}?>
                    	<img src="<?=CFile::GetPath($item['PROPERTY_BANNER_IN_WIDGET_VALUE'])?>" class="img-responsive"/></a></div>
                    <div class="name"><a href="<?=$url?>"><?=$item['NAME']?></a></div>
                    <div class="info">
                    	<span class="genre"><?=$item['PROPERTY_GENRES_VALUE']?></span>
	                    <span class="min_age">
		    				<span class="back"></span>
		    				<span class="val"><?=$item['PROPERTY_MIN_AGE_VALUE']?></span>
		    			</span>	
                    </div>
                </div>
            <? endforeach; ?>
		</div>
        <?=$arResult["NAV_STRING"]?>
    </div>
</div>
<? endif; ?>